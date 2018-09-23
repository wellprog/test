<div>
    <h1>Создание записи</h1>
    <form method="POST">
        <input type="hidden" name="user" value="<?= $MODEL ?>" />
        <input type="text" name="header" value="" />
        <textarea name="text" id="editor"></textarea>
        <input type="submit" name="SEND" value="SEND" />
    </form>
</div>

<script>
        ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
</script>