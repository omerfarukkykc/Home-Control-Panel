<div class="content">
    <b style="float: left;font-size: 30px;" >Serach & Edit Users Menu</b>
    <div class="background">
            
            <div class="search">
                <input id="searchInput" class="form-control" type="text" placeholder="Ara..">
            </div>
        <table id="member">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Adı</th>
                    <th>Soyadı</th>
                    <th>Mail adresi</th>
                    <th>Adres Satır 1</th>
                    <th>Adres Satır 2</th>
                    <th>Telefon numarası</th>
                    <th>Kullanıcı adı</th>
                    <th>Üyelik tarihi</th>
                    <th>Oda sayısı</th>
                    <th>Düzenle</th>
                </tr>
            </thead>
            <tbody id="usersTableBody">
                <?php
                foreach($data as $index => $row){
                    $index+=1;
                    $id = $row['ID'];
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $email = $row['email'];
                    $address1 = $row['address1'];
                    $address2 = $row['address2'];
                    $phone = $row['phone'];
                    $username = $row['username'];
                    $creationDate = $row['creationDate'];
                    $numberOfRooms = $row['numberOfRooms'];
                    echo"<tr>";
                    echo"<td>$index</td>";
                    echo"<td>$firstname</td>";
                    echo"<td>$lastname</td>";
                    echo"<td>$email</td>";
                    echo"<td>$address1</td>";
                    echo"<td>$address2</td>";
                    echo"<td>$phone</td>";
                    echo"<td>$username</td>";
                    echo"<td>$creationDate</td>";
                    echo"<td>$numberOfRooms</td>";
                    echo"<td><a href=\"/admin/edituser/{$id}\"><i style=\"color:green;\" class=\"fa fa-pencil-square-o fa\" aria-hidden=\"true\"></i></a></td>";
                    echo"</tr>";
                }
                ?>
            </tbody>
            
        </table>
    </div>
</div><!-- Content div end  -->
<script>
    $(document).ready(function() {
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#usersTableBody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>