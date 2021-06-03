
<div class="sidebar">

            <!-- Sidebar div start -->
            <div class="sidebar-header">
                <a href="dashboard.php"><strong>Home CPanel</strong></a>
            </div>
            <div class="sidebar-profile">
                <i style="color: #ececec;" class="fas fa-user fa-6x"></i>
                <div class="user-name"> <?php echo $_SESSION['user']['firstname']." ".$_SESSION['user']['lastname']?></div>
            </div>
            <div class="sidebar-content">
                <!-- Sidebar List Start -->
                <ul id="accordion" class="accordion">
                    <li>
                        <a href="/client/dashboard">
                            <div class="option"><i class="fa fa-home"></i>Home</div>
                        </a>
                    </li>
                    <li>
                        <div class="link option"><i class="fas fa-door-closed"></i>Rooms<i class="fa fa-chevron-down"></i></div>
                        <ul class="submenu " style="display: none;">
                        
                        <?php foreach($data['rooms'] as $value):?>
                            <li>
                                <form action="/client/room" method="POST">
                                    <input style="display:none;" name="room_id" value="<?= $value['ID']?>" type="number">
                                    <button style="width: 100%; text-align:left;" class="reset-button" type="submit">
                                        <div class="sub-option ml-25"><?= $value['roomName']?></div>
                                    </button>
                                </form>
                            </li>
                        <?php endforeach;?>
                        
                        </ul>
                    </li>


                    <li>
                        <a href="/client/statistics">
                            <div class="option"><i class="fa fa-bar-chart"></i>Statistics</div>
                        </a>
                    </li>
                    <li>
                        <a href="/client/notification">
                            <div class="option"><i class="fa fa-flag-o"></i>Notification</div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="option" onclick="logout()"><i class="fa fa-sign-out"></i>Log Out</div>
                        </a>
                    </li>
                    <li>
                        <div class="link option"><i class="fa fa-home"></i>Pages<i class="fa fa-chevron-down"></i></div>
                        <ul class="submenu " style="display: none;">
                            <li>
                                <a href="404.php">
                                    <div class="sub-option ml-25">404 Page</div>
                                </a>
                            </li>
                            <li>
                                <a href="505.php">
                                    <div class="sub-option ml-25">505 Page</div>
                                </a>
                            </li>
                            <li>
                                <a href="blank.php">
                                    <div class="sub-option ml-25">Blank Page</div>
                                </a>
                            </li>
                            <li>
                                <a href="register.php">
                                    <div class="sub-option ml-25">Register Page</div>
                                </a>
                            </li>
                            <li>
                                <a href="login.php">
                                    <div class="sub-option ml-25">Login Page</div>
                                </a>
                            </li>
                            <li>
                                <a href="room.php">
                                    <div class="sub-option ml-25">Room Page</div>
                                </a>
                            </li>
                        </ul>
                    </li>


                </ul>

                <!-- Sidebar List End -->

            </div>
            <div class="sidebar-footer">
                <span>Home CPanel &copy; 2021</span>
            </div>
        </div> <!-- Sidebar div end -->