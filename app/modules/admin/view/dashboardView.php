<?php
    $registrationChartLabel = array("Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");
    $registrationChartData = $data['userCountMonthly'];
    $registrationChartName = "2021 Aylık müşteri Kayıt Grafiği";
    $registrationChartName = json_encode($registrationChartName);
    $registrationChartLabel = json_encode($registrationChartLabel);
    $registrationChartData = json_encode($registrationChartData);

    $gainChartLabel = array("Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");
    $gainChartData = $data['netGainMonthly'];
    $gainChartName = "2021 Aylık Büyüme Oranı";
    $gainChartName = json_encode($gainChartName);
    $gainChartLabel = json_encode($gainChartLabel);
    $gainChartData = json_encode($gainChartData);
    
?>
<div class="content">
    <div class="block">
        <b style="float: left;font-size: 30px;">Dashboard</b>
    </div>
    <div class="block">
        <div class="cards-2">
            <canvas id="registrationChart"></canvas>
        </div>
        <div class="cards-2">
            <canvas id="gainChart"></canvas>
        </div>
    </div>
    <div class="block">
        <div style="line-height:120px; " class="cards-3">
            <div class="indicator">
                Kayıtlı kullanıcı sayısı
            </div>
            
            <div class="indicator" >
                <?=$data['userCount']?>
            </div>
        </div>
        <div style="line-height:120px; "  class="cards-3">
            <div class="indicator">
               Aylık Brüt Kazanç
            </div>
            <div class="indicator" >
            <?=$data['userCountMonthly'][date("m")-1]*1500?> ₺
            </div>
        </div>
        <div style="line-height:120px; "  class="cards-3">
            <div class="indicator">
               Aylık Net Kazanç
            </div>
            <div class="indicator" >
            <?=$data['userCountMonthly'][date("m")-1]*1000?> ₺
            </div>
        </div>
    </div>
</div>
<script>
var ctx = document.getElementById('registrationChart');
const registrationData = {
    type: 'bar',
    data: {
        labels: <?= $registrationChartLabel?>,
        datasets: [{
            label: <?=$registrationChartName?>,
            data: <?=$registrationChartData?>,
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
            borderWidth: 3
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
var myChart = new Chart(ctx, registrationData);
</script>
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
            tension: 0.3,
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