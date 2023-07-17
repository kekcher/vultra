<!-- ************************************************************************ -->
<!--                         ОБРАБОТЧИК ВЫХОДА ИЗ XSS                         -->
<!-- ************************************************************************ -->
<?php     
    $login=$_COOKIE['user'];   
    $TableName = $_COOKIE['cookTableName'];   

    $mysql = new mysqli('localhost','root','root','register_bd');    
    // От имени админа создаём личную таблицу юзеру
    $mysql->query(        
        "DROP TABLE $TableName;"        
    );
    // От имени админа забираем права на таблицу у юзера
    $mysql->query(        
        "REVOKE ALL PRIVILEGES ON register_bd.".$TableName." FROM ".$login."@'localhost';"        
    );    
    $mysql->close();

    setcookie('cookTableName', null, time() - 3600, "/");    
    setcookie('CookUserFound', null, time() - 3600, "/");    
    setcookie('CookAccLogin', null, time() - 3600, "/");    
    setcookie('CookAccPassword', null, time() - 3600, "/");    

    header('Location: /site/choosing.php');
?>