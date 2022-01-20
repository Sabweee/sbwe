<?php
require_once 'configDB.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/JQuery3.3.1.js"></script>
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
            <li><a href="personal_page.php" class="nav-links nav-links-btn" id="reg">Здравствуйте, <?=$_SESSION['user']['user_name']?></a></li>
            <li><a href="index.php" class="nav-links nav-links-btn2">Выход</a></li>
        </ul>
    </nav>
</div>


<!-- Cards -->
<div class="services" id="services">
    <h1>Мои файлы</h1>
    <div class="services_wrapper">
        <?php
        $query = 'SELECT `id_post`, `name`,  `date_added` FROM `post_file` WHERE `id_user` = :id_user ORDER BY `id_post` DESC';
        if (!empty($pdo)) {
        $stmt = $pdo->prepare($query);
        $stmt->execute([
                'id_user' => $_SESSION['user']['id_user']
                       ]);
        while($row = $stmt->fetch(PDO::FETCH_LAZY)){
        ?>
            <div class="services_card">
                <h2><?=$row->name?></h2>
                <p><?=$row->date_added?></p>
                <div class="services_btn"><button data-id="<?=$row->id_post?>"  class="detail_page_button">
                            Показать</button></div>
            </div>
        <?php
        }
        }
        ?>

    </div>
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
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript">
    function checkCheckBoxRegistration(){
        if($('#box1').is(':checked') ) {
            document.getElementById("modal-input-submit").style.visibility = "visible";
        } else {
            document.getElementById("modal-input-submit").style.visibility = "hidden";
        }
    }
</script>
</body>
</html>