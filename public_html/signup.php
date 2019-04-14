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
                <div class="mdc-layout-grid__cell--span-4 desktop-only "></div>
                <div class="mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--span-8-tablet mdc-layout-grid__cell--align-center mdc-elevation--z2">
                    <h1 class="kashuan txt-ctr">Sign Up:</h1>
                    <br>
                    <form method="post" action="/process_signup.php" id="signupform">
                        <div class="flx-ctr">
                            <div class="mdc-text-field mdc-text-field--outlined" data-mdc-auto-init="MDCTextField">
                                <input class="mdc-text-field__input" name="first">
                                <div class="mdc-notched-outline">
                                    <div class="mdc-notched-outline__leading"></div>
                                    <div class="mdc-notched-outline__notch">
                                        <label class="mdc-floating-label">First Name</label>
                                    </div>
                                    <div class="mdc-notched-outline__trailing"></div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="flx-ctr">
                            <div class="mdc-text-field mdc-text-field--outlined" data-mdc-auto-init="MDCTextField">
                                <input class="mdc-text-field__input" name="last">
                                <div class="mdc-notched-outline">
                                    <div class="mdc-notched-outline__leading"></div>
                                    <div class="mdc-notched-outline__notch">
                                        <label class="mdc-floating-label">Last Name</label>
                                    </div>
                                    <div class="mdc-notched-outline__trailing"></div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="flx-ctr">
                            <div class="mdc-text-field mdc-text-field--outlined" data-mdc-auto-init="MDCTextField">
                                <input class="mdc-text-field__input" name="email">
                                <div class="mdc-notched-outline">
                                    <div class="mdc-notched-outline__leading"></div>
                                    <div class="mdc-notched-outline__notch">
                                        <label class="mdc-floating-label">Email Address</label>
                                    </div>
                                    <div class="mdc-notched-outline__trailing"></div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="flx-ctr">
                            <div class="mdc-text-field mdc-text-field--outlined" data-mdc-auto-init="MDCTextField">
                                <input class="mdc-text-field__input" name="password" type="password">
                                <div class="mdc-notched-outline">
                                    <div class="mdc-notched-outline__leading"></div>
                                    <div class="mdc-notched-outline__notch">
                                        <label class="mdc-floating-label">Password</label>
                                    </div>
                                    <div class="mdc-notched-outline__trailing"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br><br>
                    <div class="flx-ctr">
                        <button class="mdc-button mdc-button--unelevated login" onclick="$('#signupform').submit()">Sign Up</button>
                        &nbsp;&nbsp;&nbsp;
                        <button class="mdc-button page-href" data-page="/signup.php">Log In</button>
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

