<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/model/UserDAO.php');

use model\UserDAO;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        $userDAO = new UserDAO();
        $connection = $userDAO->getConnection();
        if ($connection) {
            $stmt = $connection->prepare("INSERT INTO users (username, password, lastmodified) VALUES (?, ?, NOW())");
            $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT)]);
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/index.php') . '?msg=signedup');
        } else {
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/index.php') . '?msg=dbfailed');
        }
    } else {
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/index.php') . '?msg=invalid');
    }
    exit;
}