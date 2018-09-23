<h1>
    Картинки (Добавление/Удаление/Редактирование (TODO))
</h1>

<table>
    <tr>
        <th>id</th>
        <th>Название</th>
        <th>Категория</th>
        <th>Картинка</th>
        <th>Действие</th>
    </tr>
    <?php foreach ($MODEL["pics"] as $value): ?>
    <tr>
        <td><?= $value["id"] ?></td>
        <td><?= $value["name"] ?></td>
        <td><?= $value["cat"] ?></td>
        <td><img src="<?= $value["link"] ?>" /> </td>
        <td>Удалить</td>
    </tr>
    <?php endforeach; ?>
</table>

<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="pic_add" />
    <table>
        <tr>
            <th>Название картинки</th>
            <td><input type="text" name="pic_name"></td>
        </tr>
        <tr>
            <th>Категория картинки</th>
            <td><input type="text" name="pic_cat"></td>
        </tr>
        <tr>
            <th>Загрузка картинки</th>
            <td><input type="file" name="file"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Отправить" />
            </td>
        </tr>
    </table>
</form>