<?= $render('header', ['loggedUser' => $loggedUser]); ?>
<?= $render('navbar', ['activeMenu' => 'config']); ?>


<div class="container-config">
    <form method="POST" enctype="multipart/form-data" action="<?= $base; ?>/config">
        <div class="row">
            <div class="col-half">
                <h4>Imagem de Perfil</h4>
                <input type="file" name="avatar" />
                <img class="config-images" src="<?= $base; ?>/media/avatars/<?= $loggedUser->getAvatar() ?>" alt="Imagem do perfil">
            </div>
            <div class="col-half">
                <h4>Imagem de Capa</h4>
                <input type="file" name="cover" />
                <img class="config-images" src="<?= $base; ?>/media/covers/<?= $loggedUser->getCover() ?>" alt="Imagem de capa">
            </div>
        </div>
        <div class="row">
            <?php
            if (!empty($flash)) {
                echo "<div class='flash'>$flash</div>";
            }
            ?>
            <h4>Dados da Conta</h4>
            <div class="input-group input-group-icon">
                <input type="text" placeholder="Nome completo" name="name" value="<?= $loggedUser->getName() ?>" />
                <div class="input-icon"><i class="fa fa-user"></i></div>
            </div>
            <div class="input-group input-group-icon">
                <input type="email" placeholder="Endereço de email" name="email" value="<?= $loggedUser->getEmail() ?>" />
                <div class="input-icon"><i class="fa fa-envelope"></i></div>
            </div>
            <div class="input-group input-group-icon">
                <input type="password" placeholder="Nova Senha" name="password" />
                <div class="input-icon"><i class="fa fa-key"></i></div>
            </div>
            <div class="input-group input-group-icon">
                <input type="password" placeholder="Confirmar senha" name="confirmPassword" />
                <div class="input-icon"><i class="fa fa-key"></i></div>
            </div>
        </div>
        <div class="row">
            <div class="col-half">
                <h4>Data de Nascimento</h4>
                <?php $birthdate = explode('-', $loggedUser->getBirthdate()) ?>
                <div class="input-group">
                    <div class="col-third">
                        <input type="text" placeholder="DD" name="day" value="<?= $birthdate[2] ?>" />
                    </div>
                    <div class="col-third">
                        <input type="text" placeholder="MM" name="month" value="<?= $birthdate[1] ?>" />
                    </div>
                    <div class="col-third">
                        <input type="text" placeholder="YYYY" name="year" value="<?= $birthdate[0] ?>" />
                    </div>
                </div>
            </div>
            <div class="col-half">
                <h4>Cidade</h4>
                <div class="input-group input-group-icon">
                    <input type="text" placeholder="Cidade" name="city" value="<?= $loggedUser->getCity() ?>" />
                    <div class="input-icon"><i class="fa fa-city"></i></div>
                </div>
            </div>
            <div class="row">
                <h4>Local de Trabalho</h4>
                <div class="input-group input-group-icon">
                    <input type="text" placeholder="Trabalho" name="work" value="<?= $loggedUser->getWork() ?>" />
                    <div class="input-icon"><i class="fa fa-briefcase"></i></div>
                </div>
            </div>
            <button class="button" type="submit">Salvar Alterações</button>
    </form>

</div>

</body>

</html>
<script>
    (function() {
        'use strict'
        const forms = document.querySelectorAll('.requires-validation')
        Array.from(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>