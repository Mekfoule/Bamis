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
    <!--link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <link rel="stylesheet" href="css/style.css"-->
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
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

        <h1 class="text-green-600 text-3xl font-bold text-center my-3">Admin - Demandes de conge/Permission</h1>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-[80%] m-auto pt-4">
          <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
              <th class="px-6 py-3">#</th>
              <th class="px-6 py-3">Employee</th>
              <th class="px-6 py-3">Leave Application</th>
              <th class="px-6 py-3">Days</th>
              <th class="px-6 py-3">From-Date</th>
              <th class="px-6 py-3">To-Date</th>
              <th class="px-6 py-3">Status</th>
            </thead>
            <tbody>
              <!-- chargement de toutes les demandes de congé de l'utilisateur -->
              <?php
              $leaves = mysqli_query($conn, "SELECT * FROM leaves");
              if ($leaves) {
                $numrow = mysqli_num_rows($leaves);
                if ($numrow != 0) {
                  $cnt = 1;
                  while ($row1 = mysqli_fetch_array($leaves)) {
                    $datetime1 = new DateTime($row1['fromdate']);
                    $datetime2 = new DateTime($row1['todate']);
                    $interval = $datetime1->diff($datetime2);
                    echo "<tr class=\"odd:bg-white even:bg-gray-50\">
                              <td class=\"px-6 py-4\">$cnt</td>
                              <td class=\"px-6 py-4\">{$row1['ename']}</td>
                              <td class=\"px-6 py-4\">{$row1['descr']}</td>
                              <td class=\"px-6 py-4\">{$interval->format('%a Day/s')}</td>
                              <td class=\"px-6 py-4\">{$datetime1->format('Y/m/d')}</td>
                              <td class=\"px-6 py-4\">{$datetime2->format('Y/m/d')}</td>
                              <td class=\"px-6 py-4\"><b>{$row1['status']}</b></td>
                              </tr>";
                    $cnt++;
                  }
                } else {
                  echo "<tr class='text-center'><td colspan='12'>YOU DON'T HAVE ANY LEAVE HISTORY! PLEASE APPLY TO VIEW YOUR STATUS HERE!</td></tr>";
                }
              } else {
                echo "Query Error : " . "SELECT descr,status FROM leaves WHERE eid='" . $_SESSION['sess_eid'] . "'" . "<br>" . mysqli_error($conn);;
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>