<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="<?= $base ?>/assets/css/systech.css" />
    <link rel="stylesheet" href="<?= $base ?>/assets/css/style.css" />
</head>

<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="<?= $base ?>"><img src="<?= $base ?>/assets/images/logo_virtual_life.png" /></a>
            </div>
            <div class="head-side">
                <div class="head-side-left">
                    <div class="search-area">
                        <form method="GET" action="<?= $base; ?>/search">
                            <div class="search">
                                <i class="fa fa-search"></i>
                                <input type="text" placeholder="Pesquisar" name="s" class="input">
                            </div>
                            <div class="close">
                                <i class="fa fa-close"></i>
                            </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        (function($) {
            var search_button = $('.fa-search'),
                close_button = $('.close'),
                input = $('.input');
            search_button.on('click', function() {
                $(this).parent().addClass('open');
                close_button.fadeIn(500);
                input.fadeIn(500);
                input.focus();
            });

            close_button.on('click', function() {
                search_button.parent().removeClass('open');
                close_button.fadeOut(500);
                input.fadeOut(500);
            });
        })(jQuery);
    </script>