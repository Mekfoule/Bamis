<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

require_once("DBConnection.php");
session_start();
if (!isset($_SESSION["sess_user"])) {
    header("Location: index.php");
    exit; // S'assure qu'aucune autre exécution de code après la redirection
}

if (isset($_POST['update'])) {
    $emp_id = $_POST['emp_id'];
    $matricule = $_POST['matricule'];
    $domaine = $_POST['domaine'];
    $niveau = $_POST['niveau'];
    $grad = $_POST['grad'];
    $fonction = $_POST['fonction'];
    $diplome = $_POST['diplome'];
    $age = $_POST['age'];
    $datenaissance = $_POST['datenaissance'];
    $dateentree = $_POST['dateentree'];
    $dateretraite = $_POST['dateretraite'];
    $agence = $_POST['agence'];

    // Update query
    $query = "UPDATE users SET matricule=?, domaine=?, niveau=?, grad=?, fonction=?, diplome=?, age=?, datenaissance=?, dateentree=?, dateretraite=?, agence=? WHERE id=?";

    // Préparer l'instruction
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt === false) {
        echo "Error: " . mysqli_error($conn);
    } else {
        // Lier les paramètres
        mysqli_stmt_bind_param($stmt, 'sssssssssssi', $matricule, $domaine, $niveau, $grad, $fonction, $diplome, $age, $datenaissance, $dateentree, $dateretraite, $agence, $emp_id);

        // Exécuter l'instruction
        $result = mysqli_stmt_execute($stmt);
        if ($result) {
            header("Location: list_emp.php"); // Redirect to employee list after successful update
            exit;
        } else {
            echo "Update failed: " . mysqli_stmt_error($stmt);
        }
    }
}

// Récupère les détails de l'employé en fonction de emp_id à partir du paramètre URL
if (isset($_GET['id'])) {
    $emp_id = $_GET['id'];

    // Requête pour récupérer les détails de l'employé
    $query = "SELECT fullname, name, matricule, domaine, niveau, grad, fonction, diplome, age, datenaissance, dateentree, dateretraite, agence FROM users WHERE id=?";


    // Préparer l'instruction
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt === false) {
        echo "Error: " . mysqli_error($conn);
    } else {
        // Paramètre de liaison
        mysqli_stmt_bind_param($stmt, 'i', $emp_id);

        // Exécuter l'instruction
        mysqli_stmt_execute($stmt);

        // Lier les variables de résultat
        mysqli_stmt_bind_result($stmt, $fullname, $name, $matricule, $domaine, $niveau, $grad, $fonction, $diplome, $age, $datenaissance, $dateentree, $dateretraite, $agence);

        // Récupère l'enregistrement
        mysqli_stmt_fetch($stmt);

        // Ferme l'instruction
        mysqli_stmt_close($stmt);
    }
} else {
    echo "Employee ID not provided.";
    exit;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee Information</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-3">Update Employee Information</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="emp_id" value="<?php echo $emp_id; ?>">
            <div class="mb-3">
                <label for="fullname" class="form-label">Prenom</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo htmlspecialchars($name); ?>">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($matricule); ?>">
            </div>
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
                <input type="text" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>">
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
            <button type="submit" class="btn btn-primary" name="update">Update</button>
            <a href="list_emp.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>