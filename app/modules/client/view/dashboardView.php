<?php

    $gainChartLabel = array("Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");
    $gainChartData = [1,2,3,4,5,23,3,32,2];
    $gainChartName = "2021 Aylık Büyüme Oranı";
    $gainChartName = json_encode($gainChartName);
    $gainChartLabel = json_encode($gainChartLabel);
    $gainChartData = json_encode($gainChartData);
    
?>
<div class="content">
            <div class="block">
                <h1>Welcome Home CPanel</h1>
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
                    <i style="color: #313132;" class="fa fa-thermometer-full fa-12x"></i>

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
                    <i style="color: #313132;" class="fa fa-tint fa-12x"></i>
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
                    <canvas id="gainChart"></canvas>
                </div>
            </div>
        </div><!-- Content div end  -->
<script>
    var ctx = document.getElementById('gainChart');
    const gainData = {
    type: 'line',
    data: {
        labels: <?=$gainChartLabel?>,
        datasets: [{
            label: <?=$gainChartName?>,
            data: <?=$gainChartData?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 3,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.3
        }]
    },
    options: {
        scales: {   
            y: {
                beginAtZero: true
            }
        }
    }
    };
    var myChart = new Chart(ctx, gainData);
</script>