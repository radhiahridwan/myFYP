@extends('layouts.app')

@section('title', 'Change Room')

@section('content')
    <div class="student-dashboard"
        style="display: flex; min-height: 100vh; font-family: 'Poppins', sans-serif; background: #f8fbff; overflow-x: hidden;">

        <!-- ===== SIDEBAR ===== -->
        <div id="sidebar"
            style="
            width: 250px;
            background: #004AAD;
            color: white;
            position: fixed;
            top: 0;
            left: -250px;
            height: 100%;
            padding: 20px;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            transition: left 0.3s ease;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow-y: auto; 
        ">
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
                    <h2 style="color: #004AAD; margin: 0;">Change Room Application</h2>
                </div>

                <!-- Profile Dropdown -->
                <div style="position: relative;">
                    <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/student-avatar.png') }}"
                        alt="Student" id="profile-toggle"
                        style="width: 45px; height: 45px; border-radius: 50%; cursor: pointer; border: 2px solid #004AAD;">
                    <div id="profile-dropdown"
                        style="
                    display: none;
                    position: absolute;
                    right: 0;
                    top: 55px;
                    background: white;
                    border-radius: 8px;
                    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                    width: 220px;
                    overflow: hidden;
                ">
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

            <!-- ===== CHANGE ROOM FORM ===== -->
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

                    <form method="POST" action="{{ route('forms.change-room.store') }}">
                        @csrf

                        <!-- Current Room Information -->
                        <div style="margin-bottom: 25px;">
                            <h3
                                style="color: #004AAD; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">
                                Current Room Information
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

                        <!-- Change Request Details -->
                        <div style="margin-bottom: 25px;">
                            <h3
                                style="color: #004AAD; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">
                                Application Details
                            </h3>

                            <!-- Reason for Change -->
                            <div style="margin-bottom: 20px;">
                                <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">
                                    Reason for Room Change *
                                </label>
                                <select name="reason" required
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
                                    <option value="">Select Reason</option>
                                    <option value="roommate_issues"
                                        {{ old('reason') == 'roommate_issues' ? 'selected' : '' }}>
                                        Roommate Issues
                                    </option>
                                    <option value="maintenance" {{ old('reason') == 'maintenance' ? 'selected' : '' }}>
                                        Maintenance Problems
                                    </option>
                                    <option value="noisy" {{ old('reason') == 'noisy' ? 'selected' : '' }}>
                                        Too Noisy
                                    </option>
                                    <option value="prefer_floor" {{ old('reason') == 'prefer_floor' ? 'selected' : '' }}>
                                        Prefer Different Floor
                                    </option>
                                    <option value="health" {{ old('reason') == 'health' ? 'selected' : '' }}>
                                        Health Reasons
                                    </option>
                                    <option value="other" {{ old('reason') == 'other' ? 'selected' : '' }}>
                                        Other
                                    </option>
                                </select>
                            </div>

                            <!-- Detailed Explanation -->
                            <div style="margin-bottom: 20px;">
                                <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">
                                    Detailed Explanation *
                                </label>
                                <textarea name="explanation" required rows="4"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; resize: vertical;"
                                    placeholder="Please explain your reason in detail...">{{ old('explanation') }}</textarea>
                            </div>

                            <!-- Preferred New Room -->
                            <div style="margin-bottom: 20px;">
                                <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">
                                    Preferred Room *
                                </label>
                                <select name="preferred_room" required
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
                                    <option value="">Select Room</option>

                                    <!-- Floor 0: 11-0-1 to 11-0-18 -->
                                    <optgroup label="Floor 0">
                                        @for ($i = 1; $i <= 18; $i++)
                                            <option value="11-0-{{ $i }}"
                                                {{ old('preferred_room') == '11-0-' . $i ? 'selected' : '' }}>
                                                11-0-{{ $i }}
                                            </option>
                                        @endfor
                                    </optgroup>

                                    <!-- Floor 1: 11-1-1 to 11-1-18 -->
                                    <optgroup label="Floor 1">
                                        @for ($i = 1; $i <= 18; $i++)
                                            <option value="11-1-{{ $i }}"
                                                {{ old('preferred_room') == '11-1-' . $i ? 'selected' : '' }}>
                                                11-1-{{ $i }}
                                            </option>
                                        @endfor
                                    </optgroup>

                                    <!-- Floor 2: 11-2-1 to 11-2-18 -->
                                    <optgroup label="Floor 2">
                                        @for ($i = 1; $i <= 18; $i++)
                                            <option value="11-2-{{ $i }}"
                                                {{ old('preferred_room') == '11-2-' . $i ? 'selected' : '' }}>
                                                11-2-{{ $i }}
                                            </option>
                                        @endfor
                                    </optgroup>

                                    <!-- Floor 3: 11-3-1 to 11-3-18 -->
                                    <optgroup label="Floor 3">
                                        @for ($i = 1; $i <= 18; $i++)
                                            <option value="11-3-{{ $i }}"
                                                {{ old('preferred_room') == '11-3-' . $i ? 'selected' : '' }}>
                                                11-3-{{ $i }}
                                            </option>
                                        @endfor
                                    </optgroup>

                                    <!-- Floor 4: 11-4-1 to 11-4-18 -->
                                    <optgroup label="Floor 4">
                                        @for ($i = 1; $i <= 18; $i++)
                                            <option value="11-4-{{ $i }}"
                                                {{ old('preferred_room') == '11-4-' . $i ? 'selected' : '' }}>
                                                11-4-{{ $i }}
                                            </option>
                                        @endfor
                                    </optgroup>
                                </select>
                                <small style="color: #666; font-size: 12px;">* Select the room you want to change
                                    to</small>
                            </div>

                            <!-- Preferred Move Date -->
                            <div style="margin-bottom: 20px;">
                                <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">
                                    Preferred Move Date
                                </label>
                                <input type="date" name="preferred_date" value="{{ old('preferred_date') }}"
                                    min="{{ date('Y-m-d') }}"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
                            </div>
                        </div>

                        <!-- Declaration -->
                        <div
                            style="margin-bottom: 30px; padding: 20px; background: #f8fbff; border-radius: 6px; border-left: 4px solid #004AAD;">
                            <h4 style="color: #004AAD; margin-bottom: 15px;">Declaration</h4>

                            <div style="margin-bottom: 15px;">
                                <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                                    <input type="checkbox" name="declaration_accurate" value="1" required
                                        style="margin-top: 2px;">
                                    <span style="color: #333; font-size: 14px;">
                                        I declare that all information provided is true and accurate.
                                    </span>
                                </label>
                            </div>

                            <div>
                                <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                                    <input type="checkbox" name="declaration_rules" value="1" required
                                        style="margin-top: 2px;">
                                    <span style="color: #333; font-size: 14px;">
                                        I understand and agree to comply with all hostel room change rules.
                                    </span>
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div style="text-align: center;">
                            <button type="submit"
                                style="background: #004AAD; color: white; border: none; padding: 15px 40px; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: 500;">
                                Submit Application
                            </button>
                        </div>
                    </form>
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
    </script>
@endsection
