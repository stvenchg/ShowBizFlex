const subMenu = document.querySelector('#submenu');
const avatar = document.querySelector('#avatar');

function toggleMenu() {
    subMenu.classList.toggle("open-menu");
}

$('input', '#formChangeAbout').change(function() {
    $("#saveChangeAbout").removeClass("hide");
});

$('input', '#formChangeUsername').change(function() {
    $("#saveChangeUsername").removeClass("hide");
});

$('input', '#formChangeEmail').change(function() {
    $("#saveChangeEmail").removeClass("hide");
});


const showTrailerButton = document.querySelector('.showTrailerButton');
const modalTrailerBg = document.querySelector('.modalTrailer-bg');
let value = $('.modalTrailer-bg').data('value');

showTrailerButton.addEventListener('click', () => {
    modalTrailerBg.innerHTML = '<div class="modalTrailer"><iframe src="https://youtube.com/embed/' + value + '?rel=0&autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
    modalTrailerBg.style.display = "flex";

    setTimeout(() => {
        modalTrailerBg.style.opacity = "1";
    }, 50);
});

modalTrailerBg.addEventListener('click', () => {
    modalTrailerBg.innerHTML = '';
    modalTrailerBg.style.opacity = "0";
    setTimeout(() => {
        modalTrailerBg.style.display = "none";
    }, 450);
});