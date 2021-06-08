<div class="content">
        <b style="float: left;font-size: 30px;">Add Member </b>
            
            <div class="background">
                <form id="adduser">

                    <div style="margin-top: 85px;" class="block">
                        <div style="line-height: 30px; height: auto; background-color:rgb(255,255,255,0)" class="cards-2">
                            <div>
                                <div class="input-line inline-block">
                                        <label for="firstname "><b>Adı:</b></label>
                                        <div class="input-box">
                                            <input type="text" placeholder="Enter firstname" name="firstname" required>
                                        </div>
                                </div>
                                <div class="input-line inline-block">
                                        <label for="lastname"><b>Soyadı:</b></label>
                                        <div class="input-box">
                                            <input type="text" placeholder="Enter lastname" name="lastname" required>
                                        </div>
                                </div>
                            </div>
                            <div>
                                    <div class="input-line inline-block">
                                        <label for="email"><b>Mail adresi:</b></label>
                                        <div class="input-box">
                                            <input type="email" placeholder="Enter email" name="email" required>
                                        </div>
                                    </div>
                                    <div class="input-line inline-block">
                                        <label for="email"><b>Mail adresi:</b></label>
                                        <div class="input-box">
                                            <input type="email" placeholder="Enter email" name="emailChecker" required>
                                        </div>
                                    </div>
                            </div>

                            
                            <div class="input-line long">
                                <label for="address1"><b>Adres Satır 1:</b></label>
                                <div class="input-box ">
                                    <input type="text" class="w-100" placeholder="Enter address" name="address1" required>
                                </div>
                            </div>
                            <div class="input-line long">
                                <label for="address2"><b>Adres Line 2:</b></label>
                                <div class="input-box ">
                                    <input type="text" class="w-100" placeholder="Enter address" name="address2" required>
                                </div>
                            </div>
                        </div>
                        <div style="line-height: 30px; height: auto; background-color:rgb(255,255,255,0)" class="cards-2">
                            <div class="input-line long">
                                <label for="phonenumber"><b>Telefon numarası:</b></label>
                                <div class="input-box">
                                    <input type="tel" pattern="[0-9]{10}" class="w-100" placeholder="Enter phone number ex : 5435210939" name="phone" required>
                                </div>
                            </div>
                            <div class="input-line long">
                                <label for="username"><b>Kullanıcı adı:</b></label>
                                <div class="input-box">
                                    <input type="text" class="w-100" placeholder="Enter username" name="username" required>
                                </div>
                            </div>
                            <div>
                                <div class="input-line inline-block">
                                    <label for="password"><b>Şifresi:</b></label>
                                    <div class="input-box">
                                        <input type="password" placeholder="Enter password" name="password" required>
                                    </div>
                                </div>
                                <div class="input-line inline-block">
                                    <label for="password"><b>Şifresi:</b></label>
                                    <div class="input-box">
                                        <input type="password" placeholder="Enter password" name="passwordChecker" required>
                                    </div>
                                </div>
                            </div>
                            <div class="input-line inline-block" style="padding: 10px 0px;">
                                    <select name="gender" id="gender">
                                        <option value="male">Erkek</option>
                                        <option value="female">Kadın</option>
                                    </select>
                            </div>
                            <div class="input-line inline-block">
                                <label for="numberOfRooms"><b>Sahip olunan oda sayısı</b></label>
                                <div class="input-box">
                                    <input type="number" id="numberOfRooms" name="numberOfRooms" min="1" max="20">
                                </div>
                            </div>
                            
                        </div>
                        <div class="input-line">
                                <button  type="submit">Müşteri ekle</button>
                            </div> 
                    </div>
                       
                </div>
                
           </form>
        </div><!-- Content div end  -->

        <script>
            $("#adduser").submit(function(e) {
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    type: "POST",
                    url: "/admin/adduser",
                    data: form.serialize(),
                    dataType: "json",
                    success: function(data) {
                        $(window).attr('location', '/admin/edituser/'+ data.id )
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