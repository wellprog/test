<?php
    $nodes = $MODEL;
?>

<ul>
    <?php foreach($nodes as $value): ?>
    <li>
        <a href="<?= $value["url"] ?>">
            <?= $value["title"] ?>
        </a>
    </li>
    <?php endforeach; ?>
</ul>