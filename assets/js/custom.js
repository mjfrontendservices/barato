$(document).ready(function () {
    // START HERE
    $(".search_bar_input").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".item_wrapper").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
})