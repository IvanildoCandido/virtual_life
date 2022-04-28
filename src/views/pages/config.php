<?= $render('header', ['loggedUser' => $loggedUser]); ?>
<?= $render('navbar', ['activeMenu' => 'config']); ?>
<section class="config-form">
    <form method="POST">
        <div>
            <label>Nome Completo</label>
            <input class="input" type="text" name="name" />
        </div>
        <div>
            <label>Email</label>
            <input class="input" type="email" name="email" />
        </div>
        <div>
            <label>Nova Senha</label>
            <input class="input" type="password" name="password" />
        </div>
        <div>
            <label>Confirmar Senha</label>
            <input class="input" type="password" name="passwordConfirm" />
        </div>
        <input class="button" type="submit" value="Salvar Alterações" />
    </form>
</section>
</body>

</html>