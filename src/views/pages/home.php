<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1" />
    <link rel="stylesheet" href="<?= $base ?>/assets/css/style.css" />
</head>

<body>
    <?= $render('header', ['loggedUser' => $loggedUser]); ?>
    <section class="container main">
        <?= $render('navbar'); ?>
        <section class="feed mt-10">

            <div class="row">
                <div class="column pr-5">
                    <?= $render('feedEditor', ['user' => $loggedUser]); ?>
                    <?= $render('feedItem'); ?>
                </div>
                <?= $render('rightBar'); ?>
</body>

</html>