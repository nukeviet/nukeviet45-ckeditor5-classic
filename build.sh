#!/bin/bash

SOURCE="${BASH_SOURCE[0]}"
while [ -h "$SOURCE" ]; do
  TARGET="$(readlink "$SOURCE")"
  if [[ $TARGET == /* ]]; then
    SOURCE="$TARGET"
  else
    DIR="$( dirname "$SOURCE" )"
    SOURCE="$DIR/$TARGET"
  fi
done
DIR="$( cd -P "$( dirname "$SOURCE" )" >/dev/null 2>&1 && pwd )"
DIR_PATH=$PWD

if ! [ -x "$(command -v npm)" ]; then
    echo "NPM not installed!!!"
    exit
fi
if ! [ -x "$(command -v yarn)" ]; then
    echo "Install yarn as global"
    npm install --global yarn
fi

rm -rf "$DIR_PATH/build"

if [ ! -z "$1" ] || [ ! -d "$DIR_PATH/node_modules" ]; then
    echo "Reinit repository"
    rm -rf "$DIR_PATH/node_modules"
    rm -f "$DIR_PATH/yarn.lock"
    rm -f "$DIR_PATH/package-lock.json"
    npm install --save https://github.com/nukeviet/ckeditor5-nvbox.git
    yarn install
fi

echo "Begin build"
yarn run build
