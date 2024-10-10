<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxisty Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <div class="container my-5">
                <center><h1 class="dasT">Liste des Taxistes</h1></center>
                <br>    <br>
        <a class="btnAdd" href="addtaxi.php" role="button">Ajouter un taxiste</a>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Adresse</th>
                    <th>Numero de telephone</th>
                    <th>Nombre CIN</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                  $conn = new mysqli('localhost','root','','taxisty');
                  if ($conn->connect_error) {
                    die('failed to connect' .$conn->connect_errort );
                  }

                  $sql = "SELECT * FROM drivers";
                  $result = $conn->query($sql);

                  if (!$result) {
                    die ("invalide" . $connection->error );
                  }
                  while ($row = $result->fetch_assoc()){
                    echo "
                <tr>
                    <td>$row[id]</td>
                    <td>$row[prenom]</td>
                    <td>$row[nom]</td>
                    <td>$row[adresse]</td>
                    <td>$row[numerotel]</td>
                    <td>$row[numerocin]</td>
                    <td>
                    <a class='btn btn-primary btn-sm' href='edittaxi.php?id=$row[id]'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>
                    <a class='btn btn-primary btn-sm' href='deletetaxi.php?id=$row[id]'><i class='fa fa-trash' aria-hidden='true'></i></a>
                    </td>
                </tr>"; }
                ?>
            </tbody>
        </table>
    </div>
    <center>

            </div>

            <!-- ================ Order Details List ================= -->
            
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/dashboard.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>