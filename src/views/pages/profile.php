<?= $render('header', ['loggedUser' => $loggedUser]); ?>
<?= $render('navbar', ['activeMenu' => 'profile']); ?>

<section class="feed">
    <div class="row">
        <div class="box flex-1 border-top-flat">
            <div class="box-body">
                <div class="profile-cover" style="background-image: url('<?= $base; ?>/media/covers/<?= $user->getCover(); ?>');"></div>
                <div class="profile-info m-20 row">
                    <div class="profile-info-avatar">
                        <img src="<?= $base; ?>/media/avatars/<?= $user->getAvatar(); ?>" />
                    </div>
                    <div class="profile-info-name">
                        <div class="profile-info-name-text"><?= $user->getName(); ?></div>
                        <?php if ($user->getCity() === NULL) : ?>
                            <div class="profile-info-location"><?= $user->getCity(); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="profile-info-data row">
                        <?php if ($user->getId() != $loggedUser->getId()) : ?>
                            <a class="button" href="<?= $base; ?>/profile/<?= $user->getId() ?>/follow"><?= (!$isFollowing) ? 'Seguir' : 'Deixar de Seguir' ?></a>
                        <?php endif; ?>
                        <div class="profile-info-item m-width-20">
                            <div class="profile-info-item-n"><?= count($user->getFollowers()); ?></div>
                            <div class="profile-info-item-s">Seguidores</div>
                        </div>
                        <div class="profile-info-item m-width-20">
                            <div class="profile-info-item-n"><?= count($user->getFollowing()); ?></div>
                            <div class="profile-info-item-s">Seguindo</div>
                        </div>
                        <div class="profile-info-item m-width-20">
                            <div class="profile-info-item-n"><?= count($user->getPhotos()); ?></div>
                            <div class="profile-info-item-s">Fotos</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="column side pr-5">

            <div class="box">
                <div class="box-body">

                    <div class="user-info-mini">
                        <img src="<?= $base; ?>/assets/images/calendar.png" />
                        <?= date('d/m/Y', strtotime($user->getBirthdate())) ?> (<?= $age ?> anos)
                    </div>
                    <?php if ($user->getCity() === NULL) : ?>
                        <div class="user-info-mini">
                            <img src="<?= $base; ?>/assets/images/pin.png" />
                            <?= $user->getCity(); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($user->getWork() === NULL) : ?>
                        <div class="user-info-mini">
                            <img src="<?= $base; ?>/assets/images/work.png" />
                            <?= $user->getWork(); ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <div class="box">
                <div class="box-header m-10">
                    <div class="box-header-text">
                        Seguindo
                        <span>(<?= count($user->getFollowing()); ?>)</span>
                    </div>
                    <div class="box-header-buttons">
                        <a href="">ver todos</a>
                    </div>
                </div>
                <div class="box-body friend-list">
                    <?php for ($i = 0; $i < 9; $i++) : ?>
                        <?php if (isset($user->getFollowing()[$i])) : ?>
                            <div class="friend-icon">
                                <a href="<?= $base; ?>/profile/<?= $user->getFollowing()[$i]->getId() ?>">
                                    <div class="friend-icon-avatar">
                                        <img src="<?= $base; ?>/media/avatars/<?= $user->getFollowing()[$i]->getAvatar() ?>" />
                                    </div>
                                    <div class="friend-icon-name">
                                        <?= $user->getFollowing()[$i]->getName() ?>
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>

        </div>
        <div class="column pl-5">

            <div class="box">
                <div class="box-header m-10">
                    <div class="box-header-text">
                        Fotos
                        <span>(<?= count($user->getPhotos()); ?>)</span>
                    </div>
                    <div class="box-header-buttons">
                        <a href="">ver todos</a>
                    </div>
                </div>
                <div class="box-body row m-20">
                    <?php for ($i = 0; $i < 4; $i++) : ?>
                        <?php if (isset($user->getPhotos()[$i])) : ?>
                            <div class="user-photo-item">
                                <a href="#modal-<?= $user->getPhotos()[$i]->getId(); ?>" rel="modal:open">
                                    <img src="<?= $base; ?>/media/uploads/<?= $user->getPhotos()[$i]->getBody(); ?>" />
                                </a>
                                <div id="modal-<?= $user->getPhotos()[$i]->getId(); ?>" style="display:none">
                                    <img src="<?= $base; ?>/media/uploads/<?= $user->getPhotos()[$i]->getBody(); ?>" />
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>
            <?php if ($user->getId() === $loggedUser->getId()) : ?>
                <?= $render('feedEditor', ['user' => $loggedUser]); ?>
            <?php endif; ?>
            <?php foreach ($feed['posts'] as $feedItem) : ?>
                <?= $render('feedItem', [
                        'data' => $feedItem,
                        'loggedUser' => $loggedUser
                    ]); ?>
            <?php endforeach; ?>

            <div class="feed-pagination">
                <?php for ($i = 0; $i < $feed['pagesCount']; $i++) : ?>
                    <a href="<?= $base; ?>/profile/<?= $user->getId() ?>?page=<?= $i ?>" class="<?= ($i === $feed['currentPage']) ? 'active' : ''; ?>">
                        <?= $i + 1 ?>
                    </a>

                <?php endfor; ?>
            </div>


        </div>

    </div>

</section>
<?= $render('footer'); ?>