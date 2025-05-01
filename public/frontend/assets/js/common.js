$(document).off('submit', '#enquiryForm').on('submit', '#enquiryForm', function (event) {
    event.preventDefault();
    var form = $(this);
    var submitButton = form.find('button[type="submit"]');
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').remove();
    submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...');

    var formData = new FormData(this);

    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            submitButton.prop('disabled', false).html('Submit');
            if (response.status === 'success') {
                showToast('success', response.message);
                form[0].reset();
            }
           
        },
        error: function(xhr) {
            submitButton.prop('disabled', false).html('Submit');
            var errors = xhr.responseJSON?.errors;
            if (errors) {
                $.each(errors, function(key, value) {
                    var inputField = $('#' + key);
                    inputField.addClass('is-invalid');
                    inputField.after('<div class="invalid-feedback">' + value[0] + '</div>');
                });
            }
            else if (xhr.responseJSON?.message) {
                showToast('danger', xhr.responseJSON.message);
            } else {
                showToast('danger', "An error occurred! Please try again.");
            }
        }
    });
});


$(document).off('submit', '#customerCare').on('submit', '#customerCare', function (event) {
    event.preventDefault();
    var form = $(this);
    var submitButton = form.find('button[type="submit"]');
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').remove();
    submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...');

    var formData = new FormData(this);

    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            submitButton.prop('disabled', false).html('Submit');
            if (response.status === 'success') {
                showToast('success', response.message);
                form[0].reset();
            }
           
        },
        error: function(xhr) {
            submitButton.prop('disabled', false).html('Submit');
            var errors = xhr.responseJSON?.errors;
            if (errors) {
                $.each(errors, function(key, value) {
                    var inputField = $('#' + key);
                    inputField.addClass('is-invalid');
                    inputField.after('<div class="invalid-feedback">' + value[0] + '</div>');
                });
            }
            else if (xhr.responseJSON?.message) {
                showToast('danger', xhr.responseJSON.message);
            } else {
                showToast('danger', "An error occurred! Please try again.");
            }
        }
    });
});

function showToast(type = 'success', message = 'Success!') {
    const toastEl = $('#liveToast');
    const toastBody = $('#toast-body');
    let bgClass = 'bg-success';
    if (type === 'danger') {
        bgClass = 'bg-danger';
    } else if (type === 'warning') {
        bgClass = 'bg-warning text-dark';
    } else if (type === 'info') {
        bgClass = 'bg-info text-dark';
    }

    toastEl.removeClass('bg-success bg-danger bg-warning bg-info text-dark').addClass(bgClass);
    toastBody.html(message);
    const toast = new bootstrap.Toast(toastEl[0]);
    toast.show();
}