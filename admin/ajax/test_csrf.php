<?php
session_start();
require_once '../../config/database.php';
header('Content-Type: application/json');
echo json_encode([
    'post_keys'    => array_keys($_POST),
    'section_id'   => $_POST['section_id'] ?? 'ABSENT',
    'csrf_post'    => isset($_POST['csrf_token']) ? substr($_POST['csrf_token'],0,8).'...' : 'ABSENT',
    'csrf_session' => isset($_SESSION['csrf_token']) ? substr($_SESSION['csrf_token'],0,8).'...' : 'ABSENT',
    'match'        => csrf_verify(),
    'admin'        => $_SESSION['admin_logged'] ?? false,
]);
