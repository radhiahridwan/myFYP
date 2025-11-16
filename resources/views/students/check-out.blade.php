@extends('layouts.app')

@section('title', 'Check-out Form')

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
                style="display: flex; justify-content: space-between; align-items: center; background: white; padding: 15px 25px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 999;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <span id="menu-toggle" style="font-size: 26px; cursor: pointer; color: #004AAD;">☰</span>
                    <h2 style="color: #004AAD; margin: 0;">Hostel Check-out Application</h2>
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

            <!-- ===== CHECK-OUT FORM ===== -->
            <div style="padding: 25px; max-width: 800px; margin: 0 auto;">

                <!-- Back Button -->
                <div style="margin-bottom: 20px;">
                    <a href="{{ route('student.forms') }}"
                        style="background: #6c757d; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-size: 14px;">
                        ← Back to Forms
                    </a>
                </div>

                <!-- Form Container -->
                <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">

                    @if (session('success'))
                        <div
                            style="background: #d4edda; color: #155724; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div
                            style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
                            <ul style="margin: 0; padding-left: 20px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Check if student already submitted check-out form -->
                    @php
                        $existingCheckout = \App\Models\Form::where('user_id', auth()->id())
                            ->where('type', 'check_out')
                            ->first();
                    @endphp

                    @if ($existingCheckout)
                        <!-- Already submitted message -->
                        <div style="text-align: center; padding: 40px;">
                            <div style="font-size: 48px; margin-bottom: 20px;">✅</div>
                            <h3 style="color: #004AAD; margin-bottom: 15px;">Check-out Application Submitted</h3>
                            <p style="color: #666; margin-bottom: 25px;">
                                You have already submitted a hostel check-out application.
                                This form can only be submitted once.
                            </p>
                            <div style="background: #f8fbff; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                                <h4 style="color: #004AAD; margin-bottom: 10px;">Your Application Details</h4>
                                <p><strong>Status:</strong>
                                    <span style="text-transform: capitalize; font-weight: bold;">
                                        {{ $existingCheckout->status }}
                                    </span>
                                </p>
                                <p><strong>Submitted:</strong>
                                    {{ $existingCheckout->created_at->format('F j, Y') }}
                                </p>
                            </div>
                            <a href="{{ route('student.forms') }}"
                                style="background: #004AAD; color: white; padding: 12px 30px; border-radius: 6px; text-decoration: none; font-size: 14px;">
                                Return to Forms
                            </a>
                        </div>
                    @else
                        <!-- Check-out Form -->
                        <form method="POST" action="{{ route('forms.check-out.store') }}" id="checkoutForm">
                            @csrf

                            <!-- Current Room Information -->
                            <div style="margin-bottom: 25px;">
                                <h3
                                    style="color: #004AAD; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">
                                    Student Information
                                </h3>

                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                    <div>
                                        <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">
                                            Current Room *
                                        </label>
                                        <input type="text" value="{{ auth()->user()->student->hostel_room ?? 'N/A' }}"
                                            readonly
                                            style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; background: #f8f9fa; color: #666;">
                                    </div>

                                    <div>
                                        <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">
                                            Phone Number *
                                        </label>
                                        <input type="tel" name="phone"
                                            value="{{ auth()->user()->student->phone_number ?? '' }}" required
                                            style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px;"
                                            placeholder="Example: 0123456789">
                                    </div>
                                </div>
                            </div>

                            <!-- Check-out Details -->
                            <div style="margin-bottom: 25px;">
                                <h3
                                    style="color: #004AAD; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">
                                    Check-out Details
                                </h3>

                                <!-- Reason for Check-out -->
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">
                                        Reason for Check-out *
                                    </label>
                                    <select name="reason" required
                                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
                                        <option value="">Select Reason</option>
                                        <option value="completed_studies"
                                            {{ old('reason') == 'completed_studies' ? 'selected' : '' }}>
                                            Completed Studies
                                        </option>
                                        <option value="transfer" {{ old('reason') == 'transfer' ? 'selected' : '' }}>
                                            Transfer to Another Institution
                                        </option>
                                        <option value="personal" {{ old('reason') == 'personal' ? 'selected' : '' }}>
                                            Personal/Family Reasons
                                        </option>
                                        <option value="health" {{ old('reason') == 'health' ? 'selected' : '' }}>
                                            Health Reasons
                                        </option>
                                        <option value="withdrawn" {{ old('reason') == 'withdrawn' ? 'selected' : '' }}>
                                            Withdrawn from Program
                                        </option>
                                        <option value="completed_semester"
                                            {{ old('reason') == 'completed_semester' ? 'selected' : '' }}>
                                            Completed current semester
                                        <option value="other" {{ old('reason') == 'other' ? 'selected' : '' }}>
                                            Other
                                        </option>
                                    </select>
                                </div>

                                <!-- Planned Check-out Date -->
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">
                                        Planned Check-out Date *
                                    </label>
                                    <input type="date" name="checkout_date" value="{{ old('checkout_date') }}"
                                        min="{{ date('Y-m-d') }}" required
                                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
                                </div>

                                <!-- Forwarding Address -->
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">
                                        Forwarding Address *
                                    </label>
                                    <textarea name="forwarding_address" required rows="3"
                                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; resize: vertical;"
                                        placeholder="Your complete address after checking out from hostel...">{{ old('forwarding_address') }}</textarea>
                                </div>

                                <!-- Emergency Contact -->
                                <div
                                    style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                                    <div>
                                        <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">
                                            Emergency Contact Person *
                                        </label>
                                        <input type="text" name="emergency_contact_name"
                                            value="{{ old('emergency_contact_name') }}" required
                                            style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px;"
                                            placeholder="Full name">
                                    </div>

                                    <div>
                                        <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">
                                            Emergency Contact Number *
                                        </label>
                                        <input type="tel" name="emergency_contact_phone"
                                            value="{{ old('emergency_contact_phone') }}" required
                                            style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px;"
                                            placeholder="Phone number">
                                    </div>
                                </div>
                            </div>

                            <!-- Property Clearance Declaration -->
                            <div
                                style="margin-bottom: 25px; padding: 20px; background: #f8fbff; border-radius: 6px; border-left: 4px solid #004AAD;">
                                <h4 style="color: #004AAD; margin-bottom: 15px;">Property Clearance Declaration</h4>

                                <div style="display: grid; grid-template-columns: 1fr; gap: 12px;">
                                    <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                                        <input type="checkbox" name="key_returned" value="1" required
                                            style="margin-top: 2px;">
                                        <span style="color: #333; font-size: 14px;">
                                            I will return my room key to the warden upon check-out
                                        </span>
                                    </label>

                                    <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                                        <input type="checkbox" name="belongings_removed" value="1" required
                                            style="margin-top: 2px;">
                                        <span style="color: #333; font-size: 14px;">
                                            I will remove all personal belongings from the room
                                        </span>
                                    </label>

                                    <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                                        <input type="checkbox" name="no_damage" value="1" required
                                            style="margin-top: 2px;">
                                        <span style="color: #333; font-size: 14px;">
                                            There is no damage to room property and furniture
                                        </span>
                                    </label>

                                    <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                                        <input type="checkbox" name="fees_cleared" value="1" required
                                            style="margin-top: 2px;">
                                        <span style="color: #333; font-size: 14px;">
                                            All hostel fees have been paid up to date
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <!-- Final Declaration -->
                            <div
                                style="margin-bottom: 30px; padding: 20px; background: #fff3cd; border-radius: 6px; border-left: 4px solid #ffc107;">
                                <h4 style="color: #856404; margin-bottom: 15px;">Important Notice</h4>

                                <div style="margin-bottom: 15px;">
                                    <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                                        <input type="checkbox" name="final_declaration" value="1" required
                                            style="margin-top: 2px;">
                                        <span style="color: #856404; font-size: 14px;">
                                            I understand that once checked out, I cannot return to the hostel and all my
                                            belongings left behind will be disposed of after 7 days.
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <!-- Submit Button with Confirmation -->
                            <div style="text-align: center;">
                                <button type="button" onclick="confirmSubmission()"
                                    style="background: #004AAD; color: white; border: none; padding: 15px 40px; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: 500;">
                                    Submit Check-out Application
                                </button>
                            </div>

                            <!-- Warning Message -->
                            <div
                                style="margin-top: 20px; padding: 15px; background: #fff3cd; border-radius: 6px; text-align: center;">
                                <p style="color: #856404; margin: 0; font-size: 14px;">
                                    ⚠️ <strong>Important:</strong> This form can only be submitted ONCE.
                                    Please review all information carefully before submitting.
                                </p>
                            </div>
                        </form>
                    @endif
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
                profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' :
                    'block';
            });

            document.addEventListener('click', (e) => {
                if (!profileToggle.contains(e.target) && !profileDropdown.contains(e.target)) {
                    profileDropdown.style.display = 'none';
                }
            });
        });

        function confirmSubmission() {
            if (confirm(
                    '⚠️ FINAL CONFIRMATION\n\nAre you sure you want to submit your hostel check-out application?\n\nThis action cannot be undone and you will not be able to submit another check-out application.\n\nPlease ensure all information is correct before proceeding.'
                )) {
                document.getElementById('checkoutForm').submit();
            }
        }
    </script>
@endsection
