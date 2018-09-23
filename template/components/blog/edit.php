<div>
    <h1>Редактирование записи</h1>
    <form method="POST">
        <input type="hidden" name="action" value="editSave" />
        <input type="hidden" name="userid" value="<?= $MODEL["id"] ?>" />
        <input type="hidden" name="user" value="<?= $MODEL["user"] ?>" />
        <input type="text" name="header" value="<?= $MODEL["header"] ?>" />
        <textarea name="text" id="editor1"><?= $MODEL["text"] ?></textarea>
        <input type="submit" name="EDIT" value="EDIT"
        
         />
    </form>
</div>

<script>
        ClassicEditor
        .create( document.querySelector( '#editor1' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
</script>