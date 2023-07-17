<!-- ************************************************************************ -->
<!--                         ОБРАБОТЧИК АВТОРИЗАЦИИ                           -->
<!-- ************************************************************************ -->
<?php
    $login=filter_var(trim($_POST['login']),
    FILTER_SANITIZE_STRING);
    $password =filter_var(trim($_POST['pass']),
    FILTER_SANITIZE_STRING);
    
    $password = md5($password."qj39xr4y29yzdq293dj");   

    $mysql = new mysqli('localhost','root','root','register_bd');    
    
    // Находим запись пользователя из таблицы по логину и паролю(Хэшированному)
    $result = $mysql->query(
        "SELECT * FROM `users` WHERE `login`='$login' AND `password`='$password'"
    );

    // Конвертируем запись о пользователе в массив и помещаем в переменную user
    $user = $result->fetch_assoc();

    // Проверка пользователя в таблице юзеров
    if($user == null) {
        // echo "Такой пользователь не найден!";
        header('Location: /site/login.php');
        setcookie('errorFind', true, time() + 3600, "/");    
        exit();
    }
    
    // Устанавливаем файлы куки для хранения имени юзера(будут жить 1 час)
    // 4й параметр со значением "/" даёт действовать куки на всех страницах сайта
    setcookie('user', $user['login'], time() + 3600, "/");
    setcookie('userPass', $user['password'], time() + 3600, "/");
    
    $mysql->close();    
    header('Location: /site/choosing.php');
?>