<?php
spl_autoload_register(function ($class)
{require_once"classes/".$class.".php";});

if(isset($_GET["delete"])) {
    $user = new User();
    $user->deleteUser($_GET["delete"]);

}