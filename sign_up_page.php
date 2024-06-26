<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login_register_page.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
        <?php 
         
         if(isset($_POST['submit'])){
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $hashed_password = password_hash("$password", PASSWORD_DEFAULT);

        try{
            require_once "C:\wamp64\www\PHP_PROJECT\config.php";

            $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        } 

        try{
            $stmt = $pdo->prepare("SELECT Username, Email, Password FROM users WHERE Email=:email ");

            $stmt->execute([':email' => $email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            
            if($result){ ?>
            <div class='message'>
                          <p>This email is used, Try another One Please!</p>
            </div> <br>";
                <a href='sign_up_page.php'><button class='btn'>Go Back</button>
                <?php
             }else{
                $stmt = $pdo->prepare("INSERT INTO users(Username,Email,Password) VALUES(:username,:email,:password)");
                $stmt->execute([':username' => $username, ':email' => $email , ':password' => $hashed_password ]);
    
                ?>
                    <div class='message'>
                          <p>Registration successfully!</p>
                    </div> <br>
                <a href='login_page.php'><button class='btn'>Login Now</button>
                <?php } }
                
            catch(PDOException $e) {
               
            }
        


         }else{
         
        ?>
            <header>Register</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>

                <div class="field">
                    <input type="submit" name="submit" value="Register" required>
                </div>

                <div class="links">
                    Already have an account? <a href="login_page.php">Sign In</a>
                </div>   
         </form>
         <a href='home_page.php'><button class='btn'>Go Back</button></a>
            </div>
                <?php }
                 $pdo = null;?>
                
         </div>

    
</body>
</html>