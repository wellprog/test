<h1>Товары по категориям </h1>

<script>
    function changecat (element) {
        var id = element.getAttribute("data");
        document.getElementById("changeCat").setAttribute("value", id);
        document.getElementById("changeCatForm").submit();
    }
</script>
<div class="col-lg-3 col-sm-4">
        <form method="POST" id="changeCatForm">
                <input type="hidden" name="action" value="changeCat" />
                <input type="hidden" name="changeCat" value="" id="changeCat" />
                <!-- <table>
                           
                    <tr>
                        <th>Выберите категорию</th>
                        
                        <td>
                        <select name="changeCat">
                        <option value="<?= $value["NULL"] ?>" <?php if ($value["id"] == $MODEL["good_category"]["id"]) echo("selected"); ?> >нет категории</option>  
                        <?php foreach($MODEL["good_category"] as $value): ?>
                            <option value="<?= $value["id"] ?>" <?php if ($value["id"] == $MODEL["good_category"]["id"]) echo("selected"); ?> ><?= $value["name"] ?></option> 
                        <?php endforeach; ?>
                          
                        </select>
                        </td>
                      
                       <tr>
                        <td>
                                <?php foreach($MODEL["good_category"] as $value): ?>
                               <th><?= $value["name"] ?></th> 
                                <?php endforeach; ?>
                       
                        </td>
                    </tr>
                
                    </tr>
                    
                </table>
            -->

            <div id="directions_menu" class="mt10 mb10">
                    <ul id="yw7" class="nav nav-list">
                
                        <?php foreach ($MODEL["good_category"] as $value): ?>
                            <li class="listItem red parent">
                                <a class="listItemLink" data="<?= $value["id"] ?>" href="/good_manager/showCat/<?= $value["id"] ?>" ><?= $value["name"] ?></a>
                            </li>            
                        <?php endforeach; ?>
                        
                    </ul>
                </div>

                <input type="submit"  />
             </form>            
</div>



 <style>
     .good {
         float: left;
         width: 33%;
         height: 150px;
     }
 </style>


<div class="col-lg-9 col-sm-8">
        <div class="white_bg border5 mb30 shadow p20 text text-blue">
 <?php foreach($MODEL["goodCat"] as $value): ?>
 <div class="good">
 <form method="POST" action="/good_basket/addGoodInBasket">
 <input type="hidden" name="action" value="addBasket" />
    <table>
            <tr>
                <th>Наименование товара</th>
            </tr>
        
        <tr>
                <td>
                    <?= $value["name"] ?>
                </td>
        </tr>
        <tr>
                <td>
                    <?= $value["description"] ?>
                </td>
        </tr>
        <tr>
                <td>
                <input type="hidden" name="id_good_basket" value="<?= $value["id"] ?>" />
                <input type="submit" value="В корзину" />
                </td>
        </tr>
    </table>
</form>
</div>
 <?php endforeach; ?>
 <div style="clear: both;"></div>

</div>
</div>