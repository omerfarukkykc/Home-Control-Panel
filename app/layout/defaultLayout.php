<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/client/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="/assets/default/css/main.css">
    <script src="/assets/client/js/jquery-3.6.0.min.js"></script>
    <script src="/assets/default/js/main.js"></script>
    <script src="https://kit.fontawesome.com/f03a2ca762.js" crossorigin="anonymous"></script>

    <title>Lepric</title>
</head>
<body>
<div id="wrap" class="wrap">
<?=View::renderView("default","navbar")?>
<?=$data['VIEW']?>
<?=View::renderView("default","footer")?>


    
</div>

</body>
</html>
