<h1>Редактирование/создание категории </h1>



<form method="POST">
    <input type="hidden" name="action" value="edit_category" />
    <input type="hidden" name="id" value="<?= $MODEL["good_category"]["id"] ?>" />
    <table>
        <tr>
            <th>Наименование</th>
            <td><input type="text" name="name" value="<?= $MODEL["good_category"]["name"] ?>" /></td>
        </tr>
        <tr>
            <th>Описание</th>
            <td>
                <textarea name="description"><?= $MODEL["good_category"]["description"] ?></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Сохранить" />
            </td>
        </tr>
    </table>

    
</form>

