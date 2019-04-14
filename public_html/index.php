<?php
require_once "../config.php";
spl_autoload_register(function ($class_name) {
    require_once "../classes/".$class_name . ".php";
});
?>
<!-- https://github.com/abir-taheer/technight2019 -->
<!DOCTYPE html>
<html>
<head>
    <?php require_once "../macros/head.php"; ?>

</head>
<body>
    <div class="landing-bg-img"></div>
    <?php require_once "../macros/menu.php"; ?>

    <!-- Page Specific Head Content -->

</body>
</html>

