<?php
// Inclure le fichier de configuration de la base de données
require('config.php');

if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
    // Récupérer les données du formulaire et les sécuriser
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($conn, $username);

    $email = stripslashes($_POST['email']);
    $email = mysqli_real_escape_string($conn, $email);

    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    // Requête SQL pour insérer les données
    $query = "INSERT INTO `users` (username, email, password) VALUES ('$username', '$email', '" . hash('sha256', $password) . "')";

    // Exécuter la requête sur la base de données
    $res = mysqli_query($conn, $query);
    if ($res) {
        echo "<div class='success'>
              <h3>Vous êtes inscrit avec succès.</h3>
              <p>Cliquez ici pour vous <a href='../login.php'>connecter</a></p>
              </div>";
    } else {
        echo "<div class='error'>
              <h3>Une erreur est survenue. Veuillez réessayer.</h3>
              </div>";
    }
}
?>
