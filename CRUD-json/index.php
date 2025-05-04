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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Farrel</title>
</head>
<body>
    <?php if(!empty($alert)) :?>
        <div style="color: red; font-weight: bold;">
            <?= $alert ?>
        </div>
    <?php endif; ?>
    <h2>Tambah Data</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        
        <label for="name">Nama:</label><br>
        <input type="text" id="name" name="name"><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>
        <label for="phone">No. Telepon:</label><br>
        <input type="text" id="phone" name="phone"><br><br>
        <input type="file" name="uploadFile" id="file"><br><br>
        <button type="submit" name="tambahData">Tambah Data</button>
    </form>


    <h2>Update Data</h2>
    <form action="" method="POST">
        <label for="id">ID yang mau di update :</label><br>
        <input type="text" id="id" name="id"><br><br>
        <label for="name">Nama:</label><br>
        <input type="text" id="name" name="name"><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>
        <label for="phone">No. Telepon:</label><br>
        <input type="text" id="phone" name="phone"><br><br>
        <button type="submit" name="updateData">Update Data</button>
    </form>
</body>
</html>