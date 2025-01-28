<?php

/**************************
 * Ce controller gère la déconnection en détruisant la session et nous rédirige vers la page d'acceuil
 * 
 * ********************************************************************************** */


session_start();
session_unset();  // Supprime toutes les variables de session
session_destroy();  // Détruire la session
echo "<script type='text/javascript'>
            window.location.href = '/index.php';
      </script>";
    exit();

?>