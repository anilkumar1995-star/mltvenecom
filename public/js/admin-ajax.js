$(document).ready(function () {
    $(document).on('submit', '.ajax-form', function (e) {
        e.preventDefault();

        let $form = $(this);
        let $submitBtn = $form.find('button[type="submit"]');
        let originalBtnText = $submitBtn.html();
        let formData = new FormData(this);

        // Clear previous errors
        $form.find('.invalid-feedback').remove();
        $form.find('.is-invalid').removeClass('is-invalid');

        // Disable button and show loading state
        $submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $submitBtn.prop('disabled', false).html(originalBtnText);

                if (response.success) {
                    // Show success message
                    if (typeof notify === 'function') {
                        notify(response.message, 'success');
                    } else if (typeof toastr !== 'undefined') {
                        toastr.success(response.message);
                    } else {
                        alert(response.message);
                    }

                    // Redirect if URL is provided
                    if (response.redirect) {
                        setTimeout(function () {
                            window.location.href = response.redirect;
                        }, 1000);
                    } else {
                        // Optionally reset form if it's a create form and no redirect
                        if (!$form.find('input[name="_method"][value="PUT"]').length && !$form.find('input[name="_method"][value="PATCH"]').length) {
                            $form[0].reset();
                            // Reset select2 if exists
                            if ($form.find('.select2').length) {
                                $form.find('.select2').val(null).trigger('change');
                            }
                        }
                    }
                } else {
                    if (typeof notify === 'function') {
                        notify(response.message || 'An error occurred', 'error');
                    } else if (typeof toastr !== 'undefined') {
                        toastr.error(response.message || 'An error occurred');
                    } else {
                        alert(response.message || 'An error occurred');
                    }
                }
            },
            error: function (xhr) {
                $submitBtn.prop('disabled', false).html(originalBtnText);

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let $input = $form.find('[name="' + key + '"]');

                        // Handle array names like addresses[0][name] -> addresses.0.name
                        if ($input.length === 0) {
                            // Try to match array notation if key has dots
                            // This part is tricky in generic JS, simplified for now to standard names
                            // Could use regex to convert dot to bracket notation if needed
                        }

                        if ($input.length > 0) {
                            $input.addClass('is-invalid');
                            // Check if invalid-feedback already exists
                            if ($input.next('.invalid-feedback').length === 0) {
                                $input.after('<div class="invalid-feedback">' + value[0] + '</div>');
                            } else {
                                $input.next('.invalid-feedback').html(value[0]);
                            }
                        } else {
                            // Fallback for fields not found or complex names
                            if (typeof notify === 'function') {
                                notify(value[0], 'error');
                            } else if (typeof toastr !== 'undefined') {
                                toastr.error(value[0]);
                            }
                        }
                    });

                    if (typeof notify === 'function') {
                        notify('Please check the form for errors.', 'error');
                    } else if (typeof toastr !== 'undefined') {
                        toastr.error('Please check the form for errors.');
                    }
                } else {
                    let errorMessage = 'Something went wrong. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    if (typeof notify === 'function') {
                        notify(errorMessage, 'error');
                    } else if (typeof toastr !== 'undefined') {
                        toastr.error(errorMessage);
                    } else {
                        alert(errorMessage);
                    }
                }
            }
        });
    });
});
