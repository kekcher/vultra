<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма регистрации</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-4">       
        <!-- Если файлы куки не найдены, то выполняем блок html  -->
        <?php            
            if($_COOKIE['user'] == ''):
        ?>
        
        <div class="row">

            <div class="col">

                <h1>ФЖЫВЩОАЖФЦЫЗВЛСЗФЖЫВБССэфыздщсЭфывуаэсзфФорма регистрации</h1>
                <!-- Тег form для обмена даyными с сервером -->
                <!-- Атрибут action содержит адрес программы который обрабатывает данные формы  -->
                <!-- Атрибут method сообщает серверу о методе отправки данных на сервер(через запрос браузера) -->
                <form action="validation_form/check.php" method="post">
                    <input type="text" class="form-control" name="name"
                    id="name" placeholder="Введите имя"><br>

                    <input type="text" class="form-control" name="surname"
                    id="surname" placeholder="Введите Фамилию"><br>

                    <input type="text" class="form-control" name="phone"
                    id="phone" placeholder="Введите номер телефона"><br>
                    
                    <input type="text" class="form-control" name="login"
                    id="login" placeholder="Введите логин"><br>

                    <input type="password" class="form-control" name="pass"
                    id="pass" placeholder="Введите пароль"><br>

                    <!-- Кнопка типа submit позволяет при нажатии отправлять данные на сервером
                    После отправки управление данными передаётся программе в атрибуте action -->
                    <button class="btn btn-success"            
                    type="submit">Зарегистрироваться</button>
                </form>

            </div>

            <div class="col">

                <h1>Форма авторизации</h1> 

                <form action="validation_form/auth.php" method="post">
                    <input type="text" class="form-control" name="login"
                    id="login" placeholder="Введите логин"><br>
                    <input type="password" class="form-control" name="pass"
                    id="pass" placeholder="Введите пароль"><br>
                    <button class="btn btn-success"            
                    type="submit">Авторизоваться</button>
                </form>

            </div>

        </div>

        <!-- Если файлы куки найдены, то открываем приветственное сообщение с гиперссылкой на выход -->
        <?php else: ?>
            <p> 
                Привет, <?=$_COOKIE['user']?>. Чтобы выйти нажмите 
                <a href="validation_form\exit.php">здесь</a>.
            </p>
        <?php endif;?>

    </div>
</body>
</html>