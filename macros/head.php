<?php require_once "../config.php"; ?>
<title><?php echo htmlspecialchars(app_name); ?></title>
<meta name="description" content="<?php echo addslashes(app_description); ?>">
<link rel="stylesheet" href="/static/css/global.css">
<link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
<script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

<script defer>
    $(window).ready(()=>{
        window.mdc.autoInit();
        let buttons = document.querySelectorAll(".mdc-button, .mdc-list-item");
        for(let x = 0; x < buttons.length ; x++){
            mdc.ripple.MDCRipple.attachTo(buttons[x]);
        }
        var drawer = new mdc.drawer.MDCDrawer(document.querySelector('.mdc-drawer'));
        const topAppBar = mdc.topAppBar.MDCTopAppBar.attachTo(document.getElementById('app-bar'));
        topAppBar.setScrollTarget(document.getElementById('main-content'));
        topAppBar.listen('MDCTopAppBar:nav', () => {
            drawer.open = !drawer.open;
        });
    });
</script>