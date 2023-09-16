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

            <section class="py-4 px-8 mt-2 mb-5">
                <div class="flex items-center justify-between">
                    <aside>
                        <div>
                            <input type="search" name="search_post" id="search_post" placeholder="Search a post" class="px-3 py-1 h-8 rounded-md border">
                        </div>
                    </aside>

                    <aside>
                        <div class="flex items-center gap-2">
                            <button onclick="toggleModal('cat_modal')" class="bg-primary text-white rounded-md py-2 px-4 text-sm font-semibold">
                                Add Category 
                            </button>
                            <button class="bg-primary text-white rounded-md py-2 px-4 text-sm font-semibold">
                                Add Post 
                            </button>
                        </div>
                    </aside>
                </div>
            </section>

            <section class="py-4 px-8 mb-5">
                <div class="grid grid-cols-1 md:grid-cols-6">
                    <!-- Taable of Posts -->
                    <aside class="md:col-span-4">

                    </aside>
                    <!-- List of Categories -->
                    <aside class="md:col-span-2">
                        <div>
                            <h1 class="bg-primary text-white py-1 px-4 font-bold text-lg rounded-t-md">
                                <i class="fa fa-layer-group"></i> Category List
                            </h1>
                            <!-- Un ordered list -->
                            <ul id="cat_list" class="min-h-[400px] max-h-[500px] overflow-y-auto bg-white divide-y">
                                
                            </ul>
                        </div>
                    </aside>
                </div>
            </section>

        </main>
    </section>


    <!-- Include the modals file -->
    <?php include '../components/modals.html'; ?>

    <!-- Script -->
    <script>
        // Puttin Page Indicator title
        document.getElementById("page_indicator").innerHTML = `<i class="fa fa-comments"></i> Manage Blog`;
    </script>
</body>
</html>