window.addEventListener('scroll', function() {
    let scroll = window.scrollY;
    document.querySelectorAll('.layer').forEach((layer, index) => {
        let speed;
        switch(index) {
            case 0: speed = 0.9; break;
            case 1: speed = 0.6; break;
            case 2: speed = 0.4; break;
            case 3: speed = 0.2; break;
            case 4: speed = 0.1; break;
            default: speed = 0;
        }
        layer.style.backgroundPositionY = -scroll * speed + 'px';
    });
});
// creating the menubar functionality
const menuBtn = document.getElementById("menu-btn");
const mobileMenu = document.getElementById("mobile-menu");

menuBtn.addEventListener("click", () => {
mobileMenu.classList.toggle("hidden");  });


function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.body.classList.add('modal-active');
}
function togglehidden(model){
    document.getElementById(model).classList.toggle('hidden');
}
function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.body.classList.remove('modal-active');
}

function openVideoModal(videoUrl) {
    document.getElementById('videoFrame').src = videoUrl;
    document.getElementById('videoModal').classList.remove('hidden');
}

function closeVideoModal() {
    document.getElementById('videoFrame').src = '';
    document.getElementById('videoModal').classList.add('hidden');
}
function goToPage(page) {
    const url = new URL(window.location.href);
    url.searchParams.set('page', page);
    window.location.href = url.href;
}