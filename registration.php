<!-- ************************************************************************ -->
<!--                             ФОРМА РЕГИСТРАЦИИ                            -->
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
    <link rel="stylesheet" href="style\style.css">
    <title>NIR</title>
</head>

<body>
    <div class="input_container">
        <div class="input_header_container">
            <h1 class="input_header">Добро пожаловать в VULTRA!</h1>
        </div>

        <h1 class="action_sign">Регистрация</h1>

        <form action="" method="post" onsubmit="return false;" class="input_container_inner">
            <div class="input_container_element">
                <p class="input_left_sign">Имя:</p>
                <input class="input_box" type="text" id="name" name="name" />
            </div>
            <div class="input_container_element">
                <p class="input_left_sign">Фамилия:</p>
                <input class="input_box" type="text" id="surname" name="surname" />
            </div>
            <div class="input_container_element">
                <p class="input_left_sign">Номер телефона:</p>
                <input class="input_box" type="text" id="phone" name="phone" required />
            </div>
            <div class="input_container_element">
                <p class="input_left_sign">Никнейм:</p>
                <input class="input_box" type="text" id="login" name="login" />
            </div>
            <div class="input_container_element">
                <p class="input_left_sign">Пароль:</p>
                <input class="input_box" type="password" id="pass" name="pass" />
            </div>
            <div class="action_div">
                <p class="action_hdr">Ужe есть аккаунт?</p>
                <a href="login.php" class="action_ref">Войти</a>
            </div>

            <button type="submit" class="btn_input">Зарегистрироваться</button>

        </form>
    </div>
</body>

<script src="jscript/reg.js"></script>

</html>