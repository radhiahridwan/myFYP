@extends('layouts.app')

@section('title', 'User Manual')

@section('content')
    <div class="user-manual"
        style="display: flex; min-height: 100vh; font-family: 'Poppins', sans-serif; background: #f8fbff; overflow-x: hidden;">

        <!-- ===== SIDEBAR ===== -->
        <div id="sidebar"
            style="width: 250px; background: #004AAD; color: white; position: fixed; top: 0; left: -250px; height: 100%; padding: 20px; box-shadow: 4px 0 10px rgba(0,0,0,0.1); transition: left 0.3s ease; z-index: 1000; display: flex; flex-direction: column; justify-content: space-between; overflow-y: auto;">
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
                            style="background: rgba(255, 255, 255, 0.544); color: #004AAD; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">
                            <img src="{{ asset('images/manual-icon.png') }}" alt="User Manual"
                                style="width: 20px; height: 20px;">
                            User Manual
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- ===== MAIN CONTENT ===== -->
        <div id="main-content" style="flex-grow: 1; transition: margin-left 0.3s ease;">

            <!-- ===== NAVBAR ===== -->
            <div
                style="display: flex; justify-content: space-between; align-items: center; background: white; padding: 15px 25px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 999; backdrop-filter: blur(10px);">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <span id="menu-toggle" style="font-size: 26px; cursor: pointer; color: #004AAD;">☰</span>
                    <h2 style="color: #004AAD; margin: 0;">User Manual</h2>
                </div>

                <!-- Profile Dropdown -->
                <div style="position: relative;">
                    <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/student-avatar.png') }}"
                        alt="Student" id="profile-toggle"
                        style="width: 45px; height: 45px; border-radius: 50%; cursor: pointer; border: 2px solid #004AAD;">
                    <div id="profile-dropdown"
                        style="display: none; position: absolute; right: 0; top: 55px; background: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 220px; overflow: hidden;">
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

            <!-- ===== MANUAL CONTENT ===== -->
            <div style="padding: 25px; width: 100%; max-width: 1200px; margin: auto;">

                <!-- Quick Navigation -->
                <div
                    style="background: white; border-radius: 12px; padding: 20px; margin-bottom: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <h3 style="color: #004AAD; margin-top: 0;">Quick Navigation</h3>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                        <button onclick="toggleSection('payments-content')"
                            style="background: #004AAD; color: white; padding: 8px 16px; border-radius: 20px; text-decoration: none; font-size: 14px; border: none; cursor: pointer;">Payments</button>
                        <button onclick="toggleSection('outing-content')"
                            style="background: #004AAD; color: white; padding: 8px 16px; border-radius: 20px; text-decoration: none; font-size: 14px; border: none; cursor: pointer;">Outing
                            Form</button>
                        <button onclick="toggleSection('forms-content')"
                            style="background: #004AAD; color: white; padding: 8px 16px; border-radius: 20px; text-decoration: none; font-size: 14px; border: none; cursor: pointer;">Forms</button>
                        <button onclick="toggleSection('profile-content')"
                            style="background: #004AAD; color: white; padding: 8px 16px; border-radius: 20px; text-decoration: none; font-size: 14px; border: none; cursor: pointer;">Edit
                            Profile</button>
                        <button onclick="toggleSection('settings-content')"
                            style="background: #004AAD; color: white; padding: 8px 16px; border-radius: 20px; text-decoration: none; font-size: 14px; border: none; cursor: pointer;">Setting</button>
                    </div>
                </div>

                <!-- Introduction -->
                <div
                    style="background: white; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <h2 style="color: #004AAD; margin-top: 0;">Welcome to SISWI Management System</h2>
                    <p>This user manual will guide you through all the features available in your student portal. If you
                        need additional assistance, please contact your warden or the system administrator.</p>

                    <div style="background: #e8f4ff; border-left: 4px solid #004AAD; padding: 15px; margin: 15px 0;">
                        <strong> Tip:</strong> Click on the section headers below to expand or collapse the content.
                    </div>
                </div>

                <!-- Edit Profile Section -->
                <div class="manual-section"
                    style="background: white; border-radius: 12px; margin-bottom: 15px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden;">
                    <div class="section-header" onclick="toggleSection('profile-content')"
                        style="padding: 20px 25px; background: #004AAD; color: white; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                        <h2 style="margin: 0; font-size: 1.5rem;">Edit Profile</h2>
                        <span id="profile-arrow" style="font-size: 1.2rem;">▼</span>
                    </div>
                    <div id="profile-content" class="section-content" style="display: none; padding: 0 25px;">
                        <div style="padding: 25px 0;">
                            <p>Update your personal information and profile picture.</p>

                            <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin: 15px 0;">
                                <p><strong>Accessing Edit Profile:</strong></p>
                                <ol>
                                    <li>Click on your <strong>profile picture</strong> in the top-right corner</li>
                                    <li>Select <strong>"Edit Profile"</strong> from the dropdown menu</li>
                                </ol>
                            </div>

                            <h3 style="color: #004AAD;">Editable Information</h3>
                            <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin: 15px 0;">
                                <p>You can edit the following information:</p>
                                <ul>
                                    <li><strong>Name:</strong> Your full name</li>
                                    <li><strong>Student ID:</strong> Your student identification number</li>
                                    <li><strong>Course:</strong> Your academic program/course</li>
                                    <li><strong>Phone Number:</strong> Your contact number</li>
                                    <li><strong>Room Number:</strong> Your assigned hostel room</li>
                                    <li><strong>Address:</strong> Your permanent home address</li>
                                </ul>

                                <div
                                    style="background: #fff8e1; border-left: 4px solid #ffc107; padding: 10px; margin: 10px 0;">
                                    <strong>⚠️ Note:</strong> Your email address cannot be edited as it is used for system
                                    authentication.
                                </div>
                            </div>

                            <h3 style="color: #004AAD;">Profile Picture</h3>
                            <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin: 15px 0;">
                                <p><strong>To change your profile picture:</strong></p>
                                <ol>
                                    <li>Click the <strong>"Choose File"</strong> button under Profile Picture</li>
                                    <li>Select an image file from your device (JPG, JPEG, PNG formats supported)</li>
                                    <li>The image will be automatically resized and cropped to fit</li>
                                    <li>Click <strong>"Save Changes"</strong> to update your profile</li>
                                </ol>

                                <div
                                    style="background: #e8f5e9; border-left: 4px solid #4caf50; padding: 10px; margin: 10px 0;">
                                    <strong>✅ Tip:</strong> Use a clear, recent photo for easy identification by wardens and
                                    administrators.
                                </div>
                            </div>

                            <h3 style="color: #004AAD;">Saving Changes</h3>
                            <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin: 15px 0;">
                                <p>After making your changes:</p>
                                <ul>
                                    <li>Click <strong>"Save Changes"</strong> to update your information</li>
                                    <li>Click <strong>"Cancel"</strong> to discard any changes made</li>
                                    <li>You will see a success message confirming your profile has been updated</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Section -->
                <div class="manual-section"
                    style="background: white; border-radius: 12px; margin-bottom: 15px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden;">
                    <div class="section-header" onclick="toggleSection('settings-content')"
                        style="padding: 20px 25px; background: #004AAD; color: white; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                        <h2 style="margin: 0; font-size: 1.5rem;">Setting</h2>
                        <span id="settings-arrow" style="font-size: 1.2rem;">▼</span>
                    </div>
                    <div id="settings-content" class="section-content" style="display: none; padding: 0 25px;">
                        <div style="padding: 25px 0;">
                            <p>Manage your account security by changing your password.</p>

                            <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin: 15px 0;">
                                <p><strong>Accessing Settings:</strong></p>
                                <ol>
                                    <li>Click on your <strong>profile picture</strong> in the top-right corner</li>
                                    <li>Select <strong>"Settings"</strong> from the dropdown menu</li>
                                </ol>
                            </div>

                            <h3 style="color: #004AAD;">Changing Your Password</h3>


                            <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin: 15px 0;">
                                <p><strong>Steps to Change Password:</strong></p>
                                <ol>
                                    <li>Enter your <strong>Current Password</strong> for verification</li>
                                    <li>Enter your <strong>New Password</strong> following the requirements</li>
                                    <li>Confirm your new password in the <strong>Confirm New Password</strong> field</li>
                                    <li>Click <strong>"Change Password"</strong> to save the new password</li>
                                </ol>

                                <div
                                    style="background: #fff8e1; border-left: 4px solid #ffc107; padding: 10px; margin: 10px 0;">
                                    <strong>⚠️ Security Tip:</strong> Always use a strong, unique password and never share
                                    it with anyone.
                                </div>
                            </div>

                            <h3 style="color: #004AAD;">Troubleshooting</h3>
                            <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin: 15px 0;">
                                <p><strong>Common Issues:</strong></p>
                                <ul>
                                    <li><strong>Incorrect Current Password:</strong> Ensure you're entering your current
                                        password correctly</li>
                                    <li><strong>Password Mismatch:</strong> New Password and Confirm New Password must match
                                        exactly</li>
                                    <li><strong>Same as Current:</strong> New password cannot be the same as your current
                                        password</li>
                                </ul>

                                <div
                                    style="background: #ffebee; border-left: 4px solid #f44336; padding: 10px; margin: 10px 0;">
                                    <strong>🚫 Important:</strong> If you forget your password, contact system
                                    administration for assistance. You cannot reset it yourself.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payments Section -->
                <div class="manual-section"
                    style="background: white; border-radius: 12px; margin-bottom: 15px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden;">
                    <div class="section-header" onclick="toggleSection('payments-content')"
                        style="padding: 20px 25px; background: #004AAD; color: white; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                        <h2 style="margin: 0; font-size: 1.5rem;">Payments Module</h2>
                        <span id="payments-arrow" style="font-size: 1.2rem;">▼</span>
                    </div>
                    <div id="payments-content" class="section-content" style="display: none; padding: 0 25px;">
                        <div style="padding: 25px 0;">
                            <p>Submit your hostel fees and track payment status through two payment methods.</p>

                            <h3 style="color: #004AAD;">ePay Method</h3>
                            <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin: 15px 0;">
                                <p><strong>Process:</strong></p>
                                <ol>
                                    <li>Click on the <strong>"Payments"</strong> card from your dashboard</li>
                                    <li>Select <strong>"ePay Method"</strong></li>
                                    <li>Click <strong>"Go to ePay Portal"</strong> - this will redirect you to the official
                                        payment system</li>
                                    <li>Complete your payment using your UPTM credentials</li>
                                </ol>

                                <div
                                    style="background: #fff8e1; border-left: 4px solid #ffc107; padding: 10px; margin: 10px 0;">
                                    <strong>⚠️ Important:</strong> This method requires your UPTM student email (format:
                                    klxxxxxxxxxx@student.uptm.edu.my)
                                </div>
                            </div>

                            <h3 style="color: #004AAD;">JomPay Method</h3>
                            <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin: 15px 0;">
                                <p><strong>Process:</strong></p>
                                <ol>
                                    <li>Use the following details in your banking app:
                                        <ul>
                                            <li><strong>Biller Code:</strong> 88070</li>
                                            <li><strong>Reference 1:</strong> Your Student ID</li>
                                            <li><strong>Reference 2:</strong> Type of payment (e.g., "hostel fee")</li>
                                        </ul>
                                    </li>
                                </ol>
                            </div>

                            <h3 style="color: #004AAD;">After Making Payment</h3>
                            <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin: 15px 0;">
                                <p><strong>To complete the process:</strong></p>
                                <ol>
                                    <li>Upload your payment receipt (PDF, JPG, or PNG format)</li>
                                    <li>Enter the amount paid</li>
                                    <li>Click <strong>"Submit"</strong></li>
                                </ol>

                                <p><strong>Status Tracking:</strong></p>
                                <ul>
                                    <li><strong>Pending:</strong> Your payment is awaiting admin verification</li>
                                    <li><strong>Approved:</strong> Payment verified and accepted</li>
                                    <li><strong>Rejected:</strong> Payment issue - fake receipt</li>
                                </ul>

                                <div
                                    style="background: #e8f5e9; border-left: 4px solid #4caf50; padding: 10px; margin: 10px 0;">
                                    <strong> Note:</strong> Payment status updates only after admin reviews your submitted
                                    evidence. This may take up to 24-48 hours.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Outing Form Section -->
                <div class="manual-section"
                    style="background: white; border-radius: 12px; margin-bottom: 15px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden;">
                    <div class="section-header" onclick="toggleSection('outing-content')"
                        style="padding: 20px 25px; background: #004AAD; color: white; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                        <h2 style="margin: 0; font-size: 1.5rem;">Outing Form Module</h2>
                        <span id="outing-arrow" style="font-size: 1.2rem;">▼</span>
                    </div>
                    <div id="outing-content" class="section-content" style="display: none; padding: 0 25px;">
                        <div style="padding: 25px 0;">
                            <p>Manage your overnight stays outside the hostel through three dedicated tabs.</p>

                            <h3 style="color: #004AAD;">Tab 1: New Outing Form</h3>
                            <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin: 15px 0;">
                                <p><strong>To submit a new outing request:</strong></p>
                                <ol>
                                    <li>Click on the <strong>"Outing Form"</strong> card from your dashboard</li>
                                    <li>Ensure you're on the <strong>"New Outing Form"</strong> tab</li>
                                    <li>Fill in all required fields:
                                        <ul>
                                            <li><strong>Departure Date & Time:</strong> When you plan to leave</li>
                                            <li><strong>Expected Return Date & Time:</strong> When you plan to return</li>
                                            <li><strong>Destination:</strong> Where you're going</li>
                                            <li><strong>Purpose:</strong> Reason for your outing</li>
                                            <li><strong>Emergency Contact Number:</strong> Phone number in case of emergency
                                            </li>
                                            <li><strong>Relationship:</strong> Your relationship to the emergency contact
                                            </li>
                                        </ul>
                                    </li>
                                    <li>Click <strong>"Submit"</strong></li>
                                </ol>

                                <div
                                    style="background: #fff8e1; border-left: 4px solid #ffc107; padding: 10px; margin: 10px 0;">
                                    <strong>⚠️ Important:</strong> You can only have one active outing request at a time. If
                                    you see a message saying you've already submitted a form, check the "Current Outing"
                                    tab.
                                </div>
                            </div>

                            <h3 style="color: #004AAD;">Tab 2: Current Outing</h3>
                            <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin: 15px 0;">
                                <p>This tab shows your active outing request with the following options:</p>
                                <ul>
                                    <li><strong>View Status:</strong> See if your request is pending, approved, or rejected
                                    </li>
                                    <li><strong>Delete:</strong> Cancel your outing request if plans change (only available
                                        for pending requests)</li>
                                    <li><strong>Mark as Returned:</strong> Use this when you return to the hostel</li>
                                </ul>
                            </div>

                            <h3 style="color: #004AAD;">Tab 3: Outing History</h3>
                            <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin: 15px 0;">
                                <p>View your complete record of all past outings including:</p>
                                <ul>
                                    <li>Dates and times of previous outings</li>
                                    <li>Destinations and purposes</li>
                                    <li>Approval status history</li>
                                    <li>Return confirmations</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Forms Section -->
                <div class="manual-section"
                    style="background: white; border-radius: 12px; margin-bottom: 15px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden;">
                    <div class="section-header" onclick="toggleSection('forms-content')"
                        style="padding: 20px 25px; background: #004AAD; color: white; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                        <h2 style="margin: 0; font-size: 1.5rem;">Forms Module</h2>
                        <span id="forms-arrow" style="font-size: 1.2rem;">▼</span>
                    </div>
                    <div id="forms-content" class="section-content" style="display: none; padding: 0 25px;">
                        <div style="padding: 25px 0;">
                            <p>Access various application and reporting forms for hostel-related matters.</p>

                            <!-- Vehicle Sticker Application -->
                            <div class="manual-section"
                                style="background: #f8fbff; padding: 20px; border-radius: 8px; margin: 15px 0; border: 1px solid #e0e0e0;">
                                <div class="section-header" onclick="toggleSection('vehicle-content')"
                                    style="cursor: pointer;">
                                    <h3
                                        style="color: #004AAD; margin: 0; display: flex; justify-content: space-between; align-items: center;">
                                        Vehicle Sticker Application
                                        <span id="vehicle-arrow" style="font-size: 1rem;">▼</span>
                                    </h3>
                                </div>
                                <div id="vehicle-content" class="section-content" style="display: none;">
                                    <p><strong>Description:</strong> Apply for permission to bring your personal vehicle to
                                        hostel grounds</p>
                                    <p><strong>Usage:</strong> Can be applied multiple times</p>

                                    <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin: 15px 0;">
                                        <p><strong>Application Process:</strong></p>
                                        <ol>
                                            <li>Click on the <strong>"Forms"</strong> card from your dashboard</li>
                                            <li>Select <strong>"Vehicle Sticker Application"</strong></li>
                                            <li>Click <strong>"Apply"</strong> button</li>
                                            <li>Fill in the required form fields</li>
                                            <li>Upload mandatory documents:
                                                <ul>
                                                    <li>Vehicle License</li>
                                                    <li>Vehicle Registration</li>
                                                    <li>Valid Insurance Document</li>
                                                </ul>
                                            </li>
                                            <li>Click <strong>"Submit"</strong></li>
                                        </ol>

                                        <p><strong>After Submission:</strong></p>
                                        <ul>
                                            <li>Status will show as "Pending" until admin review</li>
                                            <li>Admin may approve or reject your application</li>
                                            <li>Check for admin comments if application is rejected</li>
                                            <li>Status updates automatically after admin action</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Facility Report -->
                            <div class="manual-section"
                                style="background: #f8fbff; padding: 20px; border-radius: 8px; margin: 15px 0; border: 1px solid #e0e0e0;">
                                <div class="section-header" onclick="toggleSection('facility-content')"
                                    style="cursor: pointer;">
                                    <h3
                                        style="color: #004AAD; margin: 0; display: flex; justify-content: space-between; align-items: center;">
                                        Facility Report
                                        <span id="facility-arrow" style="font-size: 1rem;">▼</span>
                                    </h3>
                                </div>
                                <div id="facility-content" class="section-content" style="display: none;">
                                    <p><strong>Description:</strong> Report issues or damages in rooms or common areas</p>
                                    <p><strong>Usage:</strong> Can be submitted multiple times</p>

                                    <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin: 15px 0;">
                                        <p><strong>Reporting Process:</strong></p>
                                        <ol>
                                            <li>Click on the <strong>"Forms"</strong> card from your dashboard</li>
                                            <li>Select <strong>"Facility Report"</strong></li>
                                            <li>Click <strong>"Apply"</strong> button</li>
                                            <li>Fill in all required fields describing the issue</li>
                                            <li>Upload image or video evidence of the damage (optional but recommended)</li>
                                            <li>Click <strong>"Submit"</strong></li>
                                        </ol>

                                        <p><strong>After Submission:</strong></p>
                                        <ul>
                                            <li>Track repair status through status updates</li>
                                            <li>Admin will update status as issue is addressed</li>
                                            <li>You'll be notified when the issue is resolved</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Change Room Request -->
                            <div class="manual-section"
                                style="background: #f8fbff; padding: 20px; border-radius: 8px; margin: 15px 0; border: 1px solid #e0e0e0;">
                                <div class="section-header" onclick="toggleSection('room-content')"
                                    style="cursor: pointer;">
                                    <h3
                                        style="color: #004AAD; margin: 0; display: flex; justify-content: space-between; align-items: center;">
                                        Change Room Request
                                        <span id="room-arrow" style="font-size: 1rem;">▼</span>
                                    </h3>
                                </div>
                                <div id="room-content" class="section-content" style="display: none;">
                                    <p><strong>Description:</strong> Request room change for medical or personal reasons</p>
                                    <p><strong>Usage:</strong> Can be applied multiple times</p>

                                    <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin: 15px 0;">
                                        <p><strong>Application Process:</strong></p>
                                        <ol>
                                            <li>Click on the <strong>"Forms"</strong> card from your dashboard</li>
                                            <li>Select <strong>"Change Room Request"</strong></li>
                                            <li>Click <strong>"Apply"</strong> button</li>
                                            <li>Fill in the required form fields</li>
                                            <li>Provide reason for room change request</li>
                                            <li>Click <strong>"Submit"</strong></li>
                                        </ol>

                                        <p><strong>After Submission:</strong></p>
                                        <ul>
                                            <li>Admin will review your request based on room availability</li>
                                            <li>Approval depends on whether suitable rooms are available</li>
                                            <li>Status will show admin decision and room availability</li>
                                            <li>If approved, you'll receive further instructions</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Hostel Check-Out Form -->
                            <div class="manual-section"
                                style="background: #f8fbff; padding: 20px; border-radius: 8px; margin: 15px 0; border: 1px solid #e0e0e0;">
                                <div class="section-header" onclick="toggleSection('checkout-content')"
                                    style="cursor: pointer;">
                                    <h3
                                        style="color: #004AAD; margin: 0; display: flex; justify-content: space-between; align-items: center;">
                                        Hostel Check-Out Form
                                        <span id="checkout-arrow" style="font-size: 1rem;">▼</span>
                                    </h3>
                                </div>
                                <div id="checkout-content" class="section-content" style="display: none;">
                                    <p><strong>Description:</strong> Formal procedure for permanently leaving the hostel</p>
                                    <p><strong>Usage:</strong> Can be submitted ONLY ONCE</p>

                                    <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin: 15px 0;">
                                        <p><strong>Application Process:</strong></p>
                                        <ol>
                                            <li>Click on the <strong>"Forms"</strong> card from your dashboard</li>
                                            <li>Select <strong>"Hostel Check-Out Form"</strong></li>
                                            <li>Click <strong>"Apply"</strong> button</li>
                                            <li>Fill in all required form fields</li>
                                            <li>Click <strong>"Submit"</strong></li>
                                        </ol>

                                        <div
                                            style="background: #ffebee; border-left: 4px solid #f44336; padding: 10px; margin: 10px 0;">
                                            <strong>🚫 CRITICAL:</strong> This form can only be submitted once. After
                                            submission, you cannot fill it out again. Use this only when you are permanently
                                            leaving the hostel and not returning.
                                        </div>

                                        <p><strong>After Submission:</strong></p>
                                        <ul>
                                            <li>Admin will process your check-out request</li>
                                            <li>You'll receive final status update from admin</li>
                                            <li>All hostel access will be revoked after approval</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Support Section -->
                <div
                    style="background: white; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <h2 style="color: #004AAD; margin-top: 0;">Need Additional Help?</h2>
                    <p>If you encounter any issues or have questions not covered in this manual:</p>

                    <div
                        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 20px;">
                        <div style="background: #f0f8ff; padding: 20px; border-radius: 8px; text-align: center;">
                            <h4 style="color: #004AAD; margin-top: 0;">Contact Warden</h4>
                            <p>Reach out to your assigned warden for hostel-related issues</p>
                            <a href="/student/wardens"
                                style="background: #004AAD; color: white; padding: 8px 16px; border-radius: 20px; text-decoration: none; display: inline-block; margin-top: 10px;">View
                                Warden List</a>
                        </div>

                    </div>
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

        });

        function toggleSection(sectionId, isInitial = false) {
            const content = document.getElementById(sectionId);
            const arrow = document.getElementById(sectionId.replace('-content', '-arrow'));

            if (content.style.display === 'block') {
                content.style.display = 'none';
                if (arrow) arrow.textContent = '▼';
            } else {
                content.style.display = 'block';
                if (arrow) arrow.textContent = '▲';

                // Scroll to section if not initial load
                if (!isInitial) {
                    content.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId !== '#') {
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 20,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });
    </script>

    <style>
        @media (max-width: 768px) {
            #sidebar {
                left: -250px;
            }

            #main-content {
                margin-left: 0;
            }
        }

        .section-header:hover {
            background: #003a8c !important;
            transition: background 0.3s ease;
        }

        .section-content {
            transition: all 0.3s ease;
        }
    </style>
@endsection
