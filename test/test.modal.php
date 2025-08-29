<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2023 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

define('NV_SYSTEM', true);
define('NV_ROOTDIR', pathinfo(str_replace(DIRECTORY_SEPARATOR, '/', __FILE__), PATHINFO_DIRNAME));

require NV_ROOTDIR . '/mainfile.php';

$bodyhtml = htmlspecialchars(file_get_contents(NV_ROOTDIR . '/news.html'));
$bodyhtml = str_replace('[BASE]', NV_BASE_SITEURL, $bodyhtml);

?>

<!DOCTYPE html>
<html lang="vi">

<head>
	<title>Kiểm tra nội dung soạn thảo trong Modal</title>
	<?php include NV_ROOTDIR . '/head.php'; ?>
</head>

<body data-editor="ClassicEditor" data-collaboration="false" data-revision-history="false">
	<header class="bg-dark mb-3">
		<div class="container">
			<div class="centered p-2 d-flex align-items-center">
				<h1 class="mb-0 mt-1"><a class="link-light" href="<?php echo NV_BASE_SITEURL ?>"><img src="<?php echo NV_BASE_SITEURL ?>images/ckeditor5.svg" alt="CKEditor 5 logo">CKEditor 5</a></h1>
				<nav class="ms-3">
					<?php include NV_ROOTDIR . '/nav.php'; ?>
				</nav>
			</div>
		</div>
	</header>
	<div class="container message">
		<div class="centered mb-4">
			<h1>Kiểm tra nội dung soạn thảo trong Modal</h1>
			<p>Trong Bootstrap Modal, thanh Balloon của trình soạn thảo sẽ bị ẩn mất. Để khắc phục cần làm 2 việc:<br>
			1. Thiết lập lại z-index cho <code>--ck-z-panel</code> phải bằng 1055 hoặc hơn.<br>
			2. Thêm <code>data-bs-focus="false"</code> vào thẻ class .modal</p>
		</div>
	</div>
	<div class="container centered">
		<div class="row row-editor">
			<div class="editor-container">
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
					Nhấp để mở Modal
				</button>
				<div class="modal fade" id="exampleModal" data-bs-focus="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl">
						<div class="modal-content">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<form method="post" action="post.php">
									<div class="mb-3">
										<textarea class="editor form-control" rows="10" name="bodyhtml">
											Bôi đen một đoạn text ở đây. Nếu có một thanh công cụ xuất hiện bên trên đoạn text
											được bôi đen và ấn vào một nút công cụ nào đó được thì việc tích hợp đã thành công.
										</textarea>
									</div>
									<div class="text-center">
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Save changes</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include NV_ROOTDIR . '/footer.php'; ?>
	<script>
		(async () => {
			const editorId = 'news_bodyhtml';
			await ClassicEditor
				.create(document.querySelector('.editor'), {
					language: 'vi',
					simpleUpload: {
						uploadUrl: '<?php echo NV_BASE_SITEURL ?>upload.php',
						withCredentials: true,
					},
					nvbox: {
						browseUrl: '<?php echo NV_BASE_SITEURL ?>popup.html?editorid=' + editorId,
						options: {
							noCache: true
						}
					}
				})
				.then(editor => {
					window.nveditor = window.nveditor || [];
					window.nveditor[editorId] = editor;
					if (editor.sourceElement && editor.sourceElement instanceof HTMLTextAreaElement && editor.sourceElement.form) {
						editor.sourceElement.form.addEventListener('submit', event => {
							editor.sourceElement.value = editor.getData();
						});
					}
				})
				.catch(error => {
					console.error(error);
				});

			//console.log(window.nveditor);
		})();
	</script>
</body>

</html>
