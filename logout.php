<?php 
    session_start();

    if( isset($_SESSION['userId'])) {
        session_destroy();
        header('Location: http://localhost/servidor-crud-base/index.php');
    }

?>

<!-- A página deve ser direcionada para a página inicial. Qualquer erro nessa execução/teste, o código deve ser refeito - Lari 06/07 --> 