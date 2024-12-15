<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounte</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="medfind.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
    <link rel="website icon" href="i1.png" type="png">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.html">
            <img src="i1.png" alt="Logo" class="im mt-0" style="width: 40px; margin-right: 10px;">
            <h3 class="pt-2" style="color:rgb(19, 18, 18); font-weight: bold; font-family: Arial, sans-serif; font-size: 2rem;">PharmFind</h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link active lie" href="painer.php" style="color: #007bff; font-weight: bold;">Votre panier</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="clic.html" style="color: #007bff; font-weight: bold;">ChatBot PharmFind</a>
        </li>
    </ul>
</div>

    </div>
</nav>
<section class="container">
    <?php include("rechphar.php"); ?>
</section>
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
                <a href="log11.php">
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
