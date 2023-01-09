<?php

/**
 * SEO Mapper
 * Maps old (alt.csv) URLs in best effort to new URLS (neu.csv) for example to create a redirect list on relaunches
 */

$old = file('alt.csv');
$new  = file('neu.csv');


function extractWords($str)
{
    $str = str_replace('index.php', '', $str);
    $str = urldecode($str);
    preg_match_all('/\pL{4,}/iu', $str, $m);
    $words = $m[0];
    return array_map('mb_strtolower', $words);
}

/**
 * Absolute number of matches
 * @param $old
 * @param $new
 *
 * @return int
 */
function match($old, $new) {
    $words1 = extractWords($old);
    $words2 = extractWords($new);
//    echo implode(' ', $words1) . PHP_EOL;
//    echo implode(' ', $words2) . PHP_EOL;

    $matches = count(array_intersect($words1, $words2));

    return $matches;
}


/**
 * Find best matching URL from an old URL and an array of new urls
 *
 * @param $oldUrl
 * @param $new
 *
 * @return string
 */
function findBestFit($oldUrl, $new) {
    $differencesTo = [];
    foreach($new as $newUrl) {
        $differencesTo[$newUrl] = match($oldUrl, $newUrl);
    }
    arsort($differencesTo);
    $value = reset($differencesTo);

    if ($value === 0) {
        return 'default';
    }
    return trim(key($differencesTo));
}



foreach($old as $oldUrl) {
#    $oldUrl = str_replace('http://example-old.com', '', $oldUrl);
    $oldUrl = trim($oldUrl);
    $newUrl = trim($newUrl);
    echo '"' . $oldUrl . '","' . findBestFit($oldUrl, $new) . '"' . PHP_EOL;
}

