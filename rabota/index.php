<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/index.css">
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
        <h1 style="text-align: center; font-size: 20px;">Авторизация</h1>
        <form method="post">
            <input type="text" name="login" placeholder="login" required>
            <input type="password" name="password" placeholder="password" required>
            <button type="submit">Вход</button>
            <a href="./reg.php">Еще не зарегистрированы? Регистрация</a>
        </form>
        
        <?
            if (isset($_POST['login']) && isset($_POST['password'])) {
                try {
                    $conn = new PDO('mysql:host=localhost;dbname=rabota','root','');
                    $dbh = $conn -> prepare("SELECT * FROM users WHERE login = :login AND password = :password");
                    $dbh -> execute(['login' => $_POST['login'], 'password' => $_POST['password']]);
    
                    if ($dbh->rowCount() > 0) {
                        $users = $dbh->fetch(PDO::FETCH_ASSOC);
    
                        setcookie('login', $users['login'], time() + 3600, '/');
                        setcookie('role', $users['role'], time() + 3600, '/');
                        header('Location: ./home.php');
                    } else {
                        echo 'Вы ввели неверные данные';
                    }
    
                } catch (PDOException $error) {
                    print_r($error);
                }
            }
        ?>
    </main>
    

</body>
</html>