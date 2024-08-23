@extends('dashboard.welcome')
@section('content')
    <div class="section-content-right">
        <div class="main-content">
            <div class="main-content-inner">
                <div class="main-content-wrap">
                    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                        <h3>MultiStep Form</h3>
                        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                            <li><a href="/">
                                    <div class="text-tiny">Dashboard</div>
                                </a></li>
                            <li><i class="icon-chevron-right"></i></li>
                            <li><a href="#">
                                    <div class="text-tiny">MultiStep Form</div>
                                </a></li>
                            <li><i class="icon-chevron-right"></i></li>
                            <li>
                                <div class="text-tiny">MultiStep Form</div>
                            </li>
                        </ul>
                    </div>
                    <form class="form-add-new-user form-style-2" id="multiStepForm" name="multiStepForm" method="POST"
                        enctype="multipart/form-data" action="{{ route('employee.store') }}">
                        @csrf
                        @if (!empty($users['id']))
                            @method('PUT')
                        @endif

                        <!-- Step 1: Basic Information -->
                        <div class="form-step form-step-active">
                            <div class="wg-box" style="width:1500px">
                                <div class="right flex-grow">
                                    {{-- <h4>Employee Details</h4> --}}
                                    <div style="display: flex; justify-content: center; align-items: center; text-align: center;">
                                        <h4 style="margin: 0;">Employee Details</h4>
                                    </div>
                                    <fieldset class="name mb-24">
                                        <div class="body-title mb-10">FullName</div>
                                        <input class="flex-grow" type="text" placeholder="Full Name"
                                            @if (isset($users['name'])) value="{{ $users['name'] }}" 
                                                    @else value="{{ old('name') }}" @endif
                                            name="full_name" tabindex="0" aria-required="true" style="margin-bottom: 6px">
                                        <span style="display:none;color:red;font-size: 140%;" id='full_name'></span>
                                    </fieldset>
                                    <fieldset class="email mb-24">
                                        <div class="body-title mb-10" style="margin-top: 22px">Email Address</div>
                                        <input class="flex-grow" type="email" placeholder="Email"
                                            @if (isset($users['email'])) value="{{ $users['email'] }}" 
                                                    @else value="{{ old('email') }}" @endif
                                            name="email_address" tabindex="0" aria-required="true"
                                            style="margin-bottom: 6px">
                                        <span style="display:none;color:red;font-size: 140%;" id='email_address'></span>
                                    </fieldset>
                                    <fieldset class="phone mb-24">
                                        <div class="body-title mb-10">Phone Number</div>
                                        <input class="flex-grow" type="text" placeholder="03*********"
                                            @if (isset($users['phone_number'])) value="{{ $users['phone_number'] }}" 
                                                    @else value="{{ old('phone_number') }}" @endif
                                            name="phone_number" tabindex="0" aria-required="true"
                                            style="margin-bottom: 6px">
                                        <span style="display:none;color:red;font-size: 140%;" id='phone_number'></span>
                                    </fieldset>
                                    <fieldset class="dob mb-24">
                                        <div class="body-title mb-10" style="margin-top: 22px">Date of Birth</div>
                                        <input class="flex-grow" type="date" name="date_of_birth"
                                            @if (isset($users['dob'])) value="{{ $users['dob'] }}" 
                                               @else value="{{ old('dob') }}" @endif
                                            tabindex="0" aria-required="true" style="margin-bottom: 6px">
                                        <span style="display:none;color:red;font-size: 140%;" id='date_of_birth'></span>
                                    </fieldset>
                                    <fieldset class="gender mb-24">
                                        <div class="body-title mb-10" style="margin-top: 22px">Gender</div>
                                        <select class="flex-grow" name="gender" tabindex="0" aria-required="true"
                                            style="margin-bottom: 6px">
                                            <option value="">Select Gender</option>
                                            <option value="male" @if (isset($users['gender']) && $users['gender'] == 'male') selected @endif>Male
                                            </option>
                                            <option value="female" @if (isset($users['gender']) && $users['gender'] == 'female') selected @endif>Female
                                            </option>
                                            <option value="other" @if (isset($users['gender']) && $users['gender'] == 'other') selected @endif>Other
                                            </option>
                                        </select>
                                        <span style="display:none;color:red;font-size: 140%;" id='gender'></span>
                                    </fieldset>
                                    <fieldset class="address mb-24">
                                        <div class="body-title mb-10" style="margin-top: 22px">Address</div>
                                        <textarea class="flex-grow" name="address" tabindex="0" aria-required="true" style="margin-bottom: 6px"
                                            rows="3">{{ isset($users['address']) ? $users['address'] : old('address') }}</textarea>
                                        <span style="display:none;color:red;font-size: 140%;" id='address'></span>
                                    </fieldset>
                                    <div class="form-navigation">
                                        <button type="button" class="next-btn btn-primary"
                                            style="width:200px;">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Additional Information -->
                        <div class="form-step">
                            <div class="wg-box" style="width:1500px">
                                <div class="right flex-grow">
                                    {{-- <h4>User Details</h4> --}}
                                    <div style="display: flex; justify-content: center; align-items: center; text-align: center;">
                                        <h4 style="margin: 0;">User Details</h4>
                                    </div>
                                    <fieldset class="username mb-24">
                                        <div class="body-title mb-10" style="margin-top: 22px">Username</div>
                                        <input class="flex-grow" type="text" name="username"
                                            placeholder="Enter Username"
                                            @if (isset($users['username'])) value="{{ $users['username'] }}" 
                                               @else value="{{ old('username') }}" @endif
                                            tabindex="0" aria-required="true" style="margin-bottom: 6px">
                                        <span style="display:none;color:red;font-size: 140%;" id='username'></span>
                                    </fieldset>
                                    <fieldset class="password mb-24">
                                        <div class="body-title mb-10">Password</div>
                                        <input class="password-input" type="password" value="{{ old('password') }}"
                                            placeholder="Enter password" name="password" tabindex="0"
                                            aria-required="true" style="margin-bottom: 6px">
                                        <span class="show-pass">
                                            <i class="icon-eye view"></i>
                                            <i class="icon-eye-off hide"></i>
                                        </span>
                                        <span style="display:none;color:red;font-size: 140%;" id='password'></span>
                                    </fieldset>
                                    {{-- <div class="form-navigation">
                                        <button type="button" class="prev-btn btn-primary" style="width:200px;">Previous</button>
                                        <button type="submit" class="submit-btn btn-primary" style="width:200px;">Save</button>
                                    </div> --}}
                                    <div class="form-navigation">
                                        <button type="button" class="prev-btn btn-primary"
                                            style="width:200px;">Previous</button>
                                        <button type="button" class="next-btn btn-primary"
                                            style="width:200px;">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-step">
                            <div class="wg-box" style="width:1500px">
                                <div class="right flex-grow">
                                    {{-- <h4>Credit Card Details</h4> --}}
                                    <div style="display: flex; justify-content: center; align-items: center; text-align: center;">
                                        <h4 style="margin: 0;">Credit Card Details</h4>
                                    </div>
                                    <fieldset class="cardholder-name mb-24">
                                        <div class="body-title mb-10">Cardholder Name</div>
                                        <input class="flex-grow" type="text" placeholder="Cardholder Name"
                                            name="card_holder_name" value="{{ old('cardholder_name') }}"
                                            aria-required="true">
                                        <span style="display:none;color:red;font-size: 140%;"
                                            id='card_holder_name'></span>

                                    </fieldset>
                                    <fieldset class="card-number mb-24">
                                        <div class="body-title mb-10">Credit/Debit Card Number</div>
                                        <input class="flex-grow" type="text" placeholder="Card Number"
                                            name="credit_debit_card_number" value="{{ old('card_number') }}"
                                            aria-required="true">
                                        <span style="display:none;color:red;font-size: 140%;"
                                            id='credit_debit_card_number'></span>

                                    </fieldset>
                                    <fieldset class="expiration-date mb-24">
                                        <div class="body-title mb-10">Expiration Date</div>
                                        <input class="flex-grow" type="date" name="expiration_date"
                                            value="{{ old('expiration_date') }}" aria-required="true">
                                        <span style="display:none;color:red;font-size: 140%;" id='expiration_date'></span>

                                    </fieldset>
                                    <fieldset class="cvv mb-24">
                                        <div class="body-title mb-10">CVV</div>
                                        <input class="flex-grow" type="text" placeholder="CVV" name="cvv"
                                            value="{{ old('cvv') }}" aria-required="true">
                                        <span style="display:none;color:red;font-size: 140%;" id='cvv'></span>

                                    </fieldset>
                                    <fieldset class="billing-address mb-24">
                                        <div class="body-title mb-10">Billing Address</div>
                                        <textarea class="flex-grow" name="billing_address" aria-required="true" rows="3">{{ old('billing_address') }}</textarea>
                                        <span style="display:none;color:red;font-size: 140%;" id='billing_address'></span>
                                    </fieldset>
                                    <div class="form-navigation">
                                        {{-- <button type="button" class="prev-btn">Previous</button> --}}
                                        <button type="button" class="prev-btn btn-primary"
                                            style="width:200px;">Previous</button>
                                        {{-- <button type="submit" class="submit-btn">Save</button> --}}
                                        <button type="submit" class="submit-btn btn-primary" style="width:200px;"
                                            id="saveBtnn">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var $formSteps = $('.form-step');
            var $nextBtn = $('.next-btn');
            var $prevBtn = $('.prev-btn');
            var $submitBtn = $('.submit-btn');
            var currentStep = 0;
            // console.log($formSteps,$nextBtn,$prevBtn,$currentStep);
            function showStep(step) {
                // console.log($formSteps,$nextBtn,$prevBtn,$currentStep,step);
                $formSteps.hide();
                $formSteps.eq(step).show();
                $nextBtn.toggle(step < $formSteps.length - 1);
                $prevBtn.toggle(step > 0);
                $submitBtn.toggle(step === $formSteps.length - 1);
            }

            function saveStepData(step) {
                var $form = $('#multiStepForm');
                var formData = $form.serialize(); // Serialize form data
                var additionalData = $.param({
                    step_id: step
                });
                formData = formData + '&' + additionalData;
                $.ajax({
                    url: $form.attr('action'), // URL from the form's action attribute
                    method: 'POST', // Use POST method
                    data: formData,
                    success: function(response) {
                        // Handle success response
                        console.log('here');
                        console.log('Data saved successfully', response.data.status);
                        if (response.success) {
                            currentStep++;
                            if (response.data.status != "done") {
                                showStep(currentStep);
                            }
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "10000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            };
                            toastr.success('Data saved successfully');
                        }
                    },
                    error: function(response) {
                        // Handle error response
                        // console.error('An error occurred:', error);
                        // response.responseJSON.errors.date
                        console.log(response.responseJSON.errors);
                        if (response.responseJSON.errors.full_name) {
                            $("#full_name").css("display", "block");
                            $("#full_name").text(
                                response.responseJSON.errors.full_name
                            );
                        } else {
                            $("#full_name").css("display", "none");
                        }
                        if (response.responseJSON.errors.email_address) {
                            $("#email_address").css("display", "block");
                            $("#email_address").text(
                                response.responseJSON.errors.email_address
                            );
                        } else {
                            $("#email_address").css("display", "none");
                        }
                        if (response.responseJSON.errors.phone_number) {
                            $("#phone_number").css("display", "block");
                            $("#phone_number").text(
                                response.responseJSON.errors.phone_number
                            );
                        } else {
                            $("#phone_number").css("display", "none");
                        }
                        if (response.responseJSON.errors.date_of_birth) {
                            $("#date_of_birth").css("display", "block");
                            $("#date_of_birth").text(
                                response.responseJSON.errors.date_of_birth
                            );
                        } else {
                            $("#date_of_birth").css("display", "none");
                        }
                        if (response.responseJSON.errors.gender) {
                            $("#gender").css("display", "block");
                            $("#gender").text(
                                response.responseJSON.errors.gender
                            );
                        } else {
                            $("#gender").css("display", "none");
                        }
                        if (response.responseJSON.errors.address) {
                            $("#address").css("display", "block");
                            $("#address").text(
                                response.responseJSON.errors.address
                            );
                        } else {
                            $("#address").css("display", "none");
                        }
                        if (response.responseJSON.errors.username) {
                            $("#username").css("display", "block");
                            $("#username").text(
                                response.responseJSON.errors.username
                            );
                        } else {
                            $("#username").css("display", "none");
                        }
                        if (response.responseJSON.errors.password) {
                            $("#password").css("display", "block");
                            $("#password").text(
                                response.responseJSON.errors.password
                            );
                        } else {
                            $("#password").css("display", "none");
                        }
                        if (response.responseJSON.errors.card_holder_name) {
                            $("#card_holder_name").css("display", "block");
                            $("#card_holder_name").text(
                                response.responseJSON.errors.card_holder_name
                            );
                        } else {
                            $("#card_holder_name").css("display", "none");
                        }
                        if (response.responseJSON.errors.billing_address) {
                            $("#billing_address").css("display", "block");
                            $("#billing_address").text(
                                response.responseJSON.errors.billing_address
                            );
                        } else {
                            $("#billing_address").css("display", "none");
                        }
                        if (response.responseJSON.errors.credit_debit_card_number) {
                            $("#credit_debit_card_number").css("display", "block");
                            $("#credit_debit_card_number").text(
                                response.responseJSON.errors.credit_debit_card_number
                            );
                        } else {
                            $("#credit_debit_card_number").css("display", "none");
                        }
                        if (response.responseJSON.errors.cvv) {
                            $("#cvv").css("display", "block");
                            $("#cvv").text(
                                response.responseJSON.errors.cvv
                            );
                        } else {
                            $("#cvv").css("display", "none");
                        }
                        if (response.responseJSON.errors.expiration_date) {
                            $("#expiration_date").css("display", "block");
                            $("#expiration_date").text(
                                response.responseJSON.errors.expiration_date
                            );
                        } else {
                            $("#expiration_date").css("display", "none");
                        }
                    }
                });
            }

            $nextBtn.click(function() {
                // console.log($formSteps,$currentStep);
                if (currentStep < $formSteps.length - 1) {
                    saveStepData(currentStep);
                    // currentStep++;
                    // showStep(currentStep);
                }
            });

            $prevBtn.click(function() {
                // console.log($formSteps,$currentStep);
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });
            $submitBtn.click(function(e) {
                e.preventDefault(); // Prevent the default form submission
                saveStepData(currentStep); // Call the save function for the last step
            });
            showStep(currentStep); // Show the first step initially
        });
    </script>
@endsection
