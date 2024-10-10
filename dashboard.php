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
            <div class="cardBox">
            <center><h1 class="dasT">Stats</h1></center>
                <div class="card">
                <div class="numbers">
                    <?php
                        $connection = new mysqli('localhost','root','','taxisty');
                        $query="SELECT id FROM reservation ORDER BY id";
                        $query_run= mysqli_query($connection,$query);
                        $row = mysqli_num_rows($query_run);
                        echo $row
                    ?>
                    </div>
                    <div>
                        <div class="cardName">Trips</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="navigate"></ion-icon>
                    </div>
                   
                </div>

                <div class="card">
                <div class="numbers">
                    <?php
                        $connection = new mysqli('localhost','root','','taxisty');
                        $query1="SELECT id FROM drivers ORDER BY id";
                        $query_run1= mysqli_query($connection,$query1);
                        $row1 = mysqli_num_rows($query_run1);
                        echo $row1
                    ?>
                    </div>
                    <div>
                        <div class="cardName">Drivers</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="speedometer"></ion-icon>
                    </div>
                    
                </div>

                <div class="card">
                <div class="numbers">
                    7,842 TND
                </div>
                    <div>
                        <div class="cardName">Earning</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
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