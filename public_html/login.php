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
                <div class="mdc-layout-grid__cell--span-4 desktop-only"></div>
                <div class="mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--span-8-tablet mdc-layout-grid__cell--align-center mdc-elevation--z2">
                    <h1 class="kashuan txt-ctr">Log In:</h1>
                    <br>
                    <form method="post" action="/process_login.php" id="loginform">
                        <div class="flx-ctr">
                            <div class="mdc-text-field" data-mdc-auto-init="MDCTextField">
                                <input class="mdc-text-field__input" name="email">
                                <div class="mdc-line-ripple"></div>
                                <label class="mdc-floating-label">Email</label>
                            </div>
                        </div>
                        <br>
                        <div class="flx-ctr">
                            <div class="mdc-text-field" data-mdc-auto-init="MDCTextField">
                                <input class="mdc-text-field__input" type="password" name="password">
                                <div class="mdc-line-ripple"></div>
                                <label class="mdc-floating-label">Password</label>
                            </div>
                        </div>
                    </form>
                    <br><br>
                    <div class="flx-ctr">
                        <button class="mdc-button mdc-button--unelevated login" onclick="$('#loginform').submit()">Log in</button>
                        &nbsp;&nbsp;&nbsp;
                        <button class="mdc-button page-href" data-page="/signup.php">Sign Up</button>
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</main>
</div>

</body>
</html>

