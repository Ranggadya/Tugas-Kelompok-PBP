<?php
session_start();

function validateUsername($username) {
    return !preg_match('/[0-9]/', $username);
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validatePassword($password) {
    return strlen($password) >= 8 &&
           preg_match('/[A-Z]/', $password) &&
           preg_match('/[a-z]/', $password) &&
           preg_match('/[0-9]/', $password);
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username         = trim($_POST['username'] ?? '');
    $email            = trim($_POST['email'] ?? '');
    $perguruan_tinggi = trim($_POST['perguruan_tinggi'] ?? '');
    $program_studi    = $_POST['program_studi'] ?? '';
    $hobi             = $_POST['hobi'] ?? [];
    $password         = $_POST['password'] ?? '';

    $formData = [
        'username'         => $username,
        'email'            => $email,
        'perguruan_tinggi' => $perguruan_tinggi,
        'program_studi'    => $program_studi,
        'hobi'             => $hobi,
        'password'         => $password
    ];

    // === VALIDASI ===
    if ($username === '') {
        $errors[] = "Username is required";
    } elseif (!validateUsername($username)) {
        $errors[] = "Username cannot contain numbers";
    }

    if ($email === '') {
        $errors[] = "Email is required";
    } elseif (!validateEmail($email)) {
        $errors[] = "Email must be valid (contain @ and domain)";
    }

    if ($program_studi === '') {
        $errors[] = "Program Studi must be selected";
    }

    if ($password === '') {
        $errors[] = "Password is required";
    } elseif (!validatePassword($password)) {
        $errors[] = "Password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, and one number";
    }

    // === HASIL ===
    if (empty($errors)) {
        $_SESSION['student_data'] = [
            'username'         => $username,
            'email'            => $email,
            'perguruan_tinggi' => $perguruan_tinggi,
            'program_studi'    => $program_studi,
            'hobi'             => $hobi,
            'registered_at'    => date('Y-m-d H:i:s')
        ];

        unset($_SESSION['form_data'], $_SESSION['errors']);
        $_SESSION['success'] = true;

        header('Location: detail.php');
        exit;
    } else {
        $_SESSION['form_data'] = $formData;
        $_SESSION['errors']    = $errors;
        $_SESSION['success']   = false;

        header('Location: index.php');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}
