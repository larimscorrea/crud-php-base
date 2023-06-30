<?php 
session_start();

if(isset($_POST['login'])) {
    require('./config/db.php');

    $userEmail = filter_var( $_POST["userEmail"], FILTER_SANITIZE_EMAIL);
    $password = filter_var( $_POST["password"], FILTER_SANITIZE_STRING); 

    $stmt = $pdo -> prepare('SELECT * FROM users WHERE email = ? ');
    $stmt -> execute([$userEmail]);
    $user = $stmt -> fetch();

    if( isset($user) ) {
        if( password_verify($password, $user -> password )) {
            echo "A senha está correta";
            $_SESSION['userId'] = $user -> id;
            header('Location: http://localhost/servidor-crud-base/index.php');
        } else {
            // echo "O e-mail ou a senha do login estão incorretos";
            $wrongLogin = "O e-mail ou a senha do login estão incorretos";
        }
    }


    // if( filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
    //     $stmt = $pdo -> prepare('SELECT * from users WHERE email = ? ');
    //     $stmt -> execute([$userEmail]);
    //     $totalUsers = $stmt -> rowCount();


    //     // echo $totalUsers . '<br> ';

    //     if( $totalUsers > 0 ) {
    //         // echo "Email já adicionado. <br> ";
    //         $emailTaken = "Email já adicionado";
    //     } else {
    //         $stmt = $pdo -> prepare('INSERT into users(name, email, password) VALUES(? , ? , ? )');
    //         $stmt -> execute([ $userName, $userEmail, $password] );

    //     }
    // }

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
                    <label for="userEmail">User Email</label>
                    <input required type="email" name="userEmail" class="form-control" />
                <br />
                <?php if(isset($wrongLogin)) { ?> 
                <p style="color: red"> <?php echo $wrongLogin ?> </p>
                <?php } $wrongLogin ?>
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