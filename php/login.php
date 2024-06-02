<?php
// Inclure le fichier de configuration de la base de données
require('config.php');

if (isset($_POST['email'], $_POST['password'])) {
    // Récupérer les données du formulaire et les sécuriser
    $email = stripslashes($_POST['email']);
    $email = mysqli_real_escape_string($conn, $email);

    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    // Requête SQL pour vérifier les informations de connexion
    $query = "SELECT * FROM `users` WHERE email='$email' AND password='" . hash('sha256', $password) . "'";
    $result = mysqli_query($conn, $query) or die(mysqli_error());

    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
        // L'utilisateur est authentifié avec succès
        // Vous pouvez rediriger l'utilisateur vers une page de tableau de bord, par exemple
        header("Location: accueil.html");
    } else {
        // L'authentification a échoué
        echo "<div class='error'>
              <h3>Identifiants incorrects. Veuillez réessayer.</h3>
              </div>";
    }
}
?>