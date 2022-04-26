<?= $render('header', ['loggedUser' => $loggedUser]); ?>
<?= $render('navbar', ['activeMenu' => 'photos']); ?>

<section class="feed">

    <?= $render('profile_header', ['user' => $user, 'loggedUser' => $loggedUser, 'isFollowing' => $isFollowing]); ?>
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