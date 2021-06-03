<?php
    $powerChartLabel =[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23];
    $powerChartData = $data['sockets_data'];
    $powerChartName = "Günlük güç tüketimi -Watt";
    $powerChartName = json_encode($powerChartName);
    $powerChartLabel = json_encode($powerChartLabel);
    $powerChartData = json_encode($powerChartData);
    
?>
<div class="content">
    <div class="block">
        <b style="float: left;font-size: 30px;"><?=$data['room_info']['roomName']?></b>
    </div>
    <div class="block">
        <div class="cards-2">
            <div class="cards-3">
                <div>
                    <p>Sıcaklık</p>
                </div>
                <div>
                <i style="color: #cc3e3e;" class="fa fa-thermometer-full fa-12x"></i>

                </div>
                <div class="text-color" id="tem">
                    <?=$data['room_info']['room_tem']."°C"?>
                </div>
            </div>
            <div class="cards-3">
                <div>
                    <p>Nem oranı</p>
                </div>
                <div>
                <i style="color: #6060e6;" class="fa fa-tint fa-12x"></i>
                </div>
                <div class="text-color" id="hum">
                <?=$data['room_info']['room_hum']."%"?>

                </div>
            </div>
            <div  onclick="lightAction(<?=$data['room_info']['ID']?>)" class="cards-3">
                <div>
                    <p>Lamba durumu</p>
                </div>
                <div>
                <?php if($data['room_info']['lampStatus']):?>
                    <i id="light<?=$data['room_info']['ID']?>" style="color: #ffa500;" class="far fa-lightbulb fa-12x"></i>
                <?php else:?>
                    <i id="light<?=$data['room_info']['ID']?>" style="color: #313132;" class="far fa-lightbulb fa-12x"></i>
                <?php endif;?>
               
                </div>
                <div id="textlight<?=$data['room_info']['ID']?>" class="text-color" id="hum">
                    <?php if($data['room_info']['lampStatus']):?>
                        On
                    <?php else:?>
                        Off
                    <?php endif;?>
                </div> 
            </div>
        </div>
        <div class="cards-2">
            <canvas id="powerChart"></canvas>
        </div>
    </div>
    <div class="block">
        <div class="cards-2">
            
            <div class="title"><b>Sockets</b></div>
            <table style="width: 100%;" id="table">
                <thead>
                    <tr>
                        <th>Socket name</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody id="socketsTable">
                </tbody>
            </table>
        </div>
        <div class="cards-2">
            
            <div class="title"><b>Devices</b></div>
            <table style="width: 100%;" id="table">
                <thead>
                    <tr>
                        <th>Device Name</th>
                        <th style="text-align: center;">Value</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody id="devicesTable">
                </tbody>
            </table>
        </div>
    </div> 
</div><!-- Content div end  -->
<script>
    var ctx = document.getElementById('powerChart');
    const powerData = {
    type: 'line',
    data: {
        labels: <?=$powerChartLabel?>,
        datasets: [{
            label: <?=$powerChartName?>,
            data: <?=$powerChartData?>,
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
    var myChart = new Chart(ctx, powerData);
    let getDevice = function() {
         $("#devicesTable").html("");
         $.ajax({
            url: "/client/getdevices",
            type: "POST",
            dataType: 'json',
            data: {
                "room_id": <?php echo $data['room_info']['ID'] ?>

            },
            success: function(res) {
               res.forEach(function(item) {
                   console.log(item)
                  $("#devicesTable").prepend(`
                  <tr>
                     <td>` + item.device_name + `</td>
                     <td style="text-align: center;">` + item.value + `</td>
                     <td style="text-align: center;"><i style="color:#C70000;" onclick="deleteDevice(` + item.ID + `)" class="fa fa-trash fa-lg" aria-hidden="true"></i></td>
                  </tr>
                  `)
               })
            }
         });
      }
      $(document).ready(function(){
        getDevice()
        getSockets()
      });


      let getSockets = function() {
          
          $("#socketsTable").html("");
          $.ajax({
             url: "/client/getsockets",
             type: "POST",
             dataType: 'json',
             data: {
                "room_id": <?php echo $data['room_info']['ID'] ?>
             },
             success: function(res) {
                res.forEach(function(item) {
                    console.log(item)
                    
                    if(item.status){
                        item.status = "On"
                    }else{
                        item.status = "Off"
                    }
                    $("#socketsTable").prepend(`
                   <tr>
                      <td>` + item.socket_name + `</td>
                      <td id="stat` + item.ID + `" style="text-align: center;">` + item.status + `</td>
                      <td style="text-align: center;"><i style="color:#C70000;" onclick="socketAction(` + item.ID + `)" class="fa fa-power-off fa-lg" aria-hidden="true"></i></i></td>
                   </tr>
                   `)
                })
             }
          });
       }
       function socketAction(id){
        $.ajax({
             url: "/client/socketpower",
             type: "POST",
             dataType: 'json',
             data: {
                "socket_id": id
             },
             success: function(res) {
               
                if(res==1){
                    $('#stat'+id).html("On")
                }else{
                    $('#stat'+id).html("Off")
                }
             },
             
          });
       }
       function lightAction(id){
        $.ajax({
             url: "/client/lightpower",
             type: "POST",
             dataType: 'json',
             data: {
                "room_id": id
             },
             success: function(res) {
               
                if(res==1){
                    $('#light'+id).css("color","#ffa500")
                    $('#textlight'+id).html("On")
                }else{
                    $('#light'+id).css("color","#313132")
                    $('#textlight'+id).html("Off")

                }
             },
             
          });
       }
</script>