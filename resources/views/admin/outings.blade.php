@extends('layouts.app')

@section('title', 'Student Outing Monitor')

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
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">Payments</a>
                    </li>
                    <li><a href="/admin/outings"
                            style="background: white; color: #004AAD; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">Outing</a>
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
                    <h2 style="color: #004AAD; margin: 0;">Student Outing Monitor</h2>
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

            <!-- ===== PAGE CONTENT ===== -->
            <div style="padding: 25px;">

                @if (session('success'))
                    <div
                        style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 25px; border: 1px solid #c3e6cb;">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div
                        style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 25px; border: 1px solid #f5c6cb;">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- ===== OVERVIEW CARDS ===== -->
                <div
                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
                    <!-- Currently Out Card -->
                    <div
                        style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align: center;">
                        <h3 style="color: #004AAD; margin: 0 0 10px 0;">Currently Out</h3>
                        <p style="font-size: 32px; font-weight: bold; color: #004AAD; margin: 0;">{{ $currentOutCount }}
                        </p>
                        <small style="color: #666;">students</small>
                    </div>

                    <!-- Recently Returned Card -->
                    <div
                        style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align: center;">
                        <h3 style="color: #28a745; margin: 0 0 10px 0;">Recently Returned</h3>
                        <p style="font-size: 32px; font-weight: bold; color: #28a745; margin: 0;">{{ $recentReturnCount }}
                        </p>
                        <small style="color: #666;">last 24 hours</small>
                    </div>

                    <!-- Overdue Card -->
                    <div
                        style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align: center;">
                        <h3 style="color: #dc3545; margin: 0 0 10px 0;">Overdue</h3>
                        <p style="font-size: 32px; font-weight: bold; color: #dc3545; margin: 0;">{{ $overdueCount }}</p>
                        <small style="color: #666;">past midnight</small>
                    </div>
                </div>

                <!-- ===== CURRENTLY OUT TABLE ===== -->
                <div
                    style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); margin-bottom: 30px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3 style="color: #004AAD; margin: 0;">Currently Out Students</h3>
                        <div style="display: flex; align-items: center; gap: 15px;">

                            <!-- Search Bar -->
                            <div style="position: relative;">
                                <form method="GET" action="{{ route('admin.outings') }}"
                                    style="display: flex; gap: 10px;">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder="Search by name, room, or destination..."
                                        style="padding: 10px 15px; border: 1px solid #ddd; border-radius: 6px; width: 300px; font-size: 14px; outline: none; transition: border-color 0.3s;"
                                        onfocus="this.style.borderColor='#004AAD'" onblur="this.style.borderColor='#ddd'">
                                    <button type="submit"
                                        style="background: #004AAD; color: white; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; transition: background 0.3s;"
                                        onmouseover="this.style.background='#003882'"
                                        onmouseout="this.style.background='#004AAD'">
                                        Search
                                    </button>
                                    @if (request('search'))
                                        <a href="{{ route('admin.outings') }}"
                                            style="background: #6c757d; color: white; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; transition: background 0.3s;"
                                            onmouseover="this.style.background='#545b62'"
                                            onmouseout="this.style.background='#6c757d'">
                                            Clear
                                        </a>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>

                    @if ($currentOutings->count() > 0)
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="background: #f8f9fa;">
                                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #e0e0e0;">
                                            Student</th>
                                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #e0e0e0;">
                                            Departure</th>
                                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #e0e0e0;">
                                            Expected Return</th>
                                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #e0e0e0;">
                                            Duration</th>
                                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #e0e0e0;">
                                            Destination</th>
                                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #e0e0e0;">
                                            Emergency Contact</th>
                                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #e0e0e0;">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="outingTableBody">
                                    @foreach ($currentOutings as $outing)
                                        <tr class="outing-row" style="border-bottom: 1px solid #e0e0e0;">
                                            <td style="padding: 12px;">
                                                <div style="display: flex; align-items: center; gap: 10px;">
                                                    @if ($outing->student->user && $outing->student->user->profile_picture)
                                                        <img src="{{ asset('storage/' . $outing->student->user->profile_picture) }}"
                                                            alt="Student"
                                                            style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                                    @else
                                                        <img src="{{ asset('images/student-avatar.png') }}"
                                                            alt="Student"
                                                            style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                                    @endif
                                                    <div>
                                                        <strong
                                                            class="student-name">{{ $outing->student->name ?? 'N/A' }}</strong><br>
                                                        <small class="student-room">Room:
                                                            {{ $outing->student->hostel_room ?? 'Not assigned' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="padding: 12px;">{{ $outing->departure_time->format('M j, g:i A') }}
                                            </td>
                                            <td style="padding: 12px;">
                                                {{ $outing->expected_return_time->format('M j, g:i A') }}</td>
                                            <td style="padding: 12px;">{{ $outing->duration }}</td>
                                            <td style="padding: 12px;" class="student-destination">
                                                {{ $outing->destination }}</td>
                                            <td style="padding: 12px;">
                                                {{ $outing->emergency_contact_number }}<br>
                                                <small>({{ $outing->emergency_contact_relationship }})</small>
                                            </td>
                                            <td style="padding: 12px;">
                                                <form action="{{ route('admin.outings.mark-returned', $outing->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit"
                                                        style="background: #28a745; color: white; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 12px; transition: background 0.3s;"
                                                        onmouseover="this.style.background='#218838'"
                                                        onmouseout="this.style.background='#28a745'">
                                                        Mark Returned
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div style="text-align: center; padding: 40px; color: #666;">
                            <h4 style="color: #004AAD; margin-bottom: 10px;">No Students Currently Out</h4>
                            <p>All students are currently in the hostel.</p>
                        </div>
                    @endif
                </div>

                <!-- ===== OVERDUE ALERTS TABLE ===== -->
                @if ($overdueOutings->count() > 0)
                    <div
                        style="background: #f8d7da; padding: 25px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); margin-bottom: 30px; border: 2px solid #dc3545;">
                        <h3 style="color: #dc3545; margin: 0 0 20px 0;">Overdue Students</h3>
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="background: #f8d7da;">
                                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dc3545;">
                                            Student</th>
                                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dc3545;">
                                            Expected Return</th>
                                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dc3545;">
                                            Overdue By</th>
                                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dc3545;">
                                            Destination</th>
                                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dc3545;">
                                            Emergency Contact</th>
                                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dc3545;">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($overdueOutings as $outing)
                                        <tr style="border-bottom: 1px solid #f5c6cb;">
                                            <td style="padding: 12px;">
                                                <div style="display: flex; align-items: center; gap: 10px;">
                                                    @if ($outing->student)
                                                        @if ($outing->student->user && $outing->student->user->profile_picture)
                                                            <img src="{{ asset('storage/' . $outing->student->user->profile_picture) }}"
                                                                alt="Student"
                                                                style="width: 40px; height: 40px; border-radius: 50%;">
                                                        @else
                                                            <img src="{{ asset('images/student-avatar.png') }}"
                                                                alt="Student"
                                                                style="width: 40px; height: 40px; border-radius: 50%;">
                                                        @endif
                                                        <div>
                                                            <strong>{{ $outing->student->name }}</strong><br>
                                                            <small>Room:
                                                                {{ $outing->student->hostel_room ?? 'Not assigned' }}</small>

                                                        </div>
                                                    @else
                                                        <img src="{{ asset('images/student-avatar.png') }}"
                                                            alt="Student"
                                                            style="width: 40px; height: 40px; border-radius: 50%;">
                                                        <div>
                                                            <strong>Student Not Found</strong><br>
                                                            <small>Room: N/A</small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td style="padding: 12px; color: #dc3545;">
                                                {{ $outing->expected_return_time->format('M j, g:i A') }}</td>
                                            <td style="padding: 12px; color: #dc3545; font-weight: bold;">
                                                {{ $outing->overdue_duration }}</td>
                                            <td style="padding: 12px;">{{ $outing->destination }}</td>
                                            <td style="padding: 12px;">
                                                {{ $outing->emergency_contact_number }}<br>
                                                <small>({{ $outing->emergency_contact_relationship }})</small>
                                            </td>
                                            <td style="padding: 12px;">
                                                <form action="{{ route('admin.outings.mark-returned', $outing->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit"
                                                        style="background: #dc3545; color: white; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 12px; transition: background 0.3s;"
                                                        onmouseover="this.style.background='#c82333'"
                                                        onmouseout="this.style.background='#dc3545'">
                                                        Mark Returned & Call
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <!-- ===== RECENTLY RETURNED TABLE ===== -->
                <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3 style="color: #28a745; margin: 0;">Recently Returned Students</h3>
                        <select onchange="window.location.href = '?return_filter=' + this.value"
                            style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; background: white;">
                            <option value="24hours" {{ $timeFilter == '24hours' ? 'selected' : '' }}>Last 24 Hours
                            </option>
                            <option value="3days" {{ $timeFilter == '3days' ? 'selected' : '' }}>Last 3 Days</option>
                            <option value="1week" {{ $timeFilter == '1week' ? 'selected' : '' }}>Last Week</option>
                            <option value="1month" {{ $timeFilter == '1month' ? 'selected' : '' }}>Last Month</option>
                            <option value="all" {{ $timeFilter == 'all' ? 'selected' : '' }}>All Time</option>
                        </select>
                    </div>

                    @if ($recentReturns->count() > 0)
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="background: #f8f9fa;">
                                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #e0e0e0;">
                                            Student</th>
                                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #e0e0e0;">
                                            Actual Return</th>
                                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #e0e0e0;">
                                            Total Duration</th>
                                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #e0e0e0;">
                                            Destination</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentReturns as $outing)
                                        <tr style="border-bottom: 1px solid #e0e0e0;">
                                            <td style="padding: 12px;">
                                                <div style="display: flex; align-items: center; gap: 10px;">
                                                    @if ($outing->student)
                                                        @if ($outing->student->user && $outing->student->user->profile_picture)
                                                            <img src="{{ asset('storage/' . $outing->student->user->profile_picture) }}"
                                                                alt="Student"
                                                                style="width: 40px; height: 40px; border-radius: 50%;">
                                                        @else
                                                            <img src="{{ asset('images/student-avatar.png') }}"
                                                                alt="Student"
                                                                style="width: 40px; height: 40px; border-radius: 50%;">
                                                        @endif
                                                        <div>
                                                            <strong>{{ $outing->student->name }}</strong><br>
                                                            <small>Room:
                                                                {{ $outing->student->hostel_room ?? 'Not assigned' }}</small>
                                                        </div>
                                                    @else
                                                        <img src="{{ asset('images/student-avatar.png') }}"
                                                            alt="Student"
                                                            style="width: 40px; height: 40px; border-radius: 50%;">
                                                        <div>
                                                            <strong>Student Not Found</strong><br>
                                                            <small>Room: N/A</small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td style="padding: 12px;">
                                                {{ $outing->actual_return_time->format('M j, g:i A') }}</td>
                                            <td style="padding: 12px;">{{ $outing->duration }}</td>
                                            <td style="padding: 12px;">{{ $outing->destination }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div style="margin-top: 20px; display: flex; justify-content: center;">
                            {{ $recentReturns->links() }}
                        </div>
                    @else
                        <div style="text-align: center; padding: 40px; color: #666;">
                            <h4 style="color: #28a745; margin-bottom: 10px;">No Return Records</h4>
                            <p>No students have returned in the selected time period.</p>
                        </div>
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

            // ===== Sidebar toggle =====
            menuToggle.addEventListener('click', () => {
                if (sidebar.style.left === '0px') {
                    sidebar.style.left = '-250px';
                    mainContent.style.marginLeft = '0';
                } else {
                    sidebar.style.left = '0';
                    mainContent.style.marginLeft = '250px';
                }
            });

            // ===== Profile dropdown =====
            profileToggle.addEventListener('click', () => {
                profileDropdown.style.display =
                    profileDropdown.style.display === 'block' ? 'none' : 'block';
            });
            document.addEventListener('click', (e) => {
                if (!profileToggle.contains(e.target) && !profileDropdown.contains(e.target)) {
                    profileDropdown.style.display = 'none';
                }
            });

            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const outingRows = document.querySelectorAll('.outing-row');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                outingRows.forEach(row => {
                    const studentName = row.querySelector('.student-name').textContent
                        .toLowerCase();
                    const studentRoom = row.querySelector('.student-room').textContent
                        .toLowerCase();
                    const studentDestination = row.querySelector('.student-destination').textContent
                        .toLowerCase();

                    const matchesSearch = studentName.includes(searchTerm) ||
                        studentRoom.includes(searchTerm) ||
                        studentDestination.includes(searchTerm);

                    row.style.display = matchesSearch ? '' : 'none';
                });
            });
        });
    </script>
@endsection
