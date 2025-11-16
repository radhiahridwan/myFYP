@extends('layouts.app')

@section('title', 'Manage Payments')

@section('content')
    <div class="admin-dashboard"
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
        padding: 20px 0;
        box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        transition: left 0.3s ease;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    ">
            <div>
                <div style="text-align:center; margin-bottom: 25px;">
                    <img src="{{ asset('images/uptm-logo.png') }}" alt="UPTM Logo"
                        style="width: 100%; max-width: 180px; height: auto; display: block; margin: 0 auto 10px;">
                    <h3 style="font-size: 16px; color: white; margin: 0;">SISWI Management</h3>
                </div>

                <ul style="list-style: none; padding: 0 20px; line-height: 2;">
                    <li><a href="/admin/dashboard"
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">Dashboard</a>
                    </li>
                    <li><a href="/admin/students"
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">Students</a>
                    </li>
                    <li><a href="/admin/houses"
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">Houses</a>
                    </li>
                    <li><a href="/admin/forms"
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">Forms</a>
                    </li>
                    <li><a href="/admin/payments"
                            style="background: white; color: #004AAD; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">Payments</a>
                    </li>
                    <li><a href="/admin/outings"
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">Outing</a>
                    </li>
                    <li><a href="/admin/rules"
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">Rules</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- ===== MAIN CONTENT ===== -->
        <div id="main-content" style="flex-grow: 1; width: 100%; transition: margin-left 0.3s ease;">

            <!-- ===== TOP NAVBAR ===== -->
            <div
                style="display: flex; justify-content: space-between; align-items: center; background: white; padding: 15px 25px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 999;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <span id="menu-toggle" style="font-size: 26px; cursor: pointer; color: #004AAD;">☰</span>
                    <h2 style="color: #004AAD; margin: 0;">Manage Payments</h2>
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
            <div style="padding: 25px; width: 100%; max-width: 1400px; margin: auto;">

                @if (session('success'))
                    <div
                        style="background: #d4edda; color: #155724; padding: 12px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- ===== PAYMENT SUMMARY CARDS ===== -->
                <div style="display: flex; gap: 20px; margin-bottom: 30px; flex-wrap: wrap;">
                    <div
                        style="flex: 1; min-width: 200px; background: #004AAD; color: white; border-radius: 16px; padding: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align: center;">
                        <h3>Total Students</h3>
                        <p style="font-size: 24px; font-weight: bold;">{{ $totalStudents }}</p>
                    </div>
                    <div
                        style="flex: 1; min-width: 200px; background: #28a745; color: white; border-radius: 16px; padding: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align: center;">
                        <h3>Total Paid</h3>
                        <p style="font-size: 24px; font-weight: bold;">{{ $totalPaid }}</p>
                    </div>
                    <div
                        style="flex: 1; min-width: 200px; background: #ffc107; color: white; border-radius: 16px; padding: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align: center;">
                        <h3>Total Pending</h3>
                        <p style="font-size: 24px; font-weight: bold;">{{ $totalPending }}</p>
                    </div>
                    <div
                        style="flex: 1; min-width: 200px; background: #dc3545; color: white; border-radius: 16px; padding: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align: center;">
                        <h3>Total Rejected</h3>
                        <p style="font-size: 24px; font-weight: bold;">
                            {{ $payments->where('status', 'rejected')->count() }}
                        </p>
                    </div>
                </div>



                <!-- ===== PAYMENT TABLE ===== -->
                <div
                    style="background: white; border-radius: 16px; padding: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow-x:auto;">
                    <h4 style="color: #004AAD; margin-bottom: 15px;">Student Payments</h4>

                    <!-- ===== SEARCH BAR ===== -->
                    <div style="margin-bottom: 20px;">
                        <form method="GET" action="{{ route('admin.payments') }}"
                            style="display: flex; gap: 10px; align-items: center;">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search by student name or ID..."
                                style="flex: 1; padding: 12px 16px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;">
                            <button type="submit"
                                style="background: #004AAD; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-size: 14px;">
                                Search
                            </button>

                        </form>
                    </div>
                    <table style="width: 100%; border-collapse: collapse; text-align:left; min-width: 800px;">
                        <thead>
                            <tr style="background: #004AAD; color: white;">
                                <th style="padding: 12px;">Name</th>
                                <th style="padding: 12px;">ID</th>
                                <th style="padding: 12px;">Amount Paid</th>
                                <th style="padding: 12px;">Status</th>
                                <th style="padding: 12px;">Date</th>
                                <th style="padding: 12px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payments as $payment)
                                <tr style="border-bottom: 1px solid #eee;">
                                    <td style="padding: 12px;">
                                        {{ $payment->user->student->name ?? 'N/A' }}
                                    </td>
                                    <td style="padding: 12px; font-weight: 500;">
                                        {{ $payment->user->student->student_id ?? 'N/A' }}
                                    </td>
                                    <td style="padding: 12px; font-weight: bold;">RM
                                        {{ number_format($payment->amount, 2) }}</td>
                                    <td style="padding: 12px;">
                                        <span
                                            style="
                        padding: 6px 12px;
                        border-radius: 20px;
                        font-size: 12px;
                        font-weight: 500;
                        @if ($payment->status == 'pending') background: #fff3cd; color: #856404; border: 1px solid #ffeaa7;
                        @elseif($payment->status == 'paid') 
                            background: #d1edff; color: #005503; border: 1px solid #62ea6b;
                        @elseif($payment->status == 'rejected') 
                            background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; @endif
                    ">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    </td>
                                    <td style="padding: 12px;">{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                                    <td style="padding: 12px;">
                                        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                            <!-- View Receipt Button -->
                                            @if ($payment->receipt)
                                                <a href="{{ route('admin.payments.receipt', $payment->id) }}"
                                                    target="_blank"
                                                    style="background: #004AAD; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px;">
                                                    View Receipt
                                                </a>
                                                <a href="{{ route('admin.payments.download', $payment->id) }}"
                                                    style="background: #28a745; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px;">
                                                    Download
                                                </a>
                                            @else
                                                <span style="color: #666; font-size: 12px;">No Receipt</span>
                                            @endif

                                            <!-- Status Update Form -->
                                            <form method="POST"
                                                action="{{ route('admin.payments.update', $payment->id) }}"
                                                style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" onchange="this.form.submit()"
                                                    style="padding: 6px 10px; border-radius: 6px; border: 1px solid #ccc; font-size: 12px; background: white;">
                                                    <option value="pending"
                                                        {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending
                                                    </option>
                                                    <option value="paid"
                                                        {{ $payment->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                                    <option value="rejected"
                                                        {{ $payment->status == 'rejected' ? 'selected' : '' }}>Rejected
                                                    </option>
                                                </select>
                                            </form>

                                            <!-- Delete Button -->
                                            <form method="POST"
                                                action="{{ route('admin.payments.destroy', $payment->id) }}"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this payment record?')"
                                                    style="background: #dc3545; color: white; padding: 6px 12px; border-radius: 6px; border: none; cursor: pointer; font-size: 12px;">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align:center; padding: 20px; color: #666;">
                                        No payment records found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>


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
    </script>
@endsection
