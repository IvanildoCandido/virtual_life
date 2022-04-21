<?= $render('header', ['loggedUser' => $loggedUser]); ?>
<?= $render('navbar', ['activeMenu' => 'home']); ?>
<section class="feed mt-10">

    <div class="row">
        <div class="column pr-5">
            <?= $render('feedEditor', ['user' => $loggedUser]); ?>

            <?php foreach ($feed['posts'] as $feedItem) : ?>
                <?= $render('feedItem', [
                        'data' => $feedItem,
                        'loggedUser' => $loggedUser
                    ]); ?>
            <?php endforeach; ?>

            <div class="feed-pagination">
                <?php for ($i = 0; $i < $feed['pagesCount']; $i++) : ?>
                    <a href="<?= $base; ?>/?page=<?= $i ?>" class="<?= ($i === $feed['currentPage']) ? 'active' : ''; ?>">
                        <?= $i + 1 ?>
                    </a>

                <?php endfor; ?>
            </div>

        </div>
        <?= $render('rightBar'); ?>