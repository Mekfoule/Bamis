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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
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
        <form class="max-w-md mx-auto" method="post">
            <div class="relative z-0 w-full mb-5 group">
                <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Prenom</label>
                <input type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" id="fullname" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>">
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nom</label>
                <input type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
            </div>

            <div class="flex items-center mb-4">
                <label for="gender" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Genre</label>
                <select class="form-select" id="gender" name="gender">
                    <option value="Male" <?php if (isset($gender) && $gender == "Male") echo "selected"; ?>>Male</option>
                    <option value="Female" <?php if (isset($gender) && $gender == "Female") echo "selected"; ?>>Femelle</option>
                </select>
            </div>


            <div class="grid md:grid-cols-2 md:gap-6">

                <div class="relative z-0 w-full mb-5 group">
                    <label for="matricule" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Matricule</label>
                    <input type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" id="matricule" name="matricule" value="<?php echo htmlspecialchars($matricule); ?>">
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="domaine" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Domaine</label>
                    <input type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" id="domaine" name="domaine" value="<?php echo htmlspecialchars($domaine); ?>">
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="niveau" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Niveau</label>
                    <input type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" id="niveau" name="niveau" value="<?php echo htmlspecialchars($niveau); ?>">
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="grad" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Grad</label>
                    <input type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" id="grad" name="grad" value="<?php echo htmlspecialchars($grad); ?>">
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="fonction" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Fonction</label>
                    <input type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" id="fonction" name="fonction" value="<?php echo htmlspecialchars($fonction); ?>">
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="diplome" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Diplome</label>
                    <input type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" id="diplome" name="diplome" value="<?php echo htmlspecialchars($diplome); ?>">
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="age" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Age</label>
                    <input type="number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>">
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="datenaissance" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Date de Naissance</label>
                    <input type="date" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" id="datenaissance" name="datenaissance" value="<?php echo htmlspecialchars($datenaissance); ?>">
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="dateentree" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Date d'Entrée</label>
                    <input type="date" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" id="dateentree" name="dateentree" value="<?php echo htmlspecialchars($dateentree); ?>">
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="dateretraite" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Date de Retraite</label>
                    <input type="date" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" id="dateretraite" name="dateretraite" value="<?php echo htmlspecialchars($dateretraite); ?>">
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="agence" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Agence</label>
                    <input type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" id="agence" name="agence" value="<?php echo htmlspecialchars($agence); ?>">
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                    <input type="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" id="password" name="password">
                </div>
                <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Add Employee</button>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
            </div>
        </form>
    </div>
</body>

</html>