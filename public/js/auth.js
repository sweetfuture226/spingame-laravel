var SnippetAuth = function() {
    var handleSignInFormSubmit = function () {
        var signinForm = $('#signin_form');

        signinForm.on('submit', function(e) {
            e.preventDefault();

            signinForm.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                }
            });

            if (!signinForm.valid()) {
                return;
            }

            var loginUrl = signinForm.attr('action');
            var formData = new FormData(signinForm[0]);

            $.ajax({
                url: loginUrl,
                type: 'POST',
                data: formData,
                success: function (response) {
                    if (response.result === "success") {
                        window.location.replace(response.url);
                    } else {
                        swal({
                            position: 'top-center',
                            showConfirmButton: false,
                            timer: 2000,
                            "title": "The user information is incorrect or your account is inactive status.",
                            "type": "error",
                        });
                    }
                },
                processData: false,
                contentType: false,
                error: function(error){
                   console.log(error);
               }
            });
        })
    }

    var handleSignUpSubmit = function () {
        var signupForm = $('#signup_form');

        signupForm.on('submit', function(e) {
            e.preventDefault();

            signupForm.validate({
                rules: {
                    username: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6,
                    }
                }
            });

            if (!signupForm.valid()) {
                return;
            }

            var registerUrl = signupForm.attr('action');
            var formData = new FormData(signupForm[0]);

            $.ajax({
                url: registerUrl,
                type: 'POST',
                data: formData,
                success: function (response) {
                    if (response.result === "success") {
                      swal({
                          "title": 'Check your email to activate your account (It might be in junk mail)',
                          "type": "success",
                          onClose: () => {
                            window.location.replace(response.url);
                          }
                      });

                    } else {
                        swal({
                            "title": response.msg,
                            "type": "error",
                        });
                    }
                },
                processData: false,
                contentType: false,
                error: function(error){
                   console.log(error);
               }
            });
        })
    }

    return {
    // public functions
        init: function() {
            handleSignInFormSubmit();
            handleSignUpSubmit();
        }
    };
}();

jQuery(document).ready(function() {
    SnippetAuth.init();
});
