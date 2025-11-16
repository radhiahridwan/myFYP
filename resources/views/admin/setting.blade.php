@extends('layouts.app')

@section('title', 'Admin Settings')

@section('content')
    <div class="admin-dashboard"
        style="display: flex; min-height: 100vh; font-family: 'Poppins', sans-serif; background: #f8fbff; overflow-x: hidden;">

        <!-- ===== SIDEBAR ===== -->
        <div id="sidebar"
            style=" width: 250px; background: #004AAD; color: white; position: fixed; top: 0;left: -250px; height: 100%; padding: 20px 0;box-shadow: 4px 0 10px rgba(0,0,0,0.1); transition: left 0.3s ease; z-index: 1000; display: flex; flex-direction: column; justify-content: space-between; ">
            <div>
                <!-- ===== UPTM LOGO ===== -->
                <div style="text-align:center; margin-bottom: 25px;">
                    <img src="{{ asset('images/uptm-logo.png') }}" alt="UPTM Logo"
                        style="width: 100%; max-width: 180px; height: auto; display: block; margin: 0 auto 10px;">
                    <h3 style="font-size: 16px; color: white; margin: 0;">SISWI Management</h3>
                </div>

                <ul style="list-style: none; padding: 0 20px; line-height: 2;">
                    <li><a href="/admin/dashboard"
                            style="background: white; color: #004AAD; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">
                            Dashboard</a></li>
                    <li><a href="/admin/students"
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">
                            Students</a></li>
                    <li><a href="/admin/houses"
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">
                            Houses</a></li>
                    <li><a href="/admin/forms"
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">
                            Forms</a></li>
                    <li><a href="/admin/payments"
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">
                            Payments</a></li>
                    <li><a href="/admin/outings"
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">
                            Outing</a></li>
                    <li><a href="/admin/rules"
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">
                            Rules</a></li>
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
                    <h2 style="color: #004AAD; margin: 0;">Settings</h2>
                </div>

                <!-- Profile Dropdown -->
                <div style="position: relative;">
                    <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/admin-avatar.png') }}"
                        alt="Admin" id="profile-toggle"
                        style="width: 45px; height: 45px; border-radius: 50%; cursor: pointer; border: 2px solid #004AAD;">
                    <div id="profile-dropdown"
                        style=" display: none; position: absolute; right: 0; top: 55px; background: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 220px; overflow: hidden; ">
                        <div style="padding: 15px; border-bottom: 1px solid #eee;">
                            <strong>{{ Auth::user()->name ?? 'Admin' }}</strong><br>
                            <small>{{ Auth::user()->email ?? 'admin@uptm.edu.my' }}</small>
                        </div>

                        <a href="/admin/profile"
                            style="display: flex; align-items: center; gap: 8px; padding: 10px 15px; color: #004AAD; text-decoration: none;">
                            <img src="{{ asset('images/profile.png') }}" alt="Profile" style="width: 20px; height: 20px;">
                            Edit Profile
                        </a>

                        <a href="/admin/settings"
                            style="background: rgba(0, 74, 173, 0.1); display: flex; align-items: center; gap: 8px; padding: 10px 15px; color: #004AAD; text-decoration: none; border-left: 3px solid #004AAD;">
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

            <!-- ===== SETTINGS CONTENT ===== -->
            <div style="padding: 25px; width: 100%; max-width: 600px; margin: auto;">

                <!-- Error Messages -->
                @if ($errors->any())
                    <div id="error-message"
                        style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Password Settings Card -->
                <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 25px;">
                        <h3 style="color: #004AAD; margin: 0;">Change Password</h3>
                    </div>

                    <form method="POST" action="{{ route('admin.settings.update-password') }}">
                        @csrf

                        <!-- Current Password Field (Always Visible) -->
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; color: #333; font-weight: 500;">
                                Current Password
                            </label>
                            <div style="position: relative;">
                                <input type="text" name="current_password" id="current_password"
                                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px;"
                                    placeholder="Enter your current password" required>
                            </div>
                        </div>

                        <!-- New Password Field (With Toggle) -->
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; color: #333; font-weight: 500;">
                                New Password
                            </label>
                            <div style="position: relative;">
                                <input type="password" name="new_password" id="new_password"
                                    style="width: 100%; padding: 12px 40px 12px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px;"
                                    placeholder="Enter new password (min. 6 characters)" required>
                                <span id="toggleNewPassword"
                                    style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                    <img src="{{ asset('images/eye-close.png') }}" alt="Show Password"
                                        style="width: 20px; height: 20px;" id="newPasswordEyeIcon">
                                </span>
                            </div>
                        </div>

                        <!-- Confirm New Password Field (With Toggle) -->
                        <div style="margin-bottom: 25px;">
                            <label style="display: block; margin-bottom: 8px; color: #333; font-weight: 500;">
                                Confirm New Password
                            </label>
                            <div style="position: relative;">
                                <input type="password" name="new_password_confirmation" id="confirm_password"
                                    style="width: 100%; padding: 12px 40px 12px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px;"
                                    placeholder="Confirm your new password" required>
                                <span id="toggleConfirmPassword"
                                    style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                    <img src="{{ asset('images/eye-close.png') }}" alt="Show Password"
                                        style="width: 20px; height: 20px;" id="confirmPasswordEyeIcon">
                                </span>
                            </div>
                        </div>

                        <div style="display: flex; gap: 15px;">
                            <a href="/admin/dashboard"
                                style="flex: 1; text-align: center; padding: 12px; background: #6c757d; color: white; text-decoration: none; border-radius: 8px; font-weight: 500;">
                                Cancel
                            </a>
                            <button type="submit"
                                style="flex: 1; padding: 12px; background: #004AAD; color: white; border: none; border-radius: 8px; font-weight: 500; cursor: pointer;">
                                Update Password
                            </button>
                        </div>

                        <!-- Success Message at Bottom -->
                        @if (session('success'))
                            <div id="success-message"
                                style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-top: 20px; border: 1px solid #c3e6cb; transition: opacity 1s ease;">
                                <strong>{{ session('success')['message'] }}</strong>
                                @if (isset(session('success')['new_password']))
                                    <div style="margin-top: 10px;">
                                        <strong>Your new password is: </strong>
                                        <span
                                            style="background: #fff; padding: 5px 10px; border-radius: 4px; font-family: monospace; border: 1px solid #ccc;">
                                            {{ session('success')['new_password'] }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        @endif
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
                profileDropdown.style.display =
                    profileDropdown.style.display === 'block' ? 'none' : 'block';
            });

            document.addEventListener('click', (e) => {
                if (!profileToggle.contains(e.target) && !profileDropdown.contains(e.target)) {
                    profileDropdown.style.display = 'none';
                }
            });

            // Password visibility toggle for new password
            const toggleNewPassword = document.getElementById('toggleNewPassword');
            const newPasswordInput = document.getElementById('new_password');
            const newPasswordEyeIcon = document.getElementById('newPasswordEyeIcon');

            toggleNewPassword.addEventListener('click', function() {
                if (newPasswordInput.type === 'password') {
                    newPasswordInput.type = 'text';
                    newPasswordEyeIcon.src = "{{ asset('images/eye-open.png') }}";
                } else {
                    newPasswordInput.type = 'password';
                    newPasswordEyeIcon.src = "{{ asset('images/eye-close.png') }}";
                }
            });

            // Password visibility toggle for confirm password
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const confirmPasswordInput = document.getElementById('confirm_password');
            const confirmPasswordEyeIcon = document.getElementById('confirmPasswordEyeIcon');

            toggleConfirmPassword.addEventListener('click', function() {
                if (confirmPasswordInput.type === 'password') {
                    confirmPasswordInput.type = 'text';
                    confirmPasswordEyeIcon.src = "{{ asset('images/eye-open.png') }}";
                } else {
                    confirmPasswordInput.type = 'password';
                    confirmPasswordEyeIcon.src = "{{ asset('images/eye-close.png') }}";
                }
            });

            // Auto-fade success message after 20 seconds
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.transition = 'opacity 3s ease';
                    successMessage.style.opacity = '0';

                    // Remove from DOM after fade completes
                    setTimeout(() => {
                        if (successMessage.parentNode) {
                            successMessage.parentNode.removeChild(successMessage);
                        }
                    }, 3000);
                }, 20000); // 20 seconds
            }

            // Auto-fade error message after 20 seconds
            const errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                setTimeout(() => {
                    errorMessage.style.transition = 'opacity 3s ease';
                    errorMessage.style.opacity = '0';

                    // Remove from DOM after fade completes
                    setTimeout(() => {
                        if (errorMessage.parentNode) {
                            errorMessage.parentNode.removeChild(errorMessage);
                        }
                    }, 3000);
                }, 20000); // 20 seconds
            }
        });
    </script>
@endsection
