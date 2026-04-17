<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/admin.css">
</head>
<body>

    <header>
        <img src="./img/logo.jpg" alt="logo">
        <h1>Библиопоиск</h1>
        <nav>
            <a href="./logout.php">Выход из аккаунта</a>
        </nav>
    </header>   

    <main>
        <form method="post">
            <h1 style="text-align: center; font-size: 20px;">Изменение статуса заявки</h1>
            <input type="text" name="id" placeholder="id" required>
            <select name='status'>
                <option value='В работе'>В работе</option>
                <option value='Завершено'>Завершено</option>
            </select>
            <button type="submit">Изменить</button>
        </form>
        
        <?
            if (!(isset($_COOKIE['login'])) || !(isset($_COOKIE['role']))) {
                header('Location: ./index.php');
            } else if ($_COOKIE['role'] == 'Пользователь') {
                header('Location: ./home.php');
            } else if ($_COOKIE['role'] == 'Администратор') {
    
    
                if (isset($_POST['id']) && isset($_POST['status'])) { 
                    $conn = new PDO('mysql:host=localhost;dbname=rabota','root','');
                    $dbh = $conn -> prepare("UPDATE tasks SET status = :status WHERE id = :id");
                    $dbh -> execute(['status' => $_POST['status'], 'id' => $_POST['id']]);
                }
    
                $conn = new PDO('mysql:host=localhost;dbname=rabota','root','');
                $dbh = $conn -> prepare("SELECT * FROM tasks");
                $dbh -> execute([]);
                $tasks = $dbh->fetchALL(PDO::FETCH_ASSOC);

                arsort($tasks);
    
                echo '<h1 style="text-align: center; font-size: 20px; padding-top: 20px;">Таски пользователей</h1>';
                foreach ($tasks as $key => $value) {
                    echo "# - " . $tasks[$key]['id'] . '<br>';
                    echo "Наименование - " . $tasks[$key]['name'] . '<br>';
                    echo "Дата - " . $tasks[$key]['date'] . '<br>';
                    echo "Статус - " . $tasks[$key]['status'] . '<br>'; 
                    echo "Оплата - " . $tasks[$key]['oplata'] . '<br><br>';      
                }
    
    
            }
    
        ?>
    </main>

</body>
</html>