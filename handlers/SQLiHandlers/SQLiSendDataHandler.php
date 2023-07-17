<!-- ************************************************************************ -->
<!--                      ОБРАБОТЧИК ОТПРАВКИ ОТЗЫВА В XSS                    -->
<!-- ************************************************************************ -->
<?php    
    // *************************************************************************
    // Подключаемся к БД за админа и выдаём привелегию текущему пользователю   *
    // *************************************************************************
    $mysql = new mysqli('localhost', 'root', 'root', 'register_bd');
    
    $TableName = $_COOKIE['cookTableName'];
    $userNick = $_COOKIE['user'];
    $userPassword = $_COOKIE['userPass']; 
    $AccLogin = $_POST['login'];
    $AccPassword = $_POST['pass'];

    // Выдаём юзеру все права на его таблицу 
    $result = $mysql->query(
        "grant all on register_bd.".$TableName." to '"."$userNick"."'@'localhost';"        
    );

    $mysql->close();
    // ********************************************************************
    // Далее нужно подключиться за юзера и авторизоваться за к-л уч запись*
    // ********************************************************************
    $mysqli = new mysqli('localhost', $userNick, $userPassword, 'register_bd');       

    $query = 
    "SELECT * FROM `$TableName` WHERE `login`='$AccLogin' AND `password`='$AccPassword';";    

    // ';DELETE FROM table_110 where id='1
    // ';INSERT INTO table_110(login,password) VALUES('a','b');    
    
    $mysqli->multi_query($query);
    do {        
        /* сохранить набор результатов в PHP */
        if ($result = $mysqli->store_result()) {
            $user = $result->fetch_assoc();            
            while ($row = $result->fetch_row()) {
                printf("%s\n", $row[0]);                
            }
        }        
    } while ($mysqli->next_result());
    
    $CountTableResult = $mysqli->query(
        "SELECT COUNT(1) FROM ".$TableName.";"        
    );   
    $CountTable = $CountTableResult->fetch_assoc();
    
    $UserFound = isset($user) ? 1 : 0;
    setcookie('CookUserFound', $UserFound, time() + 3600, "/");
    setcookie('CookAccLogin', $AccLogin, time() + 3600, "/");
    setcookie('CookAccPassword', $AccPassword, time() + 3600, "/");
    setcookie('count', $CountTable['COUNT(1)'], time() + 3600, "/");
    
    $mysqli->close();
    header('Location: /site/SQLi.php');    
?>
<!-- <p>
    Привет,    
    <a href="http://localhost/site/SQLi.php">здесь</a>.    
</p> -->