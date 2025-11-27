<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use Service\Models\User;

$user = new User;

$user->create_auto($_POST['results']);
