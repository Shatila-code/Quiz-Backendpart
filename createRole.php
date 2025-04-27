<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['roleName'])) {

        http_response_code(400);

        echo json_encode(["error" => "Role name is required"]);
        exit;
    }

    $roleName = $_POST['roleName'];

    try {
         $query = $pdo->prepare("SELECT * FROM roles WHERE RoleName = :roleName");

        $query->bindParam(":roleName", $roleName, PDO::PARAM_STR);

        $query->execute();

        if ($query->fetch(PDO::FETCH_ASSOC)) {

            http_response_code(400);

            echo json_encode(["error" => "Role already exists"]);

            exit;
        }

        $query = $pdo->prepare("INSERT INTO roles (RoleName) VALUES (:roleName)");

        $query->bindParam(":roleName", $roleName, PDO::PARAM_STR);

        $query->execute();

        echo json_encode(['message' => 'Role successfully added']);

    } catch (PDOException $e) {

        http_response_code(500);

        echo json_encode(['error' => 'Failed to add role: ' . $e->getMessage()]);
    }
}
