<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use Service\Models\User;

/*
todo pegar id
todo verificar id existe
todo retornar true ou false
*/

try {
    $id = $_POST['id'];
    $user = new User;

    $user->remove_user($id);

    return true;
} catch (Exception $e) {
    echo $e;
    return false;
}
