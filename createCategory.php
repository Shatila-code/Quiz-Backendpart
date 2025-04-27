<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['categoryDesc'])) {

        http_response_code(400);
        echo json_encode(['error' => 'Category Name is required']);
        exit;
    }

    $categoryDesc = $_POST['categoryDesc'];

    try {

        $query = $pdo->prepare("INSERT INTO category (CategoryDesc) VALUES (:categoryDesc)");
        $query->bindParam(":categoryDesc", $categoryDesc, PDO::PARAM_STR);
        $query->execute();

        echo json_encode([
            'message' => 'Category created successfully',
            'categoryId' => $pdo->lastInsertId()
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to create category: ' . $e->getMessage()]);
    }
}
