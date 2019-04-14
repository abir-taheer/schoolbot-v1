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
        <main class="main-content" id="main-content">
            <div class="mdc-top-app-bar--fixed-adjust">
                <h1 class="kashuan txt-ctr open-txt" id="opening-type"></h1>
                <div class="flx-ctr">
                    <button class="mdc-button kashuan mdc-button--raised start-button page-href" data-page="/login?redirect=home" style="display:none;">Get Started</button>
                </div>
            </div>
        </main>
    </div>
    <!-- Page Specific Head Content -->

<script>
    new TypeIt('#opening-type', {
        speed: 50
    }).pause(500).type("The the future of communication").pause(1000).type(" is here!").exec(async () => {
        await new Promise((resolve, reject) => {
            setTimeout(() => {
                $(".start-button").fadeIn();
                return resolve();
            }, 500)
        });
    }).go();
</script>
</body>
</html>

