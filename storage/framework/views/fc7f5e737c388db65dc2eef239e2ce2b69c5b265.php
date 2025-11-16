

<?php $__env->startSection('title', 'Outing Form'); ?>

<?php $__env->startSection('content'); ?>
    <div class="student-dashboard"
        style="display: flex; min-height: 100vh; font-family: 'Poppins', sans-serif; background: #f8fbff; overflow-x: hidden;">

        <!-- ===== SIDEBAR ===== -->
        <div id="sidebar"
            style=" width: 250px; background: #004AAD; color: white; position: fixed; top: 0; left: -250px;height: 100%; padding: 20px;box-shadow: 4px 0 10px rgba(0,0,0,0.1); transition: left 0.3s ease; z-index: 1000; display: flex; flex-direction: column; justify-content: space-between;overflow-y: auto;  ">
            <div>
                <div style="text-align: center; margin-bottom: 25px;">
                    <img src="<?php echo e(asset('images/uptm-logo.png')); ?>" alt="UPTM Logo"
                        style="width: 100%; max-width: 180px; height: auto; display: block; margin: 0 auto 10px;">
                    <h3 style="margin: 0;">Student Panel</h3>
                </div>
                <ul style="list-style: none; padding: 0; line-height: 2;">
                    <li>
                        <a href="/student/dashboard"
                            style="color: white; text-decoration: none; display: flex; align-items: center; gap: 10px; padding: 8px 0;">
                            <img src="<?php echo e(asset('images/home-icon.png')); ?>" alt="Dashboard"
                                style="width: 20px; height: 20px;">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="/student/rules"
                            style="color: white; text-decoration: none; display: flex; align-items: center; gap: 10px; padding: 8px 0;">
                            <img src="<?php echo e(asset('images/rule-icon.png')); ?>" alt="Rules"
                                style="width: 20px; height: 20px;">
                            Rules
                        </a>
                    </li>
                    <li>
                        <a href="/student/wardens"
                            style="color: white; text-decoration: none; display: flex; align-items: center; gap: 10px; padding: 8px 0;">
                            <img src="<?php echo e(asset('images/warden-icon.png')); ?>" alt="Warden List"
                                style="width: 20px; height: 20px;">
                            Warden List
                        </a>
                    </li>
                    <li>
                        <a href="/student/manual"
                            style="color: #ffffff; text-decoration: none; display: flex; align-items: center; gap: 10px; padding: 8px 0; font-weight: bold;">
                            <img src="<?php echo e(asset('images/manual-icon.png')); ?>" alt="User Manual"
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
                    <h2 style="color: #004AAD; margin: 0;">
                        <?php if($page == 'form'): ?>
                            Outing Form
                        <?php elseif($page == 'current'): ?>
                            Current Outing
                        <?php elseif($page == 'history'): ?>
                            Outing History
                        <?php endif; ?>
                    </h2>
                </div>

                <!-- Profile Dropdown -->
                <div style="position: relative;">
                    <img src="<?php echo e(auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/student-avatar.png')); ?>"
                        alt="Student" id="profile-toggle"
                        style="width: 45px; height: 45px; border-radius: 50%; cursor: pointer; border: 2px solid #004AAD;">
                    <div id="profile-dropdown"
                        style=" display: none; position: absolute; right: 0; top: 55px; background: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 220px; overflow: hidden; ">
                        <div style="padding: 15px; border-bottom: 1px solid #eee;">
                            <strong><?php echo e(Auth::user()->name ?? 'Student'); ?></strong><br>
                            <small><?php echo e(Auth::user()->email ?? 'student@uptm.edu.my'); ?></small>
                        </div>

                        <a href="/student/profile"
                            style="display: flex; align-items: center; gap: 8px; padding: 10px 15px; color: #004AAD; text-decoration: none;">
                            <img src="<?php echo e(asset('images/profile.png')); ?>" alt="Profile" style="width: 20px; height: 20px;">
                            Edit Profile
                        </a>

                        <a href="/student/settings"
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

            <!-- ===== OUTING CONTENT ===== -->
            <div style="padding: 30px; max-width: 800px; margin: 0 auto;">

                <?php if(session('success')): ?>
                    <div
                        style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 25px; border: 1px solid #c3e6cb;">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div
                        style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 25px; border: 1px solid #f5c6cb;">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div
                        style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 25px; border: 1px solid #f5c6cb;">
                        <ul style="margin: 0; padding-left: 20px;">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Back Button -->
                <div style="margin-bottom: 20px;">
                    <a href="<?php echo e(route('students.dashboard')); ?>"
                        style="background: #6c757d; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-size: 14px;">
                        ← Back
                    </a>
                </div>

                <!-- Quick Links -->
                <div
                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
                    <a href="/student/outing/form"
                        style="background: <?php echo e($page == 'form' ? '#004AAD' : 'white'); ?>; padding: 20px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-decoration: none; color: <?php echo e($page == 'form' ? 'white' : '#333'); ?>; text-align: center; transition: transform 0.2s, box-shadow 0.2s;">
                        <div style="font-size: 24px; margin-bottom: 10px;"></div>
                        <h4 style="margin: 0;">Outing Form</h4>
                        <p style="margin: 5px 0 0 0; font-size: 14px; opacity: 0.8;">Submit new outing request</p>
                    </a>
                    <a href="/student/outing/current"
                        style="background: <?php echo e($page == 'current' ? '#004AAD' : 'white'); ?>; padding: 20px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-decoration: none; color: <?php echo e($page == 'current' ? 'white' : '#333'); ?>; text-align: center; transition: transform 0.2s, box-shadow 0.2s;">
                        <div style="font-size: 24px; margin-bottom: 10px;"></div>
                        <h4 style="margin: 0;">Current Outing</h4>
                        <p style="margin: 5px 0 0 0; font-size: 14px; opacity: 0.8;">View active outing</p>
                    </a>
                    <a href="/student/outing/history"
                        style="background: <?php echo e($page == 'history' ? '#004AAD' : 'white'); ?>; padding: 20px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-decoration: none; color: <?php echo e($page == 'history' ? 'white' : '#333'); ?>; text-align: center; transition: transform 0.2s, box-shadow 0.2s;">
                        <div style="font-size: 24px; margin-bottom: 10px;"></div>
                        <h4 style="margin: 0;">Outing History</h4>
                        <p style="margin: 5px 0 0 0; font-size: 14px; opacity: 0.8;">View past records</p>
                    </a>
                </div>

                <!-- Student Info Card -->
                <div
                    style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); margin-bottom: 25px;">
                    <h3 style="color: #004AAD; margin-top: 0;">Student Information</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                        <div>
                            <label style="font-weight: bold; color: #555;">Name</label>
                            <p style="margin: 5px 0 0 0; color: #333;"><?php echo e($student->name); ?></p>
                        </div>
                        <div>
                            <label style="font-weight: bold; color: #555;">Student ID</label>
                            <p style="margin: 5px 0 0 0; color: #333;"><?php echo e($student->student_id); ?></p>
                        </div>
                        <div>
                            <label style="font-weight: bold; color: #555;">Room Number</label>
                            <p style="margin: 5px 0 0 0; color: #333;"><?php echo e($student->hostel_room); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Outing Form -->
                <?php if($page == 'form'): ?>
                    <div
                        style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                        <h3 style="color: #004AAD; margin-top: 0; margin-bottom: 25px;">Outing Details</h3>

                        <form action="<?php echo e(route('outing.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <!-- Departure Time -->
                            <div style="margin-bottom: 20px;">
                                <label
                                    style="display: block; font-weight: bold; margin-bottom: 8px; color: #333;">Departure
                                    Date & Time *</label>
                                <input type="datetime-local" name="departure_time"
                                    style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 16px; transition: border-color 0.3s;"
                                    min="<?php echo e(now()->format('Y-m-d') . 'T00:00'); ?>" required>
                            </div>

                            <!-- Expected Return Time -->
                            <div style="margin-bottom: 20px;">
                                <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #333;">Expected
                                    Return Date & Time *</label>
                                <input type="datetime-local" name="expected_return_time"
                                    style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 16px; transition: border-color 0.3s;"
                                    required>
                            </div>

                            <!-- Destination -->
                            <div style="margin-bottom: 20px;">
                                <label
                                    style="display: block; font-weight: bold; margin-bottom: 8px; color: #333;">Destination/Overnight
                                    Place *</label>
                                <input type="text" name="destination"
                                    placeholder="e.g., Home, Relative's House, Vacation..."
                                    style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 16px; transition: border-color 0.3s;"
                                    required>
                            </div>

                            <!-- Purpose -->
                            <div style="margin-bottom: 20px;">
                                <label
                                    style="display: block; font-weight: bold; margin-bottom: 8px; color: #333;">Purpose/Reason
                                    *</label>
                                <textarea name="purpose" rows="4" placeholder="Please describe the purpose of your outing..."
                                    style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 16px; transition: border-color 0.3s; resize: vertical;"
                                    required></textarea>
                            </div>

                            <!-- Emergency Contact -->
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                                <div>
                                    <label
                                        style="display: block; font-weight: bold; margin-bottom: 8px; color: #333;">Emergency
                                        Contact Number *</label>
                                    <input type="tel" name="emergency_contact_number" placeholder="e.g., 012-3456789"
                                        style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 16px; transition: border-color 0.3s;"
                                        required>
                                </div>
                                <div>
                                    <label
                                        style="display: block; font-weight: bold; margin-bottom: 8px; color: #333;">Relationship
                                        *</label>
                                    <select name="emergency_contact_relationship"
                                        style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 16px; transition: border-color 0.3s;"
                                        required>
                                        <option value="">Select Relationship</option>
                                        <option value="Parent">Parent</option>
                                        <option value="Guardian">Guardian</option>
                                        <option value="Sibling">Sibling</option>
                                        <option value="Relative">Relative</option>
                                        <option value="Friend">Friend</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                style="background: linear-gradient(135deg, #004AAD, #0066CC); color: white; padding: 15px 30px; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; width: 100%; transition: transform 0.2s, box-shadow 0.2s;">
                                Submit Outing Form
                            </button>
                        </form>
                    </div>
                <?php endif; ?>

                <!-- Current Outing -->
                <?php if($page == 'current'): ?>
                    <div
                        style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                        <h3 style="color: #004AAD; margin-top: 0; margin-bottom: 25px;">Current Outings</h3>

                        <?php
                            // Handle both variable names for safety
                            if (isset($currentOutings)) {
                                $outingsToDisplay = $currentOutings;
                            } elseif (isset($currentOuting)) {
                                // Check if it's a collection or single object
                                $outingsToDisplay =
                                    $currentOuting instanceof \Illuminate\Database\Eloquent\Collection
                                        ? $currentOuting
                                        : collect([$currentOuting]);
                            } else {
                                $outingsToDisplay = collect();
                            }
                        ?>

                        <?php if($outingsToDisplay->count() > 0): ?>
                            <?php $__currentLoopData = $outingsToDisplay; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div
                                    style="border: 2px solid #004AAD; border-radius: 12px; padding: 25px; margin-bottom: 20px;">
                                    <div
                                        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 20px;">
                                        <div>
                                            <label style="font-weight: bold; color: #555;">Departure Time</label>
                                            <p style="margin: 5px 0 0 0; color: #333;">
                                                <?php echo e($outing->departure_time->format('M j, Y g:i A')); ?>

                                            </p>
                                        </div>
                                        <div>
                                            <label style="font-weight: bold; color: #555;">Expected Return</label>
                                            <p style="margin: 5px 0 0 0; color: #333;">
                                                <?php echo e($outing->expected_return_time->format('M j, Y g:i A')); ?>

                                            </p>
                                        </div>
                                        <div>
                                            <label style="font-weight: bold; color: #555;">Destination</label>
                                            <p style="margin: 5px 0 0 0; color: #333;"><?php echo e($outing->destination); ?></p>
                                        </div>
                                    </div>
                                    <div style="margin-bottom: 20px;">
                                        <label style="font-weight: bold; color: #555;">Purpose</label>
                                        <p style="margin: 5px 0 0 0; color: #333;"><?php echo e($outing->purpose); ?></p>
                                    </div>
                                    <div
                                        style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                                        <div>
                                            <label style="font-weight: bold; color: #555;">Emergency Contact</label>
                                            <p style="margin: 5px 0 0 0; color: #333;">
                                                <?php echo e($outing->emergency_contact_number); ?></p>
                                        </div>
                                        <div>
                                            <label style="font-weight: bold; color: #555;">Relationship</label>
                                            <p style="margin: 5px 0 0 0; color: #333;">
                                                <?php echo e($outing->emergency_contact_relationship); ?></p>
                                        </div>
                                    </div>

                                    <!-- ADDED DELETE BUTTONS HERE -->
                                    <div style="display: flex; gap: 10px; margin-top: 15px;">
                                        <form action="<?php echo e(route('outing.mark-returned', $outing->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit"
                                                style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 10px 20px; border: none; border-radius: 8px; font-size: 14px; font-weight: bold; cursor: pointer;">
                                                Mark Returned
                                            </button>
                                        </form>

                                        <form action="<?php echo e(route('outing.delete', $outing->id)); ?>" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this outing?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit"
                                                style="background: linear-gradient(135deg, #dc3545, #c82333); color: white; padding: 10px 20px; border: none; border-radius: 8px; font-size: 14px; font-weight: bold; cursor: pointer;">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div style="text-align: center; padding: 40px; color: #666;">
                                <div style="font-size: 48px; margin-bottom: 20px;">🚶‍♂️</div>
                                <h4 style="color: #004AAD; margin-bottom: 10px;">No Active Outings</h4>
                                <p>You don't have any active outings at the moment.</p>
                                <a href="/student/outing/form"
                                    style="display: inline-block; background: #004AAD; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; margin-top: 15px;">
                                    Submit New Outing Form
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>


                <!-- Outing History -->
                <?php if($page == 'history'): ?>
                    <div
                        style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                        <h3 style="color: #004AAD; margin-top: 0; margin-bottom: 25px;">Outing History</h3>

                        <?php if($outings->count() > 0): ?>
                            <div style="overflow-x: auto;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                        <tr style="background: #f8f9fa;">
                                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #e0e0e0;">
                                                Departure</th>
                                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #e0e0e0;">
                                                Return</th>
                                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #e0e0e0;">
                                                Destination</th>
                                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #e0e0e0;">
                                                Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $outings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr style="border-bottom: 1px solid #e0e0e0;">
                                                <td style="padding: 12px;">
                                                    <?php echo e($outing->departure_time->format('M j, Y g:i A')); ?></td>
                                                <td style="padding: 12px;">
                                                    <?php if($outing->actual_return_time): ?>
                                                        <?php echo e($outing->actual_return_time->format('M j, Y g:i A')); ?>

                                                    <?php else: ?>
                                                        <?php echo e($outing->expected_return_time->format('M j, Y g:i A')); ?>

                                                        <span style="color: #dc3545;">(Expected)</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="padding: 12px;"><?php echo e($outing->destination); ?></td>
                                                <td style="padding: 12px;">
                                                    <span
                                                        style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; 
                                            background: <?php echo e($outing->status == 'out' ? '#fff3cd' : '#d4edda'); ?>; 
                                            color: <?php echo e($outing->status == 'out' ? '#856404' : '#155724'); ?>;">
                                                        <?php echo e($outing->status == 'out' ? 'OUT' : 'RETURNED'); ?>

                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div style="margin-top: 20px; display: flex; justify-content: center;">
                                <?php echo e($outings->links()); ?>

                            </div>
                        <?php else: ?>
                            <div style="text-align: center; padding: 40px; color: #666;">
                                <div style="font-size: 48px; margin-bottom: 20px;">📊</div>
                                <h4 style="color: #004AAD; margin-bottom: 10px;">No Outing History</h4>
                                <p>You haven't submitted any outing forms yet.</p>
                                <a href="/student/outing/form"
                                    style="display: inline-block; background: #004AAD; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; margin-top: 15px;">
                                    Submit Your First Outing Form
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
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

            // Hover animation for cards
            document.querySelectorAll('a[style*="background: white"]').forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-5px)';
                    card.style.boxShadow = '0 8px 20px rgba(0,0,0,0.15)';
                });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0)';
                    card.style.boxShadow = '0 4px 8px rgba(0,0,0,0.1)';
                });
            });

            // Form input focus effects (only for form page)
            <?php if($page == 'form'): ?>
                document.querySelectorAll('input, textarea, select').forEach(input => {
                    input.addEventListener('focus', () => {
                        input.style.borderColor = '#004AAD';
                        input.style.boxShadow = '0 0 0 3px rgba(0, 74, 173, 0.1)';
                    });
                    input.addEventListener('blur', () => {
                        input.style.borderColor = '#e0e0e0';
                        input.style.boxShadow = 'none';
                    });
                });

                // Set minimum return time based on departure time
                const departureInput = document.querySelector('input[name="departure_time"]');
                const returnInput = document.querySelector('input[name="expected_return_time"]');

                if (departureInput && returnInput) {
                    departureInput.addEventListener('change', function() {
                        if (this.value) {
                            returnInput.min = this.value;
                            if (returnInput.value && returnInput.value < this.value) {
                                returnInput.value = '';
                            }
                        }
                    });
                }
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\myFYP\resources\views/students/outing.blade.php ENDPATH**/ ?>