<script type="text/javascript">
    $('#title').on('blur', function(){
        $val = $(this).val();
        $var = $val.toLowerCase().replace(/[^a-z0-9]/gi,'-');
        $('#text-slug').text($var);
        $('#slug').val($var);
    });
    $('#text-slug').on('click', function(){
        $(this).hide();
        $('#input-slug').show();
    });
    $('#simpan_slug').on('click', function(){
        $val = $('#slug').val();
        $var = $val.toLowerCase().replace(/[^a-z0-9]/gi,'-');
        $('#text-slug').text($var);
        $('#input-slug').hide();
        $('#text-slug').show();
    });
    $('#close_slug').on('click', function(){
        $('#input-slug').hide();
        $('#text-slug').show();
    });
</script>
