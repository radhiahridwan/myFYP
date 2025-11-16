

<?php $__env->startSection('title', 'Manage Rooms'); ?>

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
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">
                            Dashboard</a></li>
                    <li><a href="/admin/students"
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">
                            Students</a></li>
                    <li><a href="/admin/houses"
                            style="background: white; color: #004AAD; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">
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

            <!-- ===== TOP NAVBAR ===== -->
            <div
                style="display: flex; justify-content: space-between; align-items: center; background: white; padding: 15px 25px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 999;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <span id="menu-toggle" style="font-size: 26px; cursor: pointer; color: #004AAD;">☰</span>
                    <h2 style="color: #004AAD; margin: 0;">Manage Hostel Rooms</h2>
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

            <!-- ===== PAGE CONTENT ===== -->
            <div style="padding: 30px; width: 100%; max-width: 1100px; margin: auto;">
                <div style="background: white; border-radius: 16px; padding: 25px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <h3 style="color: #004AAD; margin-bottom: 25px;">Assign Students to Rooms</h3>

                    <!-- LEVEL + ROOM DROPDOWNS -->
                    <div style="display: flex; gap: 20px; flex-wrap: wrap; margin-bottom: 25px;">
                        <div style="flex: 1;">
                            <label style="color:#333; font-weight:600;">Select Level</label>
                            <select id="level" class="form-control"
                                style="width:100%; padding:10px; border:1px solid #ccc; border-radius:10px;">
                                <option value="">-- Choose Level --</option>
                                <option value="0">Level 0</option>
                                <?php for($i = 1; $i <= 4; $i++): ?>
                                    <option value="<?php echo e($i); ?>">Level <?php echo e($i); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div style="flex: 1;">
                            <label style="color:#333; font-weight:600;">Select Room</label>
                            <select id="room" class="form-control"
                                style="width:100%; padding:10px; border:1px solid #ccc; border-radius:10px;">
                                <option value="">-- Choose Room --</option>
                                <!-- Rooms will be loaded dynamically via JavaScript -->
                            </select>
                        </div>
                    </div>

                    <!-- ADD STUDENT BUTTON -->
                    <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
                        <button id="openModal"
                            style="background:#004AAD; color:white; border:none; padding:10px 25px; border-radius:10px; font-weight:600; cursor:pointer; transition:0.3s;">
                            Add Student</button>
                    </div>

                    <!-- ===== ADD STUDENT MODAL ===== -->
                    <div id="addModal"
                        style=" display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:2000;">
                        <div style="background:white; padding:25px; border-radius:12px; width:400px;">
                            <h3 style="color:#004AAD; text-align:center;">➕ Assign Student to Room</h3>
                            <form id="addStudentForm">
                                <div style="margin-top:10px;">
                                    <label>Student ID</label>
                                    <input type="text" name="student_id" required maxlength="12"
                                        placeholder="AM0000000000"
                                        style="width:100%; padding:8px; border:1px solid #ccc; border-radius:8px;">
                                </div>
                                <div style="text-align:right; margin-top:20px;">
                                    <button type="button" id="closeModal"
                                        style="background:#aaa; color:white; border:none; padding:8px 16px; border-radius:8px;">Cancel</button>
                                    <button type="submit"
                                        style="background:#004AAD; color:white; border:none; padding:8px 16px; border-radius:8px;">Assign
                                        to Room</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- STUDENTS TABLE -->
                    <table id="students-table" style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #004AAD; color: white;">
                                <th style="padding: 12px; text-align:left;">Name</th>
                                <th style="padding: 12px; text-align:left;">Student ID</th>
                                <th style="padding: 12px; text-align:left;">Phone Number</th>
                                <th style="padding: 12px; text-align:left;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" style="text-align:center; padding: 15px;">Select a level and room to
                                    view
                                    students.</td>
                            </tr>
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
            const openModal = document.getElementById('openModal');
            const closeModal = document.getElementById('closeModal');
            const modal = document.getElementById('addModal');
            const form = document.getElementById('addStudentForm');
            const levelSelect = document.getElementById('level');
            const roomSelect = document.getElementById('room');
            const tableBody = document.querySelector('#students-table tbody');

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

            // ===== Load rooms when level is selected =====
            levelSelect.addEventListener('change', function() {
                const level = this.value;
                roomSelect.innerHTML = '<option value="">-- Choose Room --</option>';
                tableBody.innerHTML =
                    '<tr><td colspan="4" style="text-align:center; padding:15px;">Select a room to view students.</td></tr>';

                if (!level) return;

                // Fetch rooms for selected level
                fetch(`/admin/get-rooms/${level}`)
                    .then(res => res.json())
                    .then(data => {
                        data.rooms.forEach(room => {
                            const option = document.createElement('option');
                            option.value = room.id;
                            option.textContent =
                                `${room.room_number} (${room.available_beds || room.capacity} beds available)`;
                            roomSelect.appendChild(option);
                        });
                    })
                    .catch(err => {
                        console.error('Error loading rooms:', err);
                    });
            });

            // ===== Prevent opening modal before selecting level & room =====
            openModal.addEventListener('click', () => {
                const level = levelSelect.value;
                const room = roomSelect.value;

                if (!level || !room) {
                    alert('Please select both Level and Room before adding a student.');
                    return;
                }

                modal.style.display = 'flex';
            });

            closeModal.addEventListener('click', () => modal.style.display = 'none');

            // ===== Handle Add Student form submission =====
            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                const level = levelSelect.value;
                const roomId = roomSelect.value;
                const formData = new FormData(form);

                const studentData = {
                    student_id: formData.get('student_id'),
                    room_id: roomId
                };

                console.log('🔄 Assigning student to room:', studentData);

                if (!level || !roomId) {
                    alert('Please select both Level and Room first.');
                    return;
                }

                try {
                    const resp = await fetch('/admin/api/add-student', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(studentData)
                    });

                    const result = await resp.json();
                    console.log('📦 Response data:', result);

                    if (resp.ok) {
                        modal.style.display = 'none';
                        form.reset();
                        alert('✅ ' + result.message);
                        roomSelect.dispatchEvent(new Event('change'));
                    } else {
                        alert('❌ ' + (result.message || 'Error assigning student to room'));
                    }
                } catch (err) {
                    console.error('💥 Network Error:', err);
                    alert('🔴 Network error: ' + err.message);
                }
            });

            // ===== Load students dynamically =====
            roomSelect.addEventListener('change', function() {
                const roomId = this.value;
                if (!roomId) {
                    tableBody.innerHTML =
                        '<tr><td colspan="4" style="text-align:center; padding:15px;">Select a room to view students.</td></tr>';
                    return;
                }

                // Show "Loading..." while fetching
                tableBody.innerHTML =
                    '<tr><td colspan="4" style="text-align:center; padding:15px; color:#004AAD;">Loading...</td></tr>';

                fetch(`/admin/get-students/${roomId}`)
                    .then(res => res.json())
                    .then(data => {
                        const students = data.students;
                        if (students.length === 0) {
                            tableBody.innerHTML =
                                '<tr><td colspan="4" style="text-align:center; padding:15px;">No students in this room.</td></tr>';
                        } else {
                            tableBody.innerHTML = students.map(s => `
                        <tr id="student-${s.id}">
                            <td style="padding: 10px;">
                                <span class="student-name">${s.name}</span>
                                <input type="text" class="edit-input" value="${s.name}" style="display:none; width:100%; padding:5px; border:1px solid #ddd; border-radius:4px;">
                            </td>
                            <td style="padding: 10px;">
                                <span class="student-id">${s.student_id}</span>
                                <input type="text" class="edit-input" value="${s.student_id}" style="display:none; width:100%; padding:5px; border:1px solid #ddd; border-radius:4px;">
                            </td>
                            <td style="padding: 10px;">
                                <span class="phone-number">${s.phone_number}</span>
                                <input type="text" class="edit-input" value="${s.phone_number}" style="display:none; width:100%; padding:5px; border:1px solid #ddd; border-radius:4px;">
                            </td>
                            <td style="padding: 10px;">
                                <button onclick="editStudentRoom(${s.id})" class="edit-btn" style="background:#0066CC; color:white; border:none; padding:6px 12px; border-radius:6px; cursor:pointer; margin-right:5px;">Edit</button>
                                <button onclick="saveStudentRoom(${s.id})" class="save-btn" style="display:none; background:#28a745; color:white; border:none; padding:6px 12px; border-radius:6px; cursor:pointer; margin-right:5px;">Save</button>
                                <button onclick="cancelEditRoom(${s.id})" class="cancel-btn" style="display:none; background:#6c757d; color:white; border:none; padding:6px 12px; border-radius:6px; cursor:pointer; margin-right:5px;">Cancel</button>
                                <button onclick="removeStudentFromRoom(${s.id})" style="background:#E63946; color:white; border:none; padding:6px 12px; border-radius:6px; cursor:pointer;">Remove</button>
                            </td>
                        </tr>
                    `).join('');
                        }
                    })
                    .catch(() => {
                        tableBody.innerHTML =
                            '<tr><td colspan="4" style="text-align:center; padding:15px; color:#004AAD;">Unable to load students. Please refresh.</td></tr>';
                    });
            });

            // ===== Edit Student in Room =====
            window.editStudentRoom = function(id) {
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

            // ===== Save Student in Room =====
            window.saveStudentRoom = function(id) {
                const row = document.getElementById(`student-${id}`);
                const inputs = row.querySelectorAll('.edit-input');

                const data = {
                    name: inputs[0].value,
                    student_id: inputs[1].value,
                    phone_number: inputs[2].value,
                };

                // Convert empty strings to null
                if (data.phone_number === '') data.phone_number = null;

                console.log('Saving student data:', data);

                // FIXED: Use the room-specific endpoint
                fetch(`/admin/api/room-students/${id}`, {
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
                        console.log('Save result:', result);
                        if (result.success) {
                            // Update display values
                            const spans = row.querySelectorAll('span');
                            spans[0].textContent = data.name;
                            spans[1].textContent = data.student_id;
                            spans[2].textContent = data.phone_number || '—';

                            // Exit edit mode
                            cancelEditRoom(id);
                            alert('Student updated successfully!');
                        } else {
                            alert('Error updating student: ' + (result.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        if (error.errors) {
                            const errorMessages = Object.values(error.errors).flat().join(', ');
                            alert('Validation error: ' + errorMessages);
                        } else {
                            alert('Error updating student: ' + (error.message || 'Unknown error'));
                        }
                    });
            }

            // ===== Cancel Edit in Room =====
            window.cancelEditRoom = function(id) {
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

            // ===== Remove Student from Room =====
            window.removeStudentFromRoom = function(id) {
                if (!confirm("Are you sure you want to remove this student from the room?")) return;

                fetch(`/admin/students/${id}/remove-room`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                            'Content-Type': 'application/json'
                        }
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
                        alert('Student removed from room successfully!');
                        // Reload the students list
                        roomSelect.dispatchEvent(new Event('change'));
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error removing student from room: ' + (error.message || 'Unknown error'));
                    });
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\myFYP\resources\views/admin/rooms.blade.php ENDPATH**/ ?>