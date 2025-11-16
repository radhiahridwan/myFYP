

<?php $__env->startSection('title', 'Form Review'); ?>

<?php $__env->startSection('content'); ?>
    <div class="admin-dashboard"
        style="display: flex; min-height: 100vh; font-family: 'Poppins', sans-serif; background: #f8fbff; overflow-x: hidden;">

        <!-- ===== SIDEBAR ===== -->
        <div id="sidebar"
            style=" width: 250px; background: #004AAD; color: white; position: fixed; top: 0; left: -250px; height: 100%; padding: 20px 0; box-shadow: 4px 0 10px rgba(0,0,0,0.1); transition: left 0.3s ease; z-index: 1000;display: flex; flex-direction: column; justify-content: space-between; ">
            <div>
                <!-- ===== UPTM LOGO ===== -->
                <div style="text-align:center; margin-bottom: 25px;">
                    <img src="<?php echo e(asset('images/uptm-logo.png')); ?>" alt="UPTM Logo"
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
                            style="background: white; color: #004AAD; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">Forms</a>
                    </li>
                    <li><a href="/admin/payments"
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">Payments</a>
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
                    <h2 style="color: #004AAD; margin: 0;">Form Review</h2>
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

            <!-- ===== FORM REVIEW CONTENT ===== -->
            <div style="padding: 25px; max-width: 1200px; margin: 0 auto;">

                <!-- Header with Back Button and Actions -->
                <div style="display: flex; justify-content: between; align-items: center; margin-bottom: 30px;">
                    <div>
                        <a href="<?php echo e(route('admin.forms')); ?>"
                            style="background: #6c757d; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-size: 14px;">
                            ← Back to Forms
                        </a>
                    </div>
                </div>

                <?php if($form): ?>
                    <?php
                        // Safely convert form data to array
                        $formDataArray = [];
                        if (is_array($form->data)) {
                            $formDataArray = $form->data;
                        } elseif (is_string($form->data)) {
                            $decoded = json_decode($form->data, true);
                            $formDataArray = is_array($decoded) ? $decoded : [];
                        }
                    ?>

                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 25px;">

                        <!-- Left Column: Form Details -->
                        <div>

                            <!-- Application Information -->
                            <div
                                style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); margin-bottom: 20px;">
                                <h3
                                    style="color: #004AAD; margin-top: 0; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">
                                    Application Information
                                </h3>

                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                    <div>
                                        <label
                                            style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Form
                                            Type</label>
                                        <div
                                            style="padding: 10px 12px; background: #f8f9fa; border-radius: 6px; color: #666;">
                                            <?php switch($form->type):
                                                case ('vehicle_sticker'): ?>
                                                    Vehicle Sticker Application
                                                <?php break; ?>

                                                <?php case ('facility_report'): ?>
                                                    Facility Report
                                                <?php break; ?>

                                                <?php case ('change_room'): ?>
                                                    Change Room Request
                                                <?php break; ?>

                                                <?php case ('check_out'): ?>
                                                    Check-out Form
                                                <?php break; ?>

                                                <?php default: ?>
                                                    <?php echo e($form->type); ?>

                                            <?php endswitch; ?>
                                        </div>
                                    </div>

                                    <div>
                                        <label
                                            style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Application
                                            Date</label>
                                        <div
                                            style="padding: 10px 12px; background: #f8f9fa; border-radius: 6px; color: #666;">
                                            <?php echo e($form->created_at->format('F j, Y g:i A')); ?>

                                        </div>
                                    </div>

                                    <div>
                                        <label
                                            style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Current
                                            Status</label>
                                        <?php
                                            $statusColors = [
                                                'pending' => ['bg' => '#ffc107', 'text' => '#856404'],
                                                'under_review' => ['bg' => '#17a2b8', 'text' => 'white'],
                                                'approved' => ['bg' => '#28a745', 'text' => 'white'],
                                                'rejected' => ['bg' => '#dc3545', 'text' => 'white'],
                                                'completed' => ['bg' => '#6c757d', 'text' => 'white'],
                                            ];
                                            $color = $statusColors[$form->status] ?? $statusColors['pending'];
                                        ?>
                                        <span
                                            style="background: <?php echo e($color['bg']); ?>; color: <?php echo e($color['text']); ?>; padding: 8px 16px; border-radius: 6px; font-size: 14px; font-weight: bold; display: inline-block;">
                                            <?php echo e(str_replace('_', ' ', ucfirst($form->status))); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Student Information -->
                            <div
                                style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); margin-bottom: 20px;">
                                <h3
                                    style="color: #004AAD; margin-top: 0; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">
                                    Student Information
                                </h3>

                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                    <div>
                                        <label
                                            style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Full
                                            Name</label>
                                        <div
                                            style="padding: 10px 12px; background: #f8f9fa; border-radius: 6px; color: #666;">
                                            <?php echo e($form->user->name ?? 'N/A'); ?>

                                        </div>
                                    </div>

                                    <div>
                                        <label
                                            style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Student
                                            ID</label>
                                        <div
                                            style="padding: 10px 12px; background: #f8f9fa; border-radius: 6px; color: #666;">
                                            <?php echo e($form->user->student->student_id ?? 'N/A'); ?>

                                        </div>
                                    </div>
                                    <div>
                                        <label
                                            style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Phone
                                            Number</label>
                                        <div
                                            style="padding: 10px 12px; background: #f8f9fa; border-radius: 6px; color: #666;">
                                            <?php echo e($form->user->student->phone_number ?? ($formDataArray['phone'] ?? 'N/A')); ?>

                                        </div>
                                    </div>

                                    <div>
                                        <label
                                            style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Room
                                            Number</label>
                                        <div
                                            style="padding: 10px 12px; background: #f8f9fa; border-radius: 6px; color: #666;">
                                            <?php echo e($form->user->student->hostel_room ?? 'N/A'); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Vehicle Details (for vehicle sticker forms) -->
                            <?php if($form->type == 'vehicle_sticker'): ?>
                                <div
                                    style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); margin-bottom: 20px;">
                                    <h3
                                        style="color: #004AAD; margin-top: 0; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">
                                        Vehicle Details
                                    </h3>

                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                        <div>
                                            <label
                                                style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Vehicle
                                                Type</label>
                                            <div
                                                style="padding: 10px 12px; background: #f8f9fa; border-radius: 6px; color: #666;">
                                                <?php echo e(ucfirst($formDataArray['vehicle_type'] ?? 'N/A')); ?>

                                            </div>
                                        </div>

                                        <div>
                                            <label
                                                style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Registration
                                                Number</label>
                                            <div
                                                style="padding: 10px 12px; background: #f8f9fa; border-radius: 6px; color: #666;">
                                                <?php echo e($formDataArray['registration_number'] ?? 'N/A'); ?>

                                            </div>
                                        </div>

                                        <div style="grid-column: span 2;">
                                            <label
                                                style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Model
                                                & Color</label>
                                            <div
                                                style="padding: 10px 12px; background: #f8f9fa; border-radius: 6px; color: #666;">
                                                <?php echo e($formDataArray['model_color'] ?? 'N/A'); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Facility Report Details -->
                            <?php if($form->type == 'facility_report'): ?>
                                <div
                                    style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); margin-bottom: 20px;">
                                    <h3
                                        style="color: #004AAD; margin-top: 0; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">
                                        Facility Report Details
                                    </h3>

                                    <!-- Room Inventory -->
                                    <?php if(isset($formDataArray['inventory'])): ?>
                                        <div style="margin-bottom: 25px;">
                                            <h4 style="color: #004AAD; margin-bottom: 15px;">Room Inventory Count</h4>
                                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                                                <?php $__currentLoopData = ['kerusi' => 'Chair (Kerusi)', 'meja' => 'Table (Meja)', 'almari' => 'Wardrobe (Almari)', 'katil' => 'Bed (Katil)', 'tilam' => 'Mattress (Tilam)']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div style="padding: 10px; background: #f8f9fa; border-radius: 6px;">
                                                        <strong><?php echo e($label); ?></strong><br>
                                                        <span
                                                            style="color: #666;"><?php echo e($formDataArray['inventory'][$key] ?? 0); ?>/10</span>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Condition Checklist -->
                                    <?php if(isset($formDataArray['condition'])): ?>
                                        <div style="margin-bottom: 25px;">
                                            <h4 style="color: #004AAD; margin-bottom: 15px;">Facility Condition</h4>

                                            <!-- Electrical -->
                                            <div style="margin-bottom: 20px;">
                                                <h5 style="color: #004AAD; margin-bottom: 10px;">Electrical</h5>
                                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                                    <?php $__currentLoopData = ['lampu' => 'Light', 'kipas' => 'Fan', 'plug_socket' => 'Plug Socket']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(isset($formDataArray['condition'][$key])): ?>
                                                            <div
                                                                style="padding: 8px; background: #f8f9fa; border-radius: 4px;">
                                                                <strong><?php echo e($label); ?>:</strong>
                                                                <span
                                                                    style="color: #666; text-transform: capitalize;"><?php echo e(str_replace('_', ' ', $formDataArray['condition'][$key])); ?></span>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>

                                            <!-- Plumbing -->
                                            <div style="margin-bottom: 20px;">
                                                <h5 style="color: #004AAD; margin-bottom: 10px;">Plumbing</h5>
                                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                                    <?php $__currentLoopData = ['toilet' => 'Toilet', 'shower' => 'Shower', 'sink' => 'Sink']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(isset($formDataArray['condition'][$key])): ?>
                                                            <div
                                                                style="padding: 8px; background: #f8f9fa; border-radius: 4px;">
                                                                <strong><?php echo e($label); ?>:</strong>
                                                                <span
                                                                    style="color: #666; text-transform: capitalize;"><?php echo e(str_replace('_', ' ', $formDataArray['condition'][$key])); ?></span>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>

                                            <!-- Others -->
                                            <div>
                                                <h5 style="color: #004AAD; margin-bottom: 10px;">Others</h5>
                                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                                    <?php $__currentLoopData = ['langsir' => 'Curtain', 'pintu' => 'Door', 'tingkap' => 'Window']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(isset($formDataArray['condition'][$key])): ?>
                                                            <div
                                                                style="padding: 8px; background: #f8f9fa; border-radius: 4px;">
                                                                <strong><?php echo e($label); ?>:</strong>
                                                                <span
                                                                    style="color: #666; text-transform: capitalize;"><?php echo e(str_replace('_', ' ', $formDataArray['condition'][$key])); ?></span>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Damage Description -->
                                    <?php if(isset($formDataArray['damage_description'])): ?>
                                        <div style="margin-bottom: 25px;">
                                            <h4 style="color: #004AAD; margin-bottom: 10px;">Damage Description</h4>
                                            <div
                                                style="padding: 15px; background: #f8f9fa; border-radius: 6px; white-space: pre-line;">
                                                <?php echo e($formDataArray['damage_description']); ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Change Room Details -->
                            <?php if($form->type == 'change_room'): ?>
                                <div
                                    style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); margin-bottom: 20px;">
                                    <h3
                                        style="color: #004AAD; margin-top: 0; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">
                                        Change Room Details
                                    </h3>

                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                        <div>
                                            <label
                                                style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Current
                                                Room</label>
                                            <div
                                                style="padding: 10px 12px; background: #f8f9fa; border-radius: 6px; color: #666;">
                                                <?php echo e($formDataArray['current_room'] ?? 'N/A'); ?>

                                            </div>
                                        </div>

                                        <div>
                                            <label
                                                style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Preferred
                                                Room</label>
                                            <div
                                                style="padding: 10px 12px; background: #f8f9fa; border-radius: 6px; color: #666;">
                                                <?php echo e($formDataArray['preferred_room'] ?? 'N/A'); ?>

                                            </div>
                                        </div>

                                        <div>
                                            <label
                                                style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Reason</label>
                                            <div
                                                style="padding: 10px 12px; background: #f8f9fa; border-radius: 6px; color: #666; text-transform: capitalize;">
                                                <?php echo e(str_replace('_', ' ', $formDataArray['reason'] ?? 'N/A')); ?>

                                            </div>
                                        </div>

                                        <div>
                                            <label
                                                style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Preferred
                                                Date</label>
                                            <div
                                                style="padding: 10px 12px; background: #f8f9fa; border-radius: 6px; color: #666;">
                                                <?php echo e($formDataArray['preferred_date'] ? date('F j, Y', strtotime($formDataArray['preferred_date'])) : 'Not specified'); ?>

                                            </div>
                                        </div>

                                        <div style="grid-column: span 2;">
                                            <label
                                                style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Detailed
                                                Explanation</label>
                                            <div
                                                style="padding: 15px; background: #f8f9fa; border-radius: 6px; color: #666; white-space: pre-line;">
                                                <?php echo e($formDataArray['explanation'] ?? 'No explanation provided'); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Check-out Details -->
                            <?php if($form->type == 'check_out'): ?>
                                <div
                                    style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); margin-bottom: 20px;">
                                    <h3
                                        style="color: #004AAD; margin-top: 0; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">
                                        Check-out Details
                                    </h3>

                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                        <div>
                                            <label
                                                style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Current
                                                Room</label>
                                            <div
                                                style="padding: 10px 12px; background: #f8f9fa; border-radius: 6px; color: #666;">
                                                <?php echo e($formDataArray['current_room'] ?? 'N/A'); ?>

                                            </div>
                                        </div>

                                        <div>
                                            <label
                                                style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Planned
                                                Check-out Date</label>
                                            <div
                                                style="padding: 10px 12px; background: #f8f9fa; border-radius: 6px; color: #666;">
                                                <?php echo e($formDataArray['checkout_date'] ? date('F j, Y', strtotime($formDataArray['checkout_date'])) : 'Not specified'); ?>

                                            </div>
                                        </div>

                                        <div>
                                            <label
                                                style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Reason</label>
                                            <div
                                                style="padding: 10px 12px; background: #f8f9fa; border-radius: 6px; color: #666; text-transform: capitalize;">
                                                <?php
                                                    $reasonLabels = [
                                                        'completed_studies' => 'Completed Studies',
                                                        'transfer' => 'Transfer to Another Institution',
                                                        'personal' => 'Personal/Family Reasons',
                                                        'health' => 'Health Reasons',
                                                        'withdrawn' => 'Withdrawn from Program',
                                                        'completed_semester' => 'Completed Current Semester',
                                                        'other' => 'Other',
                                                    ];
                                                ?>
                                                <?php echo e($reasonLabels[$formDataArray['reason']] ?? ucfirst($formDataArray['reason'] ?? 'N/A')); ?>

                                            </div>
                                        </div>

                                        <div>
                                            <label
                                                style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Phone
                                                Number</label>
                                            <div
                                                style="padding: 10px 12px; background: #f8f9fa; border-radius: 6px; color: #666;">
                                                <?php echo e($formDataArray['phone'] ?? 'N/A'); ?>

                                            </div>
                                        </div>

                                        <div style="grid-column: span 2;">
                                            <label
                                                style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Forwarding
                                                Address</label>
                                            <div
                                                style="padding: 15px; background: #f8f9fa; border-radius: 6px; color: #666; white-space: pre-line;">
                                                <?php echo e($formDataArray['forwarding_address'] ?? 'No address provided'); ?>

                                            </div>
                                        </div>

                                        <div>
                                            <label
                                                style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Emergency
                                                Contact</label>
                                            <div
                                                style="padding: 10px 12px; background: #f8f9fa; border-radius: 6px; color: #666;">
                                                <?php echo e($formDataArray['emergency_contact_name'] ?? 'N/A'); ?><br>
                                                <?php echo e($formDataArray['emergency_contact_phone'] ?? 'N/A'); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Status Overview - ADMIN ONLY -->
                                <div
                                    style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); margin-bottom: 20px;">
                                    <h3
                                        style="color: #004AAD; margin-top: 0; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">
                                        Payment Status Overview
                                    </h3>

                                    <div
                                        style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                                        <div>
                                            <label
                                                style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Student
                                                Payment History</label>
                                            <div
                                                style="padding: 10px 12px; background: #f8f9fa; border-radius: 6px; color: #666;">
                                                <a href="/admin/payments?student=<?php echo e($form->user->student->student_id ?? ''); ?>"
                                                    style="color: #004AAD; text-decoration: none;">
                                                    View Payment Records ›
                                                </a>
                                            </div>
                                        </div>

                                        <div>
                                            <label
                                                style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Financial
                                                Clearance</label>
                                            <div
                                                style="padding: 10px 12px; background: #f8f9fa; border-radius: 6px; color: #666;">
                                                <select id="financial_clearance"
                                                    style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                                                    <option value="pending">Pending Verification</option>
                                                    <option value="cleared">All Fees Cleared</option>
                                                    <option value="outstanding">Outstanding Balance</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        style="background: #e7f3ff; padding: 15px; border-radius: 6px; border-left: 4px solid #004AAD;">
                                        <h4 style="color: #004AAD; margin: 0 0 10px 0;">Admin Notes:</h4>
                                        <textarea id="payment_notes"
                                            placeholder="Add notes about payment verification, outstanding fees, or other financial matters..."
                                            style="width: 100%; padding: 10px; border: 1px solid #b3d7ff; border-radius: 4px; min-height: 80px;"></textarea>
                                    </div>
                                </div>

                                <!-- Property Clearance Status -->
                                <div
                                    style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); margin-bottom: 20px;">
                                    <h3
                                        style="color: #004AAD; margin-top: 0; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">
                                        Property Clearance Status
                                    </h3>

                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                                        <!-- Room Key Returned -->
                                        <div
                                            style="padding: 15px; background: #f8f9fa; border-radius: 6px; text-align: center;">
                                            <div style="font-weight: 500; margin-bottom: 10px;">Room Key Returned</div>
                                            <div id="keyStatus"
                                                style="color: #dc3545; font-weight: bold; margin-bottom: 10px;">
                                                ❌ Not Returned
                                            </div>
                                            <button onclick="updatePropertyStatus('key_returned')"
                                                style="background: #004AAD; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; font-size: 12px;">
                                                Mark as Returned
                                            </button>
                                        </div>

                                        <!-- Belongings Removed -->
                                        <div
                                            style="padding: 15px; background: #f8f9fa; border-radius: 6px; text-align: center;">
                                            <div style="font-weight: 500; margin-bottom: 10px;">Belongings Removed</div>
                                            <div id="belongingsStatus"
                                                style="color: #dc3545; font-weight: bold; margin-bottom: 10px;">
                                                ❌ Not Confirmed
                                            </div>
                                            <button onclick="updatePropertyStatus('belongings_removed')"
                                                style="background: #004AAD; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; font-size: 12px;">
                                                Mark as Removed
                                            </button>
                                        </div>

                                        <!-- No Damage -->
                                        <div
                                            style="padding: 15px; background: #f8f9fa; border-radius: 6px; text-align: center;">
                                            <div style="font-weight: 500; margin-bottom: 10px;">No Damage</div>
                                            <div id="damageStatus"
                                                style="color: #dc3545; font-weight: bold; margin-bottom: 10px;">
                                                ❌ Not Verified
                                            </div>
                                            <button onclick="updatePropertyStatus('no_damage')"
                                                style="background: #004AAD; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; font-size: 12px;">
                                                Mark as Verified
                                            </button>
                                        </div>

                                        <!-- Fees Cleared -->
                                        <div
                                            style="padding: 15px; background: #f8f9fa; border-radius: 6px; text-align: center;">
                                            <div style="font-weight: 500; margin-bottom: 10px;">Fees Cleared</div>
                                            <div id="feesStatus"
                                                style="color: #ffc107; font-weight: bold; margin-bottom: 10px;">
                                                ⏳ Pending Verification
                                            </div>
                                            <button onclick="updatePropertyStatus('fees_cleared')"
                                                style="background: #004AAD; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; font-size: 12px;">
                                                Mark as Cleared
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Overall Clearance Status -->
                                    <div id="overallStatus"
                                        style="margin-top: 20px; padding: 15px; background: #fff3cd; border-radius: 6px; text-align: center; display: none;">
                                        <h4 style="color: #856404; margin: 0;">✅ All Property Clearance Completed!</h4>
                                        <p style="color: #856404; margin: 5px 0 0 0;">Student is cleared for check-out.</p>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Uploaded Documents & Media -->
                            <div
                                style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                                <h3
                                    style="color: #004AAD; margin-top: 0; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">
                                    Uploaded Files
                                </h3>

                                <div style="display: grid; grid-template-columns: 1fr; gap: 15px;">
                                    <!-- Vehicle Sticker Documents -->
                                    <?php if($form->type == 'vehicle_sticker'): ?>
                                        <?php if(isset($formDataArray['drivers_license']) && $formDataArray['drivers_license']): ?>
                                            <div
                                                style="padding: 15px; background: #f8fbff; border-radius: 6px; border-left: 4px solid #004AAD;">
                                                <div style="font-weight: 500; color: #333; margin-bottom: 5px;">Driver's
                                                    License</div>
                                                <div style="font-size: 14px; color: #666;">
                                                    <?php echo e(basename($formDataArray['drivers_license'])); ?></div>
                                                <a href="<?php echo e(asset('storage/' . $formDataArray['drivers_license'])); ?>"
                                                    target="_blank"
                                                    style="background: #004AAD; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; margin-top: 8px; text-decoration: none; display: inline-block;">
                                                    View Document
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(isset($formDataArray['vehicle_registration']) && $formDataArray['vehicle_registration']): ?>
                                            <div
                                                style="padding: 15px; background: #f8fbff; border-radius: 6px; border-left: 4px solid #004AAD;">
                                                <div style="font-weight: 500; color: #333; margin-bottom: 5px;">Vehicle
                                                    Registration</div>
                                                <div style="font-size: 14px; color: #666;">
                                                    <?php echo e(basename($formDataArray['vehicle_registration'])); ?></div>
                                                <a href="<?php echo e(asset('storage/' . $formDataArray['vehicle_registration'])); ?>"
                                                    target="_blank"
                                                    style="background: #004AAD; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; margin-top: 8px; text-decoration: none; display: inline-block;">
                                                    View Document
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(isset($formDataArray['insurance_document']) && $formDataArray['insurance_document']): ?>
                                            <div
                                                style="padding: 15px; background: #f8fbff; border-radius: 6px; border-left: 4px solid #004AAD;">
                                                <div style="font-weight: 500; color: #333; margin-bottom: 5px;">Insurance
                                                    Document</div>
                                                <div style="font-size: 14px; color: #666;">
                                                    <?php echo e(basename($formDataArray['insurance_document'])); ?></div>
                                                <a href="<?php echo e(asset('storage/' . $formDataArray['insurance_document'])); ?>"
                                                    target="_blank"
                                                    style="background: #004AAD; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; margin-top: 8px; text-decoration: none; display: inline-block;">
                                                    View Document
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <!-- Facility Report Media -->
                                    <?php if($form->type == 'facility_report' && isset($formDataArray['media']) && count($formDataArray['media']) > 0): ?>
                                        <?php $__currentLoopData = $formDataArray['media']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div
                                                style="padding: 15px; background: #f8fbff; border-radius: 6px; border-left: 4px solid #004AAD;">
                                                <div style="font-weight: 500; color: #333; margin-bottom: 5px;">
                                                    <?php if(str_contains($media, '.jpg') ||
                                                            str_contains($media, '.jpeg') ||
                                                            str_contains($media, '.png') ||
                                                            str_contains($media, '.gif')): ?>
                                                        Photo
                                                    <?php elseif(str_contains($media, '.mp4') || str_contains($media, '.mov') || str_contains($media, '.avi')): ?>
                                                        Video
                                                    <?php else: ?>
                                                        File
                                                    <?php endif; ?>
                                                </div>
                                                <div style="font-size: 14px; color: #666;"><?php echo e(basename($media)); ?></div>
                                                <a href="<?php echo e(asset('storage/' . $media)); ?>" target="_blank"
                                                    style="background: #004AAD; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; margin-top: 8px; text-decoration: none; display: inline-block;">
                                                    View File
                                                </a>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                    <!-- No Files Message -->
                                    <?php if(
                                        ($form->type == 'vehicle_sticker' &&
                                            !isset($formDataArray['drivers_license']) &&
                                            !isset($formDataArray['vehicle_registration']) &&
                                            !isset($formDataArray['insurance_document'])) ||
                                            ($form->type == 'facility_report' && (!isset($formDataArray['media']) || count($formDataArray['media']) == 0))): ?>
                                        <div style="padding: 15px; text-align: center; color: #666;">
                                            No files uploaded for this form.
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>

                        <!-- Right Column: Actions & Comments -->
                        <div>

                            <!-- Status Actions -->
                            <div
                                style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); margin-bottom: 20px;">
                                <h3
                                    style="color: #004AAD; margin-top: 0; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">
                                    Update Status
                                </h3>

                                <div style="margin-bottom: 15px;">
                                    <label
                                        style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Change
                                        Status</label>
                                    <select id="statusSelect"
                                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
                                        <option value="pending" <?php echo e($form->status == 'pending' ? 'selected' : ''); ?>>
                                            Pending
                                        </option>
                                        <option value="under_review"
                                            <?php echo e($form->status == 'under_review' ? 'selected' : ''); ?>>Under Review
                                        </option>
                                        <option value="approved" <?php echo e($form->status == 'approved' ? 'selected' : ''); ?>>
                                            Approved</option>
                                        <option value="rejected" <?php echo e($form->status == 'rejected' ? 'selected' : ''); ?>>
                                            Rejected</option>
                                        <option value="completed" <?php echo e($form->status == 'completed' ? 'selected' : ''); ?>>
                                            Completed</option>
                                    </select>
                                </div>

                                <div style="margin-bottom: 15px;">
                                    <label style="display: block; font-weight: 500; color: #333; margin-bottom: 8px;">Admin
                                        Comment</label>
                                    <textarea id="adminComment"
                                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; min-height: 100px;"
                                        placeholder="Add a comment for the student..."><?php echo e($form->admin_comment); ?></textarea>
                                </div>

                                <button onclick="updateFormStatus(<?php echo e($form->id); ?>)"
                                    style="background: #004AAD; color: white; border: none; padding: 12px 24px; border-radius: 6px; cursor: pointer; font-size: 14px; width: 100%;">
                                    Update Status
                                </button>
                            </div>

                            <!-- Quick Actions -->
                            <div
                                style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                                <h3
                                    style="color: #004AAD; margin-top: 0; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0;">
                                    Quick Actions
                                </h3>

                                <div style="display: grid; grid-template-columns: 1fr; gap: 10px; margin-bottom: 20px;">
                                    <button onclick="updateStatusDirect(<?php echo e($form->id); ?>, 'approved')"
                                        style="background: #28a745; color: white; border: none; padding: 12px; border-radius: 6px; cursor: pointer; font-size: 14px; text-align: center;">
                                        Approve Application
                                    </button>

                                    <button onclick="updateStatusDirect(<?php echo e($form->id); ?>, 'rejected')"
                                        style="background: #dc3545; color: white; border: none; padding: 12px; border-radius: 6px; cursor: pointer; font-size: 14px; text-align: center;">
                                        Reject Application
                                    </button>

                                    <button onclick="updateStatusDirect(<?php echo e($form->id); ?>, 'completed')"
                                        style="background: #6c757d; color: white; border: none; padding: 12px; border-radius: 6px; cursor: pointer; font-size: 14px; text-align: center;">
                                        Mark as Completed
                                    </button>
                                </div>

                                <!-- Export Buttons -->
                                <div style="border-top: 2px solid #f0f0f0; padding-top: 20px;">
                                    <h4 style="color: #004AAD; margin-bottom: 15px;">Export </h4>
                                    <div style="display: flex; flex-direction: column; gap: 10px;">
                                        <button onclick="exportToPDF(<?php echo e($form->id); ?>)"
                                            style="background: #dc3545; color: white; border: none; padding: 12px; border-radius: 6px; text-decoration: none; font-size: 14px; text-align: center; display: block; cursor: pointer;">
                                            <i class="fas fa-file-pdf"></i> Export to PDF
                                        </button>


                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                <?php else: ?>
                    <div
                        style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); text-align: center;">
                        <h3 style="color: #dc3545; margin-bottom: 15px;">Form Not Found</h3>
                        <p style="color: #666; margin-bottom: 20px;">The requested form could not be found.</p>
                        <a href="<?php echo e(route('admin.forms')); ?>"
                            style="background: #004AAD; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none;">
                            Back to Forms
                        </a>
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
        });

        function updateFormStatus(formId) {
            const status = document.getElementById('statusSelect').value;
            const comment = document.getElementById('adminComment').value;

            fetch(`/admin/forms/${formId}/status`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        status: status,
                        admin_comment: comment
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Status updated successfully!');
                        location.reload();
                    } else {
                        alert('Error updating status');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error updating status');
                });
        }

        function updateStatusDirect(formId, status) {
            if (confirm(`Are you sure you want to ${status} this application?`)) {
                fetch(`/admin/forms/${formId}/status`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            status: status,
                            admin_comment: document.getElementById('adminComment').value
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(`Application ${status} successfully!`);
                            location.reload();
                        } else {
                            alert('Error updating status');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error updating status');
                    });
            }
        }

        // ===== PROPERTY CLEARANCE FUNCTIONS =====
        function updatePropertyStatus(propertyType) {
            if (confirm(`Are you sure you want to mark ${propertyType.replace(/_/g, ' ')} as completed?`)) {
                const statusMap = {
                    key_returned: {
                        element: document.getElementById('keyStatus'),
                        text: '✓ Returned',
                        color: '#28a745'
                    },
                    belongings_removed: {
                        element: document.getElementById('belongingsStatus'),
                        text: '✓ Removed',
                        color: '#28a745'
                    },
                    no_damage: {
                        element: document.getElementById('damageStatus'),
                        text: '✓ Verified',
                        color: '#28a745'
                    },
                    fees_cleared: {
                        element: document.getElementById('feesStatus'),
                        text: '✓ Cleared',
                        color: '#28a745'
                    }
                };

                if (statusMap[propertyType]) {
                    const {
                        element,
                        text,
                        color
                    } = statusMap[propertyType];
                    element.textContent = text;
                    element.style.color = color;

                    // Disable the button
                    const button = element.nextElementSibling;
                    if (button) {
                        button.style.display = 'none';
                    }
                }

                checkAllCompleted();
            }
        }

        function checkAllCompleted() {
            const statusElements = [
                document.getElementById('keyStatus'),
                document.getElementById('belongingsStatus'),
                document.getElementById('damageStatus'),
                document.getElementById('feesStatus')
            ];

            const allCompleted = statusElements.every(element =>
                element.textContent.includes('✓')
            );

            if (allCompleted) {
                document.getElementById('overallStatus').style.display = 'block';
            }
        }
        // ===== END PROPERTY CLEARANCE FUNCTIONS =====

        // ===== PDF EXPORT FUNCTION =====
        function exportToPDF(formId) {
            // Show loading state
            const pdfButton = event.target;
            const originalText = pdfButton.innerHTML;
            pdfButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generating PDF...';
            pdfButton.disabled = true;

            fetch(`/admin/forms/${formId}/export-pdf`, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    }
                })
                .then(response => {
                    if (response.ok) {
                        return response.blob();
                    }
                    throw new Error('PDF generation failed');
                })
                .then(blob => {
                    // Create download link
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.style.display = 'none';
                    a.href = url;
                    a.download = `form-${formId}-${new Date().toISOString().split('T')[0]}.pdf`;
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);

                    // Reset button
                    pdfButton.innerHTML = originalText;
                    pdfButton.disabled = false;
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error generating PDF: ' + error.message);
                    // Reset button
                    pdfButton.innerHTML = originalText;
                    pdfButton.disabled = false;
                });
        }
        // ===== END PDF EXPORT FUNCTION =====
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\myFYP\resources\views/admin/form-review.blade.php ENDPATH**/ ?>