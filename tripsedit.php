<?php

$conn = new mysqli('localhost', 'root', '', 'taxisty');


$id = "";
$votreposition = "";
$destination = "";
$date = "";
$heure = "";
$nombredepersonne = "";
$numerotelephone = "";

$errorMessage = "";
$succesMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location:/trips.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM reservation WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location:/trips.php");
        exit;
    }

    $votreposition = $row["votreposition"];
    $destination = $row["destination"];
    $date = $row["date"];
    $heure = $row["heure"];
    $nombredepersonne = $row["nombredepersonne"];
    $numerotelephone = $row["numerotelephone"];
} else {

    $id = $_POST['id'];
    $votreposition = $_POST['votreposition'];
    $destination = $_POST['destination'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $nombredepersonne = $_POST['nombredepersonne'];
    $numerotelephone = $_POST['numerotelephone'];

    do {
        if (empty($id) || empty($votreposition) || empty($destination) || empty($date) || empty($heure) || empty($nombredepersonne) || empty($numerotelephone)) {
            $errorMessage = "<br> Tous les colums sont réquis <br>";
            break;
        }

        $sql = "UPDATE reservation " . "SET votreposition='$votreposition' , destination='$destination' , date='$date' , heure='$heure' , nombredepersonne='$nombredepersonne' , numerotelephone='$numerotelephone'" .
            "WHERE id=$id";

        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = " Invalid query" . $conn->error;
            break;
        }

        $succesMessage = " mise a jour succées";
        header("location:/trips.php");
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
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="dashboard.php">
                        <span class="icon">
                            <ion-icon name="car"></ion-icon>
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
                <center><h1 class="dasT2">Edit Trip</h1></center>
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
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Position</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="votreposition" value="<?php echo $votreposition; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Destiantion</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="destination" value="<?php echo $destination; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" name="date" value="<?php echo $date; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Heure</label>
                        <div class="col-sm-6">
                            <input type="time" class="form-control" name="heure" value="<?php echo $heure; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Nombre de personne</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" name="nombredepersonne" value="<?php echo $nombredepersonne; ?>">
                        </div>
                    </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Numero telephone</label>
            <div class="col-sm-6">
                <input type="tel" class="form-control" name="numerotelephone" value="<?php echo $numerotelephone; ?>">
            </div>
        </div>

        <div>
       
        <div>

<input type="submit" value="Edit" name="submit" id="submit">



    <a class="btnC" href="/" role="button">Cancel</a>
</div>
           
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

        </form>


        <!-- ================ Order Details List ================= -->

        <!-- =========== Scripts =========  -->
        <script src="assets/js/dashboard.js"></script>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>