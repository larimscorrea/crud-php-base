<?php 

if(isset($_POST['register'])) {
    require('./config/db.php');

    //O POST pega o name, semelhante ao GetElementId. 
    // $userName = $_POST["userName"]; 
    // $userEmail = $_POST["userEmail"];
    // $password = md5($_POST["password"]);

    // if(isset($_POST['userName'])) {
    //     $userName = filter_var( $_POST["userName"], FILTER_SANITIZE_STRING);
    // } else if(isset($_POST['userEmail'])) {
    //     $userEmail = filter_var( $_POST["userEmail"], FILTER_SANITIZE_EMAIL);
    // } else if(isset($_POST['password'])) {
    //     $password = filter_var( $_POST["password"], FILTER_SANITIZE_STRING); 
    // } else if(isset($_POST['passwordHashed'])) {
    //     $passwordHashed = password_hash($password, PASSWORD_DEFAULT); //Substitui o macete do md5.
    // }

    $userName = filter_var( $_POST["userName"], FILTER_SANITIZE_STRING);
    $userEmail = filter_var( $_POST["userEmail"], FILTER_SANITIZE_EMAIL);
    $password = filter_var( $_POST["password"], FILTER_SANITIZE_STRING); 
    $passwordHashed = password_hash( $_POST["password"], PASSWORD_DEFAULT); //Substitui o macete do md5.


    if( filter_var($userEmail, FILTER_VALIDATE_EMAIL) ) {
        $stmt = $pdo -> prepare('SELECT * FROM users WHERE email = ? ');
        $stmt -> execute([$userEmail]);
        $totalUsers = $stmt -> rowCount();


        // echo $totalUsers . '<br> ';

        if( $totalUsers > 0 ) {
            // echo "Email já adicionado. <br> ";
            $emailTaken = "Email já adicionado";
        } else {
            $stmt = $pdo -> prepare('INSERT into users(name, email, password) VALUES(? , ? , ? )');
            $stmt -> execute( [ $userName, $userEmail, $passwordHashed] );

            header('Location: http://localhost/servidor-crud-base/index.php');

        }
    }

    // echo $userName . " " . $userEmail . " " . $password;
}


?>

<?php require('./inc/header.html'); ?>

<div class="container">
    <div class="card">
        <div class="card-header bg-light mb-3">Registre-se</div>
        <div class="card-body"> 
            <form action="register.php" method="POST">

                <div class="form-group">
                    <label for="userName">User Name</label>
                    <input required type="text" name="userName" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="userEmail">User Email</label>
                    <input required type="email" name="userEmail" class="form-control" />
                    <br />
                    <?php if(isset($emailTaken)) { ?> 
                    <p style="color: red"> <?php echo $emailTaken?> </p>
                    <?php } $emailTaken ?>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input required type="password" name="password" class="form-control" />
                </div>

                <button name="register" class="btn btn-primary" type="submit">Register</button>

            </form>
        </div>

    </div>

</div>

<?php require('./inc/footer.html'); ?>