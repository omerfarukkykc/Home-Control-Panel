<!doctype html>
<html lang="tr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/assets/client/css/main.css">
    <link rel="stylesheet" href="/assets/client/css/dashboard.css">
    <link rel="stylesheet" href="/assets/admin/css/main.css">

    <script src="/assets/client/js/jquery-3.6.0.min.js"></script>
    <script src="/assets/admin/js/chart.js"></script>
    <title>Home CPanel</title>
</head>

<body>
    <div id="wrap" class="sidebar-active">
        <!-- Wrap div start -->
        <?=View::renderView("client","sidebar",$data['sidebar'])?>
        <?=View::renderView("client","header")?>
        <?=$data['VIEW']?>
        
    </div><!-- Wrapper div end -->

    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="/assets/client/js/echarts.min.js"></script>
    <script src="/assets/client/js/dashboard.js"></script>
    <script src="/assets/client/js/main.js"></script>
    <script src="/assets/client/js/fontawesome.js"></script>

</body>

</html>