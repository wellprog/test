<h1>good_category</h1>

<style>
    .vtable {
        width: 100%;
    }
</style>

<div>
    <table class="vtable">
        <tr>
            <th>ID категории</th>
            <th>Наименование категории</th>
            <th>Описание категории</th>
            <th>Действия</th>
        </tr>
        
        <?php foreach($MODEL["good_category"] as $value): ?>
        <tr>
            <td><?= $value["id"] ?></td>
            <td><?= $value["name"] ?></td>
            <td><?= $value["description"] ?></td>
            <td>
                <form method="GET" action="/good_manager/edit_category/<?= $value["id"] ?>">
                    <input type="submit" value="Редактировать" />
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        
        <tr>
            <td colspan="4">
                <form method="GET" action="/good_manager/edit_category">
                    <input type="submit" value="Создать" />
                </form>
            </td>
        </tr>
    </table>
</div>