<?php
    session_start();

    if (isset($_SESSION['found']) == true) {
        session_destroy();
        header("Location: http://localhost/materi-php/CRUD-json%2011-05-2025/");

    }        

?>