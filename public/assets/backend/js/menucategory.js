	function validatedata(){
            var valid = true;
            var menucatstatus = $(".menucatstatus").val();
            if (menucatstatus == "") {
                $(".error_menucatstatus").html("* Required.").addClass("error-color").show();
                $(".menucatstatus").addClass("input-error").focus();
                valid = false;
            }
	        return valid;
        }
		$(document).ready(function () {
				$('#mencatform').on('submit', function (e) {
					const is_image_exists = $('#is_image_exists').val();
					let isValid = true;

					if (is_image_exists == 0) {
						isValid = validateImageInput('input[name="image"]', '.error_image');
					}

					if (!isValid) {
						e.preventDefault();
					}
				});
			});
			
        /*
		$(document).ready(function () {
            $('#mencatform').on('submit', function (e) {
                let isValid = true;
                const imageInput = $('input[name="image"]')[0]; // raw DOM element
                const errorContainer = $('.error_image');
                const file = imageInput.files[0];
                const is_image_exists = $('#is_image_exists').val();
                if(is_image_exists == 0 ){
                        if (!file) {
                            $(".error_image").html("* Required.").addClass("error-color").show();
                            isValid = false;
                        } else if (!file.type.startsWith('image/')) {
                            $(".error_image").html("* Only valid image files are allowed (JPG, PNG, etc).").addClass("error-color").show();
                            isValid = false;
                        } else {
                            errorContainer.hide();
                        }
                        if (!isValid) {
                            e.preventDefault(); // Stop form submission
                        }
                }
            });
		});
		*/