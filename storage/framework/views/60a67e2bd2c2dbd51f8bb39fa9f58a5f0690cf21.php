

<?php $__env->startSection('title', 'Admin Profile'); ?>

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
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px;"> Students</a>
                    </li>
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
                    <h2 style="color: #004AAD; margin: 0;">Admin Profile</h2>
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
                            style="background: rgba(0, 74, 173, 0.1); display: flex; align-items: center; gap: 8px; padding: 10px 15px; color: #004AAD; text-decoration: none; border-left: 3px solid #004AAD;">
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

            <?php if($errors->any()): ?>
                <div
                    style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin: 20px auto; width: 90%; max-width: 800px; border: 1px solid #f5c6cb;">
                    <strong>Please fix the following errors:</strong>
                    <ul style="margin: 10px 0 0 20px;">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- ===== PROFILE VIEW CARD ===== -->
            <div id="profile-card"
                style="padding: 40px; width: 100%; max-width: 700px; margin: 40px auto; background: white; border-radius: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align: center;">
                <!-- Profile Picture -->
                <div style="margin-bottom: 25px;">
                    <img src="<?php echo e($admin->profile_picture ? asset('storage/' . $admin->profile_picture) : asset('images/admin-avatar.png')); ?>"
                        style="width: 150px; height: 150px; border-radius: 50%; border: 4px solid #004AAD; object-fit: cover; margin: 0 auto 20px;">
                </div>

                <!-- Admin Information -->
                <div style="margin-bottom: 30px;">
                    <h2 style="color: #004AAD; margin-bottom: 25px; font-size: 24px;"><?php echo e($admin->name ?? 'N/A'); ?></h2>

                    <div
                        style="display: flex; flex-direction: column; gap: 12px; text-align: left; max-width: 500px; margin: 0 auto;">
                        <div
                            style="display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 8px;">
                            <strong style="color: #333; min-width: 120px;">Email:</strong>
                            <span style="color: #666; text-align: right; flex: 1;"><?php echo e($admin->email ?? '-'); ?></span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 8px;">
                            <strong style="color: #333; min-width: 120px;">Phone Number:</strong>
                            <span
                                style="color: #666; text-align: right; flex: 1;"><?php echo e($adminWithUser->phone_number ?? '-'); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Success/error message -->
                <?php if(session('success')): ?>
                    <div id="success-message"
                        style="background: #d4edda; color: #155724; padding: 12px 20px; border-radius: 8px; margin: 0 auto 20px auto; width: 90%; max-width: 400px; border: 1px solid #c3e6cb; font-size: 14px;">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div id="error-message"
                        style="background: #f8d7da; color: #721c24; padding: 12px 20px; border-radius: 8px; margin: 0 auto 20px auto; width: 90%; max-width: 400px; border: 1px solid #f5c6cb; font-size: 14px;">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div id="validation-errors"
                        style="background: #f8d7da; color: #721c24; padding: 12px 20px; border-radius: 8px; margin: 0 auto 20px auto; width: 90%; max-width: 400px; border: 1px solid #f5c6cb; font-size: 14px;">
                        <strong>Please fix the following errors:</strong>
                        <ul style="margin: 10px 0 0 20px;">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Edit Button -->
                <button id="edit-profile-btn"
                    style="background: #004AAD; color: white; padding: 12px 30px; border: none; border-radius: 8px; cursor: pointer; font-size: 14px; font-weight: 500;">
                    Edit Profile
                </button>
            </div>

        </div>
    </div>

    <!-- ===== EDIT PROFILE MODAL ===== -->
    <div id="edit-profile-modal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1001; align-items: center; justify-content: center;">
        <div
            style="background: white; border-radius: 20px; padding: 30px; width: 90%; max-width: 500px; max-height: 90vh; overflow-y: auto; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                <h3 style="color: #004AAD; margin: 0;">Edit Your Profile</h3>
                <button id="close-modal-btn"
                    style="background: none; border: none; font-size: 24px; cursor: pointer; color: #666;">&times;</button>
            </div>

            <!-- FIXED FORM - USING POST METHOD ONLY -->
            <form action="<?php echo e(route('admin.profile.update')); ?>" method="POST" enctype="multipart/form-data"
                id="profile-form">
                <?php echo csrf_field(); ?>
                <!-- NO <?php echo method_field('PUT'); ?> - USING POST DIRECTLY -->

                <!-- Profile Picture -->
                <div style="text-align: center; margin-bottom: 25px;">
                    <img id="profile-preview"
                        src="<?php echo e($admin->profile_picture ? asset('storage/' . $admin->profile_picture) : asset('images/admin-avatar.png')); ?>"
                        style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid #004AAD; object-fit: cover; margin-bottom: 15px;">
                    <br>
                    <label for="profile_picture_input"
                        style="background: #004AAD; color: white; padding: 8px 15px; border-radius: 8px; cursor: pointer; font-size: 14px; display: inline-block;">
                        Change Photo
                    </label>
                    <input type="file" name="profile_picture" accept="image/*" id="profile_picture_input"
                        style="display: none;">
                </div>

                <!-- Form Fields -->
                <div style="display: flex; flex-direction: column; gap: 15px; margin-bottom: 20px;">
                    <!-- Name -->
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #333;">Full Name</label>
                        <input type="text" name="name" value="<?php echo e(old('name', $admin->name ?? '')); ?>" required
                            style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd; font-size: 14px;">
                    </div>

                    <!-- Email -->
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #333;">Email</label>
                        <input type="email" name="email" value="<?php echo e(old('email', $admin->email ?? '')); ?>" required
                            style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd; font-size: 14px;">
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #333;">Phone
                            Number</label>
                        <input type="text" name="phone_number"
                            value="<?php echo e(old('phone_number', $adminWithUser->phone_number ?? '')); ?>"
                            style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd; font-size: 14px;">
                    </div>
                </div>

                <!-- Buttons -->
                <div style="display: flex; gap: 15px; justify-content: flex-end;">
                    <button type="button" id="cancel-edit-btn"
                        style="background: #6c757d; color: white; padding: 12px 25px; border-radius: 8px; border: none; cursor: pointer; font-size: 14px; font-weight: 500;">
                        Cancel
                    </button>
                    <button type="submit"
                        style="background: #004AAD; color: white; padding: 12px 25px; border-radius: 8px; border: none; cursor: pointer; font-size: 14px; font-weight: 500;">
                        Save Changes
                    </button>
                </div>
            </form>
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

            // Modal elements
            const editBtn = document.getElementById('edit-profile-btn');
            const cancelBtn = document.getElementById('cancel-edit-btn');
            const closeModalBtn = document.getElementById('close-modal-btn');
            const editModal = document.getElementById('edit-profile-modal');
            const profileCard = document.getElementById('profile-card');

            // Sidebar toggle
            menuToggle.addEventListener('click', () => {
                sidebar.style.left = sidebar.style.left === '0px' ? '-250px' : '0';
                mainContent.style.marginLeft = sidebar.style.left === '0px' ? '250px' : '0';
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

            // Edit modal functionality
            editBtn.addEventListener('click', () => {
                editModal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            });

            function closeModal() {
                editModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }

            cancelBtn.addEventListener('click', closeModal);
            closeModalBtn.addEventListener('click', closeModal);

            // Close modal when clicking outside
            editModal.addEventListener('click', (e) => {
                if (e.target === editModal) {
                    closeModal();
                }
            });

            // Profile picture preview
            const profileInput = document.getElementById('profile_picture_input');
            const profilePreview = document.getElementById('profile-preview');

            profileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        profilePreview.src = event.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Auto-hide success message after 5 seconds
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 5000);
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\myFYP\resources\views/admin/profile.blade.php ENDPATH**/ ?>