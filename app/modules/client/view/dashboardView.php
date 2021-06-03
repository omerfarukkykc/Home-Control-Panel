

<div class="content">
        <div class="block">
            <b style="float: left;font-size: 30px;">Dashboard</b>
        </div>

            <div class="block">
                <div class="cards-3">
                    <div>
                        
                        <p>Alarm sistemi</p>
                    </div>
                    <div>
                        <?php if($data['general']['alarm']=="Activated"):?>
                            <i style="color: green;" class="fas fa-home fa-12x"></i>
                        <?php else:?>
                            <i style="color: red;" class="fas fa-home fa-12x"></i>
                        <?php endif;?>
                    </div>
                    <div class="text-color">
                        <?php echo $data['general']['alarm']?>
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
                    
                </div>
            </div>
        </div><!-- Content div end  -->
