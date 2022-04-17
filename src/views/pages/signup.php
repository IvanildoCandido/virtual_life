<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Virtual Life - Cadastro</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1" />
    <link rel="stylesheet" href="<?= $base; ?>/assets/css/login.css" />
</head>

<body>
    <header>
        <div class="container">
            <a href=""><img src="<?= $base; ?>/assets/images/devsbook_logo.png" /></a>
        </div>
    </header>
    <section class="container main">
        <form method="POST" action="<?= $base; ?>/signup">
            <?php
            if (!empty($flash)) {
                echo "<div class='flash'>$flash</div>";
            }
            ?>
            <input placeholder="Nome completo" class="input" type="text" name="name" />

            <input placeholder="E-mail" class="input" type="email" name="email" />

            <input placeholder="Senha" class="input" type="password" name="password" />

            <input id="birthdate" placeholder="Data de nascimento" class="input" type="text" name="birthdate" />

            <input class="button" type="submit" value="Fazer cadastro" />

            <a href="<?= $base; ?>/login">Já tem conta? Faça o login</a>
        </form>
    </section>
    <script src="https://unpkg.com/imask"></script>
    <script>
        IMask(document.getElementById('birthdate'), {
            mask: '00/00/0000'
        })
    </script>
</body>

</html>