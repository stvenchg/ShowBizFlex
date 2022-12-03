$(document).ready(function () {
    $('#autoWidthFeatured').lightSlider({
        autoWidth: true,
        loop: true,
        pager: true,
        onSliderLoad: function () {
            $('#autoWidthFeatured').removeClass('cS-hidden');
        }
    });
});

$(document).ready(function () {
    $('#autoWidthTrending').lightSlider({
        autoWidth: true,
        loop: true,
        pager: false,
        onSliderLoad: function () {
            $('#autoWidthTrending').removeClass('cS-hidden');
        }
    });
});

$(document).ready(function () {
    $('#autoWidthTopRated').lightSlider({
        autoWidth: true,
        loop: true,
        pager: false,
        onSliderLoad: function () {
            $('#autoWidthTopRated').removeClass('cS-hidden');
        }
    });
});

$(document).ready(function () {
    $('#autoWidthLatest').lightSlider({
        autoWidth: true,
        loop: true,
        pager: false,
        onSliderLoad: function () {
            $('#autoWidthLatest').removeClass('cS-hidden');
        }
    });
});

$(document).ready(function () {
    $('#autoWidthShowCast').lightSlider({
        autoWidth: true,
        loop: false,
        pager: false,
        onSliderLoad: function () {
            $('#autoWidthShowCast').removeClass('cS-hidden');
        }
    });
});

$(document).ready(function () {
    $('#autoWidthShowVideos').lightSlider({
        autoWidth: true,
        loop: false,
        pager: false,
        onSliderLoad: function () {
            $('#autoWidthShowVideos').removeClass('cS-hidden');
        }
    });
});

$(document).ready(function () {
    $('#autoWidthShowWallpapers').lightSlider({
        autoWidth: true,
        loop: false,
        pager: false,
        onSliderLoad: function () {
            $('#autoWidthShowWallpapers').removeClass('cS-hidden');
        }
    });
});

$(document).ready(function () {
    $('#autoWidthShowSimilar').lightSlider({
        autoWidth: true,
        loop: false,
        pager: false,
        onSliderLoad: function () {
            $('#autoWidthShowSimilar').removeClass('cS-hidden');
        }
    });
});

$(document).ready(function () {
    $('#autoWidthShowRecommandations').lightSlider({
        autoWidth: true,
        loop: false,
        pager: false,
        onSliderLoad: function () {
            $('#autoWidthShowRecommandations').removeClass('cS-hidden');
        }
    });
});