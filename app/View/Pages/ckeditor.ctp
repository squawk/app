CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For the complete reference:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// See the most common block elements.
	//config.format_tags = 'p;h1;h2;h3';

	// Make dialogs simpler.
	config.removeDialogTabs = 'image:advanced;link:advanced';

	config.toolbarGroups = [
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'tools' },
		{ name: 'document', groups: [ 'mode' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ] },
		{ name: 'styles' },
		{ name: 'colors' }
	];

	config.allowedContent = true;

	config.fillEmptyBlocks = false;

	config.filebrowserBrowseUrl = '/js/kcfinder/browse.php?type=files';
    config.filebrowserImageBrowseUrl = '/js/kcfinder/browse.php?type=images';
    config.filebrowserFlashBrowseUrl = '/js/kcfinder/browse.php?type=flash';
    config.filebrowserUploadUrl = '/js/kcfinder/upload.php?type=files';
    config.filebrowserImageUploadUrl = '/js/kcfinder/upload.php?type=images';
	config.filebrowserFlashUploadUrl = '/js/kcfinder/upload.php?type=flash';
};