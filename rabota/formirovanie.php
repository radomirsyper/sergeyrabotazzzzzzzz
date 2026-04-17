<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/formirovanie.css">
</head>
<body>

    <header>
        <img src="./img/logo.jpg" alt="logo">
        <h1>Библиопоиск</h1>
        <nav>
            <a href="./home.php">Вернуться</a>
        </nav>
    </header>

    <main>
        <h1 style="text-align: center; font-size: 20px;">Формирование заявки</h1>
        <form method="post">
            <select name='name'>
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
                <option value='5'>5</option>
                <option value='6'>6</option>
                <option value='7'>7</option>
            </select>
            <input type="date" name="date" placeholder="дата" required>
            <select name='oplata'>
                <option value='Наличными'>Наличными</option>
                <option value='Переводом'>Переводом</option>
            </select>
            <button type="submit">Отправить</button>
        </form>
    
        <!-- Бэкенд -->
        <?
            if (!(isset($_COOKIE['login'])) || !(isset($_COOKIE['role'])) || $_COOKIE['role'] == 'Администратор') {
                header('Location: ./index.php');
            }
    
            if (isset($_POST['name']) && isset($_POST['date']) && isset($_POST['oplata'])) {
                $conn = new PDO('mysql:host=localhost;dbname=rabota','root','');
                $dbh = $conn -> prepare("INSERT INTO tasks (login, name, date, oplata) VALUES (:login, :name, :date, :oplata)");
                $dbh -> execute(['login' => $_COOKIE['login'], 'name' => $_POST['name'], 'date' => $_POST['date'], 'oplata' => $_POST['oplata']]);
                echo '<p>Заявка отправлена на рассмотрение</p>';
            }
    
        ?>
    </main>

</body>
</html>