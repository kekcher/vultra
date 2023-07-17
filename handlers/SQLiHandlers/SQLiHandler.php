<!-- ************************************************************************ -->
<!--                             ОБРАБОТЧИК SQLi                              -->
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
    // Соберём название для пользовательской таблицы
    if (isset($user['id'])) {
        $tablename = "table"."_".$user['id'];
        $mysql->query(        
            "CREATE TABLE $tablename (
                id INT PRIMARY KEY AUTO_INCREMENT, 
                login VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_bin, 
                password VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin
                );"        
        );            
    } else {
        $tablename = "Таблица недоступна - пользователь не авторизован";
    }
    // Соберём название для пользовательской таблицы
    // $tablename = "table"."_".$user['id'];
    // От имени админа создаём личную таблицу юзеру(с кодировкой для поддержки case sensitive)
    // $mysql->query(        
    //     "CREATE TABLE $tablename (
    //         id INT PRIMARY KEY AUTO_INCREMENT, 
    //         login VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_bin, 
    //         password VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin
    //         );"        
    // );    
    setcookie('cookTableName', $tablename, time() + 3600, "/");
    setcookie('count', 0, time() + 3600, "/");

    $mysql->close();
    header('Location: /site/SQLi.php');
?>
