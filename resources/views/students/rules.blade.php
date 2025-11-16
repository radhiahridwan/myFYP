@extends('layouts.app')

@section('title', 'Student Rules')

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
                            style="background: rgba(255, 255, 255, 0.544); color: #004AAD; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">
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
                    <h2 style="color: #004AAD; margin: 0;">Student Rules</h2>
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
                                    style="width: 20px; height: 20px;"> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- ===== RULES CONTENT ===== -->
            <div style="padding: 25px; width: 100%; max-width: 800px; margin: auto;">
                <h3 style="color: #004AAD; margin-bottom: 20px;">🏡 Hostel Rules & Regulations</h3>
                <p style="color: #555; margin-bottom: 25px;">Please read and follow the rules below carefully. Click a rule
                    to expand and view details.</p>

                @if (isset($rules) && $rules->count() > 0)
                    <div class="accordion">
                        @foreach ($rules as $rule)
                            <div class="accordion-item"
                                style="margin-bottom: 12px; background: white; border-radius: 10px; box-shadow: 0 3px 8px rgba(0,0,0,0.1); overflow: hidden;">
                                <button class="accordion-header"
                                    style="width: 100%; text-align: left; background: none; border: none; padding: 15px 20px; font-size: 16px; font-weight: 500; color: #004AAD; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                                    <span>{{ $rule->title }}</span>
                                    <span class="arrow" style="transition: transform 0.3s;">▼</span>
                                </button>
                                <div class="accordion-content"
                                    style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease, padding 0.3s ease; padding: 0 20px;">
                                    <div style="color: #333; font-size: 15px; line-height: 1.6; margin: 10px 0;">
                                        @if ($rule->image)
                                            <img src="{{ asset('storage/' . $rule->image) }}" alt="Rule Image"
                                                style="width:200px; border-radius:8px; margin-bottom:10px; display:block;">
                                        @endif
                                        {!! $rule->description !!}
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="color: #555;">No rules found.</p>
                @endif
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
                sidebar.style.left = (sidebar.style.left === '0px') ? '-250px' : '0';
                mainContent.style.marginLeft = (sidebar.style.left === '0px') ? '250px' : '0';
            });

            // Profile dropdown toggle
            profileToggle.addEventListener('click', () => {
                profileDropdown.style.display = (profileDropdown.style.display === 'block') ? 'none' :
                    'block';
            });

            document.addEventListener('click', (e) => {
                if (!profileToggle.contains(e.target) && !profileDropdown.contains(e.target)) {
                    profileDropdown.style.display = 'none';
                }
            });

            // Accordion functionality
            const accordions = document.querySelectorAll('.accordion-header');
            accordions.forEach(header => {
                header.addEventListener('click', () => {
                    const item = header.parentElement;
                    const content = header.nextElementSibling;
                    const arrow = header.querySelector('.arrow');
                    const isOpen = content.style.maxHeight && content.style.maxHeight !== '0px';

                    // Close all other accordions
                    document.querySelectorAll('.accordion-content').forEach(c => {
                        c.style.maxHeight = '0';
                        c.style.padding = '0 20px';
                    });
                    document.querySelectorAll('.arrow').forEach(a => a.style.transform =
                        'rotate(0deg)');

                    // Toggle this one
                    if (!isOpen) {
                        content.style.maxHeight = content.scrollHeight + 'px';
                        content.style.padding = '15px 20px';
                        arrow.style.transform = 'rotate(180deg)';
                    }
                });
            });

            // Fullscreen image modal for student view
            const studentModal = document.createElement('div');
            studentModal.id = 'studentImageModal';
            studentModal.style.cssText =
                'display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); justify-content:center; align-items:center; z-index:2000;';
            const studentModalImg = document.createElement('img');
            studentModalImg.style.cssText = 'max-width:90%; max-height:90%; border-radius:8px;';
            studentModal.appendChild(studentModalImg);
            document.body.appendChild(studentModal);

            studentModal.addEventListener('click', () => {
                studentModal.style.display = 'none';
            });

            // Make rule images clickable
            document.querySelectorAll('.accordion-content img').forEach(img => {
                img.style.cursor = 'pointer';
                img.addEventListener('click', () => {
                    studentModalImg.src = img.src;
                    studentModal.style.display = 'flex';
                });
            });

        });
    </script>
@endsection
