<?php
    session_start();
    if (isset($_SESSION['username'])) {

    }
    else {
        echo "<script>alert('Anda harus menjadi admin untuk mengakses halaman ini');</script>";
        echo "<script>location.href='index.php'</script>";
    }

    if (isset($_SESSION['username'])) {
        $isAdmin = $_SESSION['isAdmin'];
    }
    else {
        $isAdmin = -1;
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <!-- Custom StyleSheet -->
    <link rel="stylesheet" href="../css/header-user.css" />
    <link rel="stylesheet" href="../css/index.css" />
    <link rel="stylesheet" href="../css/addvar.css" />
    
    <title>Home</title>
  </head>
  <body onload="renderHeader(<?= $isAdmin?>)">
    <div class="header">
        <div class="header-brand" onclick="goToHome()">
            Doradora
        </div>

        <div class="header-search">
            <form action="search-result.php" id="search-form" name="search-form" method="GET">
                <input type="text" name="search-query" placeholder="Cari dorayaki disini">
                <div class="search-icon" onclick="submitSearch()"><i class="fas fa-search"></i></div>
            </form>
        </div>

        <div id="header-user-admin"></div>

        <div class="header-user">
            <i class="fas fa-user"></i>
            <?php if (isset($_SESSION['username'])) {?>
                <p><?= $_SESSION['username'] ?></p>
            <?php } else { ?>
                <p>Guest</p>
            <?php } ?>
            
        </div>
        
        <div class="vr"></div>

        <?php 
            require_once( 'functions.php' );
            if(array_key_exists('logout-btn', $_POST)) {
                if (isset($_SESSION['username'])) {
                    session_destroy();
                    echo "<script>location.href='login.php'</script>";
                }
            }
            else if(array_key_exists('login-btn', $_POST)){
                echo "<script>location.href='login.php'</script>";
            }
        ?>

        <div class="login-logout">
            <form method="POST">
                <?php if (isset($_SESSION['username'])) {?>
                    <input type='submit' name='logout-btn' id='logout-btn' value="Log Out"/>
                <?php } else { ?>
                    <input type='submit' name='login-btn' id='login-btn' value="Log In" />
                <?php } ?>
            </form>
        </div>
    </div>
    <div class="addnew">
        <h1><a href=""></a></h1>
        <h2>ADD NEW VARIANT</h2>
        <div class="add-form">
            <form action="../index.php" method="POST">
                <p>dorayaki name</p>
                <input type="text" name="dorayakiName" placeholder="Type dorayaki name" />
                <br />
                <br />
                <p>photos</p>
                <input type="file" name="gambar" placeholder="Type your image directory ">
                <input type="hidden" name="foto" value="./images/">
                <br />
                <br />
                <p>description</p>
                <input type="text" name="diskripsi" placeholder="Type description" />
                <br />
                <br />
                <p>stock</p>
                <input type="text" name="stok" placeholder="Type stock available" />
                <br />
                <br />
                <div class="add-btn">
                    <input type="submit" value="add" name="submit">
                </div>
            </form>
        </div>
    </div>
    </body>
    <script src="./js/index.js"></script>
</html>