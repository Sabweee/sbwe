<?php

require_once '../configDB.php';
require_once '../session.start.php';

$endpoint = $_GET['endpoint'];
        $query = 'SELECT `id_post`, `name`,  `date_added` FROM `post_file` WHERE `id_post` < :endpoint ORDER BY `id_post` DESC LIMIT :limit';
        if (!empty($pdo)) {
        $stmt = $pdo->prepare($query);
        $stmt->execute([
                'limit' => 2,
                'endpoint' => $endpoint
                       ]);
        while($row = $stmt->fetch(PDO::FETCH_LAZY)){
        ?>
            <div data-id="<?=$row->id_post?>" class="services_card">
                <h2><?=$row->name?></h2>
                <p><?=$row->date_added?></p>
                <div class="services_btn"><button data-id="<?=$row->id_post?>"  class="detail_page_button">
                            Показать</button></div>
            </div>
        <?php
        }
        }
