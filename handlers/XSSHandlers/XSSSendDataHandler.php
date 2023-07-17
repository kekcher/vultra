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
    
    // Выдаём юзеру все права на его таблицу 
    $result = $mysql->query(
        "grant all on register_bd.".$TableName." to '"."$userNick"."'@'localhost';"
        // "grant all on register_bd.table_105 to 'chanel'@'localhost';"
    );

    $mysql->close();
    // *****************************************************
    // Далее нужно подключиться за юзера и добавить 1 отзыв*
    // *****************************************************
    $mysql = new mysqli('localhost', $userNick, $userPassword, 'register_bd');
    
    $nickName = $_POST['login'];
    $feedBack = $_POST['review'];
    
    $mysql->query(
        "insert into ".$TableName." (nickname, feedback) values('".$nickName."','".$feedBack."');"        
    );
    // После добавления комментария счётчик записей становится на 1 больше
    setcookie('count', $_COOKIE['count']+1, time() + 3600, "/");

    $mysql->close();
    header('Location: /site/XSS.php');
?>
<p>
    Привет,
    <?= $userPassword ?>. Чтобы выйти нажмите
    <a href="http://localhost/site/XSS.php">здесь</a>.    
</p>