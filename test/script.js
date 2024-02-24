(async () => {
	const editorId = 'news_bodyhtml';
	await ClassicEditor
    .create(document.querySelector('.editor'), {
        language: 'vi',
		simpleUpload: {
			uploadUrl: '/ckeditor/ckeditor5-online-build/test/upload.php',
			withCredentials: true,
		}
    })
    .then(editor => {
		window.nveditor = window.nveditor || [];
        window.nveditor[editorId] = editor;
    })
    .catch(error => {
		console.error(error);
	});

	console.log(window.nveditor);
})();
