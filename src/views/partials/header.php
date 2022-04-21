<header>
    <div class="container">
        <div class="logo">
            <a href="<?= $base ?>"><img src="<?= $base ?>/assets/images/logo_virtual_life.png" /></a>
        </div>
        <div class="head-side">
            <div class="head-side-left">
                <div class="search-area">
                    <form method="GET">
                        <input type="search" placeholder="Pesquisar" name="s" />
                    </form>
                </div>
            </div>
            <div class="head-side-right">
                <a href="<?= $base ?>/profile" class="user-area">
                    <div class="user-area-text"><?= $loggedUser->getName() ?></div>
                    <div class="user-area-icon">
                        <img src="<?= $base ?>/media/avatars/<?= $loggedUser->getAvatar() ?>" />
                    </div>
                </a>
                <a href="<?= $base ?>/logout" class="user-logout">
                    <img src="<?= $base ?>/assets/images/power_white.png" />
                </a>
            </div>
        </div>
    </div>
</header>