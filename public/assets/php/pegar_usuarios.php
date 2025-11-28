<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use Service\Models\User;

$user = new User;

header('Content-Type: application/json; charset=utf-8');

echo json_encode($user->get_users());
