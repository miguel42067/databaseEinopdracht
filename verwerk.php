<?php

require 'db.php';

if (isset($_POST['actie']) && $_POST['actie'] === 'toevoegen') {
    $naam = $_POST['naam'] ?? '';
    $adres = $_POST['adres'] ?? '';
    $postcode = $_POST['postcode'] ?? '';
    $woonplaats = $_POST['woonplaats'] ?? '';
    $email = $_POST['email'] ?? '';

    if (!empty($naam) && !empty($email)) {
        $stmt = $conn->prepare('INSERT INTO klanten (Naam, Email, Adres, Postcode, Woonplaats) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('sssss', $naam, $email, $adres, $postcode, $woonplaats);
        $stmt->execute();
        $stmt->close();
    }

    header('Location: index.php');
    exit;
}
