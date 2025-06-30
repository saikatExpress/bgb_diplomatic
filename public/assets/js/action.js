$(document).ready(function () {
    $("#actionFormBtn").on("click", function () {
        let form = $("#actionForm");
        let url = form.attr("action");
        let formData = form.serialize();

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            success: function (response) {
                if (response.status === "success") {
                    toastr.success("Saved successfully!");

                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    // Clear previous errors
                    $(".invalid-feedback").text("");

                    $.each(errors, function (key, messages) {
                        $("#error_" + key).text(messages[0]);
                    });

                    toastr.error("Please fix the validation errors.");
                } else {
                    toastr.error("Something went wrong while saving the form.");
                }
            },
        });
    });
});
