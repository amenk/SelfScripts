#!/bin/bash

# CONFIGURATION
EMAIL="$1"

# README
# This Script creates a 7z-encrypted backup of your Bitwarden Vault
# Preperation
# 1. Install the bw client tool
#  sudo snap install bw
# 2. Configure your EMAIL Address above

# SCRIPT


echo -n "Bitwarden Vault $EMAIL Password: "
read -s PW

umask 0077  # make files created reable by the current user only

SESSION=`bw login $EMAIL $PW --raw`
bw export "$PW" --output bitwarden-export-$EMAIL.json --format json --session $SESSION
bw logout
7z a bitwarden-export-$EMAIL.7z -p"$PW" bitwarden-export-$EMAIL.json
rm bitwarden-export-$EMAIL.json
