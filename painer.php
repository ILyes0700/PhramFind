<?php
session_start();

// Connexion à la base de données avec MySQLi
require("connect.php");
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send'])) {
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            // Vérifier si 'idphar' existe dans l'élément
            if (isset($item['idphar'])) {
                $idphar = $item['idphar'];
            } else {
                $idphar = null; // Ou une valeur par défaut si nécessaire
            }
        
            // Récupérer les informations du médicament
            $datee = date('Y-m-d'); // Convertir la date au format MySQL (YYYY-MM-DD)
            echo("<script>alert('$datee')</script>"); // Notez les guillemets pour l'alerte JS
            $medicament_nom = htmlspecialchars($item['name']);
            $medicament_quantite = (int) $item['quantity'];
            $medicament_prix = (float) $item['price']; // Assurez-vous que le prix est un float
            $tot = $medicament_prix * $medicament_quantite;

            $sql = "INSERT INTO pharmacy_medicaments (nom_medicament, quantite, prix, pharmacy_id, datee) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdids", $medicament_nom, $medicament_quantite, $tot, $idphar, $datee); // "s" pour string
            $stmt->execute();

        }
        
        // Vider le panier après l'envoi à la pharmacie
        unset($_SESSION['cart']); // Ou $_SESSION['cart'] = []; si vous préférez
    }
}
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h3 {
            text-align: center;
            color: #333;
        }
        p {
            margin: 10px 0;
            font-size: 16px;
            color: #555;
        }
        .item {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }
        .item:last-child {
            border-bottom: none;
        }
        .total {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            text-align: right;
            margin-top: 20px;
        }
        .empty-cart {
            font-size: 18px;
            text-align: center;
            color: #e74c3c;
        }
        .hr-line {
            border-top: 1px solid #ccc;
            margin: 20px 0;
        }
        .buttons {
            text-align: center;
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
            border: none;
        }
        .btn-print {
            background-color:rgb(243, 169, 58);
            color: #fff;
        }
        .bt{
            background-color:rgb(34, 108, 219);
            color: #fff;
        }
        .btn-download {
            background-color: #27ae60;
            color: #fff;
        }
        .org{
            color:rgb(34, 108, 219);
        }
        .te{
            color:rgb(243, 169, 58);
        }
        .tot{
            color:#27ae60;
        }
    </style>
</head>
<body>

<div class="container">
<a href="log11.php"><img src="icons8-flèche-gauche-50.png" alt=""></a>
    <?php
    if (empty($_SESSION['cart'])) {
        echo "<p class='empty-cart org'>Votre panier est vide.</p>";
    } else {
        echo "<h3 class='org'>__________  Panier  __________</h3>";
        $total = 0;  // To calculate the total price of the cart
        foreach ($_SESSION['cart'] as $item) {
            echo "<div class='item'>";
            echo "<p><strong class='te'>Nom:</strong> " . htmlspecialchars($item['name']) . "</p>";
            echo "<p><strong class='te'>Prix:</strong> " . number_format($item['price'], 3, ',', ' ') . " €</p>";
            echo "<p><strong class='te'>Quantité:</strong> " . $item['quantity'] . "</p>";
            echo "<p><strong class='te'>Total:</strong> " . number_format($item['total_price'], 3, ',', ' ') . " €</p>";
            echo "</div>";
            $total += $item['total_price'];  // Add each item total to the overall total
        }
        echo "<div class='hr-line class='org''></div>";
        echo "<div class='total'>";
        echo "<h4 class='tot'>Total Panier: " . number_format($total, 3, ',', ' ') . " €</h4>";
        echo "</div>";
    }
    ?>

    <!-- Button to send the data to the pharmacy -->
    <div class="buttons">
        <form method="POST">
            <button type="submit" name="send" class="btn-print">Envoyer à la Pharmacie</button>
        </form>
    </div>

    <!-- Buttons for print and download -->
    <div class="buttons">
        <button class="btn-print bt" onclick="window.print();">Imprimer le Panier</button>
        <button class="btn-download" onclick="downloadCart();">Télécharger en PDF</button>
    </div>
</div>

<!-- JavaScript to handle download -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    function downloadCart() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        let content = 'Panier:\n\n';
        <?php
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                echo "content += 'Nom: " . htmlspecialchars($item['name']) . "\\n';";
                echo "content += 'Prix: " . number_format($item['price'], 3, ',', ' ') . " €\\n';";
                echo "content += 'Quantité: " . $item['quantity'] . "\\n';";
                echo "content += 'Total: " . number_format($item['total_price'], 3, ',', ' ') . " €\\n\\n';";
            }
        }
        ?>
        content += 'Total Panier: <?php echo number_format($total, 3, ',', ' '); ?> €';

        doc.text(content, 10, 10);
        doc.save('panier.pdf');
    }
</script>

</body>
</html>
