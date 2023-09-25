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

            <section class="px-5 py-3 my-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <aside class="min-h-[100px] border px-4 py-3 rounded-lg shadow bg-white">
                        <p class="text-sm">
                            <i class="fa fa-users"></i> No of Users
                        </p>
                        <h2 class="text-5xl font-bold">
                            <span id="no_users"></span>
                        </h2>
                        <a href="#" class="text-primary italic capitalize">manage users records</a>
                    </aside>
                    <aside class="min-h-[100px] border px-4 py-3 rounded-lg shadow bg-white">
                        <p class="text-sm">
                            <i class="fa fa-users"></i> Categories
                        </p>
                        <h2 class="text-5xl font-bold">
                            <span id="no_cats"></span>
                        </h2>
                        <a href="#" class="text-primary italic capitalize">manage users records</a>
                    </aside>
                    <aside class="min-h-[100px] border px-4 py-3 rounded-lg shadow bg-white">
                        <p class="text-sm">
                            <i class="fa fa-users"></i> No of Post
                        </p>
                        <h2 class="text-5xl font-bold">
                            <span id="no_posts"></span>
                        </h2>
                        <a href="#" class="text-primary italic capitalize">manage users records</a>
                    </aside>
                </div>
            </section>

        </main>
    </section>

    <!-- Script -->
    <script>
        document.getElementById("page_indicator").innerHTML = `<i class="fa fa-tachometer-alt"></i> Dashboard`;

        let fetchDasboaardStats = () => {
            fetch('../../server/dashboard_stats.php', {
                method: 'POST', 
                headers: {
                    'Authorization' : sessionStorage.getItem('token')
                }
            })
            .then((res) => res.json())
            .then((data) => {
                document.getElementById('no_users').innerText = data.no_user;
                document.getElementById('no_cats').innerText = data.no_categories;
                document.getElementById('no_posts').innerText = data.no_posts;
            })  
        }
        fetchDasboaardStats();
    </script>
</body>
</html>