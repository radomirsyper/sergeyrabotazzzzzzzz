<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/home.css">
</head>
<body>

    <header>
        <img src="./img/logo.jpg" alt="logo">
        <h1>Библиопоиск</h1>
        <nav>
            <a href="./logout.php">Выход из аккаунта</a>
            <a href="./formirovanie.php">Формирование заявки</a>
        </nav>
    </header>

    
    <main>

        <div id="slider">
            <button onclick='slidedown()'><</button>
            <img src='./img/1.jpg' alt='slide1'>
            <button onclick='slideup()'>></button>
        </div>

        <?
        if (!(isset($_COOKIE['login'])) || !(isset($_COOKIE['role']))) {
                header('Location: ./index.php');
            } else if ($_COOKIE['role'] == 'Пользователь') {
                $conn = new PDO('mysql:host=localhost;dbname=rabota','root','');
    
                $dbh = $conn -> prepare("SELECT * FROM tasks where login = :login");
                $dbh -> execute(['login' => $_COOKIE['login']]);
    
                $tasks = $dbh->fetchALL(PDO::FETCH_ASSOC);
    
                arsort($tasks);

                echo '<h1 style="text-align: center; font-size: 20px;">Таски пользователя</h1>';
                foreach ($tasks as $key => $value) {
                    echo "# - " . $tasks[$key]['id'] . '<br>';
                    echo "Наименование - " . $tasks[$key]['name'] . '<br>';
                    echo "Дата - " . $tasks[$key]['date'] . '<br>';
                    echo "Статус - " . $tasks[$key]['status'] . '<br>';      
                    echo "Оплата - " . $tasks[$key]['oplata'] . '<br><br>';      
                }
    
            } else if ($_COOKIE['role'] == 'Администратор') {
                header('Location: ./admin.php');
            }
        ?>
    </main>

    <script src='./slider.js'></script>

</body>
</html>