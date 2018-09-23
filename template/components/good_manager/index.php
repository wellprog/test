<h1>good_manager</h1>

<style>
    .vtable {
        width: 100%;
    }
</style>

<div>
    <table class="vtable">
        <tr>
            <th>ID товара</th>
            <th>Наименование товара</th>
            <th>Описание товара</th>
            <th>Действия</th>
        </tr>
        
        <?php foreach($MODEL["goods"] as $value): ?>
        <tr>
            <td><?= $value["id"] ?></td>
            <td><?= $value["name"] ?></td>
            <td><?= $value["description"] ?></td>
            <td>
                <form method="GET" action="/good_manager/edit/<?= $value["id"] ?>">
                    <input type="submit" value="Редактировать" />
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        
        <tr>
            <td colspan="4">
                <form method="GET" action="/good_manager/edit">
                    <input type="submit" value="Создать" />
                </form>
            </td>
        </tr>
    </table>
</div>