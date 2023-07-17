<!-- ************************************************************************ -->
<!--                         ОБРАБОТЧИК ВЫХОДА ИЗ SQLi                         -->
<!-- ************************************************************************ -->
<?php    
    $login=$_COOKIE['user'];
    $password =$_COOKIE['userPass']; 
    $TableName = $_COOKIE['cookTableName'];   

    $mysql = new mysqli('localhost','root','root','register_bd');    
    
    // Находим запись пользователя из таблицы по логину и паролю(Хэшированному)
    $result = $mysql->query(
        "SELECT * FROM `users` WHERE `login`='$login' AND `password`='$password'"
    );
    // Конвертируем запись о пользователе в массив и помещаем в переменную user
    $user = $result->fetch_assoc();
    // Соберём название для пользовательской таблицы
    $TableName = "table"."_".$user['id'];
    // От имени админа создаём личную таблицу юзеру
    $mysql->query(        
        "DROP TABLE $TableName;"        
    );
    // От имени админа забираем права на таблицу у юзера
    $mysql->query(        
        "REVOKE ALL PRIVILEGES ON register_bd.".$TableName." FROM ".$login."@'localhost';"        
    );    
    $mysql->close();

    setcookie('count', null, time() - 3600, "/");
    setcookie('cookTableName', null, time() - 3600, "/");

    header('Location: /site/choosing.php');
?>