@extends('layouts.app')

@section('title', 'Student Profile')

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
                    <h2 style="color: #004AAD; margin: 0;">Student Profile</h2>
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
                            style="background: rgba(0, 74, 173, 0.1); display: flex; align-items: center; gap: 8px; padding: 10px 15px; color: #004AAD; text-decoration: none; border-left: 3px solid #004AAD;">
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



            <!-- ===== ERROR MESSAGES ONLY ===== -->
            @if (session('error'))
                <div id="error-message"
                    style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin: 20px auto; width: 90%; max-width: 800px; border: 1px solid #f5c6cb;">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div
                    style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin: 20px auto; width: 90%; max-width: 800px; border: 1px solid #f5c6cb;">
                    <strong>Please fix the following errors:</strong>
                    <ul style="margin: 10px 0 0 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- ===== PROFILE VIEW CARD ===== -->
            <div id="profile-card"
                style="padding: 40px; width: 100%; max-width: 700px; margin: 40px auto; background: white; border-radius: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align: center;">
                <!-- Profile Picture -->
                <div style="margin-bottom: 25px;">
                    <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/student-avatar.png') }}"
                        style="width: 150px; height: 150px; border-radius: 50%; border: 4px solid #004AAD; object-fit: cover; margin: 0 auto 20px;">
                </div>

                <!-- Student Information -->
                <div style="margin-bottom: 30px;">
                    <h2 style="color: #004AAD; margin-bottom: 25px; font-size: 24px;">{{ $student->name ?? 'N/A' }}</h2>

                    <div
                        style="display: flex; flex-direction: column; gap: 12px; text-align: left; max-width: 500px; margin: 0 auto;">
                        <div
                            style="display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 8px;">
                            <strong style="color: #333; min-width: 120px;">Student ID:</strong>
                            <span style="color: #666; text-align: right; flex: 1;">{{ $student->student_id ?? '-' }}</span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 8px;">
                            <strong style="color: #333; min-width: 120px;">Room Number:</strong>
                            <span
                                style="color: #666; text-align: right; flex: 1;">{{ $student->hostel_room ?? '-' }}</span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 8px;">
                            <strong style="color: #333; min-width: 120px;">Course:</strong>
                            <span style="color: #666; text-align: right; flex: 1;">{{ $student->course ?? '-' }}</span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 8px;">
                            <strong style="color: #333; min-width: 120px;">Phone Number:</strong>
                            <span
                                style="color: #666; text-align: right; flex: 1;">{{ $student->phone_number ?? '-' }}</span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 8px;">
                            <strong style="color: #333; min-width: 120px;">Email:</strong>
                            <span style="color: #666; text-align: right; flex: 1;">{{ $user->email ?? '-' }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <strong style="color: #333; min-width: 120px;">Address:</strong>
                            <span
                                style="color: #666; text-align: right; flex: 1; line-height: 1.4;">{{ $student->address ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Success Message INSIDE the card, before edit button -->
                @if (session('success'))
                    <div id="success-message"
                        style="background: #d4edda; color: #155724; padding: 12px 20px; border-radius: 8px; margin: 0 auto 20px auto; width: 90%; max-width: 400px; border: 1px solid #c3e6cb; font-size: 14px;">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Edit Button -->
                <button id="edit-profile-btn"
                    style="background: #004AAD; color: white; padding: 12px 30px; border: none; border-radius: 8px; cursor: pointer; font-size: 14px; font-weight: 500;">
                    Edit Profile
                </button>
            </div>
        </div>
    </div>

    <!-- ===== EDIT PROFILE MODAL ===== -->
    <div id="edit-profile-modal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1001; align-items: center; justify-content: center;">
        <div
            style="background: white; border-radius: 20px; padding: 30px; width: 90%; max-width: 500px; max-height: 90vh; overflow-y: auto; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                <h3 style="color: #004AAD; margin: 0;">Edit Your Profile</h3>
                <button id="close-modal-btn"
                    style="background: none; border: none; font-size: 24px; cursor: pointer; color: #666;">&times;</button>
            </div>

            <!-- FORM WITH POST METHOD - NO METHOD SPOOFING -->
            <form action="{{ route('students.profile.update') }}" method="POST" enctype="multipart/form-data"
                id="profile-form">
                @csrf
                <!-- NO @method('PUT') - USING POST DIRECTLY -->

                <!-- Profile Picture -->
                <div style="text-align: center; margin-bottom: 25px;">
                    <img id="profile-preview"
                        src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/student-avatar.png') }}"
                        style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid #004AAD; object-fit: cover; margin-bottom: 15px;">
                    <br>
                    <label for="profile_picture_input"
                        style="background: #004AAD; color: white; padding: 8px 15px; border-radius: 8px; cursor: pointer; font-size: 14px; display: inline-block;">
                        📷 Change Photo
                    </label>
                    <input type="file" name="profile_picture" accept="image/*" id="profile_picture_input"
                        style="display: none;">
                </div>

                <!-- Form Fields -->
                <div style="display: flex; flex-direction: column; gap: 15px; margin-bottom: 20px;">
                    <!-- Name -->
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #333;">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $student->name ?? '') }}" required
                            style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd; font-size: 14px;">
                    </div>

                    <!-- Student ID -->
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #333;">Student
                            ID</label>
                        <input type="text" name="student_id"
                            value="{{ old('student_id', $student->student_id ?? '') }}" required
                            style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd; font-size: 14px;">
                    </div>

                    <!-- Course -->
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #333;">Course</label>
                        <input type="text" name="course" value="{{ old('course', $student->course ?? '') }}"
                            required
                            style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd; font-size: 14px;">
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #333;">Phone
                            Number</label>
                        <input type="text" name="phone_number"
                            value="{{ old('phone_number', $student->phone_number ?? '') }}"
                            style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd; font-size: 14px;">
                    </div>

                    <!-- Room Number -->
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #333;">Room
                            Number</label>
                        <select name="hostel_room"
                            style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd; font-size: 14px;">
                            <option value="">Select Room</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->room_number }}"
                                    {{ old('hostel_room', $student->hostel_room) == $room->room_number ? 'selected' : '' }}>
                                    {{ $room->room_number }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Email -->
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #333;">Email</label>
                        <input type="email" value="{{ $user->email }}" disabled
                            style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd; font-size: 14px; background: #f5f5f5; color: #666;">
                        <small style="color: #999; font-size: 12px;">Email cannot be changed</small>
                    </div>

                    <!-- Address -->
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #333;">Address</label>
                        <textarea name="address" placeholder="Enter your address"
                            style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd; font-size: 14px; resize: vertical; min-height: 80px;">{{ old('address', $student->address ?? '') }}</textarea>
                    </div>
                </div>

                <!-- Buttons -->
                <div style="display: flex; gap: 15px; justify-content: flex-end;">
                    <button type="button" id="cancel-edit-btn"
                        style="background: #6c757d; color: white; padding: 12px 25px; border-radius: 8px; border: none; cursor: pointer; font-size: 14px; font-weight: 500;">
                        Cancel
                    </button>
                    <button type="submit"
                        style="background: #004AAD; color: white; padding: 12px 25px; border-radius: 8px; border: none; cursor: pointer; font-size: 14px; font-weight: 500;">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const menuToggle = document.getElementById('menu-toggle');
            const profileToggle = document.getElementById('profile-toggle');
            const profileDropdown = document.getElementById('profile-dropdown');

            // Modal elements
            const editBtn = document.getElementById('edit-profile-btn');
            const cancelBtn = document.getElementById('cancel-edit-btn');
            const closeModalBtn = document.getElementById('close-modal-btn');
            const editModal = document.getElementById('edit-profile-modal');
            const profileCard = document.getElementById('profile-card');

            // Sidebar toggle
            menuToggle.addEventListener('click', () => {
                sidebar.style.left = sidebar.style.left === '0px' ? '-250px' : '0';
                mainContent.style.marginLeft = sidebar.style.left === '0px' ? '250px' : '0';
            });

            // Profile dropdown
            profileToggle.addEventListener('click', () => {
                profileDropdown.style.display =
                    profileDropdown.style.display === 'block' ? 'none' : 'block';
            });

            document.addEventListener('click', (e) => {
                if (!profileToggle.contains(e.target) && !profileDropdown.contains(e.target)) {
                    profileDropdown.style.display = 'none';
                }
            });

            // Edit modal functionality
            editBtn.addEventListener('click', () => {
                editModal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            });

            function closeModal() {
                editModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }

            cancelBtn.addEventListener('click', closeModal);
            closeModalBtn.addEventListener('click', closeModal);

            // Close modal when clicking outside
            editModal.addEventListener('click', (e) => {
                if (e.target === editModal) {
                    closeModal();
                }
            });

            // Profile picture preview
            const profileInput = document.getElementById('profile_picture_input');
            const profilePreview = document.getElementById('profile-preview');

            profileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        profilePreview.src = event.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Auto-hide success message after 5 seconds
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 5000);
            }

            // Auto-hide error message after 5 seconds
            const errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                setTimeout(() => {
                    errorMessage.style.display = 'none';
                }, 5000);
            }
        });
    </script>
@endsection
