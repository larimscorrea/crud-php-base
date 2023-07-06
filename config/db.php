<?php

    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'login-project';


    // set database source name
    $dsn = 'mysql:host=' . $host . '; dbname=' . $dbname;

    try {
        //Cria instância PDO
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "Conectado com sucesso!";

    } catch(PDOException $e) {
        echo "Conexão falhou: " . $e->getMessage();

    }
?>