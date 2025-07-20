$(document).ready(function () {
    $("#actionFormBtn").on("click", function () {
        let form = $("#actionForm");
        let url = form.attr("action");
        let formData = form.serialize();

        formSubmit(url, formData);
    });
});

function formSubmit(url, formData) {
    $.ajax({
        type: "POST",
        url: url,
        data: formData,
        success: function (response) {
            if (response.status === "success") {
                toastr.success(
                    response.message || "Form submitted successfully!"
                );

                setTimeout(function () {
                    location.reload();
                }, 1000);
            }
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;

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
}
