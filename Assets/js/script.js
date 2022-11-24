// Profile subMenu events
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

// Search events
const searchButton = document.querySelector('#searchbutton');
const modalSearchBg = document.querySelector('.modalSearch-bg');
const searchInput = document.querySelector('.search');

searchButton.addEventListener('click', () => {
    modalSearchBg.style.display = "flex";
    setTimeout(() => {
        modalSearchBg.style.opacity = "0.5";
    }, 50);

    setTimeout(() => {
    searchInput.innerHTML = '<div class="search-box"><input class="inputSearch" placeholder="Rechercher ShowBizFlex..." type="text" name="query" id="inputSearch"></div>';
    }, 100);
});

modalSearchBg.addEventListener('click', () => {
    modalSearchBg.innerHTML = '';
    modalSearchBg.style.opacity = "0";
    searchInput.innerHTML = '';
    setTimeout(() => {
        modalSearchBg.style.display = "none";
    }, 250);
});

// View trailer events
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

