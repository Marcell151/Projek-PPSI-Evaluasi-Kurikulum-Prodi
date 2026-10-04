<?php
// includes/auth.php

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function require_login() {
    if (!is_logged_in()) {
        redirect('auth/login.php');
    }
}

function require_role($role) {
    require_login();
    if ($_SESSION['user_role'] !== $role) {
        // Jika tidak sesuai peran, arahkan ke beranda atau dashboard masing-masing
        if ($_SESSION['user_role'] === 'admin') {
            redirect('admin/dashboard.php');
        } else {
            redirect('responden/beranda.php');
        }
    }
}
?>
