<?php
    session_start();
    if (preg_match('/mypage/', $_SERVER['REQUEST_URI'])) {
      $html_head_title = 'CBT体験 - My page';
    } elseif (preg_match('/score/', $_SERVER['REQUEST_URI'])) {
      $html_head_title = 'CBT体験 - SCORE';
    } elseif (preg_match('/edit/', $_SERVER['REQUEST_URI'])) {
      $html_head_title = 'CBT体験 - EDIT';
    } else {
      $html_head_title = 'CBT体験';
    }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="icon" href="../favicon.ico" type="image/ico">
  <title><?php print($html_head_title); ?></title>
</head>