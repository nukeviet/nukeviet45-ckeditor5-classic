#!/bin/bash

SOURCE="${BASH_SOURCE[0]}"
while [ -h "$SOURCE" ]; do
  TARGET="$(readlink "$SOURCE")"
  if [[ $TARGET == /* ]]; then
    SOURCE="$TARGET"
  else
    DIR="$(dirname "$SOURCE")"
    SOURCE="$DIR/$TARGET"
  fi
done
DIR="$(cd -P "$(dirname "$SOURCE")" >/dev/null 2>&1 && pwd)"

cd "$DIR/../"
DIR_PATH=$PWD

PLUGINS=("nvmedia" "nviframe" "nvdocs" "nvtools" "nvbox")

# Build các plugin cần thiết
for plugin in "${PLUGINS[@]}"; do
  cd "$DIR_PATH/ckeditor5-$plugin"

  rm -rf ./node_modules
  rm -rf ./package-lock.json
  npm install

  if [[ $? > 0 ]]; then
    echo "Install $plugin error!!!"
    exit
  fi
done

cd "$DIR_PATH/nukeviet45-ckeditor5-classic"
rm -rf ./node_modules
rm -rf ./package-lock.json
npm install

if [[ $? > 0 ]]; then
  echo "Install error!!!"
  exit
fi

bash ./build.sh
