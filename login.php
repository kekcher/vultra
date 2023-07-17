<!-- ************************************************************************ -->
<!--                             ФОРМА АВТОРИЗАЦИИ                            -->
<!-- ************************************************************************ -->
<?php
    setcookie('user', null, time() - 3600, "/");
    setcookie('userPass', null, time() - 3600, "/");
    setcookie('cookTableName', null, time() - 3600, "/");
    setcookie('CookAccLogin', null, time() - 3600, "/");
    setcookie('CookAccPassword', null, time() - 3600, "/");
    setcookie('CookUserFound', null, time() - 3600, "/");
    setcookie('count', null, time() - 3600, "/");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="stylesheet" href="style/style.css">
    <title>NIR</title>
</head>
<body>
    <div class="input_container">
        <div class="input_header_container">
            <h1 class="input_header">Добро пожаловать в VULTRA!</h1>
        </div>
        <h1 class="action_sign">Авторизация</h1>
        <form action="" onsubmit="return false;" id="log_form" method="post" class="input_container_inner">
            <div class="input_container_element">
                <p class="input_left_sign">Никнейм:</p>
                <input class="input_box" type="text" id="login" name="login" />
            </div>
            <div class="input_container_element">
                <p class="input_left_sign">Пароль:</p>
                <input class="input_box" type="password" id="pass" name="pass" />
            </div>
            <div class="action_div">
                <p class="action_hdr">Ещё нет аккаунта?</p>
                <a href="registration.php" class="action_ref">Зарегистрироваться</a>
            </div>
            <button type="submit" class="btn_input">Войти</button>
        </form>
        <?php
            if (isset($_COOKIE['errorFind'])) {
                echo "<p class='log_sign_error'>Такой пользователь не найден!</p>";
            };
        ?>
    </div>
</body>

<script src="jscript/log.js"></script>

</html>
