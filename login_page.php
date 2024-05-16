<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login_register_page.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
        <?php 
             
             if(isset($_POST['submit'])){
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);
                
            
               
                $pdo = new PDO("mysql: host=localhost;dbname=1php_projet_franchet_teyar", "root" , "");
                
                
                $stmt = $pdo->prepare("SELECT * FROM users WHERE Email=:email");
                
                $stmt->bindParam(':email', $email);
                
               
                $stmt->execute();
                
                
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                
            
                if($row && password_verify($password, $row['Password']) ){
                    session_start();
                    $_SESSION['valid'] = $row['Email'];
                    $_SESSION['Username'] = $row['Username'];
                    $_SESSION['Id'] = $row['Id'];

                    setcookie("Email", $email, time() + 10000000, "/");
                    setcookie("Username",  $row['Username'], time() + 10000000, "/");
                    setcookie("Id",  $row['Id'], time() + 10000000, "/");

                    header("Location: home_page.php");
                    exit(); 
                } else {
                    echo "<div class='message'>
                            <p>Wrong Username or Password</p>
                          </div><br>";
                    echo "<a href='login_page.php'><button class='btn'>Go Back</button></a>";
                }
                
            } else {

                
            
            ?>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>

                <div class="field">
                    <input type="submit" name="submit" value="Login" required>
                </div>

                <div class="links">
                    Don't have an account? <a href="sign_up_page.php">Sing Up</a>
                </div> 
                </form>     
        </div>
        <?php } ?>    
    </div>  

    
</body>
</html>