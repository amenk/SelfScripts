SelfScript Script Collection
============================

*   mysql-stripped-dump.sh

    Template for a script to dumps a MySQL database. For some unimportant tables, only the structure is dumped.

*   clear-magento-cache

    Clear various magento caches. Has support for AIToc extensions.

*   git-extract-patches

    Extracts git commits that contain a certain text (for example ticket number) in the commit message to .patch files

*   exif-date-rename.py

    Rename Pictures (JPEG Photos) to contain the shot-date in the name. The use case is to pass those files to a photo printing company and have the date printed on the back.

*   auto-php.sh

    Automatically switch console PHP version to match composer.json
    Source this in your .bashrc (`source SelfScripts/auto-php.sh`) and `cd` to a PHP project folder -> update-alternatives is called with the current PHP version from composer.json

*  bitwarden-backup

    Script to backup your Bitwarden Vault, encrypted with your Master Passphrase and 7zip

License
=======

For license information see LICENSE.md
