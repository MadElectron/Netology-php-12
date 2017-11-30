<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Библиотека</title>
    <style>
        * {
            font-family: Arial, sans-serif;
            
        }
        table {
            border-collapse: collapse;
        }
        th, td { 
            padding: 2px 10px;
            border:  1px solid #000;
        }
        th {
            background: #eee;
        }
        td:first-child {
            text-align: center;
        }
        .container {
            width: 1200px;
            margin:  0 auto;
        } 
    </style>
</head>
<body>
    <?php 
        // Home database
        $host = 'localhost';
        $dbname = 'netology';
        $user = 'root';
        $pass = 'BJz5c8PI'; 
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        ];

        $dsn = "mysql:host=$host;dbname=$dbname";
        $pdo = new PDO($dsn, $user, $pass, $options);

        $name = $_POST['name'] ?? '';
        $author = $_POST['author'] ?? '';
        $isbn = $_POST['isbn'] ?? '';

        $query = "SELECT * FROM books 
                WHERE name like :name
                AND author like :author
                AND isbn like :isbn
            ";
        $prepquery = $pdo->prepare($query);
        $prepquery->execute([
            'name' => "%$name%",
            'author' => "%$author%",
            'isbn' => "%$isbn%",
        ]);
        $queryResult = $prepquery->fetchAll();
    ?>
    <div class="container">
        <h1>Библиотека</h1>

        <form action="" method="post" accept-charset="utf-8">
            <input type="text" name="name" value="<?php echo $_POST['name'] ?? ''; ?>" placeholder="Название">
            <input type="text" name="author" value="<?php echo $_POST['author'] ?? ''; ?>"" placeholder="Автор">
            <input type="text" name="isbn" value="<?php echo $_POST['isbn'] ?? ''; ?>"" placeholder="ISBN">
            <input type="submit" name="submit" value="Найти">
        </form>

        <table>
            <thead>
                <tr>
                    <th>№ п/п</th>
                    <th>Название</th>
                    <th>Автор</th>
                    <th>Год выпуска</th>
                    <th>Жанр</th>
                    <th>ISBN</th>
                </tr>
            </thead>
            <tbody>
            <?php  if ($queryResult) : ?>
                <?php foreach($queryResult as $index => $row) : ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['author']; ?></td>
                        <td><?php echo $row['year']; ?></td>
                        <td><?php echo $row['genre']; ?></td>
                        <td><?php echo $row['isbn']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table> 

    </div>
</body>
</html>

