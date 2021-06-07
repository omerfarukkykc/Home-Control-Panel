<div class="navbar">
    <div style="margin: 0;" class="row">
        <div class="col-6 col-s-6 col-xs-6 col-xxs-10"><a href="/">Lepric Akıllı Ev</a></div>
        <div class="col-6 col-s-6 col-xs-6 col-xxs-2">
            <div class="item"><a href="#contactus"">Bize ulaşın</a></div>
            <div class="item"><a href="/client/login">Giriş yap</a></div>
            <a href="javascript:void(0);" class="icon" onclick="navbar()">
                <i style="color: #ececec;" class="fa fa-bars"></i>
            </a>
        </div>
    </div>
    <div class="row responsive">
        <a href="#contactus"">Bize ulaşın</a>
    </div>
    <div class="row responsive">
        <a href="/client/login">Giriş yap</a>
    </div>
</div>
<script>
function navbar(){
    $('.navbar').toggleClass("active");
}
</script>