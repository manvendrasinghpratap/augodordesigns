// modelpopup.js

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Reset forms and validation when modal opens
    $('#signin-modal').on('shown.bs.modal', function () {
        let form = this.querySelector('form');
        form.reset();
        $(form).find('.is-invalid').removeClass('is-invalid');
        $(form).find('.error').remove();

        if ($('#registration').data('validator')) {
            $('#registration').validate().resetForm();
        }
    });

    // Convert inputs to lowercase
    $('input.lowercase-input').on('input', function () {
        this.value = this.value.toLowerCase();
    });

    // Registration form validation
    $('#registration').validate({
        rules: {
            name: { required: true, minlength: 3 },
            remail: { 
                required: true, 
                email: true,
                remote: {
                    url: "/check-email", // example route
                    type: "post",
                    data: {
                        email: function() { return $('[name="remail"]').val(); },
                    }
                }
            },
            rpassword: { required: true, minlength: 8 },
            rpassword_confirmation: { required: true, equalTo: '[name="rpassword"]' }
        },
        messages: {
            name: { required: "Name is required", minlength: "Minimum 3 characters" },
            remail: { required: "Email required", email: "Invalid email", remote: "Email already exists" },
            rpassword: { required: "Password required", minlength: "Minimum 8 characters" },
            rpassword_confirmation: { required: "Confirm password", equalTo: "Passwords do not match" }
        },
        errorElement: 'div',
        errorClass: 'text-danger mt-0',
        errorPlacement: function(error, element) { error.insertAfter(element); },
        highlight: function(element) { $(element).addClass('is-invalid'); },
        unhighlight: function(element) { $(element).removeClass('is-invalid'); },
        onkeyup: function(element) { this.element(element); },
        onfocusout: function(element) { this.element(element); }
    });

    // Instant password match validation
    $('[name="rpassword_confirmation"]').on('input', function() {
        $('#registration').validate().element($(this));
    });

    // Login AJAX
    $('#loginForm').on('submit', function (e) {
        e.preventDefault();
        $('#login-error').hide().text('');
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                window.location.href = response.redirect;
            },
            error: function (xhr) {
                let message = xhr.responseJSON?.message || 'Invalid email or password';
                $('#login-error').text(message).show();
            }
        });
    });

});
