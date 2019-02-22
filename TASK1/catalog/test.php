<?php
include 'Twig/Autoloader.php';
Twig_Autoloader::register();

// подключение к бд
try {
    $dbh = new PDO('mysql:dbname=php2;host=localhost', 'root', '');
} catch (PDOException $e) {
    echo "Error: Could not connect. " . $e->getMessage();
}

// установка error режима
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// выполняем запрос
try {
    // формируем SELECT запрос
    // в результате каждая строка таблицы будет объектом
    for ($i=1;$i<101;$i++) {
        $sql = "INSERT INTO `catalog` (`id`, `title`, `price`, `description`, `image`) VALUES ({$i}, 'Товар {$i}', '{$i}00', 'Описание товара {$i}', '/img/777.jpg')";
        $sth = $dbh->exec($sql);
    }
    // закрываем соединение
    unset($dbh);

} catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
}