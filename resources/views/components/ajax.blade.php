<script>
$(document).ready(function() {
    // User Registration
    $('#createUser').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '{{ route("user.register") }}',
            type: 'POST',
            data: formData,
            success: function(response) {
                Swal.fire('Success', response.message, 'success').then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    for (var error in errors) {
                        Swal.fire('Error', errors[error][0], 'error');
                    }
                } else {
                    Swal.fire('Error', 'An error occurred.', 'error');
                }
            }
        });
    });

    // Event Registration
    $('.event-regi').on('click',function(){
        var eventid = $(this).data('eventid');
        var userid = $(this).data('userid');
        $('.eventid').val(eventid);
        $('.userid').val(userid);
    });
    $('#eventparticipantform').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '{{ route("user.eventparticipantform") }}',
            type: 'POST',
            data: formData,
            success: function(response) {
                Swal.fire('Success', response.message, 'success');
                $("#eventregistrationmodle .pop-close").click();
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    for (var error in errors) {
                        Swal.fire('Error', errors[error][0], 'error');
                    }
                } else {
                    Swal.fire('Error', 'An error occurred.', 'error');
                }
            }
        });
    });

    // Login
    $('#loginForm').on('submit', function(e) {
        const username = $('input[name="username"]', this).val().trim();
    const password = $('input[name="password"]', this).val().trim();
    let hasError = false;

    if (!username) {
      $('input[name="username"]').addClass('is-invalid')
        .next('.invalid-feedback').show().text('Username is required.');
      hasError = true;
    }
    if (!password) {
      $('input[name="password"]').addClass('is-invalid')
        .next('.invalid-feedback').show().text('Password is required.');
      hasError = true;
    }
    if (hasError) return;
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: "{{ route('loginfront') }}",
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response) {
                    if(response == 1){
                        Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Password changed successfully. Redirecting to login...',
                        showConfirmButton: false,
                        timer: 1000, // auto close after 2 seconds
                        timerProgressBar: true,
                        }, location.reload());
                    }
                    if(response == 0){
                        Swal.fire('Error', 'Invalid username or password. Please try again.', 'error').then(() => {
                            location.reload();
                        });
                    }
                    if(response == 2){
                        Swal.fire('Notice', 'Please change your old password!.', 'warning').then(() => {
                            window.location.href = "{{ route('editPassword') }}";
                        });
                    }
                    if(response == 3){
                        Swal.fire('Error', 'Your account is inactive. Please contact the administrator.', 'error').then(() => {
                            location.reload();
                        });
                    }
                } else {
                    Swal.fire('Error', 'Invalid username or password. Please try again.', 'error').then(() => {
                        location.reload();
                    });
                }
            },
            error: function() {
                Swal.fire('Error', 'Invalid username or password. Please try again.', 'error');
            }
        });
    });


});

function  statusSwitch(data,id) {
		var selectedStatus = data ? 1:0;
		$.ajax({
			url: '{{ route("subscription.statusUpdate") }}',
			type: 'POST',
			data: {
				id: id,
				status: selectedStatus,
				_token: '{{ csrf_token() }}'
			},
			success: function(response) {
				Swal.fire({
				icon: 'success',
				title: 'Success!',
				text: response.message,
				timer: 2000,
				showConfirmButton: false
				}).then(function() {
				location.reload();
				});
			},
			error: function(xhr) {
				Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Something went wrong!',
				});
			}
		});
	}

function changeStatus(data,id, url = '') {
        var selectedStatus = data ? 1:0;
        if(url) {
            var updateUrl = url;
        $.ajax({
            url: updateUrl,
            type: 'POST',
            data: {
                id: customer_id,
                status: new_status,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: response.message,
                timer: 2000,
                showConfirmButton: false
                }).then(function() {
                location.reload();
                });
            },
            error: function(xhr) {
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                });
            }
        });
    }
    }    
 ////////////////////////////// To change the  status Begin ////////////////

            $(document).ready(function () {
                $(document).on('change', '.changestatus', function () {
                    const checkbox = $(this);
                    const id = checkbox.data('id');
                    const url = checkbox.data('url');
                    const status = checkbox.is(':checked') ? 1 : 0;
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            id: id,
                            status: status,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            Swal.fire(
								'Success!',
								response.message || 'Status updated successfully.',
								'success'
							).then(function() {
								location.reload(); // reload after delete
							});
                            console.log(response.message || 'Status updated successfully');
                        },
                        error: function (xhr) {
                            // Revert checkbox state if error occurs
                            Swal.fire(
								'Error!',
								'Something went wrong.',
								'error'
							);
                        }
                    });
                });
            });

          ////////////////////////////// To change the  status End////////////////
			
            $(document).on('click', '.updatepassword', function(e) {
                e.preventDefault(); // Prevent form submission 
                const form = $(this).closest('form'); // ✅ Get the parent form
                const actionUrl = form.attr('action'); // ✅ Now this will not be undefined 
                let passwordlength          = $(".passwordlength").val().trim();
                let current_password        = $("#current_password").val().trim();
                let password                = $("#password").val().trim();
                let confirmPassword         = $("#password_confirmation").val().trim();
                let isValid = true;
                $(".error_password, .error_password_confirmation, .error_current_password").text(""); 
                if (current_password === "") {
                    $(".error_current_password").text("Current Password is required.");
                    isValid = false;
                }
                if (password === "") {
                    $(".error_password").text("Password is required.");
                    isValid = false;
                }
                else if (password.length < passwordlength) {
                    $(".error_password").text("Password must be at least "+ passwordlength +" characters.");
                    isValid = false;
                }

                if (confirmPassword === "") {
                $(".error_password_confirmation").text("Confirm Password is required.");
                isValid = false;
                }
                if (password !== "" && confirmPassword !== "" && password !== confirmPassword) {
                $(".error_password_confirmation").text("Passwords do not match.");
                isValid = false;
                }
                if (isValid) {
                    $.ajax({
                            url: actionUrl,
                            type: 'POST',
                            data: {
                                passwordlength: passwordlength,
                                current_password: current_password,
                                password: password,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: response.iserror ? 'error' : 'success',
                                    title: response.iserror ? 'Error' : 'Success',
                                    text: response.message
                                }).then(() => {
                                    if (!response.iserror && response.redirect) {
                                        window.location.href = response.redirect; // Redirect to login page
                                }
                                });
                            },
                            error: function(xhr) {
                                let errorMessage = 'Something went wrong';

                                if (xhr.responseJSON) {
                                    if (xhr.responseJSON.errors) {
                                        // Join multiple validation messages
                                        errorMessage = Object.values(xhr.responseJSON.errors).flat().join('\n');
                                    } else if (xhr.responseJSON.message) {
                                        errorMessage = xhr.responseJSON.message;
                                    }
                                }

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validation Error',
                                    text: errorMessage
                                });
                            }
                        });
                    }

            });
			<!--------------------------------------------- account Change Password Start----------------------------->
			
				$(document).on('click', '.saveaccountpassword', function(e) {
                    e.preventDefault(); // Prevent form submission
                    let changepassworduserid    = $("#changepassworduserid").val().trim();
                    let password                = $("#password").val().trim();
                    let confirmPassword         = $("#password_confirmation").val().trim();
                    let isValid = true;

                    $(".error_password, .error_confirm_password").text(""); // Clear previous errors

                    if (password === "") {
                        $(".error_password").text("Password is required.");
                        isValid = false;
                    }
                    else if (password.length < 6) {
                        $(".error_password").text("Password must be at least 6 characters.");
                        isValid = false;
                    }

                    if (confirmPassword === "") {
                    $(".error_password_confirmation").text("Confirm Password is required.");
                    isValid = false;
                    }

                    if (password !== "" && confirmPassword !== "" && password !== confirmPassword) {
                    $(".error_password_confirmation").text("Passwords do not match.");
                    isValid = false;
                    }

                    if (isValid) {
                        $('#exampleModal').modal('hide');
                    $.ajax({
                        url: "{{ route('user.updatepassword') }}",
                        type: 'POST',
                        data: {
                            staff_id: changepassworduserid,
                            password: password,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
								'Success!',
								response.message || 'Record has been deleted.',
								'success'
							);
                        },
                        error: function(xhr) {
                            Swal.fire(
								'Error!',
								'Something went wrong.',
								'error'
							);
                        }
                    });

                    }
            });
			
			
			
			<!--------------------------------------------- Account Change Password End----------------------------->
			
			$(document).on('click', '.accountsubscriptionpaymentdetails', function(e) {
					let accountSubscriptionId = $(this).attr('data-subscriptionid');
					 $('#getsubscriptionpricemodalpopup').modal('show');
					 $.ajax({
                        url: "{{ route('accountsubscriptionpaymentdetails') }}",
                        type: 'POST',
                        data: {
                            accountSubscriptionId: accountSubscriptionId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
							$('.showsubscriptionpriceinmodalpopup').html(response.html);
                        },
                        error: function(xhr) {
                            Swal.fire(
								'Error!',
								'Something went wrong.',
								'error'
							);
                        }
                    });
					// $('.showsubscriptionpriceinmodalpopup').html('showsubscriptionpriceinmodalpopup');
					

            });
			
			<!--------------------------------------------- Get Subscription price Start getsubscriptionprice----------------------------->
			
			$(document).on('change', '.getsubscriptionprice', function(e) {
					$('.posandtransferamount').val(0);
					$('.calculatepayableamount').val(0);
					 $('.errormsgonexceedpaymen').html('');
                    let subscriptionid    = $(".subscription_id").val().trim();
                    $.ajax({
                        url: "{{ route('getsubscriptionprice') }}",
                        type: 'POST',
                        data: {
                            subscriptionid: subscriptionid,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
							$('.subscrptionprice').val(response.price);
							$('#mainsubscrptionprice').val(response.price);
							$('.mainamountpayable').html(response.price)
							$('.amountpayable').html(response.price)
							$('.posandtransferamount').val(0);
							$('.calculatepayableamount').val(0);
                        },
                        error: function(xhr) {
                            Swal.fire(
								'Error!',
								'Something went wrong.',
								'error'
							);
                        }
                    });

            });
			
			<!--------------------------------------------- Get Subscription price End----------------------------->

            $(document).on('click', '.deleteData', function() {
					var deleteId = $(this).data('deleteid');
					var routeUrl = $(this).data('routeurl');
					Swal.fire({
					title: 'Are you sure?',
					text: "You won't be able to revert this!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, delete it!'
					}).then((result) => {
					if (result.isConfirmed) {
					// if confirmed, do AJAX delete
					$.ajax({
						url: routeUrl,
						type: 'POST',
						data: {
							id: deleteId,
							_token: '{{ csrf_token() }}' // CSRF token required
						},
						success: function(response) {
							Swal.fire(
								'Deleted!',
								response.message || 'Record has been deleted.',
								'success'
							).then(function() {
								location.reload(); // reload after delete
							});
						},
						error: function(xhr) {
							Swal.fire(
								'Error!',
								'Something went wrong.',
								'error'
							);
						}
					});
					}
					});
			});	
            

 $(document).ready(function() {
            $('#newprice').val('');
            $(".updateprice").on("click", function() {
                $('#newprice').val('');
                var productid = $(this).attr("data-id");
                var oldprice = $(this).attr("data-oldprice");
                var fieldtobeupdate = $(this).attr("data-fieldtobeupdate");
                $('#fieldtobeupdate').val(fieldtobeupdate);
                $('.oldprice').val(oldprice);
                $('#productid').val(productid);
                $('#updatevippriceModal').modal('show');
            });
            $(".updatenewprice").on('click', function(e) {
                var newprice = $('#newprice').val();
                var productid = $('#productid').val();
                var fieldtobeupdate = $('#fieldtobeupdate').val();
                if (newprice != '') {
                    $.ajax({
                        url: "{{ route('updateproductprice') }}",
                        type: 'POST',
                        data: {
                            id: productid,
                            price: newprice,
                            fieldname: fieldtobeupdate,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#updatevippriceModal').modal('hide');
                            Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                            }).then(function() {
                            location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                            });
                        }
                    });
                }
            });
        });

        $('.update_order_status').on('click', function() {
            var orderid         = $(this).data('orderid');
            var orderstatus     = $(this).data('orderstatus');
            var customerid      = $(this).data('customerid');
            var currentlocation = $(this).data('currentlocation');

            // Set hidden fields & order status
            $('#order_status_order_id').val(orderid);
            $('#order_customer_id').val(customerid);
            $('#delivery_location').val(currentlocation);
            $('#orderstatushidden').val(orderstatus);
            $('#orderstatus').val(orderstatus).trigger('change');

            // Show modal
            $('#updateorderstatus').modal('show');

            // Populate staff dropdown via AJAX
            $.ajax({
                url: "{{ route('staff.ajax.stafflist') }}",
                type: 'GET',
                success: function(data) {
                    var $staffSelect = $('#delivery_staff_id');
                    $staffSelect.empty().append('<option value="">Select Staff</option>');
                    $.each(data, function(id, name) {
                        $staffSelect.append('<option value="'+id+'">'+name+'</option>');
                    });
                },
                error: function(err) {
                    console.error('Error fetching staff list:', err);
                }
            });
        });

        $('.order_comments').on('click', function() {
            var orderid = $(this).attr('data-orderid');
            var ordercomment = $(this).attr('data-comment');
            $('#comment_order_id').val(orderid);
            $('#order_comment').val(ordercomment);
            $('#ordercomment').modal('show');
        });
         $('.order_status_not_confirmed').on('click', function() {
                var delivered = $(this).attr('data-delivered'); // e.g., "Deliver To : John | Notes : Fragile | Delivered Date : 10/04/2025"
                var deliverypending = $(this).attr('data-deliverypending'); // e.g., "Delivery Option : Takeaway | Delivery Location : ..."

                // Split and trim
                var deliveredParts = delivered.split('|').map(function(item) { return item.trim(); });
                var deliveryParts = deliverypending.split('|').map(function(item) { return item.trim(); });

                // Check if deliver_to is blank
                var deliverToPart = deliveredParts.find(function(item) {
                return item.toLowerCase().startsWith('deliver to');
                });

                var combined = '';

                // If deliver_to exists and is not empty
                if (deliverToPart && deliverToPart.split(':')[1].trim() !== '') {
                // Combine deliveryParts first, then deliveredParts
                combined = deliveryParts.concat(deliveredParts).join('\n');
                } else {
                // If deliver_to is blank, show only deliveryParts
                combined = deliveryParts.join('\n');
                }
                // Assign to textarea/input
                $('#delivery_instruction').val(combined);
                $('#order_status_not_confirmed_popup').modal('show');
        });
     
        $('.update_payment_status').on('click', function() {
            var orderid = $(this).attr('data-orderid');
            var paymentStatus = $(this).attr('data-paymentstatus');
            $('#payment_status_order_id').val(orderid);
            $('#payment_status_update').val(paymentStatus).trigger('change');
            $('#updatepaymentstatus').modal('show');
        }); 
        
         $('.update_order_status_to_delivered').on('click', function() {
            var combined = '';
            var orderstatus             = $(this).data('orderstatus');
            var orderdeliveryid         = $(this).data('orderdeliveryid');
            var note                    = $(this).data('currentlocation');
            var deliveryorderid         = $(this).data('orderid'); 
            var deliverypending = $(this).attr('data-deliverypending'); 
            var deliveryParts = deliverypending.split('|').map(function(item) { return item.trim(); });
            combined = deliveryParts.join('\n');   
            $('#delivery_instruction_pending').val(combined);       
            orderstatus = 'delivered';
            $('#deliverorderstatus').val(orderstatus).trigger('change');
            // Set hidden fields & order status
            $('#orderdeliveryid').val(orderdeliveryid);
            $('#deliveryorderid').val(deliveryorderid);
            $('#update_order_status_to_delivered_popup').modal('show');
        });  

        
    
      
    
    $(document).ready(function() {
            $(".saveordercomment").off('click').on('click', function(e) {
                e.preventDefault();
                $(this).attr("disabled", true); // Only disable the clicked button
                var order_id = $('#comment_order_id').val();
                var comment = $('#order_comment').val().trim(); // trim immediately

                if (order_id && comment) { // cleaner check
                    $.ajax({
                        url: "{{ route('order.comments.store') }}",
                        type: 'POST',
                        data: {
                            orderid: order_id,
                            comment: comment,
                            field:'comment',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#ordercomment').modal('hide');
                            Swal.fire('Success', response.message, 'success').then(() => {
                            location.reload();
                            });
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText); // better to use console.error
                        },
                        complete: function() {
                            $(".saveordercomment").attr("disabled", false); // re-enable button after request
                        }
                    });
                } else {
                    $('#ordercomment').modal('hide');
                    $(this).attr("disabled", false);
                }
            });
            ///////////////////////////// Update payment status \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
            $(".updateorderpaymentstatus").off('click').on('click', function(e) {
                e.preventDefault();
                $(this).attr("disabled", true); // Only disable the clicked button
                var order_id = $('#payment_status_order_id').val();
                var payment_status_update = $('#payment_status_update').val().trim(); // trim immediately

                if (order_id && payment_status_update) { // cleaner check
                    $.ajax({
                        url: "{{ route('order.comments.store') }}",
                        type: 'POST',
                        data: {
                            orderid: order_id,
                            comment: payment_status_update,
                            field:'payment_status',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#updatepaymentstatus').modal('hide');
                            Swal.fire('Success', response.message, 'success').then(() => {
                            location.reload();
                            });
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText); // better to use console.error
                        },
                        complete: function() {
                            $(".updatepaymentstatus").attr("disabled", false); // re-enable button after request
                        }
                    });
                } else {
                    $('#updatepaymentstatus').modal('hide');
                    $(this).attr("disabled", false);
                }
            });
            ////////////////////////////  update order delivery location ///////////////////////////////
             $(".updateorderdeliverystatus").off('click').on('click', function(e) {
                e.preventDefault();
                $(this).attr("disabled", true); // Only disable the clicked button
                var order_id            = $('#order_status_order_id').val();
                var customer_id         = $('#order_customer_id').val();
                var delivery_option     = $('#delivery_option').val();
                var delivery_date       = $('#delivery_date').val();
                var delivery_staff_id   = $('#delivery_staff_id').val();
                var orderstatushidden   = $('#orderstatushidden').val();
                var delivery_location  = $('#delivery_location').val().trim(); // trim immediately

                const isStaffValid = validateField('#delivery_staff_id');
                const isOptionValid = validateField('#delivery_option');

                if (!isStaffValid || !isOptionValid) {
                    $(this).attr("disabled", false); // re-enable the button
                    return false;
                }
                var formData = { order_id, customer_id, delivery_option, delivery_date, delivery_staff_id, delivery_location,orderstatushidden };              

                if (order_id) { // cleaner check
                    $.ajax({
                        url: "{{ route('order.comments.store') }}",
                        type: 'POST',
                        data: {
                            orderid: order_id,
                            comment: orderstatushidden,
                            field:'status',
                            extradata : formData,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#updateorderstatus').modal('hide');
                            Swal.fire('Success', response.message, 'success').then(() => {
                            location.reload();
                            });
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText); // better to use console.error
                        },
                        complete: function() {
                            $(".updateorderstatus").attr("disabled", false); // re-enable button after request
                        }
                    });
                } else {
                    $('#updateorderstatus').modal('hide');
                    $(this).attr("disabled", false);
                }
             });
             ////////////////////////////  update order delivery status  ///////////////////////////////
             $(".updateorderstatusdelivery").off('click').on('click', function(e) {
                e.preventDefault();
                var isValid = true;
                //$(this).attr("disabled", true); // Only disable the clicked button
                var orderdeliveryid                 = $('#orderdeliveryid').val();
                var order_id                        = $('#deliveryorderid').val();                
                var deliverorderstatus              = $('#deliverorderstatus').val();
                var deliver_to                      = $('#deliver_to').val();
                var delivered_date                  = $('#delivered_date').val();
                var note                            = $('#note').val().trim(); // trim immediately
                // var delivery_date       = $('#delivery_date').val();
                if (!validateField('#deliverorderstatus')) isValid = false;
                if (!validateField('#deliver_to')) isValid = false;

                if (!isValid) {
                    $(this).prop("disabled", false);
                    return false;
                }
                var formData = { orderdeliveryid, deliverorderstatus, deliver_to, note,delivered_date };              

                if (orderdeliveryid && order_id) { // cleaner check
                    $.ajax({
                        url: "{{ route('order.comments.store') }}",
                        type: 'POST',
                        data: {
                            orderid: order_id,
                            comment: deliverorderstatus,
                            field:'status',
                            deliverextradata : formData,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#update_order_status_to_delivered_popup').modal('hide');
                            Swal.fire('Success', response.message, 'success').then(() => {
                            location.reload();
                            });
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText); // better to use console.error
                        },
                        complete: function() {
                            $(".update_order_status_to_delivered_popup").attr("disabled", false); // re-enable button after request
                        }
                    });
                } else {
                    $('#update_order_status_to_delivered_popup').modal('hide');
                    $(this).attr("disabled", false);
                }
             });

            function validateField(selector) {
                    if (!$(selector).val().trim()) {
                    $(selector).addClass('is-invalid');
                    $(selector + '_error').removeClass('d-none');
                    return false;
                    } else {
                    $(selector).removeClass('is-invalid');
                    $(selector + '_error').addClass('d-none');
                    return true;
                    }
            }
    });
</script>
