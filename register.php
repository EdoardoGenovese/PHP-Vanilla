<?php

require_once 'connect.php';
$pdo = connect();

if (isset($_POST['register'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    /*$isemailValid = filter_var(
        $email,
        FILTER_VALIDATE_REGEXP, [
            "options" => [
                "regexp" => "/^[a-z\d_]{3,20}$/i"
            ]
        ]
    );*/
    $pwdLenght = mb_strlen($password);
    
    if (empty($email) || empty($password)) {
        $msg = 'Compila tutti i campi %s';
    } /*elseif (false === $isemailValid) {
        $msg = 'Email non valida.';
    }*/ elseif ($pwdLenght < 8 || $pwdLenght > 20) {
        $msg = 'Lunghezza minima password 8 caratteri.
                Lunghezza massima 20 caratteri';
    } else {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $query = "
            SELECT id
            FROM users
            WHERE email = :email
        ";
        
        $check = $pdo->prepare($query);
        $check->bindParam(':email', $email, PDO::PARAM_STR);
        $check->execute();
        
        $user = $check->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($user) > 0) {
            $msg = 'email già in uso %s';
        } else {
            $query = "
                INSERT INTO users
                VALUES (0, :email, :password)
            ";
        
            $check = $pdo->prepare($query);
            $check->bindParam(':email', $email, PDO::PARAM_STR);
            $check->bindParam(':password', $password_hash, PDO::PARAM_STR);
            $check->execute();
            
            if ($check->rowCount() > 0) {
                header('Location: login.html');
            } else {
                $msg = 'Problemi con l\'inserimento dei dati %s';
            }
        }
    }
    
    printf($msg, '<a href="../register.html">torna indietro</a>');
}