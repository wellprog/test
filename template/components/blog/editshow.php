<div class="col-lg-3 col-sm-4">
    
    </div>
    <div class="col-lg-9 col-sm-8">
        <div class="white_bg border5 mb30 shadow p20 text text-blue">
            <h1>Блог пользователя <?= $MODEL["user"] ?></h1>
    
            
           
            <?php echo $this->WriteHTML($MODEL, "blog", "edit"); ?>
            
        </div>
    </div>