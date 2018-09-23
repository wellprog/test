<div class="emtytr">
<table>
<tr>
<th>пустая строка</th>
</tr>
<tr>
<th>пустая строка</th>
</tr>
<tr>
<th>пустая строка</th>
</tr>
<tr>
<th>пустая строка</th>
</tr>


</table>

</div>
<div class="col-lg-3 col-sm-4">
    <table>
        <tr>
            <th>Название пункта</th>
            <th>Ссылка</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($MODEL["items"] as $v): ?>
        <tr>
            <td><?= $v["name"] ?></td>
            <td><?= $v["link"] ?></td>
            <td>

                <?= $this->WriteHTML(
                    [
                        "action" => "delete",
                        "id" => $v["id"],
                        "text" => "Удалить"
                    ], "controls", "button"
                ) ?>

                
                <?= $this->WriteHTML(
                    [
                        "action" => "edit",
                        "id" => $v["id"],
                        "text" => "Редактировать"
                    ], "controls", "button"
                ) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<div class="col-lg-3 col-sm-4">
    <form method="POST" enctype="application/x-www-form-urlencoded" >
        <input type="hidden" name="action" value="add" />
        <input type="hidden" name="id" value="<?= $MODEL["item"]["id"] ?>" />
        <table>
            <tr>
                <th>Название пункта</th>
                <td><input type="text" name="name" value="<?= $MODEL["item"]["name"] ?>" /></td>
            </tr>
            <tr>
                <th>Ссылка</th>
                <td><input type="text" name="link" value="<?= $MODEL["item"]["link"] ?>" /></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" />
                </td>
            </tr>
        </table>
    </form>
</div>