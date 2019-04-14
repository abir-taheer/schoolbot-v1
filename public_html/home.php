<?php
require_once "../config.php";
spl_autoload_register(function ($class_name) {
    require_once "../classes/".$class_name . ".php";
});

// Cover the case that they aren't signed in
if( ! Session::hasSession() ){
    header("Location: /login.php?redirect=/home.php");
    exit;
}
$user = Session::getUser();
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
            <h1 class="kashuan txt-ctr">Home</h1>
            <div class="sub-container">
                <h2 class="kashuan">My Schools:</h2>
                <?php if( count($user->getSchools()) === 0 ): ?>
                    <p class="raleway">You are currently not enrolled in any schools. <a href="/chooseschool.php">Click here</a> to join a school!</p>
                <?php endif; ?>
                <div class="mdc-layout-grid">
                    <div class="mdc-layout-grid__inner">
                        <?php foreach($user->getSchools() as $school): ?>
                            <div class="mdc-card mdc-layout-grid__cell--span-5 mdc-elevation--z2" >
                                <div class="mdc-card__primary-action page-href" data-page="/schools.php?id=<?php echo $school->school_code; ?>" tabindex="0" data-mdc-auto-init="MDCRipple">
                                    <div class="mdc-card__media mdc-card__media--16-9" style="background-image: url('<?php echo $school->pic; ?>');"></div>
                                    <div class="rl-padding">
                                        <h2 class="mdc-typography mdc-typography--headline6 rl-padding"><?php echo $school->name; ?></h2>
                                    </div>
                                </div>
                                <div class="mdc-card__actions">
                                    <button class="mdc-button raleway page-href" data-page="/schools.php?id=<?php echo $school->school_code; ?>" data-mdc-auto-init="MDCRipple">View School</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>

