const toggleSidebar = document.querySelector('#toggle-sidebar');
const btnSide = document.querySelector('#btn-side');
const overlay = document.querySelector('#overlay-side');
const sidebar = document.querySelector('#sidebar');

btnSide.addEventListener('click', function (e) {
    e.cancelBubble = true;
    btnSide.classList.add('active');
    sidebar.classList.remove('-left-full');
    sidebar.classList.add('left-0');
    overlay.classList.remove('hidden');
});

toggleSidebar.addEventListener('click', function () {
    btnSide.classList.remove('active');
    sidebar.classList.add('-left-full');
    sidebar.classList.remove('left-0');
    overlay.classList.add('hidden');
})