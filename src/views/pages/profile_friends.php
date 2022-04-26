<?= $render('header', ['loggedUser' => $loggedUser]); ?>
<?= $render('navbar', ['activeMenu' => 'friends']); ?>

<section class="feed">
    <?= $render('profile_header', ['user' => $user, 'loggedUser' => $loggedUser, 'isFollowing' => $isFollowing]); ?>

    <div class="row">
        <div class="column">

            <div class="box">
                <div class="box-body">

                    <div class="tabs">
                        <div class="tab-item" data-for="followers">
                            Seguidores
                        </div>
                        <div class="tab-item active" data-for="following">
                            Seguindo
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-body" data-item="followers">

                            <div class="full-friend-list">
                                <?php foreach ($user->getFollowers() as $follower) : ?>
                                    <div class="friend-icon">
                                        <a href="<?= $base; ?>/profile/<?= $follower->getId(); ?>">
                                            <div class="friend-icon-avatar">
                                                <img src="<?= $base; ?>/media/avatars/<?= $follower->getAvatar(); ?>" />
                                            </div>
                                            <div class="friend-icon-name">
                                                <?= $follower->getName(); ?>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                        </div>
                        <div class="tab-body" data-item="following">

                            <div class="full-friend-list">
                                <?php foreach ($user->getFollowing() as $following) : ?>
                                    <div class="friend-icon">
                                        <a href="<?= $base; ?>/profile/<?= $follower->getId(); ?>">
                                            <div class="friend-icon-avatar">
                                                <img src="<?= $base; ?>/media/avatars/<?= $following->getAvatar(); ?>" />
                                            </div>
                                            <div class="friend-icon-name">
                                                <?= $following->getName(); ?>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</section>
<?= $render('footer'); ?>