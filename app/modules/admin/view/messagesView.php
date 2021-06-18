<div class="content">
    <b style="float: left;font-size: 30px;" >Messages</b>
    <div class="background">
            
            <div class="search">
                <input id="searchInput" class="form-control" type="text" placeholder="Ara..">
            </div>
        <table id="member">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>İsim</th>
                    <th>Mail adresi</th>
                    <th>Telefon numarası</th>
                    <th>Başlık</th>
                    <th style="text-align:center;">Mesaj</th>
                </tr>
            </thead>
            <tbody id="usersTableBody">
                <?php
                $index = count($data)+1;
                ?>
                <?php foreach($data as $row):?>
                <?php $index-=1;?>
                    <?php if($row['read_receipt']==1):?>
                        <tr style="background-color: #ffffff00;" >
                    <?php else:?>
                        <tr id="tr<?=$row['ID']?>" style="background-color: #00000067;">
                    <?php endif;?>
                    
                        <td><?=$index?></td>
                        <td><?=$row['name']?></td>
                        <td><?=$row['email']?></td>
                        <td><?=$row['phone']?></td>
                        <td><?=$row['subject']?></td>
                        <td style="text-align:center;"><i onclick="openmodal(<?=$row['ID']?>)" style="color:green;" class="fas fa-bars" aria-hidden="true"></i></td>
                    </tr>
                
                
                <div id="messagemodal<?=$row['ID']?>" class="modal">
                <!-- Modal content -->
                    <div class="modal-content">
                        <span onclick="closemodal(<?=$row['ID']?>)" class="close">&times;</span>
                        <div class="xcontent">
                            <div class="satir">
                                <label>Gönderen: <?=$row['name']?></label>
                            </div>
                            <div class="satir">
                                <label>Mail: <?=$row['email']?></label>
                            </div>
                            <div class="satir">
                                <label>Telefon: <?=$row['phone']?></label>
                            </div>
                            <div class="satir">
                                <label>Konu: <?=$row['subject']?></label>
                            </div>
                            <div class="satir">
                                <label>Mesaj: <?=$row['text']?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </tbody>
            
        </table>
    </div>
</div><!-- Content div end  -->
<script>
    let openedmodal
    function openmodal(message_id){
        openedmodal = message_id
      $('#messagemodal'+message_id).css("display","block")
      $.ajax({
             url: "/admin/read",
             type: "POST",
             dataType: 'json',
             data: {
                "message_id": message_id
             },
             success: function(res) {
                if(res==1){
                    $('#tr'+message_id).css("background-color","#ffffff00")
                }
             },
             
          });
    }
    function closemodal(message_id){
        openedmodal = message_id
      $('#messagemodal'+message_id).css("display","none") 
    }
   
    window.onclick = function(event) {
        if (event.target == document.getElementById("messagemodal"+openedmodal)) {
            $('#messagemodal'+openedmodal).css("display","none") 
        }
    }
    
</script>