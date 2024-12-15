<?php
// Connexion à la base de données
session_start();
require("connect.php"); // Assurez-vous que ce fichier contient la connexion à la base de données
$idphar=$_GET["id"];
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}
//Récupérer les pharmacies pour un état sélectionné, si l'état est défini dans l'URL
$idphar = isset($_GET['id']) ? $_GET['id'] : '';
// Récupérer les médicaments depuis la table pharmacy_medicaments
$sql = "SELECT * FROM pharmacy_medicaments where pharmacy_id=$idphar"; //where pharmacy_id=$idphar";
$result = $conn->query($sql);

$total_quantite = 0;
$total_prix = 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmFind - Liste des Médicaments</title>
    <link rel="stylesheet" href="medfind.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        nav {
            background-color: rgb(218, 218, 218);
        }
        .navbar-nav .nav-link {
            color: #fff;
        }
        .navbar-nav .nav-link.active {
            color: #ffc107;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .btn-print {
            background-color:rgb(243, 169, 58);
            color: #fff;
            border:none;
            border-radius:8px;
        }
        .bt{
            background-color:rgb(34, 108, 219);
            color: #fff;
            margin-left:440px;
        }
        h2 {
            font-size: 2rem;
            color: #007bff;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            text-align: center;
            padding: 12px;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        td {
            background-color: #f9f9f9;
        }
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .total-section {
            margin-top: 30px;
            padding: 20px;
            background-color: #f1f1f1;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .footer {
            background-color:rgb(227, 235, 243);
            color: #fff;
            padding: 20px 0
            text-align: center;
            margin-top: 50px;
        }
        .footer a {
            color: #ffc107;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .navbar-brand {
            color: #fff;
            font-weight: bold;
            font-size: 30px;
        }
        .im {
            margin-left: 30px;
            margin-top: -10px;
        }
        footer a {
            color: black;
            text-decoration: none;
        }
        .container {
            padding: 15px;
        }
        h2 {
            font-size: 1.5rem;
            text-align: center;
        }
        .table th, .table td {
            padding: 8px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .pm{
            padding-left:0px;
            color:rgba(172, 145, 235, 0.48);
        }
        .jn{
            padding-right:20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        
        <h3 class="mb-0 mt-0" style="font-size:36px;">
            <img src="i1.png" alt="" class="im me-2 mt-0 pr-5" style="width: 40px; height: 40px;">
            PharmFind
        </h3>
    </nav>

    <div class="container mb-5">
        <h2 class="pl-5">Liste des Médicaments Achétée</h2>
        <?php
        if ($result->num_rows > 0) {
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered table-striped">';
            echo '<thead><tr><th>Nom</th><th>Quantité</th><th>Prix</th><th>Total</th><th>Date</th></tr></thead><tbody>';

            while ($row = $result->fetch_assoc()) {
                $total_item = $row['quantite'] * $row['prix'];
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['nom_medicament']) . "</td>";
                echo "<td>" . $row['quantite'] . "</td>";
                echo "<td>" . number_format($row['prix'], 2, ',', ' ') . " d</td>";
                echo "<td>" . number_format($total_item, 2, ',', ' ') . " d</td>";
                echo "<td>" . $row['datee'] . "</td>";
                echo "</tr>";

                $total_quantite += $row['quantite'];
                $total_prix += $total_item;
            }

            echo '</tbody></table>';
            echo '</div>';
        } else {
            echo "<p>Aucun médicament disponible.</p>";
        }
        ?>
        
        <div class="total-section">
            <h3>Total des Médicaments</h3>
            <p><strong>Quantité totale :</strong> <?php echo $total_quantite; ?> </p>
            <p><strong>Total des prix :</strong> <?php echo number_format($total_prix, 2, ',', ' ') . " d"; ?></p>
        </div>
        <div class="col-12 text-center pt-4">
        <input type="submit" class="btn btn-primary" onclick="window.print();"  value="Imprimer le Facture">
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 contact-info pb-4 pt-2 ">
                    <img src="tel.png" alt="Tel" class="ic">
                    <a href="tel:+21627704669" ><span style="color:rgb(153, 153, 153); font-weight: bold;">+216 27704669</span></a>
                    <br>
                    <img src="mai.png" alt="Email" class="ic">
                    <a href="mailto:ilyesrejeb12@gmail.com"><span style="color:rgb(153, 153, 153); font-weight: bold;">ilyesrejeb12@gmail.com</span></a>
                </div>
                <div class="col-12 col-md-4 text-center social-links pt-3">
                    <a href="https://www.linkedin.com/in/rejeb-ilyes-4942a0319/">
                        <img src="icons8-linkedin-50.png" alt="LinkedIn">
                    </a>
                    <a href="https://www.facebook.com/ilyes.rejeb.96?locale=fr_FR">
                        <img src="icons8-fb-50.png" alt="Facebook">
                    </a>
                    <a href="https://github.com/ILyes0700">
                        <img src="icons8-github-50.png" alt="GitHub">
                    </a>
                    <a href="https://www.instagram.com/ilyes_rejeb_07/">
                        <img src="icons8-instagram-50.png" alt="Instagram">
                    </a>
                </div>
                <div class="col-12 col-md-4 contact-info pt-4" style="width: 30%;">
                    <a href="mony.php">
                        <img src="icons8-slide-up-50.png" alt="Back to Top" class="ic">
                    </a>
                </div>
            </div>
            <div class="text-center mt-4">
                <div class="hstack gap-3 pt-3">
                    <input type="text" class="form-control" placeholder="Quel est ton problème ?" style="width: 60%;">
                    <button type="button" class="btn btn-secondary">Submit</button>
                    <div class="vr"></div>
                    <button type="button" class="btn btn-outline-danger">Reset</button>
                </div>
                <p class="mt-4">&copy; 2024 PharmFind, Ilyes</p>
            </div>
        </div>
    </footer>

</body>
</html>

<?php
// Fermer la connexion
$conn->close();
?>
