<?php
require_once ('config.php');

require_once(CONTROLLER.'Frontend.php');

isset($_GET['action']) ? $action = $_GET['action'] : $action = null;

if($action == 'home')
{
    $controller = new Frontend();
    $controller->homeAction();

} else if($action == 'restart') {
    session_unset();
    header('Location:index.php?action=home');
} else {
    echo '404';
}