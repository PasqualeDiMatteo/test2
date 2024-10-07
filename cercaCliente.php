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

$nomeCliente = $_GET['cliente'] ?? '';

$statement = $conn->prepare("
    SELECT *
    FROM clienti
    WHERE nome LIKE ?
");

$fatture = [];
if ($statement) {
    $nomeCliente = "%$nomeCliente%";
    $statement->bind_param('s', $nomeCliente);

    $statement->execute();

    // Recupero il risultato
    $result = $statement->get_result();
    $cliente = $result->fetch_assoc(); // Recupero il cliente

    if ($cliente) {
        // Se il cliente esiste, recupero le fatture
        $clienteId = $cliente['id'];
        $queryFatture = "SELECT * FROM fatture WHERE cliente_id = $clienteId";
        $fatture = $conn->query($queryFatture);
    }
} else {
    echo "Errore nella preparazione della query.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatture Cliente</title>
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
        <div id="fatture">
            <?php if ($fatture): ?>
                <h2>Fatture di <?php echo $cliente["nome"] ?> </h2>
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
            <?php else: ?>
                <p>Nessuna fattura trovata per questo cliente.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>