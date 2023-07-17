<!-- ************************************************************************ -->
<!--                             ФОРМА XSS                                    -->
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
                <a href="handlers/XSShandlers/XSSExitHandler.php" class='choosing_btn'>Выход</a>
        </diV>
        <div class="choosing_header_container">
            <h1 class="choosing_header">
                Уязвимость "XSS"
            </h1>
        </div>

        <div class="XSS_container_inner">
            <div class="description_container">
                <h1 class="description_header">Описание</h1>
                <div id="description" class='triangle_left'></div>
                <div id="description_sign" class='description'>
                <p class="description_text">
                <strong>Межсайтовые сценарии (XSS)</strong> — это тип атаки на веб-системы, заключающийся во внедрении в 
                выдаваемую веб-системой страницу вредоносного кода (который будет выполнен 
на компьютере пользователя при открытии им этой страницы) и взаимодействии этого 
кода с веб-сервером злоумышленника. Является разновидностью атаки «Внедрение 
кода». На сегодняшний день XSS является третьим по значимости видом рисков для веб-
приложений. Его основная опасность заключается в том, что на веб-страницах содержится 
много пользовательских или иных уязвимых данных. Злоумышленник может 
использовать их для доступа к платежным картам, компьютерам пользователей и т.д.
                </p>
                </div>
            </div>
            <div class="instruction_container">
                <h1 class="instruction_header">Инструкция</h1>
                <div id="instruction" class='triangle_left'></div>
                <div id="instruction_sign" class='instruction'>
                <p class="instruction_text">
                <a href="https://youtu.be/abFi1zTA5Mo" target="_blank">
                    <p class="reff" style="text-decoration: underline; margin: 20px">Гайд по атаке XSS</p></a>
                </p>
                <a href="https://www.youtube.com/watch?v=bp0iJe8tbns" target="_blank">
                    <p class="reff" style="text-decoration: underline; margin: 20px">Гайд по защите XSS</p></a>
                </p>
                </div>
            </div>
        </div>

        <div class="split"></div>

        <div class='table_container'>

            <div class='redactor_table_box'>
                <h1 class='redactor_head'>Заполнение таблицы</h1>

                <form id='add_table' action='' method='post' class='choose_count'>
                <div class="count_div">
                    <p class='choose_count_sign'>Кол-во записей:</p>
                    <input type='number' name='count_table' id='count_table' min='0' max='100'></input>
                </div>
                    <button id='add_count' type='submit' class='btn_input'>Заполнить</button>
                </form>

            </div>

            <div class='table_box'>
                <p>Название таблицы:</p>
                <!-- С помощью куки выводим название таблицы -->
                <p>
                    <?php
                    $TableName = $_COOKIE['cookTableName'];
                    echo $TableName;
                    ?>
                </p>
                <table>
                    <tr>
                        <th>id</th>
                        <th>nickname</th>
                        <th>feedback</th>
                    </tr>
                    <!-- Рисуем сгенерированную таблицу отзывов -->
                    <?php
                    $mysql = new mysqli('localhost', 'root', 'root', 'register_bd');
                    $TableName = $_COOKIE['cookTableName'];
                    for ($i = 1; $i <= $_COOKIE['count']; $i++) {
                        $result = $mysql->query(
                            "SELECT * FROM $TableName WHERE id=$i LIMIT 1;"
                        );
                        $user = $result->fetch_assoc();
                        $userNick = $user['nickname'];
                        // Удаляет символы < > в отзыве                      
                        $userFeedb=str_replace(['<','>'],'',$user['feedback']);                         
                        echo '<tr>';
                        echo '<td>' . "$i" . '</td>';
                        echo '<td>' . "$userNick" . '</td>';
                        echo '<td>' . "$userFeedb" . '</td>';
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

        <form id="review_form" class="none_active" method="post" action="" style="width:100%">
            <div class="regular_container none_active">
                <p>Регулярное выражение:</p>
                <input type="text" id="regular" name="regular" class="input_box" />
            </div>
            <div class="regular_container">
                <p>Ник:</p>
                <input type="text" id="login" name="login" class="input_box" />
            </div>
            <div class="regular_container">
                <p>Отзыв:</p>
                <input type="text" id="review" name="review" class="input_box" />
            </div>
            <button style="margin-left: 850px;" id="add_review" class='btn_input' type="submit">Отправить</button>
        </form>

        <div class="split"></div>

        <h1>Отзывы</h1>
        <div class='review_container'>
            <?php
            $mysql = new mysqli('localhost', 'root', 'root', 'register_bd');
            $TableName = $_COOKIE['cookTableName'];
            for ($i = 1; $i <= $_COOKIE['count']; $i++) {
                $result = $mysql->query(
                    "SELECT * FROM $TableName WHERE id=$i LIMIT 1;"
                );
                $user = $result->fetch_assoc();
                $userNick = $user['nickname'];
                $userFeedb = $user['feedback'];
                echo '<div class="review_box">';
                echo '<img class="avatar" src="img/avatar.jpg" alt="avatar"></img>';
                echo "<div class='review_sign'>";
                echo "<p class='review_nick'>" . $userNick . "</p>";
                echo "<p class='review_text'>" . $userFeedb . "</p>";
                echo "</div>";
                echo "</div>";
            }
            $mysql->close();
            ?>
        </div>
    </div>
</body>
<script src="jscript\XSS.js"></script>

</html>