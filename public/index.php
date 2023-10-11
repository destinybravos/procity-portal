<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procity Portal</title>
    <link rel="stylesheet" href="./css/app.css">
    <link rel="stylesheet" href="fa_icons/css/all.css">
</head>
<body>
    <div class="bg-cover bg-no-repeat bg-center text-white" style="background-image: url('images/banner2.jpg');">
        <?php
            include "components/header.html";
            include "components/banner.html";
        ?>
    </div>

    <!-- Featured Post -->
    <section class="py-20">
        <aside class="max-w-6xl mx-auto">
            <!-- Display All Categories -->
            <h2 class="mb-2">
                Blog Categories
            </h2>
            <div id="div_cats" class="flex gap-2 overflow-x-auto w-full">
            </div>

            <!-- display all fetured posts -->
            <div id="featured_posts" class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-20">
            </div>
        </aside>
    </section>


    <script>
        let activeCateory = 'all';
        let setActiveCaategory = (category) => {
            activeCateory = category;
            fetchCatgories();
        }
        const fetchCatgories = () => {
            fetch('../server/fetch_categories.php')
            .then((res) => res.json())
            .then((data) => {
                if (data.status == 'success') {
                    let list = `<button onclick="setActiveCaategory('all')" class="hover:bg-primary hover:text-white ${(activeCateory == 'all') ? 'bg-primary text-white' : 'border-primary border'} text-primary py-1 px-3 text-xs rounded-md italic">
                                    All
                                </button>`; // Default All

                    // Loop throught the categories and accumulated the results into the list
                    data.categories.forEach((cat) => {
                        list += `<button onclick="setActiveCaategory('${cat.category}')" class="hover:bg-primary hover:text-white ${activeCateory == cat.category ? 'bg-primary text-white' : 'border-primary border'} text-primary py-1 px-3 text-xs rounded-md italic">
                                    ${cat.category}
                                </button>`;
                    });

                    // asign the list into the ul element with the id "cat_list"
                    document.getElementById('div_cats').innerHTML = list;
                } else {
                    alert(data.message);
                }
            });
        }
        fetchCatgories();

        let fetchPost = () => {
            let formData = new FormData();
            formData.append('action', 'fetch_post')

            fetch('../server/manage_post.php', {
                method: 'POST', 
                body: formData,
            })
            .then((res) => res.json())
            .then((data) => {
                let postList =  '';
                data.posts.forEach((post) => {
                    postList += `<aside class="rounded-lg shadow bg-white">
                                    <div class="h-44 bg-slate-300 flex justify-center items-center rounded-t-lg" 100px="">
                                        <img src="images/blogs/${post.image}" alt="Image" class="h-full min-w-full flex justify-center items-center">
                                    </div>
                                    <!--  -->
                                    <div class="py-3 px-4">
                                        <h1 class="mb-2 text-lg font-bold">${post.title}</h1>
                                        <p class="mb-2 text-small line-clamp-3 max-h-[200px] overflow-y-hidden">
                                            ${post.body}
                                        </p>
                                        <p class="mb-2">
                                            <a href="blogpost.php?post_id=${post.id}" class="hover:bg-primary border-primary border text-primary hover:text-white py-1 px-3 text-xs rounded-md italic">
                                                Read More
                                            </a>
                                        </p>
                                        <small class="flex justify-between">
                                            <div>
                                                Posted By: ${post.author.uname}
                                            </div>
                                            <div>
                                                Posted On:  ${(post.posted_on)}
                                            </div>
                                        </small>
                                    </div>
                                </aside>`;
                });
                document.getElementById('featured_posts').innerHTML = postList;
            });
        }
        fetchPost();

        $token = 'Hello2Token4user';

        // let test = () => {
        //     fetch('../server/headers.php', {
        //         method: 'POST',
        //         body: 
        //         // headers : {
        //         //     'Content-Type' : 'application/json',
        //         //     'Authorization' : 'Bearer ' + $token,
        //         // }
        //     })
        //     .then((res) => res.json())
        //     .then((res) => {
        //         console.log(res);
        //     });
        // }
        // test();
    </script>
</body>
</html>