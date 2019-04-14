<?php require_once "../config.php"; ?>
<aside class="mdc-drawer mdc-drawer--modal">
    <div class="mdc-drawer__header">
        <img class="drawer-logo" src="/static/img/logo.png">
        <h3 class="mdc-drawer__title lobster">SchoolBot</h3>
        <h6 class="mdc-drawer__subtitle"><?php echo Session::hasSession() ? htmlspecialchars(Session::getUser()->name) : "Not Signed In"; ?></h6>
    </div>
    <div class="mdc-drawer__content">
        <nav class="mdc-list">
            <?php if( Session::hasSession() ): ?>
                <a class="mdc-list-item mdc-list-item--activated" href="/signout.php" aria-selected="true">
                    <i class="material-icons mdc-list-item__graphic" aria-hidden="true">power_settings_new</i>
                    <span class="mdc-list-item__text">Sign Out</span>
                </a>
            <?php else: ?>
                <a class="mdc-list-item mdc-list-item--activated" href="/login.php?redirect=/home.php" aria-selected="true">
                    <i class="material-icons mdc-list-item__graphic" aria-hidden="true">lock_open</i>
                    <span class="mdc-list-item__text">Log In</span>
                </a>
            <?php endif; ?>
            <a class="mdc-list-item" href="#">
                <i class="material-icons mdc-list-item__graphic" aria-hidden="true">send</i>
                <span class="mdc-list-item__text">Outgoing</span>
            </a>
            <a class="mdc-list-item" href="#">
                <i class="material-icons mdc-list-item__graphic" aria-hidden="true">drafts</i>
                <span class="mdc-list-item__text">Drafts</span>
            </a>
        </nav>
    </div>
</aside>

<div class="mdc-snackbar">
    <div class="mdc-snackbar__surface">
        <div class="mdc-snackbar__label"
             role="status"
             aria-live="polite">
            Can't send photo. Retry in 5 seconds.
        </div>
        <div class="mdc-snackbar__actions">
            <button type="button" class="mdc-icon-button mdc-snackbar__action material-icons">clear</button>
        </div>
    </div>
</div>
<div class="mdc-drawer-scrim"></div>

<div class="mdc-drawer-app-content">
    <header class="mdc-top-app-bar app-bar" id="app-bar">
        <div class="mdc-top-app-bar__row">
            <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
                <a href="#" class="demo-menu material-icons mdc-top-app-bar__navigation-icon">menu</a>
                <span class="mdc-top-app-bar__title lobster"><?php echo htmlspecialchars(app_name); ?></span>
            </section>
        </div>
    </header>
