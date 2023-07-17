<!-- ************************************************************************ -->
<!--                             ОБРАБОТЧИК ACE                               -->
<!-- ************************************************************************ -->
<?php    
    $login=$_COOKIE['user'];
    $password =$_COOKIE['userPass'];    

    $mysql = new mysqli('localhost','root','root','register_bd');    
    
    // Находим запись пользователя из таблицы по логину и паролю(Хэшированному)
    $result = $mysql->query(
        "SELECT * FROM `users` WHERE `login`='$login' AND `password`='$password'"
    );
    // Конвертируем запись о пользователе в массив и помещаем в переменную user
    $user = $result->fetch_assoc();
    if (isset($user['id'])) {
        // Соберём название для пользовательской таблицы
        $tablename = "table"."_".$user['id'];
        // От имени админа создаём личную таблицу юзеру
        $mysql->query(        
            "CREATE TABLE $tablename(
                id INT PRIMARY key AUTO_INCREMENT,
                name VARCHAR(25),
                surname VARCHAR(100),
                series VARCHAR(10),
                number VARCHAR(10)
                );"        
        );
    } else {
        $tablename = "Таблица недоступна - пользователь не авторизован";
    }
    // // Соберём название для пользовательской таблицы
    // $tablename = "table"."_".$user['id'];
    // // От имени админа создаём личную таблицу юзеру
    // $mysql->query(        
    //     "CREATE TABLE $tablename (
    //         id INT PRIMARY KEY AUTO_INCREMENT, 
    //         nickname VARCHAR(25), 
    //         feedback text);"        
    // );
    setcookie('count', 0, time() + 3600, "/");
    setcookie('cookTableName', $tablename, time() + 3600, "/");

    $mysql->close();
    header('Location: /site/ACE.php');
?>
