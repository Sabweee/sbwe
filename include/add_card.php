<?php

require_once '../configDB.php';
require_once '../session.start.php';

$name = trim((filter_var($_POST['name'], FILTER_SANITIZE_STRING)));
$description = trim((filter_var($_POST['description'])));

if(!empty($name) && !empty($description) && check_valid()){
    if(!empty($pdo)){
        $path_file = 'uploads/' . time() . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'],'../' . $path_file);
        $query = 'INSERT INTO `post_file`(
            `id_file`,
            `id_discipline`,
            `id_user`,
            `name`,
            `expansion`,
            `link`,
            `description`
        ) 
        VALUES(:id_file, :id_discipline, :id_user, :name_post, :expansion, :link, :description)';
        $params = [
            'id_file' => 1,
            'id_discipline' => 9,
            'id_user' => $_SESSION['user']['id_user'],
            'name_post' => $name,
            'expansion' => $_FILES['file']['type'],
            'link' => $path_file,
            'description' => $description
        ];
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $data = [
            'status' => 1
        ];
        echo json_encode($data);
    }
}

function check_valid(){
    $mimetype = mime_content_type($_FILES['file']['tmp_name']);
    if (!(in_array($mimetype,array('image/jpeg','image/png', 'application/zip', 'application/msword', 'application/x-tex', 'application/pdf', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')))) {
        $errors = [
            'status' => 0,
            'message' => 'Проверьте mime-type загружаемого файла'
        ];
        echo json_encode($errors);
        return false;
    }

    if (!(in_array(getExtension($_FILES['file']['name']),array('jpeg','png','jpg', 'zip', 'doc', 'docx', 'pdf', 'tex', 'xlsx')))) {
        $errors = [
            'status' => 0,
            'message' => 'Проверьте тип файла'
        ];
        echo json_encode($errors);
        return false;
    }
    return true;
}

function getExtension($filename)
{
    $path_info = pathinfo($filename);
    return $path_info['extension'];
}