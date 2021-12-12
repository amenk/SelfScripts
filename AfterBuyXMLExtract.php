<?php

/**
 * Extracts an afterbuy Theme XML file
 */
$xml = simplexml_load_file('AfterBuyDump.xml');

foreach($xml->ShopDesign->children() as $name=>$element) {
    $name = 'dump/' . $name;
    if (strpos($name, 'XSL') !== false) {
        $name .= '.xsl';
    }
    file_put_contents($name, base64_decode((string)$element));
}
