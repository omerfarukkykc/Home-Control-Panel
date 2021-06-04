

<div class="content">
        <div class="block">
            <b style="float: left;font-size: 30px;">Dashboard</b>
        </div>

            <div class="block">
                <div onclick="alarmAction(<?=$data['general']['user_id']?>)" class="cards-3">
                    <div>
                        
                        <p>Alarm sistemi</p>
                    </div>
                    <div>
                        <?php if($data['general']['alarm']):?>
                            <i id="alarm<?=$data['general']['user_id']?>" style="color: rgb(0 177 5);" class="fas fa-home fa-12x"></i>
                        <?php else:?>
                            <i id="alarm<?=$data['general']['user_id']?>" style="color: #cc3e3e;" class="fas fa-home fa-12x"></i>
                        <?php endif;?>
                    </div>
                    <div id="alarmtext<?=$data['general']['user_id']?>" class="text-color">
                        <?php if($data['general']['alarm']):?>
                            Activated
                        <?php else:?>
                            Deactivated
                        <?php endif;?>
                    </div>
                </div>
                <div class="cards-3">
                    <div>
                        <p>Sıcaklık</p>
                    </div>
                    <div>
                    <i style="color: #cc3e3e;" class="fa fa-thermometer-full fa-12x"></i>

                    </div>
                    <div class="text-color" id="tem">
                        <?php echo $data['general']['home_tem']."°C"?>

                    </div>
                </div>
                <div class="cards-3">
                    <div>
                        <p>Nem oranı</p>
                    </div>
                    <div>
                    <i style="color:  #6060e6;" class="fa fa-tint fa-12x"></i>
                    </div>
                    <div class="text-color" id="hum">
                        <?php echo $data['general']['home_hum']."°C"?>
                    </div>
                </div>
            </div>
            <div class="block">
                <div class="cards-2">
                    <div>
                        <p>Kombi durumu</p>
                    </div>
                    <div class="numberinput">
                        <div class="piece-2">
                            <p>Su</p>
                            <div class="logo-background">
                            <i style="color: #313132;" class="fas fa-hand-holding-water fa-7x"></i>
                            </div>

                            <div>
                                <button onclick="changeValue('water',-1)" class="btn">-</button>
                                <span class="text-color" id="setWater">
                                <?php echo $data['general']['set_water_tem']."°C"?>
                                </span>
                                <button onclick="changeValue('water',1)" class="btn">+</button>
                            </div>
                        </div>
                        <div class="piece-2">
                            <div>
                                <p>Kalorifer</p>
                            </div>
                            <div class="logo-background">
                                <i style="color: #313132;" class="fab fa-gripfire fa-8x"></i>
                            </div>

                            <div>
                                <button onclick="changeValue('heater',-1)" class="btn">-</button>

                                <span class="text-color" id="setTempature">
                                    <?php echo $data['general']['set_house_tem']."°C"?>
                                </span>

                                <button onclick="changeValue('heater',1)" class="btn">+</button>
                            </div>
                        </div>
                        <div class="piece-2">
                            <div>
                                <p>Basınç</p>
                            </div>
                            <div class="logo-background">
                                <i style="color: #313132;" class="fa fa-info-circle fa-7x"></i>
                            </div>
                            <span class="text-color" id="psi">
                                <?php echo $data['general']['psi']." PSI"?>
                            </span>
                        </div>
                    </div>


                </div>
                <div class="cards-2">
                    <div>
                        <p>Güç seçenekleri</p>
                    </div>
                    <div>
                        <button value="1" id="mod1" class="reset-button mods-button">Tasarruf Modu</button>
                        <button value="2" id="mod2" class="reset-button mods-button">Konfor Modu</button>

                    </div>
                    <div>
                        <button value="3" id="mod3" class="reset-button mods-button">Yaz Modu</button>
                        <button value="4" id="mod4" class="reset-button mods-button">Kış Modu</button>
                    </div>
                </div>
            </div>
        </div><!-- Content div end  -->
<script>
    $( document ).ready(function() {
        modInit()
    });
    $('.mods-button').click(function(){
        $('.mods-button').removeClass("mods-selected")
        $(this).addClass("mods-selected")
        $.ajax({
            type: "POST",
            url: "/client/modselect",
            data: {
                "mod":$(this).val(),
                "general_id": <?=$data['general']['ID']?>
            },
            dataType: 'json',
            success: function(res){
                $('#setWater').text(res.set_water_tem)
                $('#setTempature').text(res.set_house_tem)
            }
        });
    })
    function modInit(){
        let mod = <?=$data['general']['mod']?>;
        $('#mod'+mod).addClass("mods-selected")
    }
    function alarmAction(id){
        $.ajax({
             url: "/client/alarmpower",
             type: "POST",
             dataType: 'json',
             data: {
                "user_id": id
             },
             success: function(res) {
               
                if(res==1){
                    $('#alarm'+id).css("color","rgb(0 177 5)")
                    $('#alarmtext'+id).html("Activated")
                }else{

                    $('#alarm'+id).css("color","#cc3e3e")
                    $('#alarmtext'+id).html("Deactivated")
                }
             },
          });
    }
</script>