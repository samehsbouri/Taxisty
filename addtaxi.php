<?php
$conn = new mysqli('localhost', 'root', '', 'taxisty');


$prenom = "";
$nom = "";
$adresse = "";
$numerotel = "";
$numerocin = "";


$errorMessage = "";
$succesMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $numerotel = $_POST['numerotel'];
    $numerocin = $_POST['numerocin'];

    do {
        if (empty($prenom) || empty($nom) || empty($adresse) || empty($numerotel) || empty($numerocin)) {
            $errorMessage = "<br> Tous les colums sont réquis <br>";
            break;
        }

        $sql = " INSERT INTO drivers (prenom, nom , adresse, numerotel , numerocin )" .
            "VALUES('$prenom', '$nom', '$adresse', '$numerotel' , '$numerocin')";
        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalide query" . $conn->error;
            break;
        }


        $prenom = "";
        $nom = "";
        $adresse = "";
        $numerotel = "";
        $numerocin = "";
        $succesMessage = "Taxiste ajouté";
        header("location:/drivers.php");
        exit;
    } while (false);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxisty Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="dashboard.php">
                        <span class="icon">
                            <i class="fa fa-taxi" aria-hidden="true"></i>
                        </span>
                        <span class="title">Taxisty</span>
                    </a>
                </li>

                <li>
                    <a href="dashboard.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="trips.php">
                        <span class="icon">
                            <ion-icon name="navigate"></ion-icon>
                        </span>
                        <span class="title">Trips</span>
                    </a>
                </li>

                <li>
                    <a href="drivers.php">
                        <span class="icon">
                            <ion-icon name="speedometer"></ion-icon>
                        </span>
                        <span class="title">Drivers</span>
                    </a>
                </li>

                <li>
                    <a href="login.html">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/img/customer01.png" alt="">
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <center>
                <div class="container my-5"></div>
             <center><h1 class="dasT2">Ajouter un taxiste</h1></center>
             <br>
                <?php
                if (!empty($errorMessage)) {
                    echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong style='color:red'>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
                }
                ?>

                <form method="post">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Prenom</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="prenom" value="<?php echo $prenom; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Nom</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="nom" value="<?php echo $nom; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Adresse</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="adresse" value="<?php echo $adresse; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Numero de Telephone</label>
                        <div class="col-sm-6">
                            <input type="tel" class="form-control" name="numerotel" value="<?php echo $numerotel; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Numero CIN</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="numerocin" value="<?php echo $numerocin; ?>">
                        </div>
                    </div>
                    <div>

<input type="submit" value="Add" name="submit" id="submit">



    <a class="btnC" href="/" role="button">Cancel</a>
</div>



                    <?php
                    if (!empty($succesMessage)) {
                        echo " 
                 <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$succesMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
                    }
                    ?>




                    <!-- ================ Order Details List ================= -->

                    <!-- =========== Scripts =========  -->
                    <script src="assets/js/dashboard.js"></script>

                    <!-- ====== ionicons ======= -->
                    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
                    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>