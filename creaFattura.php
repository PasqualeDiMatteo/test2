<?php
// Connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test2";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifico la connessione
if ($conn->connect_error) {
    echo "Connessione fallita: " . $conn->connect_error;
    $conn->close();
}

// Recupero dell'elenco clienti
$sqlClienti = "SELECT * FROM clienti";
$clienti = $conn->query($sqlClienti);

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Creazione Fattura</title>
</head>

<body>
    <h1>Nuova Fattura</h1>
    <form action="salvaFattura.php" method="POST">
        <label for="cliente">Nome Cliente:</label>
        <select id="cliente" name="cliente">
            <?php foreach ($clienti as $opzione) : ?>
                <option value="<?= $opzione['id'] ?>"><?= $opzione['nome'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="descrizione">Descrizione:</label>
        <input type="text" id="descrizione" name="descrizione"><br><br>

        <label for="quantita">Quantità:</label>
        <input type="number" id="quantita" name="quantita"><br><br>

        <label for="prezzo_unitario">Prezzo Unitario:</label>
        <input type="number" step="0.01" id="prezzo_unitario" name="prezzo_unitario"><br><br>

        <button type="submit">Salva Fattura</button>
    </form>
</body>

</html>