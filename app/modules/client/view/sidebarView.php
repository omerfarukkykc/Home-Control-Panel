
<div  class="sidebar">

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
       
        <ul class="menu">
            <li  >
                <a  href="/client/dashboard">
                    <i class="sidebar-logo fa fa-home" aria-hidden="true"></i>
                    Anasayfa
                </a>
            </li>
            <li >
                <a >
                    <i class="sidebar-logo fas fa-door-closed" aria-hidden="true"></i>
                    Odalar
                    <i class="fa fa-chevron-down"></i>
                </a>
                <ul>
                    <?php foreach($data['rooms'] as $key => $value):?>
                    <li id="child<?= $key?>">
                        <a  href="/client/room/<?= $value['ID']?>">
                            <?= $value['roomName']?>
                        </a>
                    </li>
                    <?php endforeach;?>
                </ul>
            </li>
            <li >
                <a  href="/client/statistics"> 
                    <i class="sidebar-logo fa fa-bar-chart" aria-hidden="true"></i>
                    İstatistikler
                </a>
            </li>
            <!--
            <li >
                <a  href="/client/notification">
                    <i class="sidebar-logo fa fa-flag-o" aria-hidden="true"></i>
                    Bildirimler
                </a>
            </li>
            -->
            <li >
                <a  href="/client/logout">
                    <i class="sidebar-logo fa fa-sign-out" aria-hidden="true"></i>
                    Çıkış yap   
                </a>
            </li>
            
        </ul>
    
    
        
        
                
        <!-- Sidebar List End -->

    </div>
    <div class="sidebar-footer">
        <span>Home CPanel &copy; 2021</span>
    </div>
</div> <!-- Sidebar div end -->
<script>
   
    $(document).ready(function() {
	$('.menu li:has(ul)').click(function(e) {
		e.preventDefault();

		if($(this).hasClass('activado')) {
			$(this).removeClass('activado');
			$(this).children('ul').slideUp();
		} else {
			$('.menu li ul').slideUp();
			$('.menu li').removeClass('activado');
			$(this).addClass('activado');
			$(this).children('ul').slideDown();
		}

		$('.menu li ul li a').click(function() {
			window.location.href = $(this).attr('href');
		})
	});
});
    
</script>