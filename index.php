<?php 
session_start();

if( isset($_SESSION['userId'])) {
    require('./config/db.php');

    $userId = $_SESSION['userId']; 

    $stmt = $pdo -> prepare('SELECT * FROM users WHERE id = ?');
    $stmt -> execute([ $userId ]);

    $user = $stmt -> fetch();

    if( $user->role === 'guest') {
        $message = "Sua conta é de um visitante";
    }

}


?>

<?php require('./inc/header.html'); ?>

<div class="container">
    <div class="card bg-light mb-3">
        <div class="card-header">
            <?php if(isset($user)) { ?>
                <h5>Seja bem-vindo, <?php echo $user->name ?></h5>
           <?php } else { ?>
                <h5>Seja bem-vindo, visitante</h5>
          <?php } ?>
        </div>
        <div class="card-body">

            <?php if(isset($user)) { ?>
                <h5>Esse conteúdo só pode ser visualizado por pessoas logadas. Faça seu <a href="login.php">login</a> e tenha acesso. </h5>
           <?php } else { ?>
                <h4>Por favor, faça <a href="login.php">login</a> ou <a href="register.php">registre-se</a> para ter acesso a todo conteúdo.</h4>
            <?php } ?>
        </div>
    </div>
</div>

<?php require('./inc/footer.html'); ?>



