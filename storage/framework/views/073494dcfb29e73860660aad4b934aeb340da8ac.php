

<?php $__env->startSection('title', 'Manage Students'); ?>

<?php $__env->startSection('content'); ?>
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
                    <img src="<?php echo e(asset('images/uptm-logo.png')); ?>" alt="UPTM Logo"
                        style="width: 100%; max-width: 180px; height: auto; display: block; margin: 0 auto 10px;">
                    <h3 style="font-size: 16px; color: white; margin: 0;">SISWI Management</h3>
                </div>

                <ul style="list-style: none; padding: 0 20px; line-height: 2;">
                    <li><a href="/admin/dashboard"
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px;"> Dashboard</a>
                    </li>
                    <li><a href="/admin/students"
                            style="background: white; color: #004AAD; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">
                            Students</a></li>
                    <li><a href="/admin/houses"
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px;"> Houses</a>
                    </li>
                    <li><a href="/admin/forms"
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px;"> Forms</a>
                    </li>
                    <li><a href="/admin/payments"
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px;"> Payments</a>
                    </li>
                    <li><a href="/admin/outings"
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px;"> Outing</a>
                    </li>
                    <li><a href="/admin/rules"
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px;"> Rules</a>
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
                    <h2 style="color: #004AAD; margin: 0;">Manage Students</h2>
                </div>

                <!-- Profile Dropdown -->
                <div style="position: relative;">
                    <img src="<?php echo e(auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/admin-avatar.png')); ?>"
                        alt="Admin" id="profile-toggle"
                        style="width: 45px; height: 45px; border-radius: 50%; cursor: pointer; border: 2px solid #004AAD;">
                    <div id="profile-dropdown"
                        style=" display: none; position: absolute; right: 0; top: 55px; background: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 220px; overflow: hidden; ">
                        <div style="padding: 15px; border-bottom: 1px solid #eee;">
                            <strong><?php echo e(Auth::user()->name ?? 'Admin'); ?></strong><br>
                            <small><?php echo e(Auth::user()->email ?? 'admin@uptm.edu.my'); ?></small>
                        </div>

                        <a href="/admin/profile"
                            style="display: flex; align-items: center; gap: 8px; padding: 10px 15px; color: #004AAD; text-decoration: none;">
                            <img src="<?php echo e(asset('images/profile.png')); ?>" alt="Profile" style="width: 20px; height: 20px;">
                            Edit Profile
                        </a>

                        <a href="/admin/settings"
                            style="display: flex; align-items: center; gap: 8px; padding: 10px 15px; color: #004AAD; text-decoration: none;">
                            <img src="<?php echo e(asset('images/setting-icon.png')); ?>" alt="Settings"
                                style="width: 20px; height: 20px;">
                            Setting
                        </a>

                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit"
                                style="background: none; border: none; width: 100%; text-align: left; padding: 10px 15px; color: red; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                                <img src="<?php echo e(asset('images/logout.png')); ?>" alt="Logout"
                                    style="width: 20px; height: 20px;">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- ===== STUDENTS TABLE ===== -->
            <div style="padding: 25px; width: 100%; max-width: 1400px; margin: auto;">
                <div
                    style="background: white; border-radius: 16px; padding: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow-x:auto;">

                    <h4 style="color: #004AAD; margin-bottom: 15px;">Students List</h4>

                    <!-- ===== SEARCH BAR ===== -->
                    <div style="margin-bottom: 20px;">
                        <form method="GET" action="<?php echo e(route('admin.students')); ?>"
                            style="display: flex; gap: 10px; align-items: center;">
                            <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                                placeholder="Search by student name or ID..."
                                style="flex: 1; padding: 12px 16px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;">
                            <button type="submit"
                                style="background: #004AAD; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-size: 14px;">
                                Search
                            </button>

                        </form>
                    </div>

                    <table style="width: 100%; border-collapse: collapse; text-align:left;">
                        <thead>
                            <tr style="background: #004AAD; color: white;">
                                <th style="padding: 10px;">Name</th>
                                <th style="padding: 10px;">Student ID</th>
                                <th style="padding: 10px;">Room Number</th>
                                <th style="padding: 10px;">Phone Number</th>
                                <th style="padding: 10px;">Email</th>
                                <th style="padding: 10px;">Address</th>
                                <th style="padding: 10px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="student-table">
                            <tr>
                                <td colspan="7" style="text-align:center; padding: 10px;">Loading...</td>
                            </tr>
                        </tbody>
                    </table>

                    <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                        <a href="/admin/students/export/pdf"
                            style="background: #dc3545; color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none;">Download
                            PDF</a>
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
            const searchForm = document.getElementById('searchForm');

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

            // Search form handler
            if (searchForm) {
                searchForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    loadStudents();
                });
            }

            // ===== Fetch Students =====
            function loadStudents() {
                const searchInput = document.querySelector('input[name="search"]');
                const searchTerm = searchInput ? searchInput.value : '';

                let url = '/admin/api/students';
                if (searchTerm) {
                    url += `?search=${encodeURIComponent(searchTerm)}`;
                }

                fetch(url)
                    .then(res => res.json())
                    .then(students => {
                        const tbody = document.getElementById('student-table');
                        if (students.length === 0) {
                            tbody.innerHTML =
                                `<tr><td colspan="7" style="text-align:center; padding:10px;">
                                ${searchTerm ? 'No students found for "' + searchTerm + '"' : 'No students found'}
                            </td></tr>`;
                            return;
                        }

                        tbody.innerHTML = students.map(s => `
                        <tr id="student-${s.id}">
                            <td style="padding:10px;">
                                <span class="student-name">${s.name}</span>
                                <input type="text" class="edit-input" value="${s.name}" style="display:none; width:100%; padding:5px; border:1px solid #ddd; border-radius:4px;">
                            </td>
                            <td style="padding:10px;">
                                <span class="student-id">${s.student_id}</span>
                                <input type="text" class="edit-input" value="${s.student_id}" style="display:none; width:100%; padding:5px; border:1px solid #ddd; border-radius:4px;">
                            </td>
                            <td style="padding:10px;">
                                <span class="room-number">${s.room ? s.room.room_number : '—'}</span>
                                <input type="text" class="edit-input" value="${s.room ? s.room.room_number : ''}" style="display:none; width:100%; padding:5px; border:1px solid #ddd; border-radius:4px;">
                            </td>
                            <td style="padding:10px;">
                                <span class="phone-number">${s.phone_number ?? '—'}</span>
                                <input type="text" class="edit-input" value="${s.phone_number ?? ''}" style="display:none; width:100%; padding:5px; border:1px solid #ddd; border-radius:4px;">
                            </td>
                            <td style="padding:10px;">
                                <span class="email">${s.email}</span>
                                <input type="email" class="edit-input" value="${s.email}" style="display:none; width:100%; padding:5px; border:1px solid #ddd; border-radius:4px;">
                            </td>
                            <td style="padding:10time;">
                                <span class="address">${s.address ?? '—'}</span>
                                <input type="text" class="edit-input" value="${s.address ?? ''}" style="display:none; width:100%; padding:5px; border:1px solid #ddd; border-radius:4px;">
                            </td>
                            <td style="padding:10px;">
                                <button onclick="editStudent(${s.id})" class="edit-btn" style="background:#004AAD;color:white;border:none;padding:6px 10px;border-radius:6px;cursor:pointer;margin-right:5px;">Edit</button>
                                <button onclick="saveStudent(${s.id})" class="save-btn" style="display:none;background:#28a745;color:white;border:none;padding:6px 10px;border-radius:6px;cursor:pointer;margin-right:5px;">Save</button>
                                <button onclick="cancelEdit(${s.id})" class="cancel-btn" style="display:none;background:#6c757d;color:white;border:none;padding:6px 10px;border-radius:6px;cursor:pointer;margin-right:5px;">Cancel</button>
                                <button onclick="deleteStudent(${s.id})" style="background:red;color:white;border:none;padding:6px 10px;border-radius:6px;cursor:pointer;">Delete</button>
                            </td>
                        </tr>
                    `).join('');
                    })
                    .catch(error => {
                        console.error('Error fetching students:', error);
                        const tbody = document.getElementById('student-table');
                        tbody.innerHTML =
                            `<tr><td colspan="7" style="text-align:center; padding:10px; color:red;">Error loading students</td></tr>`;
                    });
            }

            // ===== Edit Student =====
            window.editStudent = function(id) {
                const row = document.getElementById(`student-${id}`);

                // Show input fields
                const inputs = row.querySelectorAll('.edit-input');
                inputs.forEach(input => {
                    input.style.display = 'block';
                    input.previousElementSibling.style.display = 'none';
                });

                // Toggle buttons
                row.querySelector('.edit-btn').style.display = 'none';
                row.querySelector('.save-btn').style.display = 'inline-block';
                row.querySelector('.cancel-btn').style.display = 'inline-block';

                // Add editing style
                row.style.backgroundColor = '#f0f8ff';
            }

            // ===== Save Student =====
            window.saveStudent = function(id) {
                const row = document.getElementById(`student-${id}`);
                const inputs = row.querySelectorAll('.edit-input');

                const data = {
                    name: inputs[0].value,
                    student_id: inputs[1].value,
                    room_number: inputs[2].value,
                    phone_number: inputs[3].value,
                    email: inputs[4].value,
                    address: inputs[5].value,
                };

                // Convert empty strings to null for database
                if (data.room_number === '') data.room_number = null;
                if (data.phone_number === '') data.phone_number = null;
                if (data.address === '') data.address = null;

                console.log('Sending data:', data);

                fetch(`/admin/api/students/${id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => {
                                throw err;
                            });
                        }
                        return response.json();
                    })
                    .then(result => {
                        console.log('Success:', result);
                        if (result.success) {
                            // Update display values
                            const spans = row.querySelectorAll('span');
                            spans[0].textContent = data.name;
                            spans[1].textContent = data.student_id;
                            spans[2].textContent = data.room_number || '—';
                            spans[3].textContent = data.phone_number || '—';
                            spans[4].textContent = data.email;
                            spans[5].textContent = data.address || '—';

                            // Exit edit mode
                            cancelEdit(id);
                            alert('Student updated successfully!');

                            // Reload students to ensure data is fresh
                            loadStudents();
                        } else {
                            alert('Error updating student: ' + (result.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error updating student: ' + (error.message || 'Unknown error'));
                    });
            }

            // ===== Cancel Edit =====
            window.cancelEdit = function(id) {
                const row = document.getElementById(`student-${id}`);

                // Hide input fields
                const inputs = row.querySelectorAll('.edit-input');
                inputs.forEach(input => {
                    input.style.display = 'none';
                    input.previousElementSibling.style.display = 'inline';
                });

                // Toggle buttons
                row.querySelector('.edit-btn').style.display = 'inline-block';
                row.querySelector('.save-btn').style.display = 'none';
                row.querySelector('.cancel-btn').style.display = 'none';

                // Remove editing style
                row.style.backgroundColor = '';
            }

            // ===== Delete Student =====
            window.deleteStudent = function(id) {
                if (!confirm("Are you sure you want to delete this student?")) return;

                fetch(`/admin/api/students/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        }
                    })
                    .then(res => res.json())
                    .then(() => loadStudents());
            }

            loadStudents();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\myFYP\resources\views/admin/students.blade.php ENDPATH**/ ?>