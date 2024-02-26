# CKEditor 5 build for NukeViet 4.5

## Yêu cầu:

- Node.js 18.0.0+
- npm 5.7.1+
- git

### Cài đặt

Tại một thư mục rỗng chạy lệnh

```bash
git clone https://github.com/nukeviet/ckeditor5-nvbox.git
cd ckeditor5-nvbox
npm install
cd  ../
git clone https://github.com/nukeviet/nukeviet45-ckeditor5-classic.git
cd nukeviet45-ckeditor5-classic
npm i @nukeviet/ckeditor5-nvbox
```

Tại thư mục có chứa hai thư mục đã cài là ckeditor5-nvbox và nukeviet45-ckeditor5-classic tạo file build.sh có nội dung như sau  

```
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
DIR_PATH=$PWD

cd "$DIR_PATH/ckeditor5-nvbox"

npm run build
if [[ $? > 0 ]]; then
  echo "Build NVBox error!!!"
  exit
fi

rm -rf "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvbox/src"
rm -rf "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvbox/lang"

mkdir -p "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvbox/src"
mkdir -p "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvbox/lang"

cp -R "$DIR_PATH/ckeditor5-nvbox/src/" "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvbox/"
cp -R "$DIR_PATH/ckeditor5-nvbox/lang/" "$DIR_PATH/nukeviet45-ckeditor5-classic/node_modules/@nukeviet/ckeditor5-nvbox/"

find "$DIR_PATH/ckeditor5-nvbox/src" -name "*.js" -type f | xargs /bin/rm -f
find "$DIR_PATH/ckeditor5-nvbox/src" -name "*.js.map" -type f | xargs /bin/rm -f
find "$DIR_PATH/ckeditor5-nvbox/src" -name "*.d.ts" -type f | xargs /bin/rm -f

cd "$DIR_PATH/nukeviet45-ckeditor5-classic/"
npm run build
```

### Build

Chạy `bash build.sh`

Sau khi build thành công thì thư mục `nukeviet45-ckeditor5-classic/build` sẽ chứa 1 file js và 1 file thư mục language. Nó chính là trình soạn thảo sẽ dùng.

Nếu bạn chạy trên localhost hoặc hosting có thể test bản build bằng cách vào http://localhost/thu-muc/nukeviet45-ckeditor5-classic/test/ để chạy test thử nghiệm trình soạn thảo.

## Tính năng hay:

- Hỗ trợ định dạng tự động markdown ví dụ gõ # Tiêu đề nó sẽ chuyển thành H1

## Giấy phép

Xem LICENSE.md
