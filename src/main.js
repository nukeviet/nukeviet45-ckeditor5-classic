import {
	ClassicEditor,
	Alignment,
	Autoformat,
	AutoImage,
	Autosave,
	BalloonToolbar,
	BlockQuote,
	Bold,
	Bookmark,
	CloudServices,
	Code,
	CodeBlock,
	Emoji,
	Mention,
	Essentials,
	FindAndReplace,
	FontBackgroundColor,
	FontColor,
	FontFamily,
	FontSize,
	Fullscreen,
	GeneralHtmlSupport,
	Heading,
	Highlight,
	HorizontalLine,
	HtmlComment,
	ImageBlock,
	ImageCaption,
	ImageInline,
	ImageInsertViaUrl,
	ImageResize,
	ImageStyle,
	ImageTextAlternative,
	ImageToolbar,
	ImageUpload,
	Indent,
	IndentBlock,
	Italic,
	Link,
	LinkImage,
	List,
	ListProperties,
	Paragraph,
	PasteFromMarkdownExperimental,
	PasteFromOffice,
	PlainTableOutput,
	PageBreak,
	RemoveFormat,
	ShowBlocks,
	SourceEditing,
	SpecialCharacters,
	SpecialCharactersArrows,
	SpecialCharactersCurrency,
	SpecialCharactersEssentials,
	SpecialCharactersLatin,
	SpecialCharactersMathematical,
	SpecialCharactersText,
	Strikethrough,
	Subscript,
	Superscript,
	Table,
	TableCaption,
	TableCellProperties,
	TableColumnResize,
	TableLayout,
	TableProperties,
	TableToolbar,
	TextTransformation,
	Underline,
	WordCount,
	SimpleUploadAdapter
} from 'ckeditor5';

// CSS
import 'ckeditor5/ckeditor5.css';
import '@nukeviet/ckeditor5-nvmedia/index.css';
import '@nukeviet/ckeditor5-nviframe/index.css';
import '@nukeviet/ckeditor5-nvdocs/index.css';
import '@nukeviet/ckeditor5-nvtools/index.css';
import '@nukeviet/ckeditor5-nvbox/index.css';

// Plugin của NukeViet
import { NVMedia, NVMediaInsert } from '@nukeviet/ckeditor5-nvmedia';
import { NVBox } from '@nukeviet/ckeditor5-nvbox';
import { NVIframe, NVIframeInsert } from '@nukeviet/ckeditor5-nviframe';
import { NVDocs, NVDocsInsert } from '@nukeviet/ckeditor5-nvdocs';
import { NVTools } from '@nukeviet/ckeditor5-nvtools';

const editorConfig = {
	toolbar: {
		items: [
			'undo',
			'redo',
			'selectAll',
			'|',
			'link',
			'bookmark',
			'imageInsert',
			'nvmediaInsert',
			'nvbox',
			'insertTable',
			'nviframeInsert',
			'nvdocsInsert',
			'code',
			'codeBlock',
			'horizontalLine',
			'specialCharacters',
			'pageBreak',
			'|',
			'findAndReplace',
			'showBlocks',
			'|',
			'bulletedList',
			'numberedList',
			'outdent',
			'indent',
			'blockQuote',
			'heading',
			'fontSize',
			'fontFamily',
			'fontColor',
			'fontBackgroundColor',
			'highlight',
			'alignment',
			'|',
			'bold',
			'italic',
			'underline',
			'emoji',
			'strikethrough',
			'subscript',
			'superscript',
			'|',
			'sourceEditing',
			'nvtools',
			'removeFormat',
			'fullscreen'
		],
		// TODO: NukeViet đang để editor trong table, set lên false sẽ vỡ màn hình. Bản 5.0 hoàn thiện đặt false
		shouldNotGroupWhenFull: true
	},
	plugins: [
		Alignment,
		Autoformat,
		AutoImage,
		Autosave,
		BalloonToolbar,
		BlockQuote,
		Bold,
		Bookmark,
		CloudServices,
		Code,
		CodeBlock,
		PageBreak,
		Emoji,
		Mention,
		Essentials,
		FindAndReplace,
		FontBackgroundColor,
		FontColor,
		FontFamily,
		FontSize,
		Fullscreen,
		GeneralHtmlSupport,
		Heading,
		Highlight,
		HorizontalLine,
		HtmlComment,
		ImageBlock,
		ImageCaption,
		ImageInline,
		ImageInsertViaUrl,
		ImageResize,
		ImageStyle,
		ImageTextAlternative,
		ImageToolbar,
		ImageUpload,
		Indent,
		IndentBlock,
		Italic,
		Link,
		LinkImage,
		List,
		ListProperties,
		Paragraph,
		PasteFromMarkdownExperimental,
		PasteFromOffice,
		PlainTableOutput,
		RemoveFormat,
		ShowBlocks,
		SourceEditing,
		SpecialCharacters,
		SpecialCharactersArrows,
		SpecialCharactersCurrency,
		SpecialCharactersEssentials,
		SpecialCharactersLatin,
		SpecialCharactersMathematical,
		SpecialCharactersText,
		Strikethrough,
		Subscript,
		Superscript,
		Table,
		TableCaption,
		TableCellProperties,
		TableColumnResize,
		TableLayout,
		TableProperties,
		TableToolbar,
		TextTransformation,
		Underline,
		WordCount,
		NVIframe,
		NVIframeInsert,
		NVDocs,
		NVDocsInsert,
		NVBox,
		NVMedia,
		NVMediaInsert,
		NVTools,
		SimpleUploadAdapter
	],
	balloonToolbar: ['undo', 'redo', '|', 'bold', 'italic', '|', 'link', '|', 'bulletedList', 'numberedList'],
	fontFamily: {
		supportAllValues: true
	},
	fontSize: {
		options: [10, 12, 14, 'default', 18, 20, 22],
		supportAllValues: true
	},
	fullscreen: {
		onEnterCallback: container =>
			container.classList.add(
				'editor-container',
				'editor-container_classic-editor',
				'editor-container_include-style',
				'editor-container_include-word-count',
				'editor-container_include-fullscreen',
				'main-container'
			)
	},
	heading: {
		options: [
			{ model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
			{ model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
			{ model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
			{ model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
			{ model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
			{ model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
			{ model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' },
		]
	},
	htmlSupport: {
		disallow: [{
			name: /.*/,
			attributes: [ /^on.*/ ]
		}, {
			name: /.*/,
			attributes: [
				'action',
				'background',
				'codebase',
				'dynsrc',
				'lowsrc',
				'allownetworking',
				'allowscriptaccess',
				'fscommand',
				'seeksegmenttime'
			]
		}, {
			name: /^(script|style|link)$/
		}],
		allow: [{
			name: /.*/, // Mặc định cho phép toàn bộ các thẻ
			attributes: true, // Mặc định cho phép hết các thuộc tính, ngoài trừ các cái bị cấm bên trên
			classes: true, // Mặc định cho phép mọi class
			styles: true // Mặc định cho phép mọi inline-css
		}]
	},
	image: {
		toolbar: [
			'toggleImageCaption',
			'imageTextAlternative',
			'|',
			'imageStyle:inline',
			'imageStyle:block',
			'imageStyle:side',
			'imageStyle:wrapText',
			'imageStyle:breakText',
			'|',
			'resizeImage',
			'linkImage'
		]
	},
	licenseKey: 'GPL',
	link: {
		addTargetToExternalLinks: true,
		defaultProtocol: 'https://',
		decorators: {
			toggleDownloadable: {
				mode: 'manual',
				label: 'Downloadable',
				attributes: {
					download: 'file'
				}
			}
		}
	},
	list: {
		properties: {
			styles: true,
			startIndex: true,
			reversed: true
		}
	},
	table: {
		contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
	},
	updateSourceElementOnDestroy: false,
	iframe: {
		attributes: {
			sandbox: 'allow-scripts allow-same-origin allow-forms allow-presentation allow-popups',
			allow: 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share',
			frameborder: '0',
			referrerpolicy: 'strict-origin-when-cross-origin',
			allowfullscreen: true
		}
	}
};

ClassicEditor.defaultConfig = editorConfig;

// Tắt tự động cập nhật textarea khi submit để dùng editor.getData() thay thế
ClassicEditor.prototype.updateSourceElement = function() {}

export default ClassicEditor;
