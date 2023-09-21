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
    <div class="bg-cover bg-no-repeat bg-center text-white" style="background-image: url('images/banner1.jpg');">
        <?php
            include "components/header.html";
        ?>
    </div>

    <section class="max-w-md mx-auto my-6">
        <h2 class="text-3xl font-bold">
            Drop you Opinion About Life!
        </h2>
    </section>

    <section class="px-4">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-5 gap-6">
            <aside class="md:col-span-2 bg-slate-200 min-h-[100px] px-4 py-3">
                <form action="" method="post" id="frm_opinion">
                    <div class="col-span-full mb-4">
                        <label for="fname" class="block text-sm font-semibold leading-6 text-gray-900">Tell us your name</label>
                        <div class="mt-2">
                            <input type="text" require placeholder="Enter your name" required name="fname" id="fname" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="col-span-full mb-4">
                        <label for="message" class="block text-sm font-medium leading-6 text-gray-900">Message</label>
                        <div class="mt-2">
                            <textarea id="message" required name="message" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>
                    <div class="col-span-full mb-4">
                        <label for="avatar_url" class="block text-sm font-semibold leading-6 text-gray-900">Choose An Avatar</label>
                        <div class="mt-2">
                            <img src="" alt="" id="avatar_preview" class="h-10 w-10 hidden mb-2">
                            <input type="text" id="avatar_url" placeholder="Enter your name" required name="avatar_url" autocomplete="given-name" class="hidden w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <div role="button" id="select-avatar" class="relative flex justify-between items-center w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm sm:text-sm sm:leading-6 bg-white h-8">
                                <span>Select Avatar</span>
                                <span>
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                                <aside id="avatar-container" class="bg-white shadow rounded-md w-72 min-h-[100px] absolute top-full left-0 hidden">
                                    <div class="grid grid-cols-3 py-3 px-4 gap-4">
                                        <img src="images/avatars/avatar1.webp" alt="avatar1" class="avatar">
                                        <img src="images/avatars/avatar2.png" alt="avatar2" class="avatar">
                                        <img src="images/avatars/avatar3.avif" alt="avatar3" class="avatar">
                                        <img src="images/avatars/avatar4.png" alt="avatar4" class="avatar">
                                    </div>
                                </aside>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-full mb-4">
                        <button class="py-2 px-5 bg-blue-500 hover:bg-blue-600 text-white">
                            Submit
                        </button>
                    </div>
                </form>
            </aside>
            <aside class="md:col-span-3 bg-red-300 min-h-[100px] max-h-[70vh] overflow-y-auto">
                <ul class="px-4 py-3 divide-y" id="opinion_list">
                    
                </ul>
            </aside>
        </div>
    </section>

    <!-- Javascript for submitting form data -->
    <script>
        // Toggle Avatar Container (Show/Hide)
        document.getElementById('select-avatar').addEventListener('click', () => {
            let container = document.getElementById('avatar-container');
            if (container.classList.contains('hidden')) {
                container.classList.remove('hidden')
            } else {
                container.classList.add('hidden')
            }
        });

        let avatars = document.querySelectorAll('.avatar');
        // let avatars = document.getElementsByClassName('avatar');

        avatars.forEach((avatar) => {
            avatar.addEventListener('click', (e) => {
                // console.log(e.target.getAttribute('src'));
                let avatarUrl = e.target.src;
                document.getElementById('avatar_url').value = avatarUrl;
                document.getElementById('avatar_preview').setAttribute('src', avatarUrl);
                document.getElementById('avatar_preview').classList.remove('hidden');
            });
        })

        // function myMethod() {

        // }
        // let myMethod = () => {

        // };

        // Fetching all opinion from the database
        let fetchAllOpinion = () => {
            fetch('../server/fetch_opinions.php')
            .then((response) => response.json())
            .then((response) => {
                let list = "";
                response.opinions.forEach((opinionObj) => {
                    list += `<li class="py-4">
                        <p>
                            ${opinionObj.opinion}
                        </p>
                        <div class="flex gap-2 items-center mt-4">
                            <img src="${opinionObj.avatar}" alt="" class="h-7 w-7 rounded-full flex items-center justify-center">
                            <h2 class="font-semibold">${opinionObj.name}</h2>
                        </div>
                    </li>`;
                });
                console.log(response);
                document.getElementById("opinion_list").innerHTML = list;
            });
        };

        fetchAllOpinion();

        // Saving the opinion to database using the fetch Api
        let form = document.getElementById('frm_opinion');
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            // JSON.stringify() - encode into json && JSON.parse() - decodes frrom json
            // let data = JSON.stringify({
            //     name: document.getElementById('fname').value,
            //     message: document.getElementById('message').value,
            //     avatar_url: document.getElementById('avatar_url').value,
            // });

            let formData = new FormData();
            formData.append('name', document.getElementById('fname').value);
            formData.append('message', document.getElementById('message').value);
            formData.append('avatar_url', document.getElementById('avatar_url').value);

            let requestOption = {
                method: 'POST',
                body: formData,
            }

            fetch('../server/save_opinion.php', requestOption)
            .then((response) => response.json())
            .then((response) => {
                fetchAllOpinion();
                console.log(response);
                if (response.status == "success") {
                    form.reset();
                    document.getElementById('avatar_preview').setAttribute('src', '');
                    document.getElementById('avatar_preview').classList.add('hidden');
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            });
        });
    </script>
</body>
</html>