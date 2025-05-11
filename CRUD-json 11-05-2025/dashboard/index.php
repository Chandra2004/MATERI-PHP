<?php
    session_start();
    if (isset($_SESSION['found']) == false) {
        header("Location: http://localhost/materi-php/CRUD-json%2011-05-2025/");
        exit;
    }


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

    // Tampilkan data
    foreach ($data as $item) {
        echo "ID: " . $item['id'] . "<br>";
        echo "Nama: " . $item['name'] . "<br>";
        echo "Email: " . $item['email'] . "<br>";
        echo "No. Telepon: " . $item['phone'] . "<br><br>";
        echo "<img src='". $item['file'] ."' alt='Image' style='max-width: 200px; max-height: 200px;'><br><br>";
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
    <h1>Selamat Datang : <?= $_SESSION['identifier'] ?></h1>

    <?php if(!empty($alert)) :?>
        <div style="color: red; font-weight: bold;">
            <?= $alert ?>
        </div>
    <?php endif; ?>
    <h2>Tambah Data</h2>
    <form action="/add-data" method="POST" enctype="multipart/form-data">
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
    <form action="/update-data" method="POST" enctype="multipart/form-data">
        <label for="id">ID yang mau di update :</label><br>
        <input type="text" id="id" name="id"><br><br>
        <label for="name">Nama:</label><br>
        <input type="text" id="name" name="name"><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>
        <label for="phone">No. Telepon:</label><br>
        <input type="text" id="phone" name="phone"><br><br>
        <input type="file" name="uploadUpdateFile" id="file"><br><br>
        <button type="submit" name="updateData">Update Data</button>
    </form>

    <a href="../logout/logout_process.php">LOG OUT</a>
</body>
</html>