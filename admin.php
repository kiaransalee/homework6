<?php

if (!empty ($_POST)) {
    if (!empty ($_POST['name'])) {
        $filename = md5(filter_input(INPUT_POST, 'name', FILTER_DEFAULT));
    } else {
        echo 'Не задано название теста'. "<br>";
        echo "<a href='http://badgerico.com/test2/admin.php'>" . 'Вернуться назад' . "</a>";
        exit;
    }


    if (!empty ($_FILES) || (!empty ($_POST['test']))) {
        $filename = md5($filename);
        move_uploaded_file($_FILES['test']['tmp_name'], './tests/' . $filename . '.json');
    } else {
        echo 'Файл не загружен';
    }
}
else {
    echo 'Попробуйте еще раз';
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Домашняя работа</title>
</head>
<body>
<h3>Загрузите новый тест</h3>
<form enctype="multipart/form-data" method="POST">
    <div><input type="text" name="name" placeholder="Введите название теста"></div>
    <div><input type="file" name="test"></div>
    <div><input type="submit" value="Загрузить"></div>
</form>
