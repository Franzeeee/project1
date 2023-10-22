$(document).ready(function () {
    // Toggle dropdown when clicking the button
    $(".dropbtn").on("click", function () {
        // Hide all other dropdowns before showing the clicked one
        $(".dropdown-content").hide();
        $(this).next(".dropdown-content").toggle();
    });

    $(".showDeleteModal").on("click", function () {
        const id = $(this).data('id');
        $(".deleteModal").removeClass("d-none");
        $("#confirmDeleteButton").data('id', id); // Set the data-id in the Confirm button
    });

    function deleteData(id) {
        $.ajax({
            url: 'delete_instructor.php',
            method: 'POST',
            data: { id: id },
            success: function (response) {
                if (response === 'success') {
                    // Handle success, e.g., hide modal and update the UI
                    $(".deleteModal").addClass("d-none");
                    // Delete the row in our UI
                    const row = $(`[data-id=${id}]`).closest('tr');
                    row.remove();
                    alert('Data deleted successfully.');
                } else {
                    alert('Failed to delete data.');
                }
            }
        });
    }

    $("#confirmDeleteButton").on("click", function () {
        const id = $(this).data('id'); // Retrieve the data-id from the Confirm button
        deleteData(id);
    });

    $("#cancelDeleteButton").on("click", function () {
        $(".deleteModal").addClass("d-none");
    });

    $(".edit-button").on("click", function () {
        // Get the id value from the data-id attribute
        var id = $(this).data("id");

        // Send an Ajax request to edit.php with the id as a parameter
        $.ajax({
            url: "edit_instructor.php",
            method: "GET",
            data: { id: id },
            success: function (response) {
                window.location.href = "edit_instructor.php?id=" + id;
            },
            error: function () {
                alert("Failed to load the edit page.");
            }
        });
    });




    // Close dropdown when clicking outside
    $(document).on("click", function (event) {
        if (!$(event.target).closest(".dropdown").length) {
            $(".dropdown-content").hide();
        }
    });

});
