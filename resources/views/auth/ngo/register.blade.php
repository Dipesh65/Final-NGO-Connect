@extends('layouts.guest')

@section('content')

    <div class="bg-gray-50 min-h-screen flex items-center justify-center px-4 relative overflow-hidden">

        <!-- Background shapes -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-red-100 rounded-full opacity-20"></div>
            <div class="absolute -bottom-32 -left-32 w-64 h-64 bg-red-50 rounded-full opacity-30"></div>
            <div class="absolute top-1/4 -left-20 w-40 h-40 bg-red-200 rounded-full opacity-15"></div>
        </div>

        <div class="bg-white shadow-xl rounded-2xl w-full max-w-5xl overflow-hidden relative z-10">

            <div class="bg-white px-12 py-6 text-center border-b border-gray-100 relative">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">NGO Registration</h1>
                <p class="text-gray-600 text-lg">Register your organization and make a difference</p>

                <!-- Progress Indicator -->
                <div class="flex justify-center mt-6">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <div id="step1-indicator"
                                class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center text-sm font-medium">
                                1</div>
                            <span id="step1-text" class="ml-2 text-sm font-medium text-red-500">Basic Details</span>
                        </div>
                        <div class="w-12 h-0.5 bg-gray-300" id="progress1"></div>
                        <div class="flex items-center">
                            <div id="step2-indicator"
                                class="w-8 h-8 bg-gray-300 text-gray-500 rounded-full flex items-center justify-center text-sm font-medium">
                                2</div>
                            <span id="step2-text" class="ml-2 text-sm font-medium text-gray-500">Legal Details</span>
                        </div>
                        <div class="w-12 h-0.5 bg-gray-300" id="progress2"></div>
                        <div class="flex items-center">
                            <div id="step3-indicator"
                                class="w-8 h-8 bg-gray-300 text-gray-500 rounded-full flex items-center justify-center text-sm font-medium">
                                3</div>
                            <span id="step3-text" class="ml-2 text-sm font-medium text-gray-500">Contact Person</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="bg-white px-12 py-10">
                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 p-4 mb-8 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-600 p-4 mb-8 rounded-lg">
                        <ul class="space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.ngo') }}" enctype="multipart/form-data"
                    id="ngoRegistrationForm">
                    @csrf

                    <!-- Step 1: Basic Details -->
                    <div id="step1" class="step-content">
                        <!-- Added required fields note at the top of step 1 -->
                        <div class="bg-blue-50 border border-blue-200 text-blue-700 p-4 mb-6 rounded-lg">
                            <p class="text-sm font-medium">
                                <strong>Note:</strong> Fields marked with * are required. Please fill them.
                            </p>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Basic Details</h2>

                        <div class="space-y-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label for="ngo_name" class="block text-lg font-medium text-gray-700">NGO Name *</label>
                                    <input type="text" name="ngo_name" id="ngo_name" value="{{ old('ngo_name') }}"
                                        class="w-full px-4 py-2 bg-white border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors text-lg"
                                        placeholder="Enter NGO name" required>
                                </div>

                                <div class="space-y-2">
                                    <label for="registration_date"
                                        class="block text-lg font-medium text-gray-700">Registration Date *</label>
                                    <input type="date" name="registration_date" id="registration_date"
                                        value="{{ old('registration_date') }}"
                                        class="w-full px-4 py-2 bg-white border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors text-lg"
                                        required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label for="sector" class="block text-lg font-medium text-gray-700">Sector or Category
                                        *</label>
                                    <input type="text" name="sector" id="sector" value="{{ old('sector') }}"
                                        class="w-full px-4 py-2 bg-white border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors text-lg"
                                        placeholder="e.g., Education, Health, Environment" required>
                                </div>

                                <div class="space-y-2">
                                    <label for="address" class="block text-lg font-medium text-gray-700">Address *</label>
                                    <input tyoe="text" name="address" id="address" value="{{ old('address') }}"
                                        class="w-full px-4 py-2 bg-white border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors text-lg"
                                        placeholder="Enter complete address" required>
                                </div>

                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label for="email" class="block text-lg font-medium text-gray-700">Email Address
                                        *</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        class="w-full px-4 py-2 bg-white border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors text-lg"
                                        placeholder="Enter email address" required>
                                </div>

                                <div class="space-y-2">
                                    <label for="phone" class="block text-lg font-medium text-gray-700">Phone Number
                                        *</label>
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                        class="w-full px-4 py-2 bg-white border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors text-lg"
                                        placeholder="Enter phone number" required>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="mission" class="block text-lg font-medium text-gray-700">Mission</label>
                                <textarea name="mission" id="mission" rows="2"
                                    class="w-full px-4 py-2 bg-white border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors text-lg"
                                    placeholder="Describe your organization's mission (optional)">{{ old('mission') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Legal Details -->
                    <div id="step2" class="step-content hidden">
                        <!-- Added required fields note at the top of step 2 -->
                        <div class="bg-blue-50 border border-blue-200 text-blue-700 p-4 mb-6 rounded-lg">
                            <p class="text-sm font-medium">
                                <strong>Note:</strong> Fields marked with * are required. Please fill them.
                            </p>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Legal Details</h2>

                        <div class="space-y-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label for="registration_number"
                                        class="block text-lg font-medium text-gray-700">Registration Number (DAO) *</label>
                                    <input type="text" name="registration_number" id="registration_number"
                                        value="{{ old('registration_number') }}"
                                        class="w-full px-4 py-2 bg-white border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors text-lg"
                                        placeholder="Enter DAO registration number" required>
                                </div>

                                <div class="space-y-2">
                                    <label for="registration_district"
                                        class="block text-lg font-medium text-gray-700">Registration District (DAO)
                                        *</label>
                                    <input type="text" name="registration_district" id="registration_district"
                                        value="{{ old('registration_district') }}"
                                        class="w-full px-4 py-2 bg-white border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors text-lg"
                                        placeholder="Enter registration district" required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                                <div class="space-y-2">
                                    <label for="last_renewal_date" class="block text-lg font-medium text-gray-700">Last
                                        Renewal Date *</label>
                                    <input type="date" name="last_renewal_date" id="last_renewal_date"
                                        value="{{ old('last_renewal_date') }}"
                                        class="w-full px-4 py-2 bg-white border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors text-lg"
                                        required>
                                </div>

                                <div class="space-y-2">
                                    <label for="pan_number" class="block text-lg font-medium text-gray-700">PAN Number
                                        *</label>
                                    <input type="text" name="pan_number" id="pan_number" value="{{ old('pan_number') }}"
                                        class="w-full px-4 py-2 bg-white border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors text-lg"
                                        placeholder="Enter PAN number" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Contact Person -->
                    <div id="step3" class="step-content hidden">
                        <!-- Added required fields note at the top of step 3 -->
                        <div class="bg-blue-50 border border-blue-200 text-blue-700 p-4 mb-6 rounded-lg">
                            <p class="text-sm font-medium">
                                <strong>Note:</strong> Fields marked with * are required. Please fill them.
                            </p>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Contact Person Details</h2>

                        <div class="space-y-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label for="contact_full_name" class="block text-lg font-medium text-gray-700">Full Name
                                        *</label>
                                    <input type="text" name="contact_full_name" id="contact_full_name"
                                        value="{{ old('contact_full_name') }}"
                                        class="w-full px-4 py-2 bg-white border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors text-lg"
                                        placeholder="Enter contact person's full name" required>
                                </div>

                                <div class="space-y-2">
                                    <label for="contact_position" class="block text-lg font-medium text-gray-700">Position /
                                        Role in NGO *</label>
                                    <input type="text" name="contact_position" id="contact_position"
                                        value="{{ old('contact_position') }}"
                                        class="w-full px-4 py-2 bg-white border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors text-lg"
                                        placeholder="e.g., President, Vice-President, Secretary" required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label for="contact_phone" class="block text-lg font-medium text-gray-700">Phone Number
                                        *</label>
                                    <input type="tel" name="contact_phone" id="contact_phone"
                                        value="{{ old('contact_phone') }}"
                                        class="w-full px-4 py-2 bg-white border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors text-lg"
                                        placeholder="Enter contact phone number" required>
                                </div>

                                <div class="space-y-2">
                                    <label for="contact_email" class="block text-lg font-medium text-gray-700">Email Address
                                        *</label>
                                    <input type="email" name="contact_email" id="contact_email"
                                        value="{{ old('contact_email') }}"
                                        class="w-full px-4 py-2 bg-white border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors text-lg"
                                        placeholder="Enter contact email address" required>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="address" class="block text-lg font-medium text-gray-700">Address *</label>
                                <input tyoe="text" name="address" id="address" value="{{ old('address') }}"
                                    class="w-full px-4 py-2 bg-white border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors text-lg"
                                    placeholder="Enter contact person's address" required>
                            </div>

                            <!-- Declaration & Signature -->
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">Declaration & Signature</h3>
                                <div class="flex items-start space-x-3">
                                    <input type="checkbox" name="declaration" id="declaration"
                                        class="mt-1 w-5 h-5 text-red-500 border-red-500 rounded focus:ring-red-500"
                                        required>
                                    <label for="declaration" class="text-lg text-gray-700">
                                        I hereby certify that all the information provided and documents uploaded are true,
                                        accurate, and complete to the best of my knowledge. I understand that any false
                                        information may result in the rejection of this application or cancellation of
                                        registration.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-10">
                        <button type="button" id="prevBtn"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-3 px-8 rounded-lg transition-colors duration-200 text-lg hidden">
                            Previous
                        </button>

                        <div class="text-center mt-3">
                            <p class="text-gray-600 text-lg" id="signinBtn">
                                Already have an account?
                                <a href="{{ route('login') }}"
                                    class="text-red-500 hover:text-red-600 font-medium transition-colors">
                                    Sign In
                                </a>
                            </p>
                        </div>

                        <div class="ml-auto">
                            <button type="button" id="nextBtn"
                                class="bg-red-500 hover:bg-red-600 text-white font-medium py-3 px-8 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 text-lg">
                                Next
                            </button>

                            <button type="submit" id="submitBtn"
                                class="bg-red-500 hover:bg-red-600 text-white font-medium py-3 px-8 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 text-lg hidden">
                                Submit Registration
                            </button>
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            let currentStep = 1;
            const totalSteps = 3;

            function showStep(step) {
                // Hide all steps
                for (let i = 1; i <= totalSteps; i++) {
                    $(`#step${i}`).addClass('hidden');
                    $(`#step${i}-indicator`).removeClass('bg-red-500 text-white').addClass('bg-gray-300 text-gray-500');
                    $(`#step${i}-text`).removeClass('text-red-500').addClass('text-gray-500');
                }

                // Show current step
                $(`#step${step}`).removeClass('hidden');
                $(`#step${step}-indicator`).removeClass('bg-gray-300 text-gray-500').addClass('bg-red-500 text-white');
                $(`#step${step}-text`).removeClass('text-gray-500').addClass('text-red-500');

                // Update progress bars
                for (let i = 1; i < step; i++) {
                    $(`#progress${i}`).removeClass('bg-gray-300').addClass('bg-red-500');
                }
                for (let i = step; i < totalSteps; i++) {
                    $(`#progress${i}`).removeClass('bg-red-500').addClass('bg-gray-300');
                }

                // Show/hide navigation buttons
                if (step === 1) {
                    $('#prevBtn').addClass('hidden');
                } else {
                    $('#prevBtn').removeClass('hidden');
                }

                if (step === 2 || step === 3) {
                    $('#signinBtn').addClass('hidden');
                } else {
                    $('#signinBtn').removeClass('hidden');
                }

                if (step === totalSteps) {
                    $('#nextBtn').addClass('hidden');
                    $('#submitBtn').removeClass('hidden');
                } else {
                    $('#nextBtn').removeClass('hidden');
                    $('#submitBtn').addClass('hidden');
                }
            }

            function validateStep(step) {
                const stepElement = $(`#step${step}`);
                const requiredFields = stepElement.find('[required]');

                for (let i = 0; i < requiredFields.length; i++) {
                    const field = $(requiredFields[i]);
                    if (!field.val().trim()) {
                        field.focus();
                        alert('Please fill in all required fields before proceeding.');
                        return false;
                    }
                }
                return true;
            }

            $('#nextBtn').on('click', function () {
                if (validateStep(currentStep)) {
                    if (currentStep < totalSteps) {
                        currentStep++;
                        showStep(currentStep);
                    }
                }
            });

            $('#prevBtn').on('click', function () {
                if (currentStep > 1) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            // AJAX form submission
            $('#ngoRegistrationForm').on('submit', function (e) {
                e.preventDefault();

                if (!validateStep(currentStep)) {
                    return;
                }

                const formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('#submitBtn').prop('disabled', true).text('Submitting...');
                    },
                    success: function (response) {
                        alert('NGO registration submitted successfully!');
                        window.location.href = response.redirect || '/';
                    },
                    error: function (xhr) {
                        $('#submitBtn').prop('disabled', false).text('Submit Registration');

                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            let errorMessage = 'Please fix the following errors:\n';

                            $.each(errors, function (field, messages) {
                                errorMessage += '- ' + messages.join(', ') + '\n';
                            });

                            alert(errorMessage);
                        } else {
                            alert('An error occurred while submitting the form. Please try again.');
                        }
                    }
                });
            });

            // Initialize first step
            showStep(1);
        });
    </script>

@endsection