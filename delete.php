<?php
// Verwijder een klant op basis van id
require 'db.php';

// id ontvangen via GET
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM klanten WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
}

// Terug naar het overzicht
header('Location: index.php');
exit;
