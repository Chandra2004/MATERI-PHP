<?php
    session_start();

    
    $dataJson = "../databases/users.json";
    $data = file_exists($dataJson) ? json_decode(file_get_contents($dataJson), true) : [];
        
    if (isset($_POST['registerUser'])) {
        $i = 0;
        if (!empty($data)) {
            $lastItem = end($data);
            $i = $lastItem['id'];
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $data[] = [
            'id' => $i + 1,
            'username' => $username,
            'email' => $email,
            'password' => $password
        ];
    
    
        file_put_contents($dataJson, json_encode($data, JSON_PRETTY_PRINT));
        header("Location: http://localhost/materi-php/CRUD-json%2011-05-2025/login.php");
        exit;
    }
?>