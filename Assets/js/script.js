// Return to top button
let returnToTopButton = document.getElementById("returnToTopButton");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
    returnToTopButton.style.display = "block";
  } else {
    returnToTopButton.style.display = "none";
  }
}

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }

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
    searchInput.innerHTML = '<div class="search-box"><form action="./" method="GET"><input name="module" value="search" type="hidden"><input class="inputSearch" placeholder="Rechercher ShowBizFlex..." type="search" name="query" id="inputSearch"></form></div>';
    $('input[type="search"]').focus();
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

// Media buttons events
const panelVideosButton = document.querySelector('#panelVideosButton');
const panelWallpapersButton = document.querySelector('#panelWallpapersButton');
const panelPostersButton = document.querySelector('#panelPostersButton');

const sliderVideos = document.querySelector('#autoWidthShowVideos');
const sliderWallpapers = document.querySelector('#autoWidthShowWallpapers');
const sliderPosters = document.querySelector('#showPosters');

panelVideosButton.addEventListener('click', () => {
    panelVideosButton.classList.add("activeSpan");

    panelWallpapersButton.classList.remove("activeSpan");
    panelPostersButton.classList.remove("activeSpan");

    sliderVideos.classList.remove("hidden");

    sliderWallpapers.classList.add("hidden");
    sliderPosters.classList.add("hidden");
});


panelWallpapersButton.addEventListener('click', () => {
    panelWallpapersButton.classList.add("activeSpan");

    panelVideosButton.classList.remove("activeSpan");
    panelPostersButton.classList.remove("activeSpan");

    sliderWallpapers.classList.remove("hidden");

    sliderVideos.classList.add("hidden");
    sliderPosters.classList.add("hidden");
});


panelPostersButton.addEventListener('click', () => {
    panelPostersButton.classList.add("activeSpan");

    panelVideosButton.classList.remove("activeSpan");
    panelWallpapersButton.classList.remove("activeSpan");

    sliderPosters.classList.remove("hidden");

    sliderVideos.classList.add("hidden");
    sliderWallpapers.classList.add("hidden");
});


// Episodes buttons events
const panelLastEpisodeButton = document.querySelector('#panelLastEpisodeButton');
const panelNextEpisodeButton = document.querySelector('#panelNextEpisodeButton');

const panelshowLastEpisode = document.querySelector('.panel-showLastEpisode');
const panelshowNextEpisode = document.querySelector('.panel-showNextEpisode');

panelLastEpisodeButton.addEventListener('click', () => {
    panelLastEpisodeButton.classList.add("activeSpan");
    panelNextEpisodeButton.classList.remove("activeSpan");

    panelshowLastEpisode.classList.remove("hidden");
    panelshowNextEpisode.classList.add("hidden");
});

panelNextEpisodeButton.addEventListener('click', () => {
    panelNextEpisodeButton.classList.add("activeSpan");
    panelLastEpisodeButton.classList.remove("activeSpan");

    panelshowNextEpisode.classList.remove("hidden");
    panelshowLastEpisode.classList.add("hidden");
});