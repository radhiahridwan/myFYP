@extends('layouts.app')

@section('title', 'Vehicle Sticker Application')

@section('content')
    <div class="student-dashboard"
        style="display: flex; min-height: 100vh; font-family: 'Poppins', sans-serif; background: #f8fbff; overflow-x: hidden;">

        <!-- ===== SIDEBAR ===== -->
        <div id="sidebar"
            style=" width: 250px; background: #004AAD; color: white; position: fixed; top: 0; left: -250px; height: 100%; padding: 20px; box-shadow: 4px 0 10px rgba(0,0,0,0.1); transition: left 0.3s ease; z-index: 1000; display: flex; flex-direction: column; justify-content: space-between; overflow-y: auto; ">
            <div>
                <div style="text-align: center; margin-bottom: 25px;">
                    <img src="{{ asset('images/uptm-logo.png') }}" alt="UPTM Logo"
                        style="width: 100%; max-width: 180px; height: auto; display: block; margin: 0 auto 10px;">
                    <h3 style="margin: 0;">Student Panel</h3>
                </div>
                <ul style="list-style: none; padding: 0; line-height: 2;">
                    <li>
                        <a href="/student/dashboard"
                            style="color: white; text-decoration: none; display: flex; align-items: center; gap: 10px; padding: 8px 0;">
                            <img src="{{ asset('images/home-icon.png') }}" alt="Dashboard"
                                style="width: 20px; height: 20px;">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="/student/rules"
                            style="color: white; text-decoration: none; display: flex; align-items: center; gap: 10px; padding: 8px 0;">
                            <img src="{{ asset('images/rule-icon.png') }}" alt="Rules"
                                style="width: 20px; height: 20px;">
                            Rules
                        </a>
                    </li>
                    <li>
                        <a href="/student/wardens"
                            style="color: white; text-decoration: none; display: flex; align-items: center; gap: 10px; padding: 8px 0;">
                            <img src="{{ asset('images/warden-icon.png') }}" alt="Warden List"
                                style="width: 20px; height: 20px;">
                            Warden List
                        </a>
                    </li>
                    <li>
                        <a href="/student/manual"
                            style="color: #ffffff; text-decoration: none; display: flex; align-items: center; gap: 10px; padding: 8px 0; font-weight: bold;">
                            <img src="{{ asset('images/manual-icon.png') }}" alt="User Manual"
                                style="width: 20px; height: 20px;">
                            User Manual
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- ===== MAIN CONTENT ===== -->
        <div id="main-content" style="flex-grow: 1; width: 100%; transition: margin-left 0.3s ease;">

            <!-- ===== NAVBAR ===== -->
            <div
                style="display: flex; justify-content: space-between; align-items: center; background: white; padding: 15px 25px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 999; backdrop-filter: blur(10px);">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <span id="menu-toggle" style="font-size: 26px; cursor: pointer; color: #004AAD;">☰</span>
                    <h2 style="color: #004AAD; margin: 0;">Vehicle Sticker Application</h2>
                </div>

                <!-- Profile Dropdown -->
                <div style="position: relative;">
                    <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/student-avatar.png') }}"
                        alt="Student" id="profile-toggle"
                        style="width: 45px; height: 45px; border-radius: 50%; cursor: pointer; border: 2px solid #004AAD;">
                    <div id="profile-dropdown"
                        style=" display: none; position: absolute; right: 0; top: 55px; background: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 220px; overflow: hidden; ">
                        <div style="padding: 15px; border-bottom: 1px solid #eee;">
                            <strong>{{ Auth::user()->name ?? 'Student' }}</strong><br>
                            <small>{{ Auth::user()->email ?? 'student@uptm.edu.my' }}</small>
                        </div>

                        <a href="/student/profile"
                            style="display: flex; align-items: center; gap: 8px; padding: 10px 15px; color: #004AAD; text-decoration: none;">
                            <img src="{{ asset('images/profile.png') }}" alt="Profile" style="width: 20px; height: 20px;">
                            Edit Profile
                        </a>

                        <a href="/student/settings"
                            style="display: flex; align-items: center; gap: 8px; padding: 10px 15px; color: #004AAD; text-decoration: none;">
                            <img src="{{ asset('images/setting-icon.png') }}" alt="Settings"
                                style="width: 20px; height: 20px;">
                            Setting
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                style="background: none; border: none; width: 100%; text-align: left; padding: 10px 15px; color: red; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                                <img src="{{ asset('images/logout.png') }}" alt="Logout"
                                    style="width: 20px; height: 20px;">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- ===== VEHICLE STICKER FORM CONTENT ===== -->
            <div style="padding: 25px; max-width: 800px; margin: 0 auto;">

                <!-- Back Button -->
                <div style="margin-bottom: 20px;">
                    <a href="{{ route('student.forms') }}"
                        style="background: #6c757d; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-size: 14px;">
                        ← Back to Forms
                    </a>
                </div>

                <!-- Form Header -->
                <div style="margin-bottom: 30px;">
                    <h1 style="color: #004AAD; margin-bottom: 10px;">Vehicle Sticker Application</h1>
                    <p style="color: #666;">Apply for permission to bring your personal vehicle to hostel grounds</p>
                </div>

                <!-- Application Form -->
                <form action="{{ route('forms.vehicle-sticker.store') }}" method="POST" enctype="multipart/form-data"
                    style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    @csrf

                    <!-- Section 1: Applicant Information -->
                    <div style="margin-bottom: 30px;">
                        <h3
                            style="color: #004AAD; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">
                            📋 Applicant Information
                        </h3>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                            <!-- Full Name -->
                            <div>
                                <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Full
                                    Name</label>
                                <input type="text"
                                    value="{{ Auth::user()->student->name ?? (Auth::user()->name ?? 'N/A') }}" readonly
                                    style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; background: #f8f9fa; color: #666;">
                            </div>

                            <!-- Student ID -->
                            <div>
                                <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Student
                                    ID</label>
                                <input type="text" value="{{ Auth::user()->student->student_id ?? 'N/A' }}" readonly
                                    style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; background: #f8f9fa; color: #666;">
                            </div>

                            <!-- Phone Number -->
                            <div>
                                <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Phone
                                    Number</label>
                                <input type="tel" name="phone"
                                    value="{{ Auth::user()->student->phone_number ?? (Auth::user()->phone ?? '') }}"
                                    required
                                    style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px;">
                            </div>

                            <!-- Hostel Room -->
                            <div>
                                <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Room
                                    Number</label>
                                <input type="text" value="{{ Auth::user()->student->hostel_room ?? 'N/A' }}" readonly
                                    style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; background: #f8f9fa; color: #666;">
                            </div>
                        </div>
                    </div>
                    <!-- Section 2: Vehicle Details -->
                    <div style="margin-bottom: 30px;">
                        <h3
                            style="color: #004AAD; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">
                            Vehicle Details
                        </h3>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                            <!-- Vehicle Type -->
                            <div>
                                <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Vehicle
                                    Type *</label>
                                <select name="vehicle_type" required
                                    style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px;">
                                    <option value="">Select Vehicle Type</option>
                                    <option value="car">Car</option>
                                    <option value="motorcycle">Motorcycle</option>

                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <!-- Registration Number -->
                            <div>
                                <label
                                    style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Registration
                                    Number *</label>
                                <input type="text" name="registration_number" placeholder="e.g., ABC1234" required
                                    style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; text-transform: uppercase;">
                                <small style="color: #666; font-size: 12px;">Enter your vehicle plate number</small>
                            </div>

                            <!-- Model & Color -->
                            <div style="grid-column: span 2;">
                                <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Model &
                                    Color *</label>
                                <input type="text" name="model_color" placeholder="e.g., Myvi Red or EX5 Black"
                                    required
                                    style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px;">
                                <small style="color: #666; font-size: 12px;">Describe your vehicle model and color</small>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Document Uploads -->
                    <div style="margin-bottom: 30px;">
                        <h3
                            style="color: #004AAD; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">
                            Required Documents
                        </h3>

                        <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
                            <!-- Driver's License -->
                            <div>
                                <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">
                                    Copy of Driver's License *
                                </label>
                                <input type="file" name="drivers_license" accept=".pdf,.jpg,.jpeg,.png" required
                                    style="width: 100%; padding: 10px 0;">
                                <small style="color: #666; font-size: 12px;">Upload scanned copy of your valid driver's
                                    license (PDF, JPG, PNG)</small>
                            </div>

                            <!-- Vehicle Registration -->
                            <div>
                                <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">
                                    Copy of Vehicle Registration Certificate *
                                </label>
                                <input type="file" name="vehicle_registration" accept=".pdf,.jpg,.jpeg,.png" required
                                    style="width: 100%; padding: 10px 0;">
                                <small style="color: #666; font-size: 12px;">Upload scanned copy of vehicle registration
                                    (Geran)</small>
                            </div>

                            <!-- Insurance -->
                            <div>
                                <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">
                                    Copy of Valid Insurance *
                                </label>
                                <input type="file" name="insurance" accept=".pdf,.jpg,.jpeg,.png" required
                                    style="width: 100%; padding: 10px 0;">
                                <small style="color: #666; font-size: 12px;">Upload scanned copy of valid insurance
                                    document</small>
                            </div>

                            <!-- Additional Documents -->
                            <div>
                                <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">
                                    Additional Supporting Documents (Optional)
                                </label>
                                <input type="file" name="additional_documents[]" accept=".pdf,.jpg,.jpeg,.png"
                                    multiple style="width: 100%; padding: 10px 0;">
                                <small style="color: #666; font-size: 12px;">You can upload multiple files if
                                    needed</small>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Declaration -->
                    <div style="margin-bottom: 30px;">

                        <div
                            style="background: #f8fbff; padding: 20px; border-radius: 8px; border-left: 4px solid #004AAD;">
                            <div style="margin-bottom: 15px;">
                                <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                                    <input type="checkbox" name="declaration_accurate" required style="margin-top: 2px;">
                                    <span style="color: #333;">
                                        I declare that all information provided in this application is true and accurate to
                                        the best of my knowledge.
                                    </span>
                                </label>
                            </div>

                            <div>
                                <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                                    <input type="checkbox" name="declaration_rules" required style="margin-top: 2px;">
                                    <span style="color: #333;">
                                        I agree to abide by the hostel vehicle regulations and parking rules. I understand
                                        that violation may result in revocation of this permit.
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div style="display: flex; gap: 15px; justify-content: flex-end;">
                        <a href="{{ route('student.forms') }}"
                            style="background: #6c757d; color: white; padding: 12px 24px; border: none; border-radius: 6px; text-decoration: none; cursor: pointer; font-size: 14px;">
                            Cancel
                        </a>
                        <button type="submit"
                            style="background: #004AAD; color: white; padding: 12px 24px; border: none; border-radius: 6px; cursor: pointer; font-size: 14px; transition: background 0.3s;">
                            Submit Application
                        </button>
                    </div>
                </form>

                <!-- Important Notes -->
                <div
                    style="background: #fff8e1; padding: 20px; border-radius: 8px; margin-top: 20px; border-left: 4px solid #ffc107;">
                    <h4 style="color: #856404; margin-top: 0; margin-bottom: 10px;">📌 Important Notes:</h4>
                    <ul style="color: #856404; margin: 0; padding-left: 20px;">
                        <li>Application processing may take 3-5 working days</li>
                        <li>Ensure all documents are clear and readable</li>
                        <li>Sticker must be displayed on your vehicle at all times within hostel premises</li>
                    </ul>
                </div>

            </div>

        </div>

    </div>

    <!-- ===== SCRIPT ===== -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const menuToggle = document.getElementById('menu-toggle');
            const profileToggle = document.getElementById('profile-toggle');
            const profileDropdown = document.getElementById('profile-dropdown');

            // Sidebar toggle
            menuToggle.addEventListener('click', () => {
                if (sidebar.style.left === '0px') {
                    sidebar.style.left = '-250px';
                    mainContent.style.marginLeft = '0';
                } else {
                    sidebar.style.left = '0';
                    mainContent.style.marginLeft = '250px';
                }
            });

            // Profile dropdown toggle
            profileToggle.addEventListener('click', () => {
                profileDropdown.style.display =
                    profileDropdown.style.display === 'block' ? 'none' : 'block';
            });

            document.addEventListener('click', (e) => {
                if (!profileToggle.contains(e.target) && !profileDropdown.contains(e.target)) {
                    profileDropdown.style.display = 'none';
                }
            });

            // Form validation enhancement
            const form = document.querySelector('form');
            const submitBtn = form.querySelector('button[type="submit"]');

            form.addEventListener('submit', function(e) {
                const checkboxes = form.querySelectorAll('input[type="checkbox"][required]');
                let allChecked = true;

                checkboxes.forEach(checkbox => {
                    if (!checkbox.checked) {
                        allChecked = false;
                    }
                });

                if (!allChecked) {
                    e.preventDefault();
                    alert('Please agree to all declaration statements before submitting.');
                }
            });
        });

        function markNotificationAsRead(notificationId) {
            fetch(`/notifications/${notificationId}/mark-read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const notificationItem = document.querySelector(
                            `.notification-item[data-id="${notificationId}"]`);
                        if (notificationItem) {
                            notificationItem.style.background = 'white';
                            notificationItem.style.fontWeight = 'normal';
                        }
                    }
                });
        }
    </script>
@endsection
