<?php
// Verbind met de database via db.php (zet $conn in scope)
require 'db.php';

// Alleen verwerken als formulieractie 'toevoegen' is
if (isset($_POST['actie']) && $_POST['actie'] === 'toevoegen') {
    // Haal velden uit POST met fallback naar lege string
    $naam = $_POST['naam'] ?? '';
    $adres = $_POST['adres'] ?? '';
    $postcode = $_POST['postcode'] ?? '';
    $woonplaats = $_POST['woonplaats'] ?? '';
    $email = $_POST['email'] ?? '';
 
    // Basisvalidatie: naam en e-mail zijn verplicht
    if (!empty($naam) && !empty($email)) {
        // Voorbereid statement voor veilige insert (SQL-injectiepreventie)
        $stmt = $conn->prepare("INSERT INTO test3 (Naam, Email, Adres, Postcode, Woonplaats) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param($naam, $email, $adres, $postcode, $woonplaats);
        $stmt->execute();
        $stmt->close();
    }

    // Redirect terug naar index, zodat opnieuw laden formulier niet opnieuw invoegt
    header("Location: index.php");
    exit;
}
