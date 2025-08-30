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

# Build các plugin cần thiết
PLUGINS=("ckeditor5-nvbox" "ckeditor5-nvmedia")
for plugin in "${PLUGINS[@]}"; do
  cd "$DIR_PATH/$plugin"
  npm run prepare
  if [[ $? > 0 ]]; then
    echo "Prepare $plugin error!!!"
    exit
  fi
done

# Chép sang
PLUGINS_TO_COPY=("nvbox" "nvmedia")
for plugin in "${PLUGINS_TO_COPY[@]}"; do
  rm -rf "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-$plugin/dist"
  mkdir -p "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-$plugin/dist"
  cp -R "$DIR_PATH/ckeditor5-$plugin/dist/" "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-$plugin/"
done

# Build trình soạn thảo
cd "$DIR_PATH/nukeviet45-ckeditor5-classic/"
npm run build
if [[ $? > 0 ]]; then
  echo "Build CKEditor error!!!"
  exit
fi
