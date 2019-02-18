$('#story-search').selectize({
    valueField: 'title',
    labelField: 'title',
    searchField: ['title'],
    create: true,
    maxItems: 1,
    maxOptions: 10,
    render: {
        option: function (item, escape) {
            return '<div>' +
                '<span class="title">' +
                '<span class="name">' + escape(item.title) + '</span>' +
                '<span style="float: right;" class="name">' + escape(item.view) + '</span>' +
                '</span>' +
                '</div>';
        }
    },
    load: function (query, callback) {
        if (!query.length) return callback();
        $.ajax({
            url: '/api/tim-kiem?type=string&keyword=' + encodeURIComponent(query),
            type: 'GET',
            error: function () {
                callback();
            },
            success: function (res) {
                callback(res);
            }
        });
    },
});


$(document).on('click', '#search-story', function () {
    var val = $('#story-search').val();
    $(location).attr('href', window.location.origin + '/tim-kiem/' + val);
});


$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

// Hide Header on on scroll down
// var didScroll;
// var lastScrollTop = 0;
// var delta = 5;
// var navbarHeight = $('header').outerHeight();
//
// $(window).scroll(function (event) {
//     didScroll = true;
// });
//
// setInterval(function () {
//     if (didScroll) {
//         hasScrolled();
//         didScroll = false;
//     }
// }, 250);
//
// function hasScrolled() {
//     var st = $(this).scrollTop();
//
//     // Make sure they scroll more than delta
//     if (Math.abs(lastScrollTop - st) <= delta)
//         return;
//
//     // If they scrolled down and are past the navbar, add class .nav-up.
//     // This is necessary so you never see what is "behind" the navbar.
//     if (st > lastScrollTop && st > navbarHeight) {
//         // Scroll Down
//         $('header').removeClass('header-down').addClass('header-up');
//     } else {
//         // Scroll Up
//         if (st + $(window).height() < $(document).height()) {
//             $('header').removeClass('header-up').addClass('header-down');
//         }
//     }
//
//     lastScrollTop = st;
// }
