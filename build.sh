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

cd "$DIR_PATH/ckeditor5-nvbox"
npm run build
if [[ $? > 0 ]]; then
  echo "Build NVBox error!!!"
  exit
fi

cd "$DIR_PATH/ckeditor5-nvmedia"
npm run build
if [[ $? > 0 ]]; then
  echo "Build NVMedia error!!!"
  exit
fi

cd "$DIR_PATH/ckeditor5-nvtools"
npm run build
if [[ $? > 0 ]]; then
  echo "Build NVTools error!!!"
  exit
fi

#git add ./src/*
#git commit -m "Update build NVBox"
#git push
#if [[ $? > 0 ]]; then
#  echo "Push NVBox to repo error!!!"
#  exit
#fi

# Xử lý plugin nvbox
rm -rf "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvbox/lang"
rm -rf "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvbox/src"

mkdir -p "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvbox/lang"
mkdir -p "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvbox/src"

cp -R "$DIR_PATH/ckeditor5-nvbox/lang/" "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvbox/"
cp -R "$DIR_PATH/ckeditor5-nvbox/src/" "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvbox/"

find "$DIR_PATH/ckeditor5-nvbox/src" -name "*.js" -type f | xargs /bin/rm -f
find "$DIR_PATH/ckeditor5-nvbox/src" -name "*.js.map" -type f | xargs /bin/rm -f
find "$DIR_PATH/ckeditor5-nvbox/src" -name "*.d.ts" -type f | xargs /bin/rm -f

# Xử lý plugin nvmedia
rm -rf "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvmedia/lang"
rm -rf "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvmedia/src"
rm -rf "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvmedia/typings"
rm -rf "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvmedia/theme"

mkdir -p "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvmedia/lang"
mkdir -p "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvmedia/src"
mkdir -p "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvmedia/typings"
mkdir -p "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvmedia/theme"

cp -R "$DIR_PATH/ckeditor5-nvmedia/lang/" "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvmedia/"
cp -R "$DIR_PATH/ckeditor5-nvmedia/src/" "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvmedia/"
cp -R "$DIR_PATH/ckeditor5-nvmedia/typings/" "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvmedia/"
cp -R "$DIR_PATH/ckeditor5-nvmedia/theme/" "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvmedia/"

find "$DIR_PATH/ckeditor5-nvmedia/src" -name "*.js" -type f | xargs /bin/rm -f
find "$DIR_PATH/ckeditor5-nvmedia/src" -name "*.js.map" -type f | xargs /bin/rm -f
find "$DIR_PATH/ckeditor5-nvmedia/src" -name "*.d.ts" -type f | xargs /bin/rm -f

# Xử lý plugin nvtools
rm -rf "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvtools/src"

mkdir -p "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvtools/src"

cp -R "$DIR_PATH/ckeditor5-nvtools/src/" "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvtools/"

find "$DIR_PATH/ckeditor5-nvtools/src" -name "*.js" -type f | xargs /bin/rm -f
find "$DIR_PATH/ckeditor5-nvtools/src" -name "*.js.map" -type f | xargs /bin/rm -f
find "$DIR_PATH/ckeditor5-nvtools/src" -name "*.d.ts" -type f | xargs /bin/rm -f

rm -rf "$DIR_PATH/nukeviet45-ckeditor5-classic/build/"

cd "$DIR_PATH/nukeviet45-ckeditor5-classic/"
if [ -z "$1" ]; then
  npm run build
else
  npm run build-dev
fi
if [[ $? > 0 ]]; then
  echo "Build CKEditor error!!!"
  exit
fi
curl -k https://raw.githubusercontent.com/ckeditor/ckeditor5/master/LICENSE.md > "$DIR_PATH/nukeviet45-ckeditor5-classic/build/LICENSE.md"
