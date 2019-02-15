<?php
  //ini_get("MAX_POST_SIZE"); 	

  include_once 'models/config.php';
// подгружаем и активируем авто-загрузчик Twig-а
require_once 'Twig/Autoloader.php';
Twig_Autoloader::register();

try {
    // указывае где хранятся шаблоны
    $loader = new Twig_Loader_Filesystem('templates');

    // инициализируем Twig
    $twig = new Twig_Environment($loader);

    // подгружаем шаблон
    $template = $twig->loadTemplate('image.tmpl');

    // передаём в шаблон переменные и значения
    // выводим сформированное содержание
    $photo = PHOTO.$_GET['photo'];
    $content = $template->render(array(
        'photo' => $photo,
    ));
    echo $content;

} catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
}
?>
