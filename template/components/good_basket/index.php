<h1>basket_redact</h1>

<style>
    .basket_table {
        width: 100%;
    }
</style>

<div>
    <table class="basket_table">
        <tr>
            <th>номер</th>
            <th>Наименование товара</th>
            <th>Количество</th>
            <th>Цена</th>
            <th>Действия</th>
        </tr>
        
        <?php foreach($MODEL["goods_basket"] as $value): ?>
        <tr>
            <td><?= $value["id"] ?></td>
            <td><?= $value["name"] ?></td>
            <td><input type="number" value="<?= $value["count"] ?>" /></td>
            <td><?= $value["prise"] ?></td>
            
            <td>
                <form method="POST" action="/good_basket/deleteGoodBasket">
                    <input type="hidden" name="id" value="<?= $value["id"] ?>" />
                    <input type="submit" value="Удалить" />
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        
        
    </table>
</div>