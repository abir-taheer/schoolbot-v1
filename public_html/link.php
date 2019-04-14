<?php
require_once "../config.php";
spl_autoload_register(function ($class_name) {
    require_once "../classes/".$class_name . ".php";
});

// Cover the case that they aren't signed in
if( ! Session::hasSession() ){
    header("Location: /login.php?redirect=/link.php");
    exit;
}
if(isset($_GET["link-code"])){
                        $code = new LinkCode($_REQUEST["link-code"]);
                        if( ! $code->constructed ){
                            setcookie("notification", base64_encode("That code is invalid"), strtotime("+1 day"), "/");
                            header("Location: /link.php");
                            exit;
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
<div class="landing-bg-img"></div>
<?php require_once "../macros/menu.php"; ?>
<main class="main-content" id="main-content">
    <div class="mdc-top-app-bar--fixed-adjust">
        <div class="mdc-layout-grid">
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell--span-4 desktop-only "></div>
                <div class="mdc-card mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--span-8-tablet mdc-layout-grid__cell--align-center mdc-elevation--z2">
                    <h1 class="kashuan txt-ctr">Link with application:</h1>
                    <?php if( ! isset($_REQUEST["link-code"]) ): ?>
                        <form>
                            <div class="flx-ctr">
                                <div class="mdc-text-field mdc-text-field--outlined" data-mdc-auto-init="MDCTextField">
                                    <input type="text" id="tf-outlined" class="mdc-text-field__input" name="link-code">
                                    <div class="mdc-notched-outline">
                                        <div class="mdc-notched-outline__leading"></div>
                                        <div class="mdc-notched-outline__notch">
                                            <label for="tf-outlined" class="mdc-floating-label">Link Code:</label>
                                        </div>
                                        <div class="mdc-notched-outline__trailing"></div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="flx-ctr">
                                <button class="mdc-button mdc-button--raised" style="width:80%;">Add</button>
                            </div>
                            <br>
                        </form>
                    <?php else: ?>
                    <form action="/add_app.php" method="post">
                        <input type="hidden" name="link_code" value="<?php echo $_REQUEST["link-code"]; ?>">
                        <p class="txt-ctr arch">What do you want to name this app (for personal records)</p>
                        <div class="flx-ctr">
                            <div class="mdc-text-field mdc-text-field--outlined" data-mdc-auto-init="MDCTextField">
                                <input type="text" id="tf-outlined" class="mdc-text-field__input" name="title">
                                <div class="mdc-notched-outline">
                                    <div class="mdc-notched-outline__leading"></div>
                                    <div class="mdc-notched-outline__notch">
                                        <label for="tf-outlined" class="mdc-floating-label">Title:</label>
                                    </div>
                                    <div class="mdc-notched-outline__trailing"></div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="flx-ctr">
                            <button class="mdc-button mdc-button--raised" style="width:80%;">Add</button>
                        </div>
                        <br><br>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
    </div>
</main>
</div>
</body>
</html>

