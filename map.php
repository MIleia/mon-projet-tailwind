<?php
    require_once 'bdd_pharmacol/config.php';

    header('Content-Type: application/json');

    try {
        if (!isset($pdo)) {
            $pdo = new PDO($dsn, $db_user, $db_pass, $options);
        }
        $pays = isset($_GET['pays']) ? trim($_GET['pays']) : '';
        $pays_autorises = ['Niger', 'Togo', 'Bénin'];
        if (!in_array($pays, $pays_autorises)) {
            http_response_code(400);
            echo json_encode(['error' => "Pays non autorisé ou manquant"]);
            exit;
        }
        $stmt = $pdo->prepare("SELECT * FROM entreprise WHERE pays = :pays");
        $stmt->execute(['pays' => $pays]);
        $marqueurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($marqueurs);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
?>


