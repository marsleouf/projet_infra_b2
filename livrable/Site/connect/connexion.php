<?php
include_once('../config/pdo.php');
require_once('../models/user_model.php');
require_once('../controller/user_controller.php');
session_start();

// construit l'utilisateur à partir des données entrées pour se connecter et compare la correspondance entre email et mot de passe.

$reponse_user = $pdo->query('SELECT mail, mdp FROM users');
$donnees_user = $reponse_user->fetchAll();
$user_controller = new user_manager($pdo);
if (isset($_POST['email']))
{
    $user = $user_controller->getUser($_POST["email"]);
}
foreach ($donnees_user as $indice=>$tab){
    if ( empty($_POST["email"]) or empty($_POST["mot_de_passe"])){
        header('Location: /Dashbord/connect/form_connex.html');
        exit();
    } elseif ($tab['mail'] == $_POST["email"] and $tab['mdp'] == $_POST["mot_de_passe"]){
        $_SESSION['isConnected'] = TRUE;
        $_SESSION['email'] = $_POST["email"];
        $_SESSION['user'] = $user;
        header('Location: /Dashbord/index.php');
        exit();
    }
}
header('Location: /Dashbord/connect/form_connex.html');
?>