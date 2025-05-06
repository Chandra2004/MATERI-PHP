<?php
    $dataJson = "../data.json";
    $data = file_exists($dataJson) ? json_decode(file_get_contents($dataJson), true) : [];
    if (isset($_POST['updateData'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        foreach ($data as &$item) {
            if ($item['id'] == $id) {
                if(!empty($_FILES['uploadUpdateFile']['name'])){
                    if (file_exists($item['file'])) {
                        unlink('../' . $item['file']);
                    }
        
                    $ext = pathinfo($_FILES['uploadUpdateFile']['name'], PATHINFO_EXTENSION);
                    $foto = $id . "-updated." . $ext;
                    move_uploaded_file($_FILES['uploadUpdateFile']['tmp_name'], '../file-upload/' . $foto);
                    $item['file'] = "../file-upload/" . $foto;
                }
        
                $item['name'] = $name;
                $item['email'] = $email;
                $item['phone'] = $phone;
                break;
            }
        }
        
        file_put_contents($dataJson, json_encode($data, JSON_PRETTY_PRINT));
        header("Location: http://localhost:8080");
        exit;
    }
?>