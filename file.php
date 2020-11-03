<?php
  session_start();
  require('sql.php');
  require('../function.php');

  $id = $_POST['id'];
  $file = $_FILES['img'];
  $imglink = $_POST['imglink'];
  //echo '<pre>';print_r($imglink);die;

 if (!empty($file['name'])) {
  $img = md5(uniqid($file['name'])) . '.' . explode('.', $file['name'])['1']; //Генерируем уникальное  имя 
  move_uploaded_file($file['tmp_name'], "../img/user/" . $img); //Сохраняем изображение в папке
  unlink('../img/user/'. $imglink); //Удаляем старое изображение
  update_img($id, $img, $pdo); //Сохраняем новое изображение
  set_flash_message('success', 'Изображение обновили!!!');
  redirect_to('../page_profile.php?id='. $id);
 }
 else {
  set_flash_message('danger', 'Загрузите изображение!');
  redirect_to('../media.php?id='. $id);
  die;
 }