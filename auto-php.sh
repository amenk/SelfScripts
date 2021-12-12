autophp() {
  if [ "$PWD" != "$MYOLDPWD" ]; then
    MYOLDPWD="$PWD";
    BEFORE_BIN=`readlink /etc/alternatives/php`  
    if [ -e "composer.json" ]; then
      VERS=`grep '"php"' composer.json | sed -r 's/.*([0-9]\.[0-9]*)\..*/\1/g'`

      if [ "$VERS" == "" ]; then
        echo "!!! composer.json found, but no PHP version fixed"
        return; 
      fi

      WANTS_BIN=/usr/bin/php$VERS

      if [ "$BEFORE_BIN" != "$WANTS_BIN" ]; then
         echo === Enabling PHP $VERS - before: $BEFORE_BIN ===;
         sudo update-alternatives --set php $WANTS_BIN
      fi
    fi
  fi
}

export PROMPT_COMMAND=autophp;$PROMPT_COMMAND
