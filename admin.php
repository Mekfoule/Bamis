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
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
        <title>Admin</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <?php include "tailwindConfig.php"; ?>
    </head>

    <body>
        <div>
            <?php
            include "navbar.php";
            ?>
        </div>
        <div class="flex flex-row">
            <div class="hidden md:block">
                <?php
                include "sidebar.php";
                ?>
            </div>
            <div class="flex-1 p-5">

                <h1 class="text-green-600 text-3xl font-bold text-center my-3">Admin Panel</h1>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-[80%] m-auto pt-4">

                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
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
            </div>
        </div>

        <?php
        include "footer.php";
        ?>
    </body>

    </html>

<?php
}

ini_set('display_errors', true);
error_reporting(E_ALL);
?>