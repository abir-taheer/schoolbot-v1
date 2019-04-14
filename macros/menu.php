<?php require_once "../config.php"; ?>
<aside class="mdc-drawer mdc-drawer--modal">
    <div class="mdc-drawer__content">
        <nav class="mdc-list">
            <a class="mdc-list-item mdc-list-item--activated" href="#" aria-selected="true">
                <i class="material-icons mdc-list-item__graphic" aria-hidden="true">inbox</i>
                <span class="mdc-list-item__text">Inbox</span>
            </a>
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

    <main class="main-content" id="main-content">
        <div class="mdc-top-app-bar--fixed-adjust">

        </div>
    </main>
</div>
