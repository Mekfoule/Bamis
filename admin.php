<?php
require_once("DBConnection.php");
session_start();
if (!isset($_SESSION["sess_user"])) {
    header("Location: index.php");
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
        <link rel="stylesheet" href="css/style.css"> -->
        <title>Admin</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: '#22cb5c',
                            secondary: '#cc392e',
                            neutral: '#888888',
                        }
                    }
                }
            }
        </script>

    </head>

    <body>

        <nav class="bg-primary flex justify-between items-center shadow-xl">
            <div class="container-fluid">
                <!-- <a class="navbar-brand" href="#">Bamis Bank</a>
                <button class="btn-default" onclick="window.location.href='leavehist.php';">Leave History</button> -->
            </div>
            <!-- <nav class="nav navbar-right">
                <a class="nav-link active" href="#">Active</a>

            </nav> -->

            <!-- <button id="logout" onclick="window.location.href='logout.php';">Logout</button> -->

            <ul class="gap-4 p-3 flex items-center">
                <li class="nav-item">
                    <a class="nav-link" href="list_emp.php" style="color:white;">Voir Employes <span style="background-color:#2196f3;" class="py-1 px-2 rounded-full"><?php include('count_emp.php'); ?></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_emp.php" style="color:white;">Ajouter </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="leave_history.php" style="color:white;">Demande de Congé/Permission</a>
                </li>
                <li class="nav-item">
                    <button id="logout" onclick="window.location.href='logout.php';" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2">Deconnexion</button>

                </li>
            </ul>

        </nav>

        <h1 class="text-green-600 text-3xl font-bold my-4">Admin Panel</h1>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-[80%] m-auto pt-4">

            <table class=" w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Employe</th>
                    <th class="px-6 py-3">Demande de permission</th>
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Periode</th>
                    <th class="px-6 py-3">Decision</th>
                    <!-- <th>Action</th> -->
                </thead>
                <tbody>
                    <!-- chargement de toutes les demandes de congé depuis la base de données -->
                    <?php
                    global $row;
                    $query = mysqli_query($conn, "SELECT * FROM leaves WHERE status='Pending'");

                    $numrow = mysqli_num_rows($query);

                    if ($query) {

                        if ($numrow != 0) {
                            $cnt = 1;

                            while ($row = mysqli_fetch_assoc($query)) {
                                $datetime1 = new DateTime($row['fromdate']);
                                $datetime2 = new DateTime($row['todate']);
                                $interval = $datetime1->diff($datetime2);

                                echo "<tr class=\"odd:bg-white even:bg-gray-50\">
                                                    <td class=\"px-6 py-4\">$cnt</td>
                                                    <td class=\"px-6 py-4\">{$row['ename']}</td>
                                                    <td class=\"px-6 py-4\">{$row['descr']}</td>
                                                    <td class=\"px-6 py-4\">{$datetime1->format('Y/m/d')} <b>--</b> {$datetime2->format('Y/m/d')}</td>
                                                    <td class=\"px-6 py-4\">{$interval->format('%a Day/s')}</td>
                                          
                                                    <td class=\"px-6 py-4\"><a href=\"updateStatusAccept.php?eid={$row['eid']}&descr={$row['descr']}\"><button class='btn-success btn-sm' >Accept</button></a>
                                                    <a href=\"updateStatusReject.php?eid={$row['eid']}&descr={$row['descr']}\"><button class='btn-danger btn-sm' >Reject</button></a></td>
                                                  </tr>";
                                $cnt++;
                            }
                        }
                    } else {
                        echo "Query Error : " . "SELECT * FROM leaves WHERE status='Pending'" . "<br>" . mysqli_error($conn);
                    }
                    ?>

                </tbody>
            </table>
        </div>

        <footer class="footer navbar navbar-expand-lg navbar-light bg-light" style="color:white;">
            <div>
                <p class="text-center">&copy; <?php echo date("Y"); ?> - Bamis Bank</p>
                <p class="text-center">PFE 2024</p>
            </div>
        </footer>
    </body>

    </html>

<?php
}

ini_set('display_errors', true);
error_reporting(E_ALL);
?>