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

$school = new School($_GET["id"]);
if( Session::hasSession() ){
    $user = Session::getUser();
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
        <h1 class="kashuan txt-ctr"><?php echo $school->name; ?></h1>
        <?php if( isset($user) && ! in_array($school, $user->getSchools())): ?>
        <div class="flx-ctr">
            <button class="mdc-button mdc-button--raised page-href" data-page="/add_school.php?school=<?php echo $school->school_code; ?>">Join School</button>
        </div>
        <?php endif; ?>
        <div class="sub-container">
            <h2 class="kashuan">Updates:</h2>
            <div class="mdc-layout-grid">
                <div class="mdc-layout-grid__inner">
                    <?php foreach($school->getUpdates() as $update): ?>
                        <div class="mdc-card mdc-layout-grid__cell--span-4 mdc-elevation--z2" >
                            <div class="mdc-card__primary-action page-href" data-page="/schools.php?id=<?php echo $update["update_id"]; ?>" tabindex="0" data-mdc-auto-init="MDCRipple">
                                <div class="mdc-card__media mdc-card__media--16-9" style="background-image: url('<?php echo $update["pic"]; ?>');"></div>
                                <div class="rl-padding">
                                    <h2 class="mdc-typography mdc-typography--headline6 rl-padding kashuan"><?php echo $update["title"]; ?></h2>
                                    <p class="mdc-typography rl-padding raleway" style="height: 160px;text-overflow: ellipsis;"><?php echo $update["content"] ?></p>
                                </div>
                            </div>
                            <div class="mdc-card__actions">
                                <button class="mdc-button raleway page-href" data-page="/schools.php?id=<?php echo $update["update_id"]; ?>" data-mdc-auto-init="MDCRipple">View Update</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <h2 class="kashuan">Resources:</h2>
            <div class="mdc-layout-grid">
                <div class="mdc-layout-grid__inner">
                    <?php foreach($school->getAllResources() as $resource): ?>
                        <div class="mdc-card mdc-layout-grid__cell--span-4 mdc-elevation--z2" >
                            <div class="mdc-card__primary-action page-href" data-page="<?php echo $resource["url"]; ?>" tabindex="0" data-mdc-auto-init="MDCRipple">
                                <div class="rl-padding">
                                    <h2 class="mdc-typography mdc-typography--headline6 rl-padding kashuan"><?php echo $resource["name"]; ?></h2>
                                </div>
                            </div>
                            <div class="mdc-card__actions">
                                <button class="mdc-button raleway page-href" data-page="/schools.php?id=<?php echo $resource["url"]; ?>" data-mdc-auto-init="MDCRipple">View Resource</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
    </div>
</main>
</div>
</body>
</html>

