<div class="row">
    <div class="box flex-1 border-top-flat">
        <div class="box-body">
            <div class="profile-cover" style="background-image: url('<?= $base; ?>/media/covers/<?= $user->getCover(); ?>');"></div>
            <div class="profile-info m-20 row">
                <div class="profile-info-avatar">
                    <a href="<?= $base; ?>/profile/<?= $user->getId() ?>">
                        <img src="<?= $base; ?>/media/avatars/<?= $user->getAvatar(); ?>" />
                    </a>
                </div>
                <div class="profile-info-name">
                    <div class="profile-info-name-text"><a href="<?= $base; ?>/profile/<?= $user->getId() ?>"><?= $user->getName(); ?></a></div>
                    <?php if (!empty($user->getCity())) : ?>
                        <div class="profile-info-location"><?= $user->getCity(); ?></div>
                    <?php endif; ?>
                </div>
                <div class="profile-info-data row">
                    <?php if ($user->getId() != $loggedUser->getId()) : ?>
                        <a class="button" href="<?= $base; ?>/profile/<?= $user->getId() ?>/follow"><?= (!$isFollowing) ? 'Seguir' : 'Deixar de Seguir' ?></a>
                    <?php endif; ?>
                    <div class="profile-info-item m-width-20">
                        <a href="<?= $base; ?>/friends">
                            <div class="profile-info-item-n"><?= count($user->getFollowers()); ?></div>
                            <div class="profile-info-item-s">Seguidores</div>
                        </a>
                    </div>
                    <div class="profile-info-item m-width-20">
                        <a href="<?= $base; ?>/friends">
                            <div class="profile-info-item-n"><?= count($user->getFollowing()); ?></div>
                            <div class="profile-info-item-s">Seguindo</div>
                        </a>
                    </div>
                    <div class="profile-info-item m-width-20">
                        <a href="<?= $base; ?>/photos">
                            <div class="profile-info-item-n"><?= count($user->getPhotos()); ?></div>
                            <div class="profile-info-item-s">Fotos</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>