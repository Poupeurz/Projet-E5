<?php
// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e5";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion: " . $conn->connect_error);
}

// Récupérer les données du formulaire
$user = $_POST['username'];
$quiz_id = $_POST['quiz_id'];  // Récupère l'identifiant du quiz

// Préparer les réponses
$responses = [
    ['quiz_id' => $quiz_id, 'question' => 'Quel est le rôle de la balise head dans un document HTML ?', 'answer' => $_POST['question1_1']],
    ['quiz_id' => $quiz_id, 'question' => 'Que représente la déclaration !DOCTYPE html dans un document HTML ?', 'answer' => $_POST['question1_2']],
    ['quiz_id' => $quiz_id, 'question' => 'Quelle est la différence entre les balises ul et ol ?', 'answer' => $_POST['question1_3']],
    ['quiz_id' => $quiz_id, 'question' => 'Expliquez à quoi sert l\'attribut src dans la balise img', 'answer' => $_POST['question1_4']],
    ['quiz_id' => $quiz_id, 'question' => 'Comment créer un lien hypertexte dans un document HTML ? Donnez un exemple', 'answer' => $_POST['question1_5']],
    ['quiz_id' => $quiz_id, 'question' => 'Expliquez la différence entre une classe et un ID en CSS.', 'answer' => $_POST['question2_1']],
    ['quiz_id' => $quiz_id, 'question' => 'Qu\'est-ce que le modèle de boîte (Box Model) en CSS ?', 'answer' => $_POST['question2_2']],
    ['quiz_id' => $quiz_id, 'question' => 'À quoi sert l\'attribut hover en CSS ? Donnez un exemple.', 'answer' => $_POST['question2_3']],
    ['quiz_id' => $quiz_id, 'question' => 'Quelle est la différence entre les unités de mesure absolues et relatives en CSS ? Donnez un exemple de chaque', 'answer' => $_POST['question2_4']],
    ['quiz_id' => $quiz_id, 'question' => 'Expliquez ce qu\'est Flexbox en CSS et donnez un exemple de son utilisation', 'answer' => $_POST['question2_5']],
    ['quiz_id' => $quiz_id, 'question' => 'Quelle est la différence entre include et require en PHP ?', 'answer' => $_POST['question3_1']],
    ['quiz_id' => $quiz_id, 'question' => 'Expliquez ce qu\'est une session en PHP.', 'answer' => $_POST['question3_2']],
    ['quiz_id' => $quiz_id, 'question' => 'À quoi sert la fonction var_dump() en PHP ?', 'answer' => $_POST['question3_3']],
    ['quiz_id' => $quiz_id, 'question' => 'Expliquez la différence entre les méthodes GET et POST en PHP.', 'answer' => $_POST['question3_4']],
    ['quiz_id' => $quiz_id, 'question' => 'Qu\'est-ce que PDO en PHP ?', 'answer' => $_POST['question3_5']],
    ['quiz_id' => $quiz_id, 'question' => 'Quelle est la différence entre let, const et var en JavaScript ?', 'answer' => $_POST['question4_1']],
    ['quiz_id' => $quiz_id, 'question' => 'Qu\'est-ce que le DOM (Document Object Model) en JavaScript ?', 'answer' => $_POST['question4_2']],
    ['quiz_id' => $quiz_id, 'question' => 'Quelle est la différence entre == et === en JavaScript ?', 'answer' => $_POST['question4_3']],
    ['quiz_id' => $quiz_id, 'question' => 'À quoi sert la méthode addEventListener() en JavaScript ?', 'answer' => $_POST['question4_4']],
    ['quiz_id' => $quiz_id, 'question' => 'Expliquez ce qu\'est une fonction en JavaScript et donnez un exemple.', 'answer' => $_POST['question4_5']]
];

// Préparer la requête SQL pour insérer les réponses
$sql = "INSERT INTO responses (username, quiz_id, question, answer) VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

// Exécuter l'insertion pour chaque réponse
foreach ($responses as $response) {
    // Vérifier si la réponse n'est pas vide avant de l'insérer
    if (!empty($response['answer'])) {
        $stmt->bind_param("siss", $user, $response['quiz_id'], $response['question'], $response['answer']);
        $stmt->execute();
    }
}

// Vérifier si les insertions ont réussi
if ($stmt->error) {
    echo "Erreur: " . $stmt->error;
} else {
    echo '<script>alert("Réponses enregistrées avec succès!"); window.location.href = "/accueil.html";</script>';
}

// Fermer la connexion
$stmt->close();
$conn->close();
?>
