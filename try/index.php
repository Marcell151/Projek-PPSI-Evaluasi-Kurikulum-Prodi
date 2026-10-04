<?php
// index.php
require_once 'config/app.php';
require_once 'includes/helpers.php';
require_once 'includes/auth.php';

if (is_logged_in()) {
    if ($_SESSION['user_role'] === 'admin') {
        redirect('admin/dashboard.php');
    } else {
        redirect('responden/beranda.php');
    }
} else {
    redirect('auth/login.php');
}
?>
