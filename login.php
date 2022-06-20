<?php
session_start();
require_once 'connect.php';
$pdo = connect();

if (isset($_SESSION['session_id'])) {
    header('Location: home.php');
    exit;
}

if (isset($_POST['login'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $msg = 'Inserisci email e password %s';
    } else {
        $query = "
            SELECT email, password
            FROM users
            WHERE email = :email
        ";
        
        $check = $pdo->prepare($query);
        $check->bindParam(':email', $email, PDO::PARAM_STR);
        $check->execute();
        
        $user = $check->fetch(PDO::FETCH_ASSOC);
        
        if (!$user || password_verify($password, $user['password']) === false) {
            $msg = 'Credenziali utente errate %s';
        } else {
            session_regenerate_id();
            $_SESSION['session_id'] = session_id();
            $_SESSION['session_user'] = $user['email'];
            
            header('Location: home.php');
            exit;
        }
    }
    
}