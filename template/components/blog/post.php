<div>
    <h2><?= $MODEL["header"] ?></h2>
    <form method="POST">
        <input type="hidden" name="user" value="<?= $MODEL["user"] ?>" />
        <input type="hidden" name="userid" value="<?= $MODEL["id"] ?>" />
        
        
        <?php if ($MODEL["showDel"]): ?>
        <input type="submit" name="edit" value="edit"  />
        <input type="hidden" name="action" value="delete" />
        <input type="submit" name="delete" value="delete"  />
        <?php endif; ?>
    </form>
    
    
    <div>Дата создания - <?= $MODEL["create_date"] ?></div>
    <?= $MODEL["text"] ?>
</div>