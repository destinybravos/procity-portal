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
    <?php
        include "components/header.html";
    ?>

    <div class="max-w-md mx-auto my-6">
        <form action="" method="post" id="frm_contact">
            <div class="col-span-full mb-4">
                <label for="fname" class="block text-sm font-medium leading-6 text-gray-900">Fullname</label>
                <div class="mt-2">
                    <input type="text" required name="fname" id="fname" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="col-span-full mb-4">
                <label for="email_address" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                <div class="mt-2">
                    <input type="email" required name="email_address" id="email_address" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="col-span-full mb-4">
                <label for="subject" class="block text-sm font-medium leading-6 text-gray-900">Subject</label>
                <div class="mt-2">
                    <input type="text" required name="subject" id="subject" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div class="col-span-full mb-4">
                <label for="message" class="block text-sm font-medium leading-6 text-gray-900">Message</label>
                <div class="mt-2">
                    <textarea id="message" required name="message" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                </div>
            </div>
            <div class="col-span-full mb-4">
                <button class="py-2 px-5 bg-blue-500 hover:bg-blue-600 text-white">
                    Submit
                </button>
            </div>
        </form>
    </div>

    <!-- Javascript for submitting form data -->
    <script>
        let form = document.getElementById("frm_contact");

        form.addEventListener("submit", function (e) {
            e.preventDefault();
            // Get all the data from the form
            let fullname = document.getElementById("fname").value;
            let email = document.getElementById("email_address").value;
            let subject = document.getElementById("subject").value;
            let message = document.getElementById("message").value;

            // Make HTTP request to the save_contact endpoint on the server
            fetch(`../server/save_contact.php?fullname=${fullname}&subject=${subject}&message=${message}&email=${email}`)
            .then((res) => res.json())
            .then((data) => {
                if(data.status == "success"){
                    alert(data.message);
                    form.reset();
                }else{
                    alert(data.message);
                }
            })
            .catch((err) => {
                console.log("errr", err);
            });
        });
    </script>
</body>
</html>