@extends('layouts.app')

@section('title', 'Payments')

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
                    <h2 style="color: #004AAD; margin: 0;">Student Dashboard</h2>
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


            <!-- ===== PAYMENTS CONTENT ===== -->
            <div style="padding: 25px; width: 100%; max-width: 1200px; margin: auto;">
                <h3 style="color: #004AAD; margin-bottom: 20px;">Welcome, {{ Auth::user()->name ?? 'Student' }}</h3>
                <!-- Back Button -->
                <div style="margin-bottom: 20px;">
                    <a href="{{ route('students.dashboard') }}"
                        style="background: #6c757d; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-size: 14px;">
                        ← Back
                    </a>
                </div>
                <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">

                    <!-- Payment Methods Section -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">

                        <!-- ePay Method Card -->
                        <div
                            style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); border-left: 4px solid #004AAD;">
                            <h4 style="color: #004AAD; margin-bottom: 15px; display: flex; align-items: center; gap: 8px;">
                                ePay Method
                            </h4>
                            <p style="color: #555; margin-bottom: 15px; line-height: 1.5;">
                                Pay through the official ePay system. This method requires UPTM email.
                            </p>
                            <div
                                style="background: #fff9e6; border: 1px solid #ffd166; border-radius: 8px; padding: 12px; margin-bottom: 15px;">
                                <p style="color: #856404; margin: 0; font-size: 14px; line-height: 1.4;">
                                    <strong>Note:</strong> Only recognizes UPTM email (klxxxxxxxxxx@student.uptm.edu.my)
                                </p>
                            </div>
                            <a href="http://epay.kptm.edu.my" target="_blank"
                                style="display: inline-block; background: #004AAD; color: white; padding: 12px 24px; border-radius: 12px; text-decoration: none; font-weight: 500; transition: background 0.3s;">
                                Go to ePay Portal
                            </a>
                        </div>

                        <!-- JomPay Method Card -->
                        <div
                            style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); border-left: 4px solid #28a745;">
                            <h4 style="color: #28a745; margin-bottom: 15px; display: flex; align-items: center; gap: 8px;">
                                JomPay Method
                            </h4>
                            <p style="color: #555; margin-bottom: 15px; line-height: 1.5;">
                                Pay through JomPay using the following details:
                            </p>
                            <div style="background: #f8f9fa; border-radius: 10px; padding: 15px; margin-bottom: 15px;">
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                    <div>
                                        <strong style="color: #333;">Biller Code:</strong>
                                    </div>
                                    <div style="font-family: monospace; font-weight: bold; color: #004AAD;">
                                        88070
                                    </div>
                                    <div>
                                        <strong style="color: #333;">Reference 1:</strong>
                                    </div>
                                    <div style="font-family: monospace; font-weight: bold; color: #ad0000;">
                                        {{ Auth::user()->student_id ?? 'Your Student ID' }}
                                    </div>
                                    <div>
                                        <strong style="color: #333;">Reference 2:</strong>
                                    </div>
                                    <div style="font-family: monospace; color: #666;">
                                        Type of payment (e.g. hostel fee)
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Upload Receipt Card -->
                    <div
                        style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                        <h4 style="color: #004AAD; margin-bottom: 15px;">Upload Payment Receipt</h4>
                        <form action="{{ route('students.payments.upload') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div style="margin-bottom: 15px;">
                                <label for="receipt" style="display: block; margin-bottom: 5px; font-weight: 500;">Select
                                    File:</label>
                                <input type="file" name="receipt" id="receipt" required accept=".jpg,.jpeg,.png,.pdf"
                                    style="padding: 10px; border-radius: 8px; border: 1px solid #ccc; width: 100%;">
                                <small style="color: #666; margin-top: 5px; display: block;">Accepted formats: JPG, PNG,
                                    PDF
                                    (Max: 5MB)</small>
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label for="amount" style="display: block; margin-bottom: 5px; font-weight: 500;">Amount
                                    Paid (RM):</label>
                                <input type="number" name="amount" id="amount" step="0.01" min="0"
                                    required placeholder="0.00"
                                    style="padding: 10px; border-radius: 8px; border: 1px solid #ccc; width: 100%;">
                            </div>
                            <button type="submit"
                                style="background: #004AAD; color: white; padding: 12px 20px; border-radius: 12px; border: none; cursor: pointer; font-weight: 500; transition: background 0.3s;">
                                Submit Receipt
                            </button>
                        </form>
                    </div>

                    <!-- Payment Status Table -->
                    <div
                        style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                        <h4 style="color: #004AAD; margin-bottom: 15px;">Your Payment Status</h4>
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background: #004AAD; color: white;">
                                    <th style="padding: 10px; text-align: left;">Date</th>
                                    <th style="padding: 10px; text-align: left;">Amount (RM)</th>
                                    <th style="padding: 10px; text-align: left;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr style="background: white; border-bottom: 1px solid #eee;">
                                        <td style="padding: 10px;">{{ $payment->created_at->format('d M Y') }}</td>
                                        <td style="padding: 10px;">RM {{ number_format($payment->amount, 2) }}</td>
                                        <td style="padding: 10px;">
                                            @if ($payment->status == 'pending')
                                                <span style="color: orange; font-weight: 500;">Pending</span>
                                            @elseif($payment->status == 'paid')
                                                <span style="color: green; font-weight: 500;">Paid</span>
                                            @elseif($payment->status == 'rejected')
                                                <span style="color: red; font-weight: 500;">Rejected</span>
                                            @else
                                                <span style="color: #666; font-weight: 500;">{{ $payment->status }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($payments->isEmpty())
                                    <tr>
                                        <td colspan="3" style="padding: 10px; text-align: center; color: #555;">No
                                            payments submitted yet.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
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

            // Close profile dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!profileToggle.contains(e.target) && !profileDropdown.contains(e.target)) {
                    profileDropdown.style.display = 'none';
                }
            });
        });
    </script>
@endsection
