<?php
    $roomsPowerChartLabel =["Mutfak","Banyo","Salon","Oturma odası"];
    $roomsPowerChartData = [0,1,2,3,4,5,6];
    $roomsPowerChartName = "Odaların enerji tüketim grafiği";
    $roomsPowerChartName = json_encode($roomsPowerChartName);
    $roomsPowerChartLabel = json_encode($roomsPowerChartLabel);
    $roomsPowerChartData = json_encode($roomsPowerChartData);
    

    $dailyPowerChartLabel =[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23];
    $dailyPowerChartData = $data['socket_data'];
    $dailyPowerChartName = "Günlük güç tüketimi -Watt";
    $dailyPowerChartName = json_encode($dailyPowerChartName);
    $dailyPowerChartLabel = json_encode($dailyPowerChartLabel);
    $dailyPowerChartData = json_encode($dailyPowerChartData);
    
    $monthlyBillChartLabel =[1,2,3,4,5,6,7,8,9,10,11,12];
    $monthlyBillChartData = $data['socket_data'];
    $monthlyBillChartName = "Aylık fatura grafiği";
    $monthlyBillChartName = json_encode($monthlyBillChartName);
    $monthlyBillChartLabel = json_encode($monthlyBillChartLabel);
    $monthlyBillChartData = json_encode($monthlyBillChartData);
    
    $monthlyPowerChartLabel =[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23];
    $monthlyPowerChartData = $data['socket_data'];
    $monthlyPowerChartName = "Aylık güç tüketim grafiği";
    $monthlyPowerChartName = json_encode($monthlyPowerChartName);
    $monthlyPowerChartLabel = json_encode($monthlyPowerChartLabel);
    $monthlyPowerChartData = json_encode($monthlyPowerChartData);

?>
<div class="content">
    <div class="block">
        <b style="float: left;font-size: 30px;">Statistics</b>
    </div>
    <div class="block">
        <div class="cards-2">
        <div class="cards-2">
            <canvas id="roomsPowerChart"></canvas>
        </div>
        <div style="line-height: 100px; " class="cards-2 ">
            <div>
                            
                <h2 style="color: black;">Elektrik Faturası</h2>
            </div>
            <div>
                <p>Tahmini tutar 67.7 tl</p>
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
            
        }]
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
        labels: <?=$monthlyBillChartLabel?>,
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
    type: 'line',
    data: {
        labels: <?=$monthlyPowerChartLabel?>,
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
        }
    }
    };
    var roomsPowerChart = new Chart($('#roomsPowerChart'), roomsPowerData);
    var dailyPowerChart = new Chart($('#dailyPowerChart'), dailyPowerData);
    var monthlyBillChart = new Chart($('#monthlyBillChart'), monthlyBillData);
    var monthlyPowerChart = new Chart($('#monthlyPowerChart'), monthlyPowerData);
</script>