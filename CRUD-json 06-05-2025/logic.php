<?php
    $dataJson = "data.json";
    $data = file_exists($dataJson) ? json_decode(file_get_contents($dataJson), true) : [];

    // Fungsi untuk menghapus data
    if (isset($_GET['delete'])) {
        $idToDelete = $_GET['delete'];
        foreach ($data as $key => $item) {
            if ($item['id'] == $idToDelete) {
                if (file_exists($item['file'])) {
                    unlink($item['file']);
                }
            
                unset($data[$key]);
                break;
            }
        }
        $data = array_values($data);
        file_put_contents($dataJson, json_encode($data, JSON_PRETTY_PRINT));
        header("Location: http://localhost:8080"); // agar reload bersih
        exit;
    }

    // Fungsi untuk mengupdate data
    if (isset($_POST['updateData'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        foreach ($data as &$item) {
            if ($item['id'] == $id) {
                if(!empty($_FILES['uploadUpdateFile']['name'])){
                    if (file_exists($item['file'])) {
                        unlink($item['file']);
                    }
        
                    $ext = pathinfo($_FILES['uploadUpdateFile']['name'], PATHINFO_EXTENSION);
                    $foto = $id . "-updated." . $ext;
                    move_uploaded_file($_FILES['uploadUpdateFile']['tmp_name'], 'file-upload/' . $foto);
                    $item['file'] = "file-upload/" . $foto;
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

    // Fungsi untuk menambahkan data
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

            move_uploaded_file($_FILES['uploadFile']['tmp_name'], 'file-upload/' . $foto);
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

    // Tampilkan data
    foreach ($data as $item) {
        echo "ID: " . $item['id'] . "<br>";
        echo "Nama: " . $item['name'] . "<br>";
        echo "Email: " . $item['email'] . "<br>";
        echo "No. Telepon: " . $item['phone'] . "<br><br>";
        echo "<a href='". $item['file'] ."'>" . $item['file'] . "</a><br><br>";
        echo "<a href='?delete=" . $item['id'] . "'>Hapus</a><br>";
        echo "<hr>";
    }
?>