<?php

use LdapRecord\Container;
use LdapRecord\Models\ActiveDirectory\User;

require 'vendor/autoload.php';

try {
    // LDAP bağlantısı için ayarlar
    $connection = Container::getConnection();
    $connection->connect();

    echo "LDAP server connection successful!";

    // Örnek kullanıcı arama (bu isteğe bağlıdır)
    $user = User::find('ASPILSAN\\your_username');
    if ($user) {
        echo "User found: " . $user->getName();
    } else {
        echo "User not found.";
    }
} catch (\Exception $e) {
    echo "LDAP connection failed: " . $e->getMessage();
}
