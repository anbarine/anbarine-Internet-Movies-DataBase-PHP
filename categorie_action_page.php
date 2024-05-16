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
        <a href="categorie_action_page.php"> Action</a>
        <a href="categorie_drama_page.php"> Drama</a>
        </nav>

        <div class="icones">
        <a href="search_page.php" class="fas fa-search"></a>
        <a href="cart_page.php" class="fas fa-shopping-cart"> </a>
        <a href="login_page.php" class="fas fa-user"></a>
        </div>
        
    </header>

    <h1 class="heading">Action</h1>
    <div class="movies-cat">

                <?php
        try{
            $pdo = new PDO("mysql: host=localhost;dbname=1php_projet_franchet_teyar", "root" , "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        try{
                $stmt = $pdo->prepare("SELECT Title, Image, Director, Actor, Price FROM movies WHERE Category= 'Action' ");
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k => $v) {
                ?>
                <div class="movie">
                <img src="<?php echo $v['Image'] ?>" alt="<?php echo $v['Title'] ?>">
                <div class="movie-info">
                    <h2> <?php echo $v["Title"] ?> </h2>
                    <h2> Price: <?php echo $v["Price"] ?>$ </h2>
                    
                </div>
                <div class="overview">
                    <h2> - Director: </h2> 
                    <p><?php echo $v["Director"] ?> </p>
                    <h2> - Actors: </h2>
                    <p><?php echo $v["Actor"] ?> </p>
                    <button class="button">Add to cart</button>

                </div>
            </div>
                <?php
                }}catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                }

                if (isset($_POST['movie_id'])) {
                    $movieId = intval($_POST['movie_id']);
                }
                try{
                    $pdo = new PDO("mysql: host=localhost;dbname=1php_projet_franchet_teyar", "root" , "");
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                try{
                    if(!isset($_SESSION['valid']) || !$_SESSION['valid']){
                        
                    }else{
                        $id = $_COOKIE['Id'];
                        $stmt = $pdo->prepare("SELECT * FROM cart WHERE id_user = :user AND id_movie = :movie");
                        $stmt->bindParam(':user', $id);
                        $stmt->bindParam(':movie', $movieId);
                        $stmt->execute();
                        $iterations = 0;

                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k => $v) {
                            $iterations += 1;
                        }
                        if($iterations == 0 ){
                        $stmt = $pdo->prepare("INSERT INTO cart (Id, Id_user, Id_movie) VALUES (NULL, $id, $movieId)");
                        $stmt->execute();
                        }
                    }
                        

                }catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }

        ?>
    </div>

    
    


</body>
</html>