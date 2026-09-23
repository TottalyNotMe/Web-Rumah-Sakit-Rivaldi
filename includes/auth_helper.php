<?php
// includes/auth_helper.php

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function get_user_role() {
    return isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
}

function require_login() {
    if (!is_logged_in()) {
        header("Location: index.php?page=login");
        exit;
    }
}

function require_role($role) {
    require_login();
    if (get_user_role() !== $role) {
        // Redirect to their respective dashboards if they access unauthorized page
        $current_role = get_user_role();
        if ($current_role == 'admin') header("Location: index.php?page=admin_dashboard");
        elseif ($current_role == 'officer') header("Location: index.php?page=officer_dashboard");
        elseif ($current_role == 'doctor') header("Location: index.php?page=doctor_dashboard");
        else header("Location: index.php?page=dashboard");
        exit;
    }
}

function require_admin() {
    require_role('admin');
}

function require_officer() {
    require_role('officer');
}

function require_doctor() {
    require_role('doctor');
}

function require_patient() {
    require_role('patient');
}
?>
