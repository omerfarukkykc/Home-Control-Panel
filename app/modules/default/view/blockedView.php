<div class="error">
    <strong><span style="color:red;"><?=$data['ip']?></span> ip adresli kullanıcı engellenmiştir.</strong><br>
    <?php if($data['msg']!=null):?>
    <strong>Engellenme sebebi: <span style="color:red;"> <?php print_r($data['msg'])?></span></strong>
    <?php endif?>
</div>      