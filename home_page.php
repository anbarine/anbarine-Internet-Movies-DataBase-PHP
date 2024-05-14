<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies Website</title>
    <link href="home_page.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>/*to put later */</style>
</head>
<body>
    
    
    <header> <input type="checkbox" name="menu" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>
        <a href="home_page.php" class="logo">Movies <span> Shop</span></a>   

        <nav class="navbar">
        <a href="home_page.php"> Home</a>
        <a href="categorie_page.php"> Categories</a>
        <a href=""> Produits</a>
        <a href="Amber_Deco.html#contact"> Contact</a>
        </nav>

        <div class="icones">
        <a href="#" class="fas fa-heart" ></a>
        <a href="#" class="fas fa-shopping-cart"> </a>
        <a href="login_page.php" class="fas fa-user"></a>
        </div>
        
    </header>
    <div class="movies">

                <?php
        try{
            $pdo = new PDO("mysql: host=localhost;dbname=1php_projet_franchet_teyar", "root" , "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        try{
                $stmt = $pdo->prepare("SELECT Title, Image, Director, Price FROM movies");
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k => $v) {
                ?>
                <div class="movie">
                <img src="<?php echo $v['Image'] ?>" alt="<?php echo $v['Title'] ?>">
                <div class="movie-info">
                    <h3> <?php echo $v["Title"] ?> </h3>
                    <p> - Director: <?php $v["Director"] ?> </p>
                    <button class="button">Price: <?php echo $v["Price"] ?>$</button>
                </div>
                <div class="overview">
                    <!-- Additional movie details or actions can be placed here -->
                </div>
            </div>
                <?php
                }}catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                }
        ?>
    </div>

    
    


</body>
</html>