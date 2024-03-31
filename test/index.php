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
		<title>CKEditor 5 ClassicEditor for NukeViet 4.5</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="<?php echo NV_BASE_SITEURL ?>favicon.ico">
		<link href="<?php echo NV_BASE_SITEURL ?>css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo NV_BASE_SITEURL ?>css/styles.css">
	</head>
	<body data-editor="ClassicEditor" data-collaboration="false" data-revision-history="false">
		<header class="bg-dark mb-3">
			<div class="container">
				<div class="centered p-2 d-flex align-items-center">
					<h1 class="mb-0 mt-1"><a class="link-light" href="https://ckeditor.com/ckeditor-5/" target="_blank" rel="noopener noreferrer"><img src="<?php echo NV_BASE_SITEURL ?>images/ckeditor5.svg" alt="CKEditor 5 logo">CKEditor 5</a></h1>
					<nav class="ms-3">
						<ul class="list-inline mb-0">
							<li class="list-inline-item"><a class="link-light" href="https://ckeditor.com/docs/ckeditor5/" target="_blank" rel="noopener noreferrer">Documentation</a></li>
							<li class="list-inline-item"><a class="link-light" href="https://ckeditor.com/" target="_blank" rel="noopener noreferrer">Website</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</header>
		<div class="container message">
			<div class="centered mb-4">
				<h1>CKEditor 5 ClassicEditor for NukeViet 4.5 test page</h1>
			</div>
		</div>
		<div class="container centered">
			<div class="row row-editor">
				<div class="editor-container">
					<form method="post" action="post.php">
						<div class="mb-3">
							<textarea class="editor form-control" rows="10" name="bodyhtml"><?php echo $bodyhtml ?></textarea>
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<footer class="mt-3 bg-light">
			<div class="container">
				<div class="p-4">
					<p><a href="https://ckeditor.com/ckeditor-5/" target="_blank" rel="noopener">CKEditor 5</a>
						– Rich text editor of tomorrow, available today
					</p>
					<p>Copyright © 2003-2024,
						<a href="https://cksource.com/" target="_blank" rel="noopener">CKSource</a>
						Holding sp. z o.o. All rights reserved.
					</p>
				</div>
			</div>
		</footer>
		<script src="<?php echo NV_BASE_SITEURL ?>js/jquery.min.js"></script>
		<script src="<?php echo NV_BASE_SITEURL ?>js/bootstrap.bundle.min.js"></script>
		<script src="../build/ckeditor.js"></script>
		<script src="../build/language/vi.js"></script>
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
				})
				.catch(error => {
					console.error(error);
				});

				//console.log(window.nveditor);
			})();
		</script>
	</body>
</html>
