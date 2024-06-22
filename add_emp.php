<?php
// Assurez-vous que ce fichier PHP est inclus dans un script activé pour la session ou ajoutez session_start() s'il n'est pas inclus.
session_start();
if (!isset($_SESSION["sess_user"])) {
    header("Location: index.php"); // Redirection vers la connexion si la session n'est pas définie
    exit();
}

// Inclut la connexion à la base de données
require_once("DBConnection.php");


// Initialise les variables pour contenir les valeurs d'entrée du formulaire
$fullname = "";
$name =  '';
$matricule = $domaine = $niveau = '';
$grad = $fonction = $diplome = '';
$age = $datenaissance = $dateentree = '';
$dateretraite = $agence = '';
$password = ''; // Initialise la variable de mot de passe
$errors = [];


// Gérer la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valider les données d'entrée (exemple de base, vous aurez peut-être besoin de plus de validation)
    if (empty($_POST["name"])) {
        $errors[] = "Name is required";
    } else {
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
    }



    // Champs supplémentaires pour les détails de l'employé
    $matricule = mysqli_real_escape_string($conn, $_POST["matricule"]);
    $domaine = mysqli_real_escape_string($conn, $_POST["domaine"]);
    $niveau = mysqli_real_escape_string($conn, $_POST["niveau"]);
    $grad = mysqli_real_escape_string($conn, $_POST["grad"]);
    $fonction = mysqli_real_escape_string($conn, $_POST["fonction"]);
    $diplome = mysqli_real_escape_string($conn, $_POST["diplome"]);
    $age = mysqli_real_escape_string($conn, $_POST["age"]);
    $datenaissance = mysqli_real_escape_string($conn, $_POST["datenaissance"]);
    $dateentree = mysqli_real_escape_string($conn, $_POST["dateentree"]);
    $dateretraite = mysqli_real_escape_string($conn, $_POST["dateretraite"]);
    $agence = mysqli_real_escape_string($conn, $_POST["agence"]);

    // Valider et hacher le mot de passe
    if (empty($_POST["password"])) {
        $errors[] = "Password is required";
    } else {
        $password = $_POST["password"];
        // Hachez le mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    }

    // S'il n'y a pas d'erreur de validation, procédez à l'insertion dans la base de données
    if (empty($errors)) {
        // Préparer l'instruction SQL
        $sql = "INSERT INTO users (fullname, name, matricule, domaine, niveau, grad, fonction, diplome, age, datenaissance, dateentree, dateretraite, agence, password) 
                VALUES ('$fullname','$name', '$matricule', '$domaine', '$niveau', '$grad', '$fonction', '$diplome', '$age', '$datenaissance', '$dateentree', '$dateretraite', '$agence', '$hashed_password')";

        // Execute SQL query
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Employee added successfully');</script>";
            // Redirection vers la page des employés ou une autre page appropriée
            header("Location: list_emp.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 800px;
            margin-top: 2rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4">Add Employee</h2>
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Prenom</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Genre</label>
                <select class="form-select" id="gender" name="gender">
                    <option value="Male" <?php if (isset($gender) && $gender == "Male") echo "selected"; ?>>Male</option>
                    <option value="Female" <?php if (isset($gender) && $gender == "Female") echo "selected"; ?>>Femelle</option>
                </select>
            </div>


            <div class="mb-3">

                <div class="mb-3">
                    <label for="matricule" class="form-label">Matricule</label>
                    <input type="text" class="form-control" id="matricule" name="matricule" value="<?php echo htmlspecialchars($matricule); ?>">
                </div>
                <div class="mb-3">
                    <label for="domaine" class="form-label">Domaine</label>
                    <input type="text" class="form-control" id="domaine" name="domaine" value="<?php echo htmlspecialchars($domaine); ?>">
                </div>
                <div class="mb-3">
                    <label for="niveau" class="form-label">Niveau</label>
                    <input type="text" class="form-control" id="niveau" name="niveau" value="<?php echo htmlspecialchars($niveau); ?>">
                </div>
                <div class="mb-3">
                    <label for="grad" class="form-label">Grad</label>
                    <input type="text" class="form-control" id="grad" name="grad" value="<?php echo htmlspecialchars($grad); ?>">
                </div>
                <div class="mb-3">
                    <label for="fonction" class="form-label">Fonction</label>
                    <input type="text" class="form-control" id="fonction" name="fonction" value="<?php echo htmlspecialchars($fonction); ?>">
                </div>
                <div class="mb-3">
                    <label for="diplome" class="form-label">Diplome</label>
                    <input type="text" class="form-control" id="diplome" name="diplome" value="<?php echo htmlspecialchars($diplome); ?>">
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>">
                </div>
                <div class="mb-3">
                    <label for="datenaissance" class="form-label">Date de Naissance</label>
                    <input type="date" class="form-control" id="datenaissance" name="datenaissance" value="<?php echo htmlspecialchars($datenaissance); ?>">
                </div>
                <div class="mb-3">
                    <label for="dateentree" class="form-label">Date d'Entrée</label>
                    <input type="date" class="form-control" id="dateentree" name="dateentree" value="<?php echo htmlspecialchars($dateentree); ?>">
                </div>
                <div class="mb-3">
                    <label for="dateretraite" class="form-label">Date de Retraite</label>
                    <input type="date" class="form-control" id="dateretraite" name="dateretraite" value="<?php echo htmlspecialchars($dateretraite); ?>">
                </div>
                <div class="mb-3">
                    <label for="agence" class="form-label">Agence</label>
                    <input type="text" class="form-control" id="agence" name="agence" value="<?php echo htmlspecialchars($agence); ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Add Employee</button>