<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle btn btn-default" data-toggle="collapse" data-target="#yii_booster_collapse_yw3"
                id="yw4" name="yt1" type="button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="yii_booster_collapse_yw3">
            <ul id="yw5" class="nav navbar-nav">
                
                <?php foreach($MODEL as $v): ?>
                <li class="listItem top_menu_item menu_item_red active">
                    <a class="listItemLink" href="<?= $v["link"] ?>"><?= $v["name"] ?></a>
                </li>
                <?php endforeach; ?>


                <!--
                <li class="listItem top_menu_item menu_item_green">
                    <a class="listItemLink" href="http://www.rubiconepro.ru/news/">События и акции</a>
                </li>
                <li class="listItem top_menu_item menu_item_yellow">
                    <a class="listItemLink" title="Блоги" href="http://www.rubiconepro.ru/blog/">Блог</a>
                </li>
                <li class="listItem top_menu_item menu_item_blue">
                    <a class="listItemLink" title="Контакты" href="http://www.rubiconepro.ru/contacts/">Контакты</a>
                </li>

                -->
            </ul>
        </div>
    </div>
</nav>