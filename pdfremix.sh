#!/bin/bash

## Assume:

# We have
#
# 1 3 5 7 8 6 4 2 
# and want it in 
# 1 2 3 4 5 6 7 8

NO_OF_PAGES=`pdftk "$1" dump_data | grep NumberOfPages | cut -d " " -f 2`
HALF=`echo $(( $NO_OF_PAGES / 2 ))`


FRONTSIDES=1-$HALF

BACKSIDES=$(( $HALF + 1 ))-$NO_OF_PAGES


pdftk "$1" cat $FRONTSIDES output /tmp/$$fronts.pdf
pdftk "$1" cat ${BACKSIDES}south output /tmp/$$backs.pdf

pdftk A=/tmp/$$fronts.pdf B=/tmp/$$backs.pdf shuffle A Bend-1 output "$1.remixed.pdf"
