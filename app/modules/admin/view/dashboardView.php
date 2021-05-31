<?php
    $chartLabel = array("Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");
    $chartData = $data['userCountMonthly'];
    $chartName = "2021 Aylık müşteri Kayıt Grafiği";
    $chartName = json_encode($chartName);
    $chartLabel = json_encode($chartLabel);
    $chartData = json_encode($chartData);
?>
<div class="content">
    <div class="block">
        <b style="float: left;font-size: 30px;">Dashboard</b>
    </div>
    <div class="block">
        <div class="cards-2">
            <canvas id="myChart"></canvas>
        </div>
        <div class="cards-2">
            <div style="line-height:100px; " class="cards-3">
                <div class="indicator">
                    Kullanıcı sayısı
                </div>
                
                <div class="indicator" >
                   <?=$data['userCount']?>
                </div>
            </div>
            <div style="line-height:100px; "  class="cards-3">
                <div class="indicator">
                    Brüt Kazanç
                </div>
                <div class="indicator" >
                <?=$data['userCount']*1500?> ₺
                </div>
            </div>
            <div style="line-height:100px; "  class="cards-3">
                <div class="indicator">
                    Net Kazanç
                </div>
                <div class="indicator" >
                <?=$data['userCount']*1000?> ₺
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var ctx = document.getElementById('myChart');
const data = {
    type: 'bar',
    data: {
        labels: <?= $chartLabel?>,
        datasets: [{
            label: <?=$chartName?>,
            data: <?=$chartData?>,
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
var myChart = new Chart(ctx, data);
</script>