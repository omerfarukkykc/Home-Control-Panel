<?php
    $roomsPowerChartLabel =$data['rooms'];
    $roomsPowerChartData = $data['roomsPower'];
    $roomsPowerChartName = "Odaların enerji tüketim grafiği";
    $roomsPowerChartName = json_encode($roomsPowerChartName);
    $roomsPowerChartLabel = json_encode($roomsPowerChartLabel);
    $roomsPowerChartData = json_encode($roomsPowerChartData);
    
    $dailyPowerChartLabel =[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23];
    $dailyPowerChartData = $data['sum_socket_data'];
    $dailyPowerChartName = "Günlük güç tüketimi -W";
    $dailyPowerChartName = json_encode($dailyPowerChartName);
    $dailyPowerChartLabel = json_encode($dailyPowerChartLabel);
    $dailyPowerChartData = json_encode($dailyPowerChartData);
    
    $monthlyBillChartData = $data['monthly_bills'];
    $monthlyBillChartName = "Aylık fatura grafiği -₺";
    $monthlyBillChartName = json_encode($monthlyBillChartName);
    $monthlyBillChartData = json_encode($monthlyBillChartData);
    
    $monthlyPowerChartData = $data['monthly_kW'];
    $monthlyPowerChartName = "Aylık güç tüketim grafiği -kW";
    $monthlyPowerChartName = json_encode($monthlyPowerChartName);
    $monthlyPowerChartData = json_encode($monthlyPowerChartData);

?>
<div class="content">
    <div class="block">
        <b style="float: left;font-size: 30px;">Statistics</b>
    </div>
    <div class="block">
        <div class="cards-2">
        <div class="cards-2">
            <canvas style="height: 200px;" id="roomsPowerChart"></canvas>
        </div>
        <div style="line-height: 100px; " class="cards-2 ">
            <div>
                            
                <h2 style="color: black;">Elektrik Faturası</h2>
            </div>
            <div>
                <p><?=round($data['sumWatt']/1000,2)?> kW Elektrik harcanmıştır</p>
                <p>Tahmini tutar:  <b style="font-size:30px; color: brown;"><?=round((floatval($data['sumWatt'])/1000)*0.3967,2)?></b> ₺</p>
            </div>
        </div>
        </div>
        
        <div  class="cards-2">
            <canvas id="dailyPowerChart"></canvas>
        </div>
        
    </div>   
    <div class="block">
        <div  class="cards-2">
            <canvas id="monthlyBillChart"></canvas>
        </div>
        <div  class="cards-2">
            <canvas id="monthlyPowerChart"></canvas>
        </div>
    </div>
            

</div><!-- Content div end  -->
<script>
    
    const roomsPowerData = {
    type: 'doughnut',
    data: {
        labels: <?=$roomsPowerChartLabel?>,
        datasets: [{
            label: <?=$roomsPowerChartName?>,
            data: <?=$roomsPowerChartData?>,
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
            tension: 0.3,
            hoverOffset: 10
            
        }],
        options: {  
            responsive: true,
            maintainAspectRatio: false
        }
    },
    

    
    };
    const dailyPowerData = {
    type: 'line',
    data: {
        labels: <?=$dailyPowerChartLabel?>,
        datasets: [{
            label: <?=$dailyPowerChartName?>,
            data: <?=$dailyPowerChartData?>,
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
    const monthlyBillData = {
    type: 'bar',
    data: {
        datasets: [{
            label: <?=$monthlyBillChartName?>,
            data: <?=$monthlyBillChartData?>,
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
    const monthlyPowerData = {
    type: 'bar',
    data: {
        datasets: [{
            label: <?=$monthlyPowerChartName?>,
            data: <?=$monthlyPowerChartData?>,
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
        },
    }
    };
    var roomsPowerChart = new Chart($('#roomsPowerChart'), roomsPowerData);
    var dailyPowerChart = new Chart($('#dailyPowerChart'), dailyPowerData);
    var monthlyBillChart = new Chart($('#monthlyBillChart'), monthlyBillData);
    var monthlyPowerChart = new Chart($('#monthlyPowerChart'), monthlyPowerData);
</script>