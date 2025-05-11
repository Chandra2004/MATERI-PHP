<?php
    session_start();

    $dataJson = "../databases/users.json";
    $data = file_exists($dataJson) ? json_decode(file_get_contents($dataJson), true) : [];
        
    if (isset($_POST['loginUser'])) {
        $identifier = $_POST['identifier'];
        $password = $_POST['password'];

        $userFound = false;
        $alert = "";
        foreach ($data as $user) {
            if (($user['username'] === $identifier || $user['email'] === $identifier) && $user['password'] === $password) {
                $userFound = true;
                break;
            }
        }
        
        if ($userFound) {
            // ini jika login berhasil
            $_SESSION['found'] = $userFound;
            $_SESSION['identifier'] = $identifier;

            header("Location: http://localhost/materi-php/CRUD-json%2011-05-2025/dashboard");
            exit;
        } else {
            $alert = "Invalid username/email or password.";
        }

        $_SESSION['alert'] = $alert;

        file_put_contents($dataJson, json_encode($data, JSON_PRETTY_PRINT));
        
        // ini jika login gagal
        header("Location: http://localhost/materi-php/CRUD-json%2011-05-2025/");
        exit;
    }
?>