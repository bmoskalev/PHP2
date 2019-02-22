<?php
include_once 'config.php';
include_once 'DB.php';
// подгружаем и активируем авто-загрузчик Twig-а
require_once '../Twig/Autoloader.php';
Twig_Autoloader::register();

if($_POST){
    $i=$_POST['ITEMS'];
    $count=25;
    // указывае где хранятся шаблоны
    $loader = new Twig_Loader_Filesystem('templates');

    // инициализируем Twig
    $twig = new Twig_Environment($loader);

    // подгружаем шаблон
    $template = $twig->loadTemplate('item.tmpl');

    $items = $db->getArr("catalog", $i, $count);
    $content = "";
    foreach ($items as $item) {
        $content .= $template->render(array(
            'item' => $item
        ));
    }
    print_r($content);
    $result['html']=$content;
    echo json_encode($result);
}