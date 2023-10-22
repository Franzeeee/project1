$(document).ready(function () {


    $(".showAddModal").on("click", function () {
        $(".addModal").removeClass("d-none");
    });
    $("#cancelAdd").on("click", function () {
        $(".addModal").addClass("d-none");
    });
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
            // url: 'delete_instructor.php',
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
        alert();
    });




    // Close dropdown when clicking outside
    $(document).on("click", function (event) {
        if (!$(event.target).closest(".dropdown").length) {
            $(".dropdown-content").hide();
        }
    });

    // Listen for the form submission
    $(".addSubjectForm").on("submit", function (e) {
        e.preventDefault(); // Prevent the default form submission behavior

        // Serialize the form data
        var formData = $(this).serialize();

        // Send an AJAX POST request
        $.ajax({
            url: "add_instructorSubject.php",
            method: "POST",
            data: formData,
            success: function (response) {
                alert("Subject Successfully Added!");
                $(".addModal").addClass("d-none");
            },
            error: function (error) {
                // Handle errors here, e.g., display an error message
                console.log("Error: " + error);
            }
        });

    });
});
