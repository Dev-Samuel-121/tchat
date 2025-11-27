<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use Service\Models\User;

$user = new User;

$id = $user->create($_POST['inputUsername'], password_hash($_POST['inputPassword'], PASSWORD_DEFAULT), $_FILES['inputAvatar']);
