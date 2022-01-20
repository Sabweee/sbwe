<?php
session_start();
require_once 'configDB.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>STUD_FILES</title>
</head>
<body>
<div class="nav-container">
    <nav class="navbar">
        <h1 id="navbar-logo">STUD_FILES</h1>
        <div class="menu-toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <ul class="nav-menu">
            <li><a href="#home" class="nav-links">Главная</a></li>
            <li><a href="personal_page.php" class="nav-links nav-links-btn" id="reg">Здравствуйте<?=', ' . $_SESSION['user']['user_name']?></a></li>
            <li><a id="exit_account_button" class="nav-links nav-links-btn2">Выход</a></li>
        </ul>
    </nav>
</div>
<div id="main_container__detail_page">
<?php
$query = 'SELECT `user_name`, `name`, `date_added`, `description`, `link` FROM `post_file` `pf`, `user` `u` WHERE `id_post` = :id_post AND `u`.`id_user` = `pf`.`id_user`';
if (!empty($pdo)) {
    $params = [
        'id_post' => $_SESSION['id_post']
    ];
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    while($row = $stmt->fetch(PDO::FETCH_LAZY)) {
?>
        <div class="main">
            <div  class="main-container1">
                <div class="main-content">
                    <h1>
                        <?=$row->name?>
                    </h1>

                    <p1 class="modal-input1">
                        <?=$row->description?>
                    </p1>

                </div>

                <div class="main-img-container">
                    <img src="images/pic5.svg" alt="" id="main-img">
                </div>
            </div>
        </div>
        <!-- Information -->
        <div class="services4" id="services">
            <div class="services3" id="services">
                <div class="services2" id="services">
                    <h1><?=$row->date_added?></h1>
                    <h1><?=$row->user_name?></h1>
                </div>
                <button data-url="<?=$row->link?>" class="main-btn1">
                    <h1>
                        <a>
                            Скачать
                        </a>
                    </h1>
                </button>
            </div>
        </div>
<?php
    }
}
?>
</div>

<!-- Footer -->
<div class="footer_container">
    <section class="social_media">
        <div class="social_media-wrap">
            <div class="footer_logo">
                <a href="#" id="footer_logo">STUD_FILES</a>
            </div>
            <p class="website_right">Ⓒ STUD_FILES 2021. Все права защищены.</p>
            <div class="social_icons">
                <a href="/" class="social_icon-link" target="_blank"><i class='fab fa-facebook-f'></i></a>
                <a href="/" class="social_icon-link"><i class='fab fa-instagram f-10x'></i></a>
                <a href="/" class="social_icon-link"><i class="far fa-envelope" style="color: white;font-size: 35px"></i></a>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript" src="js/JQuery3.3.1.js"></script>
<script type="text/javascript" src="js/app2.js"></script>

</body>
</html>