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

// Query per ottenere la lista delle fatture
$sqlFatture = "SELECT * FROM fatture";
$fatture = $conn->query($sqlFatture);

$conn->close();
?>


<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatture</title>
    <style>
        .container {
            margin: 20px;
        }

        .riepilogo {
            border: 1px solid #ccc;
            padding: 20px;
        }

        form {
            display: inline-block;
        }

        .ricerca {
            display: flex;
            justify-content: flex-end;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="creaFattura.php">Crea nuova fattura </a>
        <form action="cercaCliente.php" method="GET" class="ricerca">
            <input type="text" name="cliente" placeholder="Mario Rossi">
            <button type="submit">Cerca Cliente</button>
        </form>
        <?php if ($fatture->num_rows > 0): ?>
            <div id="fatture">
                <h2>Fatture</h2>
                <?php foreach ($fatture as $fattura) : ?>
                    <div>N:<?= $fattura['id'] ?> Data:<?= $fattura['data'] ?> Descrizione:<?= $fattura['descrizione'] ?>
                        <form action="modificaFattura.php" method="GET">
                            <input type="hidden" name="id" value="<?= $fattura['id'] ?>"><br>
                            <button type="submit">Modifica Fattura</button>
                        </form>
                        <form action="scaricaFattura.php" method="GET">
                            <input type="hidden" name="id" value="<?= $fattura['id'] ?>"><br>
                            <button type="submit">Scarica Fattura</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Nessuna fattura trovata.</p>
        <?php endif; ?>
    </div>
</body>

</html>