<!-- ************************************************************************ -->
<!--                         ОБРАБОТЧИК РЕГИСТРАЦИИ                           -->
<!-- ************************************************************************ -->
<?php
    // В глобальные значения полей помещаем отфильтрованные от ненужных символов и пробелов значения(фильтром FILTER_SANSIZE_STRING)
    // А также в фильтруемом значении оператор $_POST для определения метода передачи данных(post или get)
    $name=filter_var(trim($_POST['name']),
    FILTER_SANITIZE_STRING);
    $surname=filter_var(trim($_POST['surname']),
    FILTER_SANITIZE_STRING);
    $phone=filter_var(trim($_POST['phone']),
    FILTER_SANITIZE_STRING);
    $login=filter_var(trim($_POST['login']),
    FILTER_SANITIZE_STRING);
    $password =filter_var(trim($_POST['pass']),
    FILTER_SANITIZE_STRING);    

    // Хэширование пароля
    $password = md5($password."qj39xr4y29yzdq293dj");
    // В переменной будет лежать подключение к БД(хост, имя, пароль, название БД)
    $mysql = new mysqli('localhost','root','root','register_bd');
    // query - Функция принимающая SQL-запрорс(будем добавлять нового юзера в таблицу юзеров и его уч запись в БД)
    $mysql->query(
        "INSERT INTO `users` (`login`, `password`, `name`, `surname`, `phone`) VALUES('$login', '$password', '$name', '$surname', '$phone')"
    );
    $mysql->query(
        "CREATE USER '$login'@'localhost' IDENTIFIED BY '$password';"
    );

    // Конвертируем запись о пользователе в массив и помещаем в переменную result
    // Находим запись пользователя из таблицы по логину и паролю(Хэшированному)
    $result = $mysql->query(
        "SELECT * FROM `users` WHERE `login`='$login' AND `password`='$password'"
    );

    // Конвертируем запись о пользователе в массив и помещаем в переменную user
    $user = $result->fetch_assoc();

    // Обязательно закрываем соединение
    $mysql->close();

    // Записываем в куки логин и пароль юзера
    setcookie('user', $user['login'], time() + 3600, "/");
    setcookie('userPass', $user['password'], time() + 3600, "/");
    
    header('Location: /site/choosing.php');
?>