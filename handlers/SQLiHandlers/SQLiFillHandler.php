<!-- ************************************************************************ -->
<!--                       ОБРАБОТЧИК ЗАПОЛНЕНИЯ ТАБЛИЦЫ XSS                  -->
<!-- ************************************************************************ -->
<?php
    // *******************************************************************
    // Находим пользователя по логину и паролю из куки                   *
    // *******************************************************************
    $mysql = new mysqli('localhost','root','root','register_bd');   
                        
    $login=$_COOKIE['user'];
    $password =$_COOKIE['userPass']; 
    
    $result = $mysql->query(
        "SELECT * FROM `users` WHERE `login`='$login' AND `password`='$password'"
    );
    
    // ***************************************************************************************
    // Обновляем таблицу и вызываем процедуру с таблицей юзера и переданным числом записей   *
    // ***************************************************************************************
    $count=isset($_POST['count_table']) ? $_POST['count_table'] : 0;
    // $count=$_POST['count_table'];

    $user = $result->fetch_assoc();    
    // Собираем название таблицы, видимой юзеру         
    $TableName = "table_".$user['id'];      

    $mysql->query(
        "DELETE FROM $TableName;"        
    );
    $mysql->query(
        "ALTER TABLE $TableName AUTO_INCREMENT = 1;"
    );
    $mysql->query(
        "DROP TABLE logins;"
    );
    $mysql->query(
        "DROP TABLE passwords;"
    );    
    $mysql->query(
        "CALL fill_accounttable('$TableName', '$count');"
    );
    
    // *****************************************************************
    // Заполняем куки пользовательским числом записей и саму таблицу   *
    // *****************************************************************
    setcookie('count', $count, time() + 3600, "/");
    setcookie('cookTableName', $TableName, time() + 3600, "/");

    $mysql->close();
    header('Location: /site/SQLi.php');
?>