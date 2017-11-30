<!DOCTYPE html>
<html>
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

    $dsn = "mysql:host=$host;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $pass,  array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8'));

    $query = "SELECT * from books";

    $queryResult = $pdo->query($query);
?>
    <div class="container">
        <h1>Библиотека</h1>
        <table>
            <thead>
                <tr>
                    <th>№ п/п</th>
                    <th>Название</th>
                    <th>Год выпуска</th>
                    <th>Жанр</th>
                    <th>ISBN</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($queryResult as $index => $row) : ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['author']; ?></td>
                    <td><?php echo $row['year']; ?></td>
                    <td><?php echo $row['genre']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table> 
    </div>
</body>
</html>

