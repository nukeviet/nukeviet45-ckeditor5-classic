# CKEditor 5 build for NukeViet 4.5

## Yêu cầu:

- Node.js 18.0.0+
- npm 5.7.1+
- git
- curl

## Cài đặt

Tại một thư mục rỗng chạy lệnh

```bash
git clone https://github.com/nukeviet/ckeditor5-nvbox.git
cd ckeditor5-nvbox
npm install
cd  ../
git clone https://github.com/nukeviet/ckeditor5-nvmedia.git
cd ckeditor5-nvmedia
npm install
cd  ../
git clone https://github.com/nukeviet/nukeviet45-ckeditor5-classic.git
cd nukeviet45-ckeditor5-classic
npm install
```

## Build

- Tại thư mục nukeviet45-ckeditor5-classic xác định được file build.sh
- Để build nhanh phục vụ test chạy `bash build.sh dev`
- Để build sử dụng chạy `bash build.sh`. Chạy chậm hơn gấp đôi

Sau khi build thành công thì thư mục `nukeviet45-ckeditor5-classic/build` sẽ chứa 1 file js và 1 file thư mục language. Nó chính là trình soạn thảo sẽ dùng.

Nếu bạn chạy trên localhost hoặc hosting có thể test bản build bằng cách vào http://localhost/thu-muc/nukeviet45-ckeditor5-classic/test/ để chạy test thử nghiệm trình soạn thảo.

**Cập nhật phiên bản**

Hướng dẫn chính thức của CKEditor [tại đây](https://ckeditor.com/docs/ckeditor5/latest/updating/guides/updating-ckeditor-5.html)   
Tóm tắt lại cần:

- Đọc mục `MINOR BREAKING CHANGES` trong bản phát hành ([Ví dụ bản này](https://github.com/ckeditor/ckeditor5/releases/tag/v41.1.0)) để xác định xem cần sửa gì cho NVBox và các plugin phát triển của NukeViet không.
- Chỉnh sửa NVBox và các plugin nếu cần thiết
- Sửa phiên bản `dependencies` trong package.json của kho code này và cả nvbox, nvmedia lên bản mới.
- Trong thư mục `nukeviet45-ckeditor5-classic` chạy: 

```bash
rm -rf node_modules
rm -f package-lock.json
npm install
```

- Sau đó build.sh để build

## Tích hợp NukeViet

- Giao diện cần có đủ CSS như trong contents.css
- Tìm chỗ xử lý formXSSsanitize để bỏ qua .ck-button-save nếu không ấn chèn link vào nó sẽ submit cái form
- Ảnh nội dòng, nếu không resize thì sẽ bị bể giao diện nếu quá to. Còn resize lại thì không cần đến JS để chỉnh kích thước ảnh luôn.
- Ảnh nội dòng thì không thể có chú thích ảnh.
- Thêm thẻ mark vào các thẻ HTML được phép

## Tính năng hay

## So sánh với CKEditor 4:

### Thuận lợi, tính năng nay

- Chuyên nghiệp hơn, được tiếp tục cập nhật trong tương lai
- Hỗ trợ định dạng tự động markdown ví dụ gõ # Tiêu đề nó sẽ chuyển thành H1, gõ \*\*nội dung\*\* nó sẽ chuyển thành in đậm...
- Soạn thảo tốc độ và thú vị hơn. Ví dụ: Nhấp chuột vào đối tượng nào thì công cụ của đối tượng đó được hiển thị ngay vị trí đó, giả sử nhấp vào liên kết thì có nút sửa liên kết ngay vị trí con chuột. Nhấp vào ảnh thì công cụ căn ảnh, đổi chú thích nổi lên ngay.
- Hỗ trợ kéo thả thay đổi kích thước ảnh.
- Dùng CSS của trang hiện tại để hiển thị nội dung định dạng, kết quả sẽ sát hơn so với thực tế.
- Công cụ chèn và quản lý bảng tối ưu hơn.
- Chèn và sửa ảnh chỉ bằng 1 thao tác upload trực tiếp.
- Chỉnh sửa table có thể kéo thả và hiển thị không bị vỡ giao diện như CKEditor 4
- Bôi đen một đoạt text, dán link vào nó sẽ tự chuyển thành liên kết

### Tính năng hay nhưng không sử dụng

- Chèn video Youtube, Facebook, Spotify, Instagram, Vimeo, Twitter, Dailymotion; chèn liên kết Google Maps, Flickr chỉ bằng cách copy và dán link vào trình soạn thảo. Nguyên nhân: Yêu cầu dùng các thành phần khác để xử lý như Iframely, Embedly. Trong tương lai có thể nghiên cứu viết lại plugin Iframe, Video, Docviewer trở lại

### Hạn chế

- Mất các tính năng: Tẩy link ngoài, chèn iframe, chèn tài liệu từ Google Docs hoặc Microsoft Office, lấy ảnh về máy chủ, mẫu dựng sẵn.
- Mất tính năng tạo và chỉnh sửa đặt chỗ. Có thể dùng link bình thường để thay thế tuy nhiên không xem và quản lý được như cũ.
- Mất tính năng chèn biểu thức toán học.
- Mất tính năng chèn biểu tượng cảm xúc. Tuy nhiên có thể dùng công cụ của trình soạn thảo để chèn, trên di động thì bàn phím có sẵn.

### Một số vấn đề khi edit một bài viết trước đây của CKEditor 4 trên CKEditor 5

- Phải định dạng lại ảnh, vì template dùng cho ảnh không tương thích. Việc hiển thị ngoài site không ảnh hưởng.

## Giấy phép

Xem LICENSE.md
