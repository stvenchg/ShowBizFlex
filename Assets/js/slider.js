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
        loop: true,
        pager: false,
        onSliderLoad: function () {
            $('#autoWidthShowCast').removeClass('cS-hidden');
        }
    });
});