<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST</title>
    <link rel="stylesheet" href="./css/app.css">
    <link rel="stylesheet" href="fa_icons/css/all.css">
</head>
<body>
    <div class="bg-cover bg-no-repeat bg-center text-white" style="background-image: url('images/banner1.jpg');">
        <?php
            include "components/header.html";
        ?>
    </div>


    <section class="py-10">
        <div class="max-w-6xl mx-auto px-4 py-4 grid grid-cols-1 lg:grid-cols-4 gap-4">
            <aside class="lg:col-span-3">
                <h1 class="text-4xl font-black mb-4" id="el_post_title"></h1>
                <div class="flex items-start gap-2">
                    <img src="images/avatars/avatar1.webp" alt="" class="h-12 w-12 rounded-full flex items-center justify-center bg-slate-400">
                    <aside class="leading-3">
                        <h2 class="text-base font-semibold" id="el_post_author"></h2>
                        <small>Posted on: <span id="el_date"></span></small>
                    </aside>
                </div>

                <div class="py-5">
                    <img id="post_image" src="" alt="" class="max-w-full">
                </div>

                <p id="el_post_body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto labore at necessitatibus id laborum 
                    dicta explicabo ab minima in ipsa minus, excepturi asperiores totam obcaecati ratione fuga vero 
                    porro sapiente!
                </p>

            </aside>

            <aside class="bg-red-500">
                sd
            </aside>
        </div>
    </section>




    <!-- Javascript for submitting form data -->
    <script>
        // Method to fetch the post data
        let fetchPost = async (post_id) => {
            let formData = new FormData();
            formData.append('action', 'fetch_a_post');
            formData.append('post_id', post_id);

            await fetch('../server/manage_post.php', {
                method: 'POST', 
                body: formData,
            })
            .then((res) => res.json())
            .then((data) => {
                document.getElementById('el_post_title').innerHTML = data.post.title;
                document.getElementById('el_post_author').innerHTML = data.post.author.uname;
                document.getElementById('el_date').innerHTML = data.post.posted_on;
                document.getElementById('post_image').setAttribute('src', `images/blogs/${data.post.image}`);
                document.getElementById('el_post_body').innerHTML = data.post.body;
            });
        }


        let url = new URL(location); // Decalre a new URL object
        let post_id = url.searchParams.get('post_id'); // Search for the post_id parameter
        
        // If post id is null or empty or undefined, redirect back to the main|index page
        if (post_id == null || post_id == '' || post_id == undefined) {
            location.href = 'index.php';
        } else {
            // If the post exists, then fetch the post data
            fetchPost(post_id);
        }

    </script>
</body>
</html>