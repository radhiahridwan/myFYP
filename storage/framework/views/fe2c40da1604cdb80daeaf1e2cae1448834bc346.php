

<?php $__env->startSection('title', 'Student Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div class="student-dashboard"
        style="display: flex; min-height: 100vh; font-family: 'Poppins', sans-serif; background: #f8fbff; overflow-x: hidden;">

        <!-- ===== SIDEBAR ===== -->
        <div id="sidebar"
            style=" width: 250px; background: #004AAD; color: white; position: fixed; top: 0; left: -250px; height: 100%;padding: 20px; box-shadow: 4px 0 10px rgba(0,0,0,0.1); transition: left 0.3s ease; z-index: 1000; display: flex;flex-direction: column; justify-content: space-between; overflow-y: auto;  ">
            <div>
                <div style="text-align: center; margin-bottom: 25px;">
                    <img src="<?php echo e(asset('images/uptm-logo.png')); ?>" alt="UPTM Logo"
                        style="width: 100%; max-width: 180px; height: auto; display: block; margin: 0 auto 10px;">
                    <h3 style="margin: 0;">Student Panel</h3>
                </div>
                <ul style="list-style: none; padding: 0; line-height: 2;">
                    <li>
                        <a href="/student/dashboard"
                            style="background: rgba(255, 255, 255, 0.544); color: #004AAD; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">
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
                            style="color: white; text-decoration: none; display: flex; align-items: center; gap: 10px; padding: 8px 0;">
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
                style="display: flex; justify-content: space-between; align-items: center; background: white; padding: 15px 25px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 999; backdrop-filter: blur(10px);">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <span id="menu-toggle" style="font-size: 26px; cursor: pointer; color: #004AAD;">☰</span>
                    <h2 style="color: #004AAD; margin: 0;">Student Dashboard</h2>
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

            <!-- ===== DASHBOARD CONTENT ===== -->
            <div style="padding: 25px; width: 100%; max-width: 1200px; margin: auto;">
                <h3 style="color: #004AAD; margin-bottom: 20px;">Welcome, <?php echo e(Auth::user()->name ?? 'Student'); ?></h3>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">

                    <?php
                        $tabs = [
                            [
                                'url' => '/student/payments',
                                'icon' => 'payments-icon.png',
                                'title' => 'Payments',
                                'desc' => 'Submit your hostel fee or view payment status.',
                            ],
                            [
                                'url' => route('outing.form'),
                                'icon' => 'outing-icon.png',
                                'title' => 'Outing Form',
                                'desc' => 'Apply or record your outing activities.',
                            ],
                            [
                                'url' => '/student/forms',
                                'icon' => 'form-icon.png',
                                'title' => 'Forms',
                                'desc' => 'Submit reports and applications.',
                            ],
                        ];
                    ?>
                    <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($tab['url']); ?>" style="text-decoration:none; color:inherit;">
                            <div class="dashboard-card"
                                style=" background: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); cursor: pointer; transition: transform 0.2s, box-shadow 0.2s; aspect-ratio: 1 / 1;  display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">

                                <img src="<?php echo e(asset('images/' . $tab['icon'])); ?>" alt="<?php echo e($tab['title']); ?>"
                                    style="width: 50px; height: 50px; object-fit: contain; margin-bottom: 10px;">
                                <h4 style="color: #004AAD; margin: 10px 0 5px;"><?php echo e($tab['title']); ?></h4>
                                <p style="font-size: 14px; color: #555;"><?php echo e($tab['desc']); ?></p>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

            // Hover animation for tabs
            document.querySelectorAll('.dashboard-card').forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'scale(1.05)';
                    card.style.boxShadow = '0 6px 15px rgba(0,0,0,0.15)';
                });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'scale(1)';
                    card.style.boxShadow = '0 4px 8px rgba(0,0,0,0.1)';
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\myFYP\resources\views/students/dashboard.blade.php ENDPATH**/ ?>