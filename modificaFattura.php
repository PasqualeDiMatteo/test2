<?php
// Connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test2";

$conn = new mysqli($servername, $username, $password, $dbname);

// Recupero dell'ID della fattura
$id_fattura = $_GET['id'];

// Verifico che l'ID sia valido
if ($id_fattura <= 0) {
    echo "ID Fattura non valido.";
}

// Recupero dei dati della fattura
$sqlFattura = "SELECT * FROM fatture WHERE id = $id_fattura";
$resultFattura = $conn->query($sqlFattura);
$fattura = $resultFattura->fetch_assoc();

if (!$fattura) {
    echo "Fattura non trovata.";
}

// Recupero dell'elenco clienti
$queryClienti = "SELECT * FROM clienti";
$clienti = $conn->query($queryClienti);
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Modifica Fattura</title>
</head>

<body>
    <h1>Modifica Fattura</h1>
    <form action="salvaModificaFattura.php" method="POST">
        <label for="cliente">Nome Cliente:</label>
        <select id="cliente" name="cliente">
            <?php foreach ($clienti as $opzione) : ?>
                <option value="<?= $opzione['id'] ?>" <?= $opzione['id'] == $fattura['cliente_id'] ? 'selected' : '' ?>><?= $opzione['nome'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" name="id_fattura" value="<?= $fattura['id'] ?>"><br><br>
        <label for="descrizione">Descrizione:</label>
        <input type="text" id="descrizione" name="descrizione" value="<?= $fattura['descrizione'] ?>"><br><br>
        <label for="quantita">Quantità:</label>
        <input type="number" id="quantita" name="quantita" value="<?= $fattura['quantita'] ?>"><br><br>
        <label for="prezzo_unitario">Prezzo Unitario:</label>
        <input type="number" step="0.01" id="prezzo_unitario" name="prezzo_unitario" value="<?= $fattura['prezzo_unitario'] ?>"><br><br>
        <button type="submit">Salva Modifiche</button>
    </form>
</body>

</html>