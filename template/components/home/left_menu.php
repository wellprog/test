<div id="directions_menu" class="mt10 mb10">
    <ul id="yw7" class="nav nav-list">

        <?php foreach ($MODEL as $v): ?>
            <li class="listItem red parent">
                <a class="listItemLink" href="<?= $v["url"] ?>"><?= $v["name"] ?></a>
            </li>            
        <?php endforeach; ?>
        <!--
        <li class="listItem red parent">
            <a class="listItemLink" href="http://www.rubiconepro.ru/kompyuternye-kursy">Компьютерные курсы</a>
        </li>
        <li class="listItem green parent">
            <a class="listItemLink" href="http://www.rubiconepro.ru/kursy-angliyskogo">Курсы английского</a>
        </li>
        <li class="listItem yellow parent">
            <a class="listItemLink" href="http://www.rubiconepro.ru/">Подготовка к ОГЭ и ЕГЭ</a>
        </li>
        <li class="listItem blue parent">
            <a class="listItemLink" href="http://www.rubiconepro.ru/">Дополнительное развитие</a>
        </li>
        -->
    </ul>
</div>