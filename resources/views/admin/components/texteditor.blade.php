<script src="{{asset('app-assets-old/vendors/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('app-assets-old/vendors/ckeditor/nanospell/autoload.js')}}"></script>
<script>
    CKEDITOR.replace( 'information', {
        allowedContent: true,
        filebrowserBrowseUrl: '/admin/filemanager',
        filebrowserWindowWidth: '640',
        filebrowserWindowHeight: '480',
        height : '200px',
        toolbar : [
            ['Source','PasteFromWord'],
            ['Cut','Copy'],
            ['Undo','Redo','Find','Replace','SelectAll','RemoveFormat'],
            [ 'Link', 'Unlink', 'Anchor','Image','Embed', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'Iframe', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'],
            [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv' ],
            ['TextColor','BGColor'],
            ['Bold','Italic','Underline','Superscript'],
            ['Styles','Format','Font','FontSize','lineheight','Maximize'],
        ]
    });

    nanospell.ckeditor('all',{
        dictionary : "id",
        server : "php"
    });
</script>
<script>
    CKEDITOR.replace( 'preview', {
        forcePasteAsPlainText: true,
        clipboard_defaultContentType: 'text',
        allowedContent: true,
        height:'110px',
        toolbar :
            [
                ['Source','Cut','Copy','TextColor','BGColor','Bold','Italic','Underline','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','Styles','Format','Font']
            ]
    });

    CKEDITOR.replace( 'content', {
        forcePasteAsPlainText: true,
        clipboard_defaultContentType: 'text',
        allowedContent: true,
        filebrowserBrowseUrl: '/admin/filemanager',
        filebrowserWindowWidth: '1080',
        filebrowserWindowHeight: '720',
        height : '350px',
        toolbar : [
            ['Source','PasteFromWord'],
            ['Cut','Copy'],
            ['Undo','Redo','Find','Replace','SelectAll','RemoveFormat'],
            [ 'Link', 'Unlink', 'Anchor','Image','Embed', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'Iframe', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'],
            [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv' ],
            ['TextColor','BGColor'],
            ['Bold','Italic','Underline','Superscript'],
            ['Styles','Format','Font','FontSize','lineheight','Maximize'],
        ]
    });

    nanospell.ckeditor('all',{
        dictionary : "id",
        server : "php"
    });
</script>
