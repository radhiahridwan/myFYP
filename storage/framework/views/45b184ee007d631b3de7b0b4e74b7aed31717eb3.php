

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div class="admin-dashboard"
        style="display: flex; min-height: 100vh; font-family: 'Poppins', sans-serif; background: #f8fbff; overflow-x: hidden;">

        <!-- ===== SIDEBAR ===== -->
        <div id="sidebar"
            style=" width: 250px; background: #004AAD; color: white; position: fixed; top: 0;left: -250px; height: 100%; padding: 20px 0;box-shadow: 4px 0 10px rgba(0,0,0,0.1); transition: left 0.3s ease; z-index: 1000; display: flex; flex-direction: column; justify-content: space-between; ">
            <div>
                <!-- ===== UPTM LOGO ===== -->
                <div style="text-align:center; margin-bottom: 25px;">
                    <img src="<?php echo e(asset('images/uptm-logo.png')); ?>" alt="UPTM Logo"
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

            <!-- ===== TOP NAVBAR ===== -->
            <div
                style="display: flex; justify-content: space-between; align-items: center; background: white; padding: 15px 25px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 999;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <span id="menu-toggle" style="font-size: 26px; cursor: pointer; color: #004AAD;">☰</span>
                    <h2 style="color: #004AAD; margin: 0;">Admin Dashboard</h2>
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

            <!-- ===== DASHBOARD CONTENT ===== -->
            <div style="padding: 25px; width: 100%; max-width: 1400px; margin: auto;">

                <!-- Metrics -->
                <div
                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
                    <div
                        style="background: white; border-radius: 16px; padding: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align:center;">
                        <h4 style="color: #004AAD;">Total Students</h4>
                        <p style="font-size: 28px; font-weight: 700; color: #222;"><?php echo e($totalStudents); ?></p>
                    </div>
                    <div
                        style="background: white; border-radius: 16px; padding: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align:center;">
                        <h4 style="color: #004AAD;">Total Admins</h4>
                        <p style="font-size: 28px; font-weight: 700; color: #222;"><?php echo e($totalAdmins); ?></p>
                    </div>
                    <div
                        style="background: white; border-radius: 16px; padding: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align:center;">
                        <h4 style="color: #004AAD;">Pending Payments</h4>
                        <p style="font-size: 28px; font-weight: 700; color: #004AAD;"><?php echo e($pendingPayments); ?></p>
                        <small style="color: #666;">Awaiting payment</small>
                    </div>
                    <div
                        style="background: white; border-radius: 16px; padding: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align:center;">
                        <h4 style="color: #004AAD;">Total Forms</h4>
                        <p style="font-size: 28px; font-weight: 700; color: #004AAD;"><?php echo e($totalForms); ?></p>
                        <small style="color: #666;">All time</small>
                    </div>
                </div>

                <div
                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 20px; margin-bottom: 30px;">

                    <!-- Recent Students -->
                    <div
                        style="background: white; border-radius: 16px; padding: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow-x:auto;">
                        <h4 style="color: #004AAD; margin-bottom: 15px;">Recent Students</h4>
                        <div style="max-height: 300px; overflow-y: auto;">
                            <table style="width: 100%; border-collapse: collapse; text-align:left;">
                                <thead>
                                    <tr style="background: #004AAD; color: white;">
                                        <th style="padding: 10px;">Name</th>
                                        <th style="padding: 10px;">Email</th>
                                        <th style="padding: 10px;">Room</th>
                                        <th style="padding: 10px;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $recentStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td style="padding: 10px; font-weight: 500;"><?php echo e($student->name); ?></td>
                                            <td style="padding: 10px;"><?php echo e($student->email); ?></td>
                                            <td style="padding: 10px;">
                                                <?php if($student->hostel_room): ?>
                                                    <?php echo e($student->hostel_room); ?>

                                                <?php else: ?>
                                                    <span style="color: #666;">Not assigned</span>
                                                <?php endif; ?>
                                            </td>
                                            <td style="padding: 10px;">
                                                <span
                                                    style="background: #28a745; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px;">
                                                    Active
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="4" style="text-align:center; padding: 20px; color: #666;">
                                                No students found
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Recent Forms -->
                    <div
                        style="background: white; border-radius: 16px; padding: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow-x:auto;">
                        <h4 style="color: #004AAD; margin-bottom: 15px;">Recent Forms</h4>
                        <div style="max-height: 300px; overflow-y: auto;">
                            <table style="width: 100%; border-collapse: collapse; text-align:left;">
                                <thead>
                                    <tr style="background: #004AAD; color: white;">
                                        <th style="padding: 10px;">Student</th>
                                        <th style="padding: 10px;">Form Type</th>
                                        <th style="padding: 10px;">Status</th>
                                        <th style="padding: 10px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $recentForms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td style="padding: 10px; font-weight: 500;">
                                                <?php if($form->student): ?>
                                                    <?php echo e($form->student->name); ?>

                                                <?php else: ?>
                                                    <span style="color: #666;">Unknown Student</span>
                                                <?php endif; ?>
                                            </td>
                                            <td style="padding: 10px;"><?php echo e($form->type ?? 'N/A'); ?></td>
                                            <td style="padding: 10px;">
                                                <?php if($form->status === 'pending'): ?>
                                                    <span
                                                        style="background: #ffc107; color: #856404; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;">
                                                        Pending
                                                    </span>
                                                <?php elseif($form->status === 'under_review'): ?>
                                                    <span
                                                        style="background: #17a2b8; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;">
                                                        Under Review
                                                    </span>
                                                <?php elseif($form->status === 'approved'): ?>
                                                    <span
                                                        style="background: #28a745; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;">
                                                        Approved
                                                    </span>
                                                <?php elseif($form->status === 'rejected'): ?>
                                                    <span
                                                        style="background: #dc3545; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;">
                                                        Rejected
                                                    </span>
                                                <?php elseif($form->status === 'completed'): ?>
                                                    <span
                                                        style="background: #6c757d; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;">
                                                        Completed
                                                    </span>
                                                <?php else: ?>
                                                    <span
                                                        style="background: #6c757d; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;">
                                                        <?php echo e(ucfirst($form->status)); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td style="padding: 10px;">
                                                <a href="/admin/forms/<?php echo e($form->id); ?>"
                                                    style="background: #004AAD; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px;">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="4" style="text-align:center; padding: 20px; color: #666;">
                                                No forms submitted recently
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes pulse {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }
    </style>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\myFYP\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>