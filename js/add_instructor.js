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
            url: 'delete_instructorSubject.php',
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
                    $(".deleteModal").addClass("d-none");
                    // Delete the row in our UI
                    const row = $(`[data-id=${id}]`).closest('tr');
                    row.remove();
                    alert('Data deleted successfully.');
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


    // Modal For Edit Feature
    $(".edit-button").on("click", function () {
        const id = $(this).data('id');
        const subjectName = $(this).data('name');

        const $editModal = $(".editModal");
        const $editForm = $editModal.find(".editForm");
        const selectElement = document.getElementById("editInputState");

        // Fetch data for the selected row via AJAX
        $.ajax({
            url: "edit_instructorSubject.php",
            type: "GET",
            data: { id: id },
            success: function (response) {
                const data = JSON.parse(response);

                // Populate the edit modal with the data
                $editForm.find("#instructorSub_ID").val(id);
                $editForm.find("#editSubjectId").val(data.subject_id);
                const optionToChange = selectElement.options[0];
                optionToChange.textContent = subjectName;
                $editForm.find("#editSchedule").val(data.schedule);
                $editForm.find("#editRoom").val(data.room);

                // Show the edit modal
                $editModal.removeClass("d-none");
            },
            error: function () {
                alert("Failed to load the edit page.");
            }
        });
    });

    $(".editModal-Student").on("click", function () {
        const id = $(this).data('id');
        alert();
        const $editModal = $(".editModal");
        const $editForm = $editModal.find(".editForm");
        const selectElement = document.getElementById("editInputState");

        $editModal.removeClass("d-none");

        // Fetch data for the selected row via AJAX
        // $.ajax({
        //     url: "edit_instructorSubject.php",
        //     type: "GET",
        //     data: { id: id },
        //     success: function (response) {
        //         const data = JSON.parse(response);

        //         // Populate the edit modal with the data
        //         $editForm.find("#instructorSub_ID").val(id);
        //         $editForm.find("#editSubjectId").val(data.subject_id);
        //         const optionToChange = selectElement.options[0];
        //         optionToChange.textContent = subjectName;
        //         $editForm.find("#editSchedule").val(data.schedule);
        //         $editForm.find("#editRoom").val(data.room);

        //         // Show the edit modal

        //     },
        //     error: function () {
        //         alert("Failed to load the edit page.");
        //     }
        // });
    });


    $("#cancelEdit").on("click", function () {
        $(".editModal").addClass("d-none");
        $(".editModal-Student").addClass("d-none");
    });



    // Close dropdown when clicking outside
    $(document).on("click", function (event) {
        if (!$(event.target).closest(".dropdown").length) {
            $(".dropdown-content").hide();
        }
    });


    $(".addSubjectForm").on("submit", function (e) {
        e.preventDefault();

        var formData = $(this).serialize();
        $.ajax({
            url: "add_instructorSubject.php",
            method: "POST",
            data: formData,
            success: function (response) {
                alert("Subject Successfully Added!");
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
            url: "edit_instructorSubject.php",
            method: "POST",
            data: formData,
            success: function (response) {
                alert("Subject Successfully Added!");
                $(".addModal").addClass("d-none");
                location.reload();
            },
            error: function (error) {

                console.log("Error: " + error);
            }
        });

    });
});
