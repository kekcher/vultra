<!-- ************************************************************************ -->
<!--                      ОБРАБОТЧИК ЗАГРУЗКИ ФАЙЛА В ACE                     -->
<!-- ************************************************************************ -->
<?php
    $file = $_FILES['file'];
    
    $mysql = new mysqli('localhost', 'root', 'root', 'register_bd');

    $TableName = $_COOKIE['cookTableName'];
    $userNick = $_COOKIE['user'];    

    // Выдаём юзеру все права на его таблицу 
    $result = $mysql->query(
        "grant all on register_bd.".$TableName." to '"."$userNick"."'@'localhost';"        
    );
    $mysql->close();

    $type = end(explode('.', $file['name']));
    $path = '/site/download/' . $file['name'];

    $deftype = $_POST['type'];

    if ($deftype <> '') {
        if (strpos($deftype, $type) !== false) {
            if ($file['size'] <= (int)$_POST['size']) {
                setcookie('CookTypeFile', $type, time() + 3600, "/");
                setcookie('CookNameFile', $file['name'], time() + 3600, "/");
                setcookie('CookSizeFile', $file['size'], time() + 3600, "/");
                setcookie('CookPathFile', $path, time() + 3600, "/");
                setcookie('CookDefFile', true, time() + 3600, "/");
                move_uploaded_file($file['tmp_name'], 'C:/MAMP/htdocs/site/download/' . $file['name']);
            } else {
                setcookie('CookTypeFile', $type, time() + 3600, "/");
                setcookie('CookNameFile', $file['name'], time() + 3600, "/");
                setcookie('CookSizeFile', $file['size'], time() + 3600, "/");
                setcookie('CookPathFile', null, time() - 3600, "/");
                setcookie('CookDefFile', false, time() + 3600, "/");
            }
        } else {
            setcookie('CookTypeFile', $type, time() + 3600, "/");
            setcookie('CookNameFile', $file['name'], time() + 3600, "/");
            setcookie('CookSizeFile', $file['size'], time() + 3600, "/");
            setcookie('CookPathFile', null, time() - 3600, "/");
            setcookie('CookDefFile', false, time() + 3600, "/");
        }
    }else {
        setcookie('CookTypeFile', $type, time() + 3600, "/");
        setcookie('CookNameFile', $file['name'], time() + 3600, "/");
        setcookie('CookSizeFile', $file['size'], time() + 3600, "/");
        setcookie('CookPathFile', $path, time() + 3600, "/");
        setcookie('CookDefFile', true, time() + 3600, "/");
        move_uploaded_file($file['tmp_name'], 'C:/MAMP/htdocs/site/download/' . $file['name']);
    }

    header('Location: /site/ACE.php');
?>
