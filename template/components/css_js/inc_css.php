<?php
    $files = $MODEL;
?>

<?php foreach ($files as $value): ?>
    <link rel="stylesheet" type="text/css" href="<?= $value ?>" />
<?php endforeach; ?>