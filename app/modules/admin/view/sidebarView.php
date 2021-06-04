

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
            <li>
                <a onclick="parentOpen()" href="/admin/dashboard">
                    <i class="sidebar-logo fa fa-home" aria-hidden="true"></i>
                    Anasayfa
                </a>
            </li>
            <li>
                <a onclick="parentOpen()" href="/admin/users"> 
                    <i class="sidebar-logo fa fa-users" aria-hidden="true"></i>
                    Kullanıcılar
                </a>
            </li>
            <li>
                <a onclick="parentOpen()" href="/admin/adduser">
                    <i class="sidebar-logo fa fa-user-plus" aria-hidden="true"></i>
                    Kullanıcı ekle
                </a>
            </li>
            <li>
                <a onclick="parentOpen()" href="/admin/logout">
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
    function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
        c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
        }
    }
    return "";
    }

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
    $( document ).ready(function() {
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
        if(id==null){
            setCookie("parent1","0",30)
        }
        var cookie = getCookie("parent"+id);
        if(cookie == 0){
            //Diğerlerini kapat tıklananı aç
            setCookie("parent"+id,"1",30)
            $('.menu li ul').slideUp();
            $('.menu li').removeClass('activado');
            $("#parent"+id).addClass('activado');
            $("#parent"+id).children('ul').addClass('activado');
            $("#parent"+id).children('ul').slideDown();
        }else{
            //Tıklananı kapat 
            setCookie("parent"+id,"0",30)
            $("#parent"+id).removeClass('activado');
            $("#parent"+id).children('ul').removeClass('activado');
            $("#parent"+id).children('ul').slideUp();
            
        }
    }
    
</script>