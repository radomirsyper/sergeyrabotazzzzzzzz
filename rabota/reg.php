<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/reg.css">
</head>
<body>

    <header>
        <img src="./img/logo.jpg" alt="logo">
        <h1>Библиопоиск</h1>
        <nav>
            <a href="./index.php">Авторизация</a>
            <a href="./reg.php">Регистрация</a>
        </nav>
    </header>
    
    <main>
        <h1 style="text-align: center; font-size: 20px;">Регистрация</h1>
        <form method="post">
            <input type="text" name="login" placeholder="login" required>
            <input type="password" name="password" placeholder="password" required>
            <input type="text" name="fio" placeholder="ФИО" required>
            <input type="email" name="email" placeholder="email" required>
            <input type="number" name="phone" placeholder="Телефон в формате 89***" required>
            <button type="submit">Вход</button>
        </form>
        <a href="./index.php">Уже зарегистрированы? Авторизация</a>
    
    
        <?
            if (isset($_POST['login']) && isset($_POST['password'])) {
                try {
                    $conn = new PDO('mysql:host=localhost;dbname=rabota','root','');
                    $dbh = $conn -> prepare("SELECT * FROM users WHERE login = :login");
                    $dbh -> execute(['login' => $_POST['login']]);
    
                    if ($dbh->rowCount() > 0) {
                        echo '<span style="color: red;">Такие данные уже есть</span>';
                    } else {
                        $dbh = $conn -> prepare("INSERT INTO users (login, password, fio, email, phone) VALUES (:login, :password, :fio, :email, :phone)");
                        $dbh -> execute(['login' => $_POST['login'], 'password' => $_POST['password'], 'fio' => $_POST['fio'], 'email' => $_POST['email'], 'phone' => $_POST['phone']]);
    
                        setcookie('login', $_POST['login'], time() + 3600, '/');
                        setcookie('role', 'Пользователь', time() + 3600, '/');
                        header('Location: ./home.php');
                    }
    
                } catch (PDOException $error) {
                    print_r($error);
                }
            }
        ?>
    </main>

    

</body>
</html>