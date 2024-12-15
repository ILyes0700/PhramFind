<?php
// Connexion à la base de données
require("connect.php");

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}
//$sql_meds = "SELECT med.nom, med.imagee, med.disce, med.prix FROM med
//JOIN phar_med ON med.id = phar_med.med_id 
//WHERE phar_med.phar_id = $pharmacy_id";

// Récupérer l'ID de la pharmacie depuis l'URL
$pharmacy_id = isset($_GET['id']) ? $_GET['id'] : 0;

// Sécuriser l'ID pour éviter les injections SQL
$pharmacy_id = $conn->real_escape_string($pharmacy_id);
echo "<script>alert($pharmacy_id);</script>";
// Requête SQL pour récupérer les médicaments de la pharmacie par son ID
$sql_meds = "SELECT m.id,m.nom,m.imagee,m.disce,m.prix from med m , phar p where m.id=p.id and p.id=$pharmacy_id;";
$result_meds = $conn->query($sql_meds);

// Requête SQL pour récupérer les détails de la pharmacie
$sql_pharmacy = "SELECT * FROM phar WHERE id = $pharmacy_id";
$result_pharmacy = $conn->query($sql_pharmacy);
$pharmacy = $result_pharmacy->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Pharmacie</title>
    <link rel="stylesheet" href="medfind.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel= "stylesheet" href= "https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css" >
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }
        .container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h1, h2 {
            color: #007bff;
        }
        .card {
            margin-top: 20px;
        }
        .card-body {
            text-align: center;
        }
        .card-title {
            font-size: 18px;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="log11.php"><img src="icons8-flèche-gauche-50.png" alt="" class="pb-3"></a>
    <h1>Détails de la Pharmacie: <?php echo $pharmacy['nomphar']; ?></h1>
    <p style="color:rgb(89, 190, 148); font-weight: bold;"><strong>Adresse:</strong> <?php echo $pharmacy['address1'] . ', ' . $pharmacy['zip']; ?></p>

    <h2>Médicaments disponibles:</h2>

    <div class="row">
    <?php
if ($result_meds->num_rows > 0) {
    while ($row = $result_meds->fetch_assoc()) {
        echo "<div class='col-xs-12 col-sm-12 col-md-6 col-lg-3 pt-3'>
                <div class='card'>
                    <img src='" . $row['imagee'] . "' class='card-img-top' alt='...'>
                    <div class='card-body ca'>
                        <h5 class='card-title'><span class='co'>" . $row['nom'] . "</span></h5>
                        <p class='card-text'>" . $row['disce'] . "</p>
                        <form action='prix.php' method='POST'>
                            <input type='hidden' name='med_name' value='" . $row['nom'] . "'>
                            <input type='hidden' name='idphar' value='" . $pharmacy_id . "'>
                            <input type='hidden' name='med_price' value='" . $row['prix'] . "'>
                            <input type='number' name='quantity' class='num' placeholder='Quantité' min='0' required>
                            <input type='submit' class='btn btn-primary bt'value='Acheter'>
                        </form>
                        
                        <p class='prix pt-2'>" . $row['prix'] . " d</p>
                    </div>
                </div>
              </div>";
    }
} else {
    echo "<p style='color:rgb(89, 190, 148); font-weight: bold;'>Aucun médicament trouvé dans cette pharmacie.</p>";
}
?>


</div>


</body>
</html>

<?php
// Fermer la connexion à la base de données
$conn->close();
?>
