

<?php $__env->startSection('title', 'Facility Report'); ?>

<?php $__env->startSection('content'); ?>
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
                    <h2 style="color: #004AAD; margin: 0;">Facility Report</h2>
                </div>

                <!-- Profile Dropdown -->
                <div style="position: relative;">
                    <img src="<?php echo e(auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/student-avatar.png')); ?>"
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

            <!-- ===== FACILITY REPORT FORM ===== -->
            <div style="padding: 25px; max-width: 800px; margin: 0 auto;">

                <!-- Back Button -->
                <div style="margin-bottom: 20px;">
                    <a href="<?php echo e(route('student.forms')); ?>"
                        style="background: #6c757d; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-size: 14px;">
                        ← Back to Forms
                    </a>
                </div>

                <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                    <h1 style="color: #004AAD; margin-bottom: 25px; text-align: center;">Facility Damage Report</h1>

                    <form action="<?php echo e(route('forms.facility-report.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <!-- Section 1: Room Inventory Count -->
                        <div style="margin-bottom: 30px; padding: 20px; background: #f8fbff; border-radius: 8px;">
                            <h3
                                style="color: #004AAD; margin-bottom: 20px; border-bottom: 2px solid #004AAD; padding-bottom: 8px;">
                                Room Inventory Count</h3>

                            <div style="display: flex; flex-direction: column; gap: 15px;">
                                <?php $__currentLoopData = ['kerusi' => 'Chair (Kerusi)', 'meja' => 'Table (Meja)', 'almari' => 'Wardrobe (Almari)', 'katil' => 'Bed (Katil)', 'tilam' => 'Mattress (Tilam)']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div
                                        style="display: flex; justify-content: between; align-items: center; padding: 10px 0; border-bottom: 1px solid #e0e0e0;">
                                        <label style="font-weight: 500; color: #333; min-width: 200px;">
                                            <?php echo e($label); ?>

                                        </label>
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                            <input type="number" name="inventory[<?php echo e($key); ?>]" min="0"
                                                max="10"
                                                style="width: 80px; padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px;"
                                                required>
                                            <span style="color: #666;">/ 10</span>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <!-- Section 2: Condition Checklist -->
                        <div style="margin-bottom: 30px; padding: 20px; background: #f8fbff; border-radius: 8px;">
                            <h3
                                style="color: #004AAD; margin-bottom: 20px; border-bottom: 2px solid #004AAD; padding-bottom: 8px;">
                                Facility Condition Checklist</h3>

                            <!-- Electrical -->
                            <div style="margin-bottom: 25px;">
                                <h4 style="color: #004AAD; margin-bottom: 15px;">Electrical</h4>
                                <div style="display: flex; flex-direction: column; gap: 15px;">
                                    <?php $__currentLoopData = ['lampu' => 'Light (Lampu)', 'kipas' => 'Fan (Kipas)', 'plug_socket' => 'Plug Socket']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div
                                            style="background: white; padding: 15px; border-radius: 6px; border: 1px solid #e0e0e0;">
                                            <label
                                                style="font-weight: 500; display: block; margin-bottom: 10px; color: #333;"><?php echo e($item); ?></label>
                                            <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                                                <?php $__currentLoopData = ['good' => 'Good', 'damaged' => 'Damaged', 'missing' => 'Missing']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; font-size: 14px;">
                                                        <input type="radio" name="condition[<?php echo e($key); ?>]"
                                                            value="<?php echo e($status); ?>" required>
                                                        <?php echo e($label); ?>

                                                    </label>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                            <!-- Plumbing -->
                            <div style="margin-bottom: 25px;">
                                <h4 style="color: #004AAD; margin-bottom: 15px;">Plumbing</h4>
                                <div style="display: flex; flex-direction: column; gap: 15px;">
                                    <?php $__currentLoopData = ['toilet' => 'Toilet', 'shower' => 'Shower', 'sink' => 'Sink']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div
                                            style="background: white; padding: 15px; border-radius: 6px; border: 1px solid #e0e0e0;">
                                            <label
                                                style="font-weight: 500; display: block; margin-bottom: 10px; color: #333;"><?php echo e($item); ?></label>
                                            <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                                                <?php $__currentLoopData = ['good' => 'Good', 'clogged' => 'Clogged', 'no_water' => 'No Water', 'leaking' => 'Leaking', 'blocked' => 'Blocked']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; font-size: 14px;">
                                                        <input type="radio" name="condition[<?php echo e($key); ?>]"
                                                            value="<?php echo e($status); ?>" required>
                                                        <?php echo e($label); ?>

                                                    </label>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                            <!-- Others -->
                            <div>
                                <h4 style="color: #004AAD; margin-bottom: 15px;">Others</h4>
                                <div style="display: flex; flex-direction: column; gap: 15px;">
                                    <?php $__currentLoopData = ['langsir' => 'Curtain (Langsir)', 'pintu' => 'Door (Pintu)', 'tingkap' => 'Window (Tingkap)']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div
                                            style="background: white; padding: 15px; border-radius: 6px; border: 1px solid #e0e0e0;">
                                            <label
                                                style="font-weight: 500; display: block; margin-bottom: 10px; color: #333;"><?php echo e($item); ?></label>
                                            <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                                                <?php if($key == 'langsir'): ?>
                                                    <?php $__currentLoopData = ['good' => 'Good', 'torn' => 'Torn', 'missing' => 'Missing']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <label
                                                            style="display: flex; align-items: center; gap: 8px; font-size: 14px;">
                                                            <input type="radio" name="condition[<?php echo e($key); ?>]"
                                                                value="<?php echo e($status); ?>" required>
                                                            <?php echo e($label); ?>

                                                        </label>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = ['good' => 'Good', 'stuck' => 'Stuck', 'broken_lock' => 'Broken Lock', 'broken' => 'Broken']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <label
                                                            style="display: flex; align-items: center; gap: 8px; font-size: 14px;">
                                                            <input type="radio" name="condition[<?php echo e($key); ?>]"
                                                                value="<?php echo e($status); ?>" required>
                                                            <?php echo e($label); ?>

                                                        </label>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Damage Details -->
                        <div style="margin-bottom: 30px; padding: 20px; background: #f8fbff; border-radius: 8px;">
                            <h3
                                style="color: #004AAD; margin-bottom: 15px; border-bottom: 2px solid #004AAD; padding-bottom: 8px;">
                                Specific Damage Description</h3>
                            <textarea name="damage_description"
                                placeholder="Please provide detailed description of the damages, issues, or anything that needs repair..."
                                style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 6px; min-height: 120px; font-family: inherit;"
                                required></textarea>
                        </div>

                        <!-- Section 4: Media Upload -->
                        <div style="margin-bottom: 30px; padding: 20px; background: #f8fbff; border-radius: 8px;">
                            <h3
                                style="color: #004AAD; margin-bottom: 15px; border-bottom: 2px solid #004AAD; padding-bottom: 8px;">
                                Upload Photos/Videos</h3>
                            <input type="file" name="media[]" multiple accept="image/*,video/*"
                                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; background: white;">
                            <small style="color: #666; display: block; margin-top: 8px;">
                                You can upload multiple photos/videos. Maximum file size: 10MB each.
                            </small>
                        </div>

                        <!-- Declaration -->
                        <div
                            style="margin-bottom: 25px; padding: 15px; background: #fff3cd; border-radius: 6px; border: 1px solid #ffeaa7;">
                            <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                                <input type="checkbox" name="declaration_accurate" required style="margin-top: 3px;">
                                <span style="color: #856404; font-size: 14px;">
                                    I confirm that all information provided in this facility report is accurate and true to
                                    the best of my knowledge.
                                </span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            style="background: #004AAD; color: white; border: none; padding: 15px 30px; border-radius: 6px; cursor: pointer; font-size: 16px; width: 100%;">
                            Submit Facility Report
                        </button>
                    </form>
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
                profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' :
                    'block';
            });

            document.addEventListener('click', (e) => {
                if (!profileToggle.contains(e.target) && !profileDropdown.contains(e.target)) {
                    profileDropdown.style.display = 'none';
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\myFYP\resources\views/students/facility-report.blade.php ENDPATH**/ ?>