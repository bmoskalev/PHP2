<?php
function translit($string)
{
    $translit = array(
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ы' => 'y', 'ъ' => '', 'ь' => '', 'э' => 'eh', 'ю' => 'yu', 'я' => 'ya');

    return str_replace(' ', '_', strtr(mb_strtolower(trim($string)), $translit));
}

function changeImage($h, $w, $src, $newsrc, $type)
{
    $newimg = imagecreatetruecolor($h, $w);
    switch ($type) {
        case 'jpeg':
            $img = imagecreatefromjpeg($src);
            imagecopyresampled($newimg, $img, 0, 0, 0, 0, $h, $w, imagesx($img), imagesy($img));
            imagejpeg($newimg, $newsrc);
            break;
        case 'png':
            $img = imagecreatefrompng($src);
            imagecopyresampled($newimg, $img, 0, 0, 0, 0, $h, $w, imagesx($img), imagesy($img));
            imagepng($newimg, $newsrc);
            break;
        case 'gif':
            $img = imagecreatefromgif($src);
            imagecopyresampled($newimg, $img, 0, 0, 0, 0, $h, $w, imagesx($img), imagesy($img));
            imagegif($newimg, $newsrc);
            break;
    }
}

if (isset($_POST['send'])) {
    if ($_FILES['userfile']['error']) {
        $message = 'Ошибка загрузки файла!';
    } elseif ($_FILES['userfile']['size'] > 1000000) {
        $message = 'Файл слишком большой';
    } elseif (
        $_FILES['userfile']['type'] == 'image/jpeg' ||
        $_FILES['userfile']['type'] == 'image/png' ||
        $_FILES['userfile']['type'] == 'image/gif'
    ) {
        if (copy($_FILES['userfile']['tmp_name'], PHOTO_BIG . translit($_FILES['userfile']['name']))) {
            $fileName = translit($_FILES['userfile']['name']);
            $path = PHOTO_SMALL . $fileName;
            $type = explode('/', $_FILES['userfile']['type'])[1];
            changeImage(150, 150, $_FILES['userfile']['tmp_name'], $path, $type);
            $bigPath = PHOTO_BIG;
            $smallPath = PHOTO_SMALL;
            $file_size = filesize($bigPath . $fileName);
            $db->exec("INSERT INTO images (bigPath, smallPath, fileName, bigFileSize) values ('$bigPath', '$smallPath', '$fileName', '$file_size')");
            // в случае ошибки SQL выражения выведем сообщене об ошибке

            $error_array = $db->errorInfo();

            if ($db->errorCode() != 0000) {
                echo "SQL ошибка: " . $error_array[2] . '<br />';
            }

        } else {
            $message = 'Ошибка загрузки файла!';
        }
    } else {
        $message = 'Не правильный тип файла!';
    }
}
