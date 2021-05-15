<!doctype html>
<html lang="tr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/assets/client/css/login.css">
    <link rel="stylesheet" href="/assets/client/css/perfect-scrollbar.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <title>Home Asistant</title>
        
</head>

<body>
    <div class="global-message" style="top: 0 !important;"></div>
    <?=$data['VIEW']?>
 
    
    <script src="/assets/client/js/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/f03a2ca762.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="/assets/client/js/main.js"></script>
    <script>
        $(document).ready(function () {

        <?php if(isset($data['msg'])): ?>
            GlobalMessage('<?=$data['msg']?>');
        <?php endif;?>
        });
    </script>

</body>

</html>