<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

require_once("DBConnection.php");
session_start();
if (!isset($_SESSION["sess_user"])) {
    header("Location: index.php");
    exit; // S'assure qu'aucune autre exécution de code après la redirection
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <title>Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <?php include "tailwindConfig.php"; ?>
</head>

<body class="flex flex-col h-screen">
    <div>
        <?php
        include "navbar.php";
        ?>
    </div>
    <div class="flex flex-row flex-1">
        <div class="hidden md:block">
            <?php
            include "sidebar.php";
            ?>
        </div>
        <div class="flex-1 p-5 overflow-x-auto overflow-y-auto">

            <h1 class="text-green-600 text-3xl font-bold text-center my-3">Admin Panel - Registered Employees</h1>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-[90%] mx-auto pt-4 mx-0">

                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <th class="px-6 py-3">#</th>
                        <th class="px-6 py-3">Nom d'utilisateur/Prenom</th>
                        <th class="px-6 py-3">Nom</th>
                        <th class="px-6 py-3">Matricule</th>
                        <th class="px-6 py-3">Domaine</th>
                        <th class="px-6 py-3">Niveau</th>
                        <th class="px-6 py-3">Grad</th>
                        <th class="px-6 py-3">Fonction</th>
                        <th class="px-6 py-3">Diplome</th>
                        <th class="px-6 py-3">Age</th>
                        <th class="px-6 py-3">Date de Naissance</th>
                        <th class="px-6 py-3">Date d'Entrée</th>
                        <th class="px-6 py-3">Date de Retraite</th>
                        <th class="px-6 py-3">Agence</th>
                        <th class="px-6 py-3">Modifier</th>
                        <th class="px-6 py-3">Supprimer</th>

                    </thead>
                    <tbody>
                        <?php
                        $req = "SELECT id, name, fullname, matricule, domaine, niveau, grad, fonction, diplome, age, datenaissance, dateentree, dateretraite, agence FROM users WHERE type = 'Employee'";
                        $employees = mysqli_query($conn, $req);
                        if ($employees) {
                            $cnt = 1;
                            while ($row = mysqli_fetch_assoc($employees)) {
                                echo "<tr class=\"odd:bg-white even:bg-gray-50\">
                                    <td class=\"px-6 py-4\">$cnt</td>
                                    <td class=\"px-6 py-4\">{$row['name']} / {$row['fullname']}</td >
                                    <td class=\"px-6 py-4\">{$row['fullname']}</td >
                                    <td class=\"px-6 py-4\">{$row['matricule']}</td >
                                    <td class=\"px-6 py-4\">{$row['domaine']}</td >
                                    <td class=\"px-6 py-4\">{$row['niveau']}</td >
                                    <td class=\"px-6 py-4\">{$row['grad']}</td >
                                    <td class=\"px-6 py-4\">{$row['fonction']}</td >
                                    <td class=\"px-6 py-4\">{$row['diplome']}</td >
                                    <td class=\"px-6 py-4\">{$row['age']}</td >
                                    <td class=\"px-6 py-4\">{$row['datenaissance']}</td >
                                    <td class=\"px-6 py-4\">{$row['dateentree']}</td >
                                    <td class=\"px-6 py-4\">{$row['dateretraite']}</td >
                                    <td class=\"px-6 py-4\">{$row['agence']}</td >
                                     <td class=\"px-6 py-4\">
                                        <a href=\"update_emp.php?id={$row['id']}\"><button class=\"px-3 py-2 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800\">Update</button></a>
                                     <td class=\"px-6 py-4\">
                                        <a href=\"delete_emp.php?id={$row['id']}\"><button  class=\"px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800\">delete</button></a>
                                    </td>
                                </tr>";
                                $cnt++;
                            }
                        } else {
                            echo "<tr class='text-center'><td colspan='14'>No employees found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>