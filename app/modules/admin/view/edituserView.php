<div class="content">
         <b style="float: left;font-size: 30px;">Edit User</b>
         <div class="background">
            <div class="left">
               <div class="title">User information</div>
               <div>
                  <form id="savechanges" >
                     <input style="display: none;" type="number" name="id" value="<?php echo $data["ID"] ?>">
                     <div class="input-line inline-block">
                        <label for="firstname ">Firstname:</label>
                        <div class="input-box">
                           <input type="text" placeholder="Enter firstname" value="<?php echo $data["firstname"] ?>" name="firstname" required>
                        </div>
                     </div>
                     <div class="input-line inline-block">
                        <label for="lastname">Lastname:</label>
                        <div class="input-box">
                           <input type="text" placeholder="Enter lastname" value="<?php echo $data["lastname"] ?>" name="lastname" required>
                        </div>
                     </div>
               </div>
               <div>
                  <div class="input-line inline-block">
                     <label for="email">Email:</label>
                     <div class="input-box">
                        <input type="text" placeholder="Enter email" value="<?php echo $data["email"] ?>" name="email" required>
                     </div>
                  </div>
                  <div class="input-line inline-block">
                     <label for="email">Email:</label>
                     <div class="input-box">
                        <input type="text" placeholder="Enter email" value="<?php echo $data["email"] ?>" name="emailChecker" required>
                     </div>
                  </div>
               </div>
               <div class="input-line long">
                  <label for="address1">Address Line 1:</label>
                  <div class="input-box ">
                     <input type="text" class="w-100" placeholder="Enter address" value="<?php echo $data["address1"] ?>" name="address1" required>
                  </div>
               </div>
               <div class="input-line long">
                  <label for="address2">Address Line 2:</label>
                  <div class="input-box ">
                     <input type="text" class="w-100" placeholder="Enter address" value="<?php echo $data["address2"] ?>" name="address2" required>
                  </div>
               </div>
               <div class="input-line long">
                  <label for="phonenumber">Phone number:</label>
                  <div class="input-box">
                     <input type="text" class="w-100" placeholder="Enter phone number" value="<?php echo $data["phone"] ?>" name="phone" required>
                  </div>
               </div>
               <div class="input-line long">
                  <label for="username">Username:</label>
                  <div class="input-box">
                     <input type="text" class="w-100" placeholder="Enter username" value="<?php echo $data["username"] ?>" name="username" required>
                  </div>
               </div>
               <div>
                  <div class="input-line inline-block" style="padding: 10px 0px;">
                     <select name="gender" value="<?php echo $data["gender"] ?>" id="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                     </select>
                  </div>
                  <div class="input-line inline-block">
                     <label for="numberOfRooms">How many rooms does the house have:</label>
                     <div class="input-box">
                        <input type="number" value="<?php echo $data["numberOfRooms"] ?>" id="numberOfRooms" name="numberOfRooms" min="1" max="20">
                     </div>
                  </div>
               </div>
               <div>
                  <div class="input-line inline-block">
                     <button type="submit">Save changes</button>
                  </div>
                  <div class="input-line inline-block">
                     <button style="color: red;" onclick="deleteUser(<?php echo $data['ID'] ?>)">Delete User</button>
                  </div>
               </div>
               
                  
               
               </form>
            </div>
            <div class="right">
               <div class="title">Room add</div>
               <div class="input-line long">
                  <label for="firstname ">Room name:</label>
                  <div class="input-box">
                     <input type="text" class="w-100" placeholder="Enter Room name" id="roomName" required>
                  </div>
               </div>

               <div class="input-line">
                  <button id="addRoom" type="submit">Add room</button>
               </div>
               <div class="title">Rooms</div>
               <table id="rooms">
                  <thead>
                     <tr>
                     
                        <th>Oda Adı</th>
                        <th style="text-align: center;">Edit</th>
                        <th style="text-align: center;">Delete</th>
                     </tr>
                  </thead>
                  <tbody id="roomTable">
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <script>
       function deleteUser(user_id) {
         let x = $("#roomName").val();
         $.ajax({
            url: "/admin/deleteuser",
            type: "POST",
            data: {
               "user_id": user_id
            },
            success: function(msg) {
               $(window).attr('location', '/admin/users')
            }
         });
      }
       let getRoom = function() {
         $("#roomTable").html("");
         $.ajax({
            url: "/admin/getroom",
            type: "POST",
            dataType: 'json',
            data: {
               "id": <?php echo $data["ID"] ?>
            },
            success: function(res) {
               res.forEach(function(item) {
                  $("#roomTable").prepend(`
                  <tr>
                     <td>` + item.roomName + `</td>
                     <td style="text-align: center;"><a href="/admin/editroom/` + item.ID + `"><i style="color:green;" class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a></td>
                     <td style="text-align: center;"><i style="color:#C70000;" onclick="deleteRoom(` + item.ID + `)" class="fa fa-trash fa-lg" aria-hidden="true"></i></td>
                  </tr>
                  `)
               })
            }
         });
      }
      $(document).ready(
      getRoom());

      $("#addRoom").click(function() {
         let x = $("#roomName").val();
         $.ajax({
            url: "/admin/addroom",
            type: "POST",
            data: {
               "roomname": x,
               "id": <?php echo $data["ID"] ?>
            },
            success: function(msg) {
                Toast.fire({
                 icon: 'success',
                 title: 'Oda başarıyla eklendi'
             });
               $("#roomName").val("");
               getRoom();
            }
         });
      })

     function deleteRoom(room_id) {
         let x = $("#roomName").val();
         $.ajax({
            url: "/admin/deleteroom",
            type: "POST",
            data: {
               "room_id": room_id
            },
            success: function(msg) {
               getRoom();
            }
         });
      }
      function edituser(id) {
    $(window).attr('location', 'user.php?id=' + id)
}
$(document).ready(function() {
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#usersTableBody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
$("#savechanges").submit(function(e) {
    e.preventDefault();
    var form = $(this);
    $.ajax({
        type: "POST",
        url: "/admin/saveuser",
        data: form.serialize(),
        success: function(data) {
         Toast.fire({
                icon: 'success',
                title: "Başarıyla güncellendi"
            });
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            Toast.fire({
                icon: 'error',
                title: XMLHttpRequest.status + ' ' + errorThrown + '.'
            });
        }
    });
});
      
   </script>