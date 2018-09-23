<?php
    if (!is_array($MODEL["posts"])) {
        $MODEL["posts"] = [];
    }
?>
<div class="col-lg-3 col-sm-4">
    
    </div>
    <div class="col-lg-9 col-sm-8">
        <div class="white_bg border5 mb30 shadow p20 text text-blue">
            <h1>Блог пользователя <?= $MODEL["user"] ?></h1>
    
            
            <?php 
                foreach ($MODEL["posts"] as $v) {
                    $v["showDel"] = $MODEL["showDel"];
                    echo $this->WriteHTML($v, "blog", "post"); 
                }
            ?>

            <?php if ($MODEL["showDel"]) echo $this->WriteHTML($MODEL["user"], "blog", "create"); ?>

            
            
        </div>
    </div>