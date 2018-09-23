<h1>Редактирование/создание товара</h1>


<script>
    function removeLine(el) {
        var e = $(el);
        e.parent().parent().detach();
    }

    function addLine(el) {
        
        var button = $(el);
        var tr = button.parent().parent();

        
        var template = $("#lineTemplate").clone();
        template.removeAttr("id");

        tr.after(template);
    }
</script>

<table style="display:none;">
        <tr id="lineTemplate">
            <td><input name="param[name][]" value="" /></td>
            <td><input name="param[value][]" value="" /></td>
            <td>
                <button onclick="addLine(this); return false;">Add</button>
                <button onclick="removeLine(this); return false;">Remove</button>
            </td>
        </tr>
</table>

<form method="POST">
    <input type="hidden" name="action" value="edit" />
    <input type="hidden" name="id" value="<?= $MODEL["good"]["id"] ?>" />
    <table>
        <tr>
            <th>Наименование</th>
            <td><input type="text" name="name" value="<?= $MODEL["good"]["name"] ?>" /></td>
        </tr>
        <tr>
            <th>Описание</th>
            <td>
                <textarea name="description"><?= $MODEL["good"]["description"] ?></textarea>
            </td>
        </tr>
        <tr>
            <th>Выберите категорию</th>
            <td>
            
            <select name="category_id">
            <option value="<?= $value["NULL"] ?>" <?php if ($value["id"] == $MODEL["good"]["id"]) echo("selected"); ?> >нет категории</option>  
            <?php foreach($MODEL["good_category"] as $value): ?>
                <option value="<?= $value["id"] ?>" <?php if ($value["id"] == $MODEL["good"]["id"]) echo("selected"); ?> ><?= $value["name"] ?></option> 
            <?php endforeach; ?>
              
	        </select>
             
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Сохранить" />
            </td>
        </tr>
    </table>

    <table>

        <?php foreach($MODEL["params"] as $value): ?>
        <tr>
            <td><input name="param[name][]" value="<?= $value["name"] ?>" /></td>
            <td><input name="param[value][]" value="<?= $value["value"] ?>" /></td>
            <td>
                <button onclick="addLine(this); return false;">Add</button>
                <button onclick="removeLine(this); return false;">Remove</button>
            </td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td><input name="param[name][]" value="" /></td>
            <td><input name="param[value][]" value="" /></td>
            <td>
                <button onclick="addLine(this); return false;">Add</button>
                <button onclick="removeLine(this); return false;">Remove</button>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <input type="submit" value="Сохранить" />
            </td>
        </tr>
    </table>
</form>


<?php

    if ($MODEL["good"]["id"] != 0) 
        echo $this->drawRoute("pic", "edit", [
            "module" => "good",
            "id" => $MODEL["good"]["id"]
        ]);

?>

