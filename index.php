<?php

include 'db.php';

if (['REQUEST_METHOD'] === 'POST') {
    $naam = trim($_POST['naam'] ?? '');
    $adres = trim($_POST['adres'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $postcode = trim($_POST['postcode'] ?? '');
    $woonplaats = trim($_POST['woonplaats'] ?? '');

    if ($naam !== '' && $email !== '') {
        $stmt = $conn->prepare('INSERT INTO klanten (Naam, Adres, Email, Postcode, Woonplaats) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('sssss', $naam, $adres, $email, $postcode, $woonplaats);
        $stmt->execute();
        $stmt->close();

        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

$sql = 'SELECT * FROM klanten';
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Klantenlijst</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-..." crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">Klantenbeheer</a>
    </div>
</nav>

<div class="container">
    <div class="mb-4">
        <h2>Klantenlijst</h2>

        <form method="post" class="row gy-2 gx-3 align-items-end mt-3">
            <div class="col-md-4">
                <label for="naam" class="form-label">Naam</label>
                <input type="text" id="naam" name="naam" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="adres" class="form-label">Adres</label>
                <input type="text" id="adres" name="adres" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="col-md-2">
                <label for="postcode" class="form-label">Postcode</label>
                <input type="text" id="postcode" name="postcode" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="woonplaats" class="form-label">Woonplaats</label>
                <input type="text" id="woonplaats" name="woonplaats" class="form-control">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Opslaan</button>
            </div>
        </form>
    </div>

    <div class="table-responsive">
          <table class="table table-striped table-hover align-middle">
                <thead class="table-primary">
                      <tr>
                            <th>ID</th>
                            <th>Naam</th>
                            <th>Adres</th>
                            <th>E-mail</th>
                            <th>Postcode</th>
                            <th>Woonplaats</th>
                            <th>Acties</th>
                </tr>
                </thead>
                <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                echo '<td>' . htmlspecialchars($row['naam']) . '</td>';
                echo '<td>' . htmlspecialchars($row['adres']) . '</td>';
                echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                echo '<td>' . htmlspecialchars($row['postcode']) . '</td>';
                echo '<td>' . htmlspecialchars($row['woonplaats']) . '</td>';
                echo '<td>';
                echo '<a class="btn btn-sm btn-outline-primary me-1" href="edit.php?id=' . (int)$row['id'] . '">Bewerken</a>';
                echo '<a class="btn btn-sm btn-outline-danger" href="delete.php?id=' . (int)$row['id'] . '" onclick="return confirm(\'Weet je zeker dat je deze klant wilt verwijderen?\');">Verwijderen</a>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
</body>
</html>
