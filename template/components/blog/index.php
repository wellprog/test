<div class="col-lg-3 col-sm-4">
    
</div>
<div class="col-lg-9 col-sm-8">
    <div class="white_bg border5 mb30 shadow p20 text text-blue">
        <h1>Выбор блога студента</h1>

        <ul>
            <?php foreach ($MODEL as $v) : ?>
            <li><a href="/blog/user/<?= $v["user"] ?>">Блог пользователя - <?= $v["user"] ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>