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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Admin Panel</title>

    <style>
        h1 {
            text-align: center;
            font-size: 2.5em;
            font-weight: bold;
            padding-top: 1em;
        }

        .mycontainer {
            width: 90%;
            margin: 1.5rem auto;
            min-height: 60vh;
        }

        .mycontainer table {
            margin: 1.5rem auto;
        }
    </style>

</head>

<body>
    <nav class="navbar header-nav navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin.php">Bamis Bank</a>

            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link" href="list_emp.php" style="color:white;">View Employes <span class="badge badge-pill" style="background-color:#2196f3;"><?php include('count_emp.php'); ?></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_emp.php" style="color:white;">Ajouter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="leave_history.php" style="color:white;">Historique</a>
                </li>
                <li class="nav-item">
                    <button id="logout" onclick="window.location.href='logout.php';" class="btn btn-danger">Deconnexion</button>
                </li>
            </ul>
        </div>
    </nav>

    <h1>Admin Panel - Registered Employees</h1>

    <div class="mycontainer">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <th>#</th>
                    <th>Nom d'utilisateur/Prenom</th>
                    <th>Nom</th>
                    <th>Matricule</th>
                    <th>Domaine</th>
                    <th>Niveau</th>
                    <th>Grad</th>
                    <th>Fonction</th>
                    <th>Diplome</th>
                    <th>Age</th>
                    <th>Date de Naissance</th>
                    <th>Date d'Entrée</th>
                    <th>Date de Retraite</th>
                    <th>Agence</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    $req = "SELECT id, name, fullname, matricule, domaine, niveau, grad, fonction, diplome, age, datenaissance, dateentree, dateretraite, agence FROM users WHERE type = 'Employee'";
                    $employees = mysqli_query($conn, $req);
                    if ($employees) {
                        $cnt = 1;
                        while ($row = mysqli_fetch_assoc($employees)) {
                            echo "<tr>
                                    <td>$cnt</td>
                                    <td>{$row['name']} / {$row['fullname']}</td>
                                    <td>{$row['fullname']}</td>
                                    <td>{$row['matricule']}</td>
                                    <td>{$row['domaine']}</td>
                                    <td>{$row['niveau']}</td>
                                    <td>{$row['grad']}</td>
                                    <td>{$row['fonction']}</td>
                                    <td>{$row['diplome']}</td>
                                    <td>{$row['age']}</td>
                                    <td>{$row['datenaissance']}</td>
                                    <td>{$row['dateentree']}</td>
                                    <td>{$row['dateretraite']}</td>
                                    <td>{$row['agence']}</td>
                                    <td>
                                        <a href=\"update_emp.php?id={$row['id']}\"><button class='btn btn-primary btn-sm'>Update</button></a>
                                        <a href=\"delete_emp.php?id={$row['id']}\"><button class='btn btn-danger btn-sm'>Delete</button></a>
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

    <footer class="footer navbar navbar-expand-lg navbar-light bg-light" style="color:white;">
        <div>
            <p class="text-center">&copy; <?php echo date("Y"); ?> - HR Management - Bamis Bank</p>
            <p class="text-center">PFE 2024</p>
        </div>
    </footer>
</body>

</html>