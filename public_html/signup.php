<?php
require_once "../config.php";
spl_autoload_register(function ($class_name) {
    require_once "../classes/".$class_name . ".php";
});

if( Session::hasSession() ){
    if( isset($_GET["redirect"]) ){
        header("Location: ".$_GET["redirect"]);
    } else {
        header("Location: /home.php");
    }
}
?>
<!-- https://github.com/abir-taheer/technight2019 -->
<!DOCTYPE html>
<html>
<head>
    <?php require_once "../macros/head.php"; ?>

</head>
<body>
<?php require_once "../macros/menu.php"; ?>
<main class="main-content" id="main-content">
    <div class="mdc-top-app-bar--fixed-adjust">
        <!-- Login Card -->
        <div class="mdc-layout-grid">
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell--span-4 desktop-only mdc-layout-grid__cell--span-8-tablet mdc-layout-grid__cell--align-center mdc-elevation--z2"></div>
                <div class="mdc-layout-grid__cell--span-4">

                </div>
            </div>
        </div>
    </div>
</main>
</div>

</body>
</html>

