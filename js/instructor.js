$(document).ready(function () {
    // Toggle dropdown when clicking the button
    $(".dropbtn").on("click", function () {
        // Hide all other dropdowns before showing the clicked one
        $(".dropdown-content").hide();
        $(this).next(".dropdown-content").toggle();
    });

    // Close dropdown when clicking outside
    $(document).on("click", function (event) {
        if (!$(event.target).closest(".dropdown").length) {
            $(".dropdown-content").hide();
        }
    });
});