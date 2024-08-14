import axios from "axios";

jQuery(document).ready(function ($) {
    const contactBlockSelector = $(".kd-contact-form-block");
    if (!contactBlockSelector.length) return;

    let home_url = window.location.origin;
    let api_url = home_url + '/wp-json/tamtam/v1/contact-form';

    $(contactBlockSelector).find("#contact-form").on("submit", function (e) {
        e.preventDefault();

        let form = $(this);
        let statusMessage = form.find(".status-message");

        if (form.hasClass('loading')) {
            return;
        }

        // Clear previous error messages
        form.find(".error-message").remove();
        statusMessage.addClass("hidden").removeClass("success error").text("");

        // Gather form data
        let formData = {
            fullname: form.find("#fullname").val(),
            email: form.find("#email").val(),
            message: form.find("#message").val()
        };

        // Disable the submit button to prevent multiple submissions
        let submitButton = form.find("button[type='submit']");
        submitButton.prop("disabled", true);
        form.addClass('loading');

        // Make the AJAX request with Axios
        axios.post(api_url, formData)
            .then(function (response) {
                if (response.data.status === 'success') {
                    // Display success message
                    statusMessage.addClass("success").removeClass("hidden").text(response.data.message);

                    // Optionally, clear the form fields
                    form[0].reset();
                } else {
                    // Display error messages
                    $.each(response.data.errors, function (key, error) {
                        let field = form.find("#" + key);
                        field.after('<p class="error-message mt-1">' + error + '</p>');
                    });
                    // Display a general error message
                    statusMessage.addClass("error").removeClass("hidden").text('There are errors in the form. Please fix them and try again.');
                }
            })
            .catch(function (error) {
                // Handle error (e.g., network error)
                statusMessage.addClass("error").removeClass("hidden").text("There was an issue submitting the form. Please try again later.");
            })
            .finally(function () {
                // Re-enable the submit button
                submitButton.prop("disabled", false);
                form.removeClass('loading');
            });
    });
});
