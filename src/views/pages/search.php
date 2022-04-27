<?= $render('header', ['loggedUser' => $loggedUser]); ?>
<?= $render('navbar', ['activeMenu' => 'search']); ?>

<section class="feed mt-10">
    <div class="row">
        <div class="column pr-5">
            <h3>Você pesquisou por : <?= $search ?></h3>
            <div class="full-friend-list">
                <?php foreach ($users as $user) : ?>
                    <div class="friend-icon">
                        <a href="<?= $base; ?>/profile/<?= $user->getId(); ?>">
                            <div class="friend-icon-avatar">
                                <img src="<?= $base; ?>/media/avatars/<?= $user->getAvatar(); ?>" />
                            </div>
                            <div class="friend-icon-name">
                                <?= $user->getName(); ?>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?= $render('rightBar'); ?>
    </div>
</section>
<?= $render('footer'); ?>