<?php
    // inisialisasi variabel json
    $dataJson = "https://iptv-org.github.io/api/categories.json";

    // Baca data dari file JSON
    $jsonString = @file_get_contents($dataJson);

    $data = json_decode($jsonString, true);


    // $data = file_exists($dataJson) ? json_decode(file_get_contents($dataJson), true) : [];

    // Tampilkan data
    // foreach ($data as $item) {
    //     echo "ID: " . $item['id'] . "<br>";
    //     echo "Nama: " . $item['name'] . "<br>";
    //     echo "<hr>";
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <label for="opsi">Pilih Category</label>
    <select name="" id="">
        <?php foreach ($data as $item) : ?>
            <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
        <?php endforeach; ?>
    </select>
</body>
</html>