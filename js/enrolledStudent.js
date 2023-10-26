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
        $("#confirmDeleteButton").data('id', id);
    });

    function deleteData(id) {
        $.ajax({
            url: 'delete_enrolledStudent.php',
            method: 'POST',
            data: { id: id },
            success: function (response) {

                // alert('Failed to delete data.');
                const row = $(`[data-id=${id}]`).closest('tr');
                row.remove();
                alert('Data deleted successfully.');
                location.reload();

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


    // Modal For Edit Feature
    $(".editModal-Student").on("click", function () {
        const id = $(this).data('id');

        const $editModal = $(".editModal");
        const $editForm = $editModal.find(".editForm");
        const selectElement = document.getElementById("editInputState");


        // Fetch data for the selected row via AJAX
        $.ajax({
            url: "edit_enrolledStudent.php",
            type: "GET",
            data: { id: id },
            success: function (response) {
                const data = JSON.parse(response);

                // Populate the edit modal with the data
                $editForm.find("#grade").val(data.grade);
                $editForm.find("#id").val(id);

                // hide the edit modal
                $editModal.removeClass("d-none");

            },
            error: function () {
                alert("Failed to load the edit page.");
            }
        });
    });


    $("#cancelEdit").on("click", function () {
        $(".editModal").addClass("d-none");
    });



    // Close dropdown when clicking outside
    $(document).on("click", function (event) {
        if (!$(event.target).closest(".dropdown").length) {
            $(".dropdown-content").hide();
        }
    });

    // Add Feature
    $(".addStudentForm").on("submit", function (e) {
        e.preventDefault();

        var formData = $(this).serialize();
        $.ajax({
            url: "add_enrolledStudent.php",
            method: "POST",
            data: formData,
            success: function (response) {
                alert("Student Successfully Added!");
                $(".addModal").addClass("d-none");
                location.reload();
            },
            error: function (error) {

                console.log("Error: " + error);
            }
        });

    });

    $(".editForm").on("submit", function (e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: "edit_enrolledStudent.php",
            method: "POST",
            data: formData,
            success: function (response) {
                alert("Student Successfully Updated!");
                $(".addModal").addClass("d-none");
                location.reload();
            },
            error: function (error) {

                console.log("Error: " + error);
            }
        });

    });
});
