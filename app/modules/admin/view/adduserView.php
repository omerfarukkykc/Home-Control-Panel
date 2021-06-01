<div class="content">
        <b style="float: left;font-size: 30px;">Add Member </b>
            
            <div class="background">
                <form id="adduser">

                    <div style="margin-top: 85px;" class="block">
                        <div style="line-height: 30px; height: auto; background-color:rgb(255,255,255,0)" class="cards-2">
                            <div>
                                <div class="input-line inline-block">
                                        <label for="firstname "><b>Firstname:</b></label>
                                        <div class="input-box">
                                            <input type="text" placeholder="Enter firstname" name="firstname" required>
                                        </div>
                                </div>
                                <div class="input-line inline-block">
                                        <label for="lastname"><b>Lastname:</b></label>
                                        <div class="input-box">
                                            <input type="text" placeholder="Enter lastname" name="lastname" required>
                                        </div>
                                </div>
                            </div>
                            <div>
                                    <div class="input-line inline-block">
                                        <label for="email"><b>Email:</b></label>
                                        <div class="input-box">
                                            <input type="email" placeholder="Enter email" name="email" required>
                                        </div>
                                    </div>
                                    <div class="input-line inline-block">
                                        <label for="email"><b>Email:</b></label>
                                        <div class="input-box">
                                            <input type="email" placeholder="Enter email" name="emailChecker" required>
                                        </div>
                                    </div>
                            </div>

                            
                            <div class="input-line long">
                                <label for="address1"><b>Address Line 1:</b></label>
                                <div class="input-box ">
                                    <input type="text" class="w-100" placeholder="Enter address" name="address1" required>
                                </div>
                            </div>
                            <div class="input-line long">
                                <label for="address2"><b>Address Line 2:</b></label>
                                <div class="input-box ">
                                    <input type="text" class="w-100" placeholder="Enter address" name="address2" required>
                                </div>
                            </div>
                        </div>
                        <div style="line-height: 30px; height: auto; background-color:rgb(255,255,255,0)" class="cards-2">
                            <div class="input-line long">
                                <label for="phonenumber"><b>Phone number:</b></label>
                                <div class="input-box">
                                    <input type="tel" pattern="[0-9]{10}" class="w-100" placeholder="Enter phone number ex : 5435210939" name="phone" required>
                                </div>
                            </div>
                            <div class="input-line long">
                                <label for="username"><b>Username:</b></label>
                                <div class="input-box">
                                    <input type="text" class="w-100" placeholder="Enter username" name="username" required>
                                </div>
                            </div>
                            <div>
                                <div class="input-line inline-block">
                                    <label for="password"><b>Password:</b></label>
                                    <div class="input-box">
                                        <input type="password" placeholder="Enter password" name="password" required>
                                    </div>
                                </div>
                                <div class="input-line inline-block">
                                    <label for="password"><b>Password:</b></label>
                                    <div class="input-box">
                                        <input type="password" placeholder="Enter password" name="passwordChecker" required>
                                    </div>
                                </div>
                            </div>
                            <div class="input-line inline-block" style="padding: 10px 0px;">
                                    <select name="gender" id="gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                            </div>
                            <div class="input-line inline-block">
                                <label for="numberOfRooms"><b>How many rooms does the house have:</b></label>
                                <div class="input-box">
                                    <input type="number" id="numberOfRooms" name="numberOfRooms" min="1" max="20">
                                </div>
                            </div>
                            
                        </div>
                        <div class="input-line">
                                <button  type="submit">Add member</button>
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