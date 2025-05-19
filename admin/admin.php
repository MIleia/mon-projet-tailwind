<?php
session_start();
require_once './bdd_pharmacol/config.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

if ($action === 'login') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE mail = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['mot_de_passe'])) {
        $_SESSION['authenticated'] = true;
        $_SESSION['mail'] = $user['mail'];
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Identifiants incorrects.']);
    }
    exit();
}

if ($action === 'check_session') {
    if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
        echo json_encode([
            'authenticated' => true,
            'mail' => $_SESSION['mail']
        ]);
    } else {
        echo json_encode(['authenticated' => false]);
    }
    exit();
}

if ($action === 'logout') {
    session_destroy();
    echo json_encode(['success' => true]);
    exit();
}
