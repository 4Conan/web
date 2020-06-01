<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="icon" href="http://localhost/dir/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="http://localhost/dir/favicon.ico" type="image/x-icon">
    <style type="text/css">
        * {
            padding: 0;
            margin: 0;
            border: 0;
        }
        .file {
            margin: 0 auto;
            width: 800px;
            height: auto;
            padding: 15px;
            border: 1px solid #ddd;
        }
        .file ul {
            width: 100%;
            list-style: none;
        }
        .file li {
            width: 100%;
            height: 50px;
            line-height: 50px;
            font-size: 16px;
            border-bottom: 1px solid #eaeaee;
        }
        .file li a {
            color:#000;
            text-decoration: none;
        }
        .file li img {
            margin-bottom: -10px;
            margin-right: 5px;
        }
        .bd input {
            border-radius: 10px;
            outline: none;
        }
        .bdinp {
            border: 1px solid #000;
            height: 40px;
            width: 80%;
        }
        .bdsub {
            border: 0;
            background:#ccc;
            width: 15%;
            height: 40px;
        }
    </style>
</head>
<body>
<div class="file">
    <ul>
<?php
require_once 'php/class.dir.php';

if($_GET['path']){
    $path = $_GET['path'];
}else {
    $path = $_SERVER['DOCUMENT_ROOT'];
}
$dir = new dir();
$dir->odir($path);
?>
    </ul>
</div>
</body>
</html>