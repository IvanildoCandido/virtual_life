<?= $render('header', ['loggedUser' => $loggedUser]); ?>
<?= $render('navbar', ['activeMenu' => 'photos']); ?>

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
        <div class="column">

            <div class="box">
                <div class="box-body">
                    <?php if (count($user->getPhotos()) === 0) : ?>
                        <h3 class="photos-msg">Este usuário ainda não adicionou nenhuma foto!</h3>
                    <?php endif; ?>
                    <?php foreach ($user->getPhotos() as $photo) : ?>
                        <div class="full-user-photos">
                            <div class="user-photo-item">
                                <a href="#modal-<?= $photo->getId() ?>" rel="modal:open">
                                    <img src="<?= $base; ?>/media/uploads/<?= $photo->getBody() ?>" />
                                </a>
                                <div id="modal-<?= $photo->getId() ?>" style="display:none">
                                    <img src="<?= $base; ?>/media/uploads/<?= $photo->getBody() ?>" />
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>


                </div>
            </div>

        </div>
    </div>

</section>
<?= $render('footer'); ?>