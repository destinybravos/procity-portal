// Restrict all Admin Only Elements
let active_user = JSON.parse(sessionStorage.getItem("active_user"));
// console.log(active_user.role);
if (active_user.role !== 'admin') {
    let adminElements = document.querySelectorAll('.admin-only');
    adminElements.forEach((element) => {
        element.classList.add('hidden');
    })
}