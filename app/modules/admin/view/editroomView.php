
<div class="content">
        <b style="float: left;font-size: 30px;">Room Edit Menu</b>
           <div style="padding-top: 50px;" class="background">
                <div class="cards3">
                    <div class="title"><b>Room information</b></div>
                    <form id="a">
                        <div>
                            <div class="input-line inline-block">
                                <label for="firstname "><b>Room name:</b></label>
                                <div class="input-box">
                                    <input type="text" class="w-100" placeholder="Enter Room name" value="<?php echo $data["roomName"]?>" id="roomNamei" required>
                                </div>
                            </div>
                            <div class="input-line inline-block">
                                <button id="saveChanges" type="submit">Save changes</button>
                            </div>
                        </div>
                    </form>

                </div>  
                <div class="cards3">
                    <div>
                        <div class="title"><b>Add socket</b></div>
                        <div class="input-line inline-block">
                            <label for="firstname "><b>Socket name:</b></label>
                            <div class="input-box">
                                <input type="text" class="w-100" placeholder="Enter Socket name"  id="socketName" required>
                            </div>
                        </div>

                        <div class="input-line inline-block">
                            <button id="addSocket" type="submit">Add socket</button>
                        </div>
                    </div>
                    <div class="title"><b>Sockets</b></div>
                    <table id="table">
                        <thead>
                            <tr>
                                <th>Socket name</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Delete</th>
                            </tr>
                        </thead>
                        <tbody id="socketsTable">
                        </tbody>
                    </table>
                </div>
                <div class="cards3">
                    <div>
                        <div class="title"><b>Add device</b></div>
                        <div class="input-line inline-block">
                            <label for="firstname "><b>Device name:</b></label>
                            <div class="input-box">
                                <input type="text" class="w-100" placeholder="Enter Device name" id="deviceName" required>
                            </div>
                        </div>

                        <div class="input-line inline-block">
                            <button id="addDevice" type="submit">Add device</button>
                        </div>
                    </div>
                    <div class="title"><b>Devices</b></div>
                    <table id="table">
                        <thead>
                            <tr>
                                <th>Device Name</th>
                                <th style="text-align: center;">Type</th>
                                <th style="text-align: center;">Value</th>
                                <th style="text-align: center;">Delete</th>
                            </tr>
                        </thead>
                        <tbody id="devicesTable">
                        </tbody>
                    </table>
                </div>
           </div>
        </div><!-- Content div end  -->
        <script>
        let getDevice = function() {
         $("#devicesTable").html("");
         $.ajax({
            url: "/admin/getdevices",
            type: "POST",
            dataType: 'json',
            data: {
               "room_id": <?php echo $data["ID"] ?>
            },
            success: function(res) {
               res.forEach(function(item) {
                   console.log(item)
                  $("#devicesTable").prepend(`
                  <tr>
                     <td>` + item.device_name + `</td>
                     <td style="text-align: center;">` + item.device_type  + `</td>
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

      $("#addDevice").click(function() {
         let x = $("#deviceName").val();
         $.ajax({
            url: "/admin/adddevice",
            type: "POST",
            data: {
               "device_name": x,
               "room_id": <?php echo $data["ID"] ?>
            },
            success: function(msg) {
                if(msg!="fail"){
                    Toast.fire({
                    icon: 'success',
                    title: 'Device başarıyla eklendi'
                    });
                getDevice();
                $("#deviceName").val("") 
                }   
            }
         });
      })

     function deleteDevice(device_id) {
         $.ajax({
            url: "/admin/deletedevice",
            type: "POST",
            data: {
               "device_id": device_id
            },
            success: function(msg) {
                getDevice();
            }
         });
      }


      let getSockets = function() {
          
         $("#socketsTable").html("");
         $.ajax({
            url: "/admin/getsockets",
            type: "POST",
            dataType: 'json',
            data: {
               "room_id": <?php echo $data["ID"] ?>
            },
            success: function(res) {
               res.forEach(function(item) {
                   console.log(item)
                  $("#socketsTable").prepend(`
                  <tr>
                     <td>` + item.socket_name + `</td>
                     <td style="text-align: center;">` + item.status + `</td>
                     <td style="text-align: center;"><i style="color:#C70000;" onclick="deleteSocket(` + item.ID + `)" class="fa fa-trash fa-lg" aria-hidden="true"></i></td>
                  </tr>
                  `)
               })
            }
         });
      }
      $("#addSocket").click(function() {
         let x = $("#socketName").val();
         $.ajax({
            url: "/admin/addsocket",
            type: "POST",
            data: {
               "socket_name": x,
               "room_id": <?php echo $data["ID"] ?>
            },
            success: function(msg) {
                if(msg!="fail"){
                    Toast.fire({
                        icon: 'success',
                        title: 'Soket başarıyla eklendi'
                    });
                    getSockets();
                    $("#socketName").val("")
                }
            }
         });
      })

     function deleteSocket(socket_id) {
         $.ajax({
            url: "/admin/deletesocket",
            type: "POST",
            data: {
               "socket_id": socket_id
            },
            success: function(msg) {
                getSockets();
            }
         });
      }
      $('#a').submit(function(e){
          e.preventDefault();
          var form = $(this);
          
        $.ajax({
            url: "/admin/saveroom",
            type: "POST",
            data: {
               "room_id": <?php echo $data["ID"] ?>,
               "roomName": $('#roomNamei').val()
            },
            success: function(msg) {
            }
         });

      })

        </script>