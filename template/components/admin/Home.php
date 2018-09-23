<div class="col-lg-9 col-sm-8">
    <div class="white_bg border5 mb30 shadow p20 text text-blue">
        <h1>Редактирование главной страницы</h1>
        <form method="POST">
        
            <textarea name="text" id="editor"><?= $MODEL["text"] ?></textarea>
            <textarea name="text1" id="editor1"><?= $MODEL["text1"] ?></textarea>
            <input type="submit" />

        </form>
    </div>
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
    ClassicEditor
    .create( document.querySelector( '#editor1' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
</script>