<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./../css/app.css">
    <link rel="stylesheet" href="../fa_icons/css/all.css">
    <script>
        // Check if the user is logged in. If not, redirect to login page
        let activeUser = sessionStorage.getItem('active_user');

        if (activeUser == null || activeUser == '' || activeUser == undefined){
            location.href = 'login.html';
        }
    </script>
</head>
<body class="bg-slate-100">

    <section>
        <!-- Sidebar -->
        <aside class="h-full left-0 fixed w-56 bg-white shadow-md z-40">
            <?php
                include '../components/sidebar.html';
            ?>
        </aside>

        <!-- Main Content -->
        <main class="ml-56">
            <?php
                include '../components/admin_header.html';
            ?>

            <section>
                Dashboard
            </section>

        </main>
    </section>

    <!-- Script -->
    <script>
        document.getElementById("page_indicator").innerHTML = `<i class="fa fa-tachometer-alt"></i> Dashboard`;
    </script>
</body>
</html>