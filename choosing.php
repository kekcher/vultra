<!-- ************************************************************************ -->
<!--                             ФОРМА ВЫБОРА УЯЗВИМОСТИ                      -->
<!-- ************************************************************************ -->
<?php
    setcookie('errorFind', null, time() - 3600, "/"); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">    
    <title>NIR</title>
</head>

<body>
    <div class="choosing_container">
        <div class="choosing_header_container">
            <h1 class="choosing_header">Выберите уязвимость:</h1>
        </div>
        <a href="handlers/XSSHandlers/XSSHandler.php" class="choosing_btn">XSS</a>
        <a href="handlers/SQLiHandlers/SQLiHandler.php" class="choosing_btn">SQL-инъекция</a>
        <a href="handlers/ACEHandlers/ACEHandler.php" class="choosing_btn">Исполнение произвольного кода</a>
        <button class="none_active_btn">BruteForce</button>
        <a href="login.php" id='choosing_exit' class='choosing_btn'>Выход</a>
    </div>
</body>

</html>