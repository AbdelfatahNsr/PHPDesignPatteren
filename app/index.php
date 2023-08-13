<?php
    require_once 'controllers/PersonController.php';
    require '../config/PDODatabaseAdapter.php'; 
    
    $adapter = new PDODatabaseAdapter(
        "mysql:host=localhost;dbname=test",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    
    $controller = new PersonController($adapter);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newPerson = $_POST['newPerson'];
        $controller->addAction($newPerson);
    }
    
    $controller->index();
    