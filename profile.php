<?php 

session_start();

if(isset($_SESSION['userId'])) {
    require('./config/db.php');

    $userId = $_SESSION['userId'];

    if( isset($_POST['edit']) ) {
        $userName = filter_var( $_POST["userName"], FILTER_SANITIZE_STRING);
        $userEmail = filter_var( $_POST["userEmail"], FILTER_SANITIZE_EMAIL);
        $stmt = $pdo -> prepare('UPDATE users SET name=?, email=? WHERE id=?');
        $stmt ->execute([$userName, $userEmail, $userId]);

    }

    $stmt = $pdo -> prepare('SELECT * FROM users WHERE id = ? ');
    $stmt->execute([$userId]);

    $user = $stmt -> fetch();
}

?>

<?php require('./inc/header.html'); ?>

<div class="container">
    <div class="card">
        <div class="card-header bg-light mb-3">Atualize seus dados</div>
        <div class="card-body"> 

            <form action="profile.php" method="POST">
            <?php if(isset($user)) { ?> 
                <div class="form-group">
                    <label for="userName">User Name</label>
                    <input required type="text" name="userName" class="form-control" value="<?php echo $user->name ?? '' ?>" /> 
                </div>
                <div class="form-group">
                    <label for="userEmail">User Email</label>
                    <input required type="email" name="userEmail" class="form-control" value="<?php echo $user->email ?? '' ?>" />
                    <br />
                    <?php if(isset($emailTaken)) { ?> 
                    <p style="color: red"> <?php echo $emailTaken?> </p>
                    <?php } ?> 
                </div>
                <?php } else { ?>
                <p> Usuário não encontrado. </p>
                <?php } ?>
                <button name="edit" class="btn btn-primary" type="submit">Atualize seus dados.</button>

            </form>
        </div>

    </div>

</div>

<?php require('./inc/footer.html'); ?>