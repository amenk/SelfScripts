#!/bin/bash -x


# Exports a database while stripping the data of some tables
# Useful for setting up a development system that does not need log-data and so on
# 
# Alexander Menk, 13. Apr 2012
# License: https://github.com/amenk/SelfScripts/blob/master/LICENSE.md


### Configuration

DB=databasename
USER=username
PASS=password

# Tables to strip (export only structure)
STRIP="firstbigtable secondbigtable"



### Main Program

ignore_tables=""

for I in $STRIP
do
	ignore_tables="${ignore_tables} --ignore-table=$DB.$I"
done

mysqldump --no-data --single-transaction -u$USER -p$PASS $DB $STRIP
mysqldump --single-transaction $ignore_tables -u$USER -p$PASS $DB

