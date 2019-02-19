<?php
include_once 'models/config.php';
// подключение к бд
try {
    $connect_str = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
    $db = new PDO($connect_str, DB_USER, DB_PASS);
} catch (PDOException $e) {
    echo "Error: Could not connect. " . $e->getMessage();
}
include_once 'models/photo.php';
// подгружаем и активируем авто-загрузчик Twig-а
require_once 'Twig/Autoloader.php';
Twig_Autoloader::register();


try {
    // указывае где хранятся шаблоны
    $loader = new Twig_Loader_Filesystem('templates');

    // инициализируем Twig
    $twig = new Twig_Environment($loader);

    // подгружаем шаблон
    $template = $twig->loadTemplate('index.tmpl');

    // передаём в шаблон переменные и значения
    // выводим сформированное содержание

    // выберем несколько строчек из базы
    $result = $db->query("SELECT * FROM `images`");

    // в случае ошибки SQL выражения выведем сообщене об ошибке
    $error_array = $db->errorInfo();

    if ($db->errorCode() != 0000)

        echo "SQL ошибка: " . $error_array[2] . '<br /><br />';

    // теперь получаем данные из класса PDOStatement
    while ($row = $result->fetchObject()) {
        // в результате получаем ассоциативный массив
        $images[] = $row;
    }

    //$images = array_slice(scandir(PHOTO_SMALL), 2);

    $content = $template->render(array(
        'images' => $images,
        'path' => PHOTO_SMALL,
    ));
    echo $content;

} catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
}


