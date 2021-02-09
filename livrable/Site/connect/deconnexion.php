<?php
//ferme la session et redirige vers l entrée du site
session_start();
session_destroy();
header('Location: /Dashbord/connect/form_connex.html');
exit;
?>