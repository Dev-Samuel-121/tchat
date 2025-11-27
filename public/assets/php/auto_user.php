<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use Service\Models\User;

// Instancia o model User
$user = new User();

// Validação básica
$users = isset($_POST['users']) ? (int)$_POST['users'] : 1;
$gender = isset($_POST['gender']) ? filter_var($_POST['gender'], FILTER_SANITIZE_STRING) : 'all';
$nationality = isset($_POST['nationality']) ? filter_var($_POST['nationality'], FILTER_SANITIZE_STRING) : 'all';

try {
    $result = $user->create_auto($users, $gender, $nationality);

    if ($result) {
        echo "Usuário(s) criado(s) com sucesso!";
    } else {
        echo "Falha ao criar usuários.";
    }
} catch (Exception $e) {
    // Retorna o erro em caso de falha
    echo "Erro: " . $e->getMessage();
}
