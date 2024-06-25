<nav>
    <div class="bg-primary flex justify-between items-center shadow-md px-2">

        <a class="ps-4 font-bold text-md" href="admin.php">Bamis Bank</a>
        <!-- <button class="btn-default" onclick="window.location.href='leavehist.php';">Leave History</button> </div> -->
        <!-- <nav class="nav navbar-right">
            <a class="nav-link active" href="#">Active</a>
            
            </nav>

            <button id="logout" onclick="window.location.href='logout.php';">Logout</button> </div> -->

        <ul class="gap-4 p-3 flex items-center">

            <li class="nav-item">
                <a class="nav-link" href="list_emp.php" style="color:white;">Voir Employes <span class="py-1 px-2 rounded-md bg-red-500"><?php include('count_emp.php'); ?></span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="leave_history.php" style="color:white;">Historique</a>
            </li>
            <li class="bg-secondary hover:opacity-80 py-2 px-3 rounded-md shadow text-white">
                <button id="logout" onclick="window.location.href='logout.php';">Deconnexion</button>
            </li>
        </ul>

    </div>
</nav>