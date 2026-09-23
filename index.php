<?php
session_start();
require_once 'config/database.php';
require_once 'includes/auth_helper.php';

// Simple Routing
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Validasi page yang diakses untuk mencegah directory traversal
$allowed_pages = [
    // Public
    'home', 'about', 'hospitals', 'doctors', 'doctor_profile', 'services', 'promo', 'articles', 'contact', 'faq',
    // Auth
    'login', 'register', 'forgot_password', 'logout',
    // Patient Portal
    'dashboard', 'book_appointment', 'appointments', 'medical_records', 'lab_results', 'billing', 'invoice_detail',
    // Doctor
    'doctor_dashboard', 'doctor_patients', 'doctor_encounter', 'doctor_prescription', 'doctor_lab_request',
    // Admin & Officer
    'admin_dashboard', 'admin_users', 'admin_patients', 'admin_doctors', 'admin_poly', 'admin_schedules', 'admin_rooms', 
    'officer_dashboard', 'queue_management'
];
if (!in_array($page, $allowed_pages)) {
    $page = 'home';
}

require_once 'includes/header.php';
require_once "pages/{$page}.php";
require_once 'includes/footer.php';
?>
