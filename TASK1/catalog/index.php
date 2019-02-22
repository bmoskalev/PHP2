<?php
include_once 'models/config.php';
include_once 'models/DB.php';
// подключение к бд
try {
    $connect_str = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
    $db = new DB($connect_str, DB_USER, DB_PASS);
} catch (PDOException $e) {
    echo "Error: Could not connect. " . $e->getMessage();
}
// подгружаем и активируем авто-загрузчик Twig-а
require_once 'Twig/Autoloader.php';
Twig_Autoloader::register();


try {
    // указывае где хранятся шаблоны
    $loader = new Twig_Loader_Filesystem('templates');

    // инициализируем Twig
    $twig = new Twig_Environment($loader);

    // подгружаем шаблон
    $template = $twig->loadTemplate('item.tmpl');

    $items = $db->getArr("catalog", 0, 25);
    $content = "";
    foreach ($items as $item) {
        $content .= $template->render(array(
            'item' => $item
        ));
    }
    // подгружаем шаблон
    $template = $twig->loadTemplate('index.tmpl');

    // передаём в шаблон переменные и значения
    // выводим сформированное содержание


    $page = $template->render(array(
        'content' => $content,
    ));
    echo $page;

} catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
}


