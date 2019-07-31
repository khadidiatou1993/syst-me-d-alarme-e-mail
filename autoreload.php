<?php
$page = $_SERVER['PHP_SELF'];
var_dump($page);
var_dump(rand(10, 10000));
$sec = "60";
?>
<html>
    <head>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    </head>
    <body>
    <?php
        echo "Watch the page reload itself in 60 second!";
    ?>
    </body>
</html>