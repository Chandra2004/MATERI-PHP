<?php
    $dataJson = "../data.json";
    $data = file_exists($dataJson) ? json_decode(file_get_contents($dataJson), true) : [];
        
    if (isset($_POST['tambahData'])) {
        $i = 0;
        if (!empty($data)) {
            $lastItem = end($data);
            $i = $lastItem['id'];
        }

        $fileUpload = $_FILES['uploadFile'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // Validasi file upload
        $foto = "";
        if(!empty($_FILES['uploadFile']['name'])){
            $ext = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);
            
            $foto = $i+1 . "." . $ext;

            move_uploaded_file($_FILES['uploadFile']['tmp_name'], '../file-upload/' . $foto);
        }


        $alert = "";
        $showAlert = false;
        foreach ($data as $item){
            if ($email == $item['email']) {
                $alert = "Email sudah terdaftar";
                $showAlert = true;
                break;
            }
        }
        if (!$showAlert) {
            $data[] = [
                'id' => $i + 1,
                'file' => "file-upload/" . $foto,
                'name' => $name,
                'email' => $email,
                'phone' => $phone
            ];
        
        
            file_put_contents($dataJson, json_encode($data, JSON_PRETTY_PRINT));
            header("Location: http://localhost:8080");
            exit;
        }
    }
?>