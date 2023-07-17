<!-- ************************************************************************ -->
<!--                             ФОРМА ACE                                    -->
<!-- ************************************************************************ -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>NIR</title>
</head>

<body>
    <div class="XSS_container">
    <div class="exit_div">
        <a href="handlers/ACEhandlers/ACEExitHandler.php" class='choosing_btn'>Выход</a>
    </diV>

        <div class="choosing_header_container">
            <h1 class="choosing_header" id="ispoln">
                Уязвимость "Исполнение произвольного кода"
            </h1>
        </div>
        <div class="XSS_container_inner">
            <div class="description_container">
                <h1 class="description_header">Описание</h1>
                <div id="description" class='triangle_left'></div>
                <div id="description_sign" class='description'>
                <p class="description_text">
                <strong>Выполнение произвольного кода (ACE)</strong> — уязвимость в программной системе, когда злонамеренный пользователь (хакер) может 
заставить её исполнять любой машинный код, какой захочет. Если можно заставить 
машину исполнять произвольный код по сети, это иногда называется удалённое 
исполнение кода. Это самая опасная из программных уязвимостей — вредоносный код 
внедряется через внешне безобидные действия (например, загрузку файла данных), и 
может делать что угодно в пределах привилегий программы: извлекать информацию из 
памяти программы, пересылать её по сети, читать, писать и модифицировать файлы.
                </p>
                </div>
            </div>
            <div class="instruction_container">
                <h1 class="instruction_header">Инструкция</h1>
                <div id="instruction" class='triangle_left'></div>
                <div id="instruction_sign" class='instruction'>
                <p class="instruction_text">
                <a href="https://youtu.be/DMY2SICTl_U" target="_blank">
                    <p class="reff" style="text-decoration: underline; margin: 20px">Гайд по атаке ACE</p></a>
                </p>
                <a href="https://youtu.be/-1HfH4p6s78" target="_blank">
                    <p class="reff" style="text-decoration: underline; margin: 20px">Гайд по защите ACE</p></a>
                </p>
                </p>
                </div>
            </div>
        </div>
        <div class="split"></div>
        <div class='table_container'>
            <div class='redactor_table_box'>
                <h1 class='redactor_head'>Заполнение таблицы</h1>

                <form id="add_table" action='' method='post' class='choose_count'>
                    <div class="count_div">
                        <p class='choose_count_sign'>Кол-во записей:</p>
                        <input type='number' name='count_table' id='count_table' min='0' max='100'></input>
                    </div>
                    <button id="add_count" type='submit' class='btn_input'>Заполнить</button>
                </form>                

            </div>
            <div class='table_box'>
                <p>Название таблицы:</p>
                <p>
                    <?php
                        $TableName = $_COOKIE['cookTableName'];
                        echo $TableName;                        
                    ?>
                </p>
                <table>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>surname</th>
                        <th>series</th>
                        <th>number</th>
                    </tr>

                    <!-- Рисуем сгенерированную таблицу уч записей -->
                    <?php
                    $mysql = new mysqli('localhost', 'root', 'root', 'register_bd');
                    $TableName = $_COOKIE['cookTableName'];
                    for ($i = 1; $i <= $_COOKIE['count']; $i++) {
                        $result = $mysql->query(
                            "SELECT * FROM $TableName WHERE id=$i LIMIT 1;"
                        );
                        $passport = $result->fetch_assoc();
                        $passportName = $passport['name'];
                        $passportSurname = $passport['surname'];
                        $passportSeries = $passport['series'];
                        $passportNumber = $passport['number'];
                        echo '<tr>';
                        echo '<td>' . "$i" . '</td>';
                        echo '<td>' . "$passportName" . '</td>';
                        echo '<td>' . "$passportSurname" . '</td>';
                        echo '<td>' . "$passportSeries" . '</td>';
                        echo '<td>' . "$passportNumber" . '</td>';
                        echo '</tr>';
                    }
                    $mysql->close();
                    ?>

                </table>
            </div>
        </div>
        <div class="split" id="split_bottom"></div>
        <div class='choose_work_box'>
            <button id="atack_btn">Атака</button>
            <button id="defense_btn">Защита</button>
        </div>
        <form id="file_form" class='none_active' enctype="multipart/form-data" method="post" action="" style="width:100%">
            <div id='def_type' class="regular_container none_active">
                <p>Типы файлов:</p>
                <input type="text" id="type" name="type" class="input_box" />
            </div>
            <div id='def_size' class="regular_container none_active">
                <p>Размер файла:</p>
                <input type="text" id="size" name="size" class="input_box" />
            </div>
            <div class="regular_container">
                <label style="margin-left:600px; margin-top: 20px; margin-bottom: 20px;" class="input-file">
                    <span id='filename' class="input-file-text" type="text">Файл не выбран</span>
                    <input id='fileupload' type="file" name="file">
                    <span class="input-file-btn">Выберите файл</span>
                </label>
            </div>
            <button style="margin-left: 860px;" id="load" class='btn_input' type="submit">Загрузить</button>
        </form>
        <div class="split"></div>
        <?php
        if (isset($_COOKIE['CookTypeFile'])) {
            if ($_COOKIE['CookDefFile']) {
                echo "<p class='log_sign_complete'>Файл успешно загружен!</p>";
                echo "<p class='code_info'>Имя файла:<span class='code_info_sign'>" . $_COOKIE["CookNameFile"] . "</span></p>";
                echo "<p class='code_info'>Тип файла:<span class='code_info_sign'>" . $_COOKIE["CookTypeFile"] . "</span></p>";
                echo "<p class='code_info'>Размер файла:<span class='code_info_sign'>" . $_COOKIE["CookSizeFile"] . "</span> байт</p>";
                echo "<p class='code_info'>Ваш файл хранится:<a href='" . $_COOKIE["CookPathFile"] . "'>Здесь</a></p>";
            } else {
                echo "<p class='log_sign_error'>Файл не пропущен!</p>";
                echo "<p class='code_info'>Имя файла:<span class='code_info_sign'>" . $_COOKIE["CookNameFile"] . "</span></p>";
                echo "<p class='code_info'>Тип файла:<span class='code_info_sign'>" . $_COOKIE["CookTypeFile"] . "</span></p>";
                echo "<p class='code_info'>Размер файла:<span class='code_info_sign'>" . $_COOKIE["CookSizeFile"] . "</span> байт</p>";
            }
        }
        ?>
    </div>
    <script src='jscript/ACE.js'></script>
</body>

</html>