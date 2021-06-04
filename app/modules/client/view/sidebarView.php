
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
            <li >
                <a  href="/client/notification">
                    <i class="sidebar-logo fa fa-flag-o" aria-hidden="true"></i>
                    Bildirimler
                </a>
            </li>
            <li >
                <a  href="#">
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
    /*
    var parents = Array()
    var childs = Array()

    function checkCookie(parentid,childid) {
        var parent = getCookie("parent"+parentid);
        var child = getCookie("child"+childid);
        if (parent == "1") {
            //Parent açık olarak gelecek
            $('#parent'+parentid).addClass('activado');
            $('#parent'+parentid).children('ul').addClass('activado');
            $('#parent'+parentid).children('ul').css("display","block");
            if(child == "1"){
                $('#child'+childid).addClass('activado');
                console.log("child"+childid)
            }

        }
        
    }
    function checkParent(parentid){
        var parent = $.cookie("parent"+parentid);
        if (parent == "1") {
            //Parent açık olarak gelecek
            $('#parent'+parentid).addClass('activado');
        }
        
    }
    $( document ).ready(function() {
        checkParent(1)
        checkParent(2)
        checkParent(3)
        checkParent(4)
        checkParent(5)

        checkCookie(1,0)
        checkCookie(1,1)
        checkCookie(1,2)
        checkCookie(1,3)
        checkCookie(1,4)


    });
    function childOpen(id){
        
        var cookie = getCookie("child"+id);
        if(cookie == 0){
            for(var i = 0; i<20;i++){
                setCookie("child"+i,"0",30)
            }
            setCookie("child"+id,"1",30)
        }else{
            setCookie("child"+id,"0",30)
        }
        
    }
    function parentOpen(id){
        parents.push("parent"+id)
        var cookie =  $.cookie("parent"+id);
        if(cookie == 0){
            //Diğerlerini kapat tıklananı aç
            $.cookie("parent"+id,1)
            menuleriKapat()
            menuyuAc(id)
        }else{
            //Tıklananı kapat 
            $.cookie("parent"+id,0)
            menuyuKapat(id)
        }
    }
    function open(id){
        menuleriKapat()
        var cookie = getCookie("parent"+id);
        if(cookie == 0){
            //Diğerlerini kapat tıklananı aç
            $.cookie("parent"+id,1)
            aciliOlanlariKapat()
            tiklananiAciliGoster(id)
        }else{
            //Tıklananı kapat 
            $.cookie("parent"+id,0)
            tiklananiKapaliGoster(id)
        }
    }
    
    $( document ).ready(function() {
            var dizi = Array("1","2","asdas")
            console.log(JSON.stringify(dizi))
            
            $.cookie("cookie_adi",JSON.stringify(dizi));
            
            console.log(JSON.parse($.cookie("cookie_adi")))
        });

    function tiklananiAciliGoster(id){
        $("#parent"+id).addClass('activado');
    }
    function tiklananiKapaliGoster(id){
        $("#parent"+id).removeClass('activado');
    }
    function aciliOlanlariKapat(){

    }
    function menuleriKapat(){
        $('.menu li ul').slideUp();
        $('.menu li').removeClass('activado');
    }
    function menuyuKapat(id){
        $("#parent"+id).removeClass('activado');
        $("#parent"+id).children('ul').removeClass('activado');
        $("#parent"+id).children('ul').slideUp();
    }
    function menuyuAc(id){
        $("#parent"+id).addClass('activado');
        $("#parent"+id).children('ul').addClass('activado');
        $("#parent"+id).children('ul').slideDown();
    }*/
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