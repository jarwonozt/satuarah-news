<script src="{{asset('app-assets/vendors/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('app-assets/vendors/ckeditor/nanospell/autoload.js')}}"></script>
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
    CKEDITOR.replace( 'content', {
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
