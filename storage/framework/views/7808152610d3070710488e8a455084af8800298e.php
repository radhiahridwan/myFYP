

<?php $__env->startSection('title', 'Forms'); ?>

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
                style="display: flex; justify-content: space-between; align-items: center; background: white; padding: 15px 25px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 999; backdrop-filter: blur(10px);">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <span id="menu-toggle" style="font-size: 26px; cursor: pointer; color: #004AAD;">☰</span>
                    <h2 style="color: #004AAD; margin: 0;">Forms</h2>
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

            <!-- ===== FORMS CONTENT ===== -->
            <div style="padding: 25px;">

                <!-- Back Button -->
                <div style="margin-bottom: 20px;">
                    <a href="<?php echo e(route('students.dashboard')); ?>"
                        style="background: #6c757d; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-size: 14px;">
                        ← Back
                    </a>
                </div>

                <!-- OPEN FORMS Section -->
                <div style="margin-bottom: 30px;">
                    <h1 style="color: #004AAD; margin-bottom: 20px; font-size: 24px; font-weight: bold;">OPEN FORMS</h1>
                    <div style="display: flex; flex-direction: column; gap: 15px;">
                        <?php
                            // Get user's submitted forms
$userForms = \App\Models\Form::where('user_id', auth()->id())->get();

// SIMPLE CHECK - if user has any forms of each type
$hasVehicleSticker = $userForms->where('type', 'vehicle_sticker')->count() > 0;
$hasFacilityReport = $userForms->where('type', 'facility_report')->count() > 0;
$hasChangeRoom = $userForms->where('type', 'change_room')->count() > 0;
$hasCheckOut = $userForms->where('type', 'check_out')->count() > 0;

// Get LATEST form of each type for status
$vehicleForm = $userForms
    ->where('type', 'vehicle_sticker')
    ->sortByDesc('created_at')
    ->first();
$facilityForm = $userForms
    ->where('type', 'facility_report')
    ->sortByDesc('created_at')
    ->first();
$changeRoomForm = $userForms
    ->where('type', 'change_room')
    ->sortByDesc('created_at')
    ->first();
$checkOutForm = $userForms->where('type', 'check_out')->sortByDesc('created_at')->first();

$vehicleStatus = $vehicleForm->status ?? 'not_applied';
$facilityStatus = $facilityForm->status ?? 'not_applied';
$changeRoomStatus = $changeRoomForm->status ?? 'not_applied';
$checkOutStatus = $checkOutForm->status ?? 'not_applied';
                        ?>
                        <!-- Vehicle Sticker Application Card -->
                        <div class="form-card"
                            style="
                            background: white;
                            border-radius: 12px;
                            padding: 20px;
                            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                            transition: all 0.3s ease;
                            border: 1px solid #e0e0e0;
                        ">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <div style="flex: 1;">
                                    <h3
                                        style="color: #004AAD; margin-top: 0; margin-bottom: 8px; font-size: 16px; font-weight: bold;">
                                        VEHICLE STICKER APPLICATION
                                    </h3>
                                    <p style="color: #666; font-size: 13px; margin-bottom: 8px; font-style: italic;">
                                        Form can be applied multiple times
                                    </p>
                                    <p style="color: #333; font-size: 14px; margin-bottom: 0;">
                                        <strong>Description:</strong> Apply for permission to bring your personal vehicle to
                                        hostel grounds
                                    </p>

                                    <!-- Show submitted details if applied -->
                                    <?php if($hasVehicleSticker): ?>
                                        <?php
                                            $vehicleForm = $vehicleForm;
                                            $vehicleData = json_decode($vehicleForm->data, true);
                                        ?>
                                        <div
                                            style="margin-top: 10px; padding: 10px; background: #f8fbff; border-radius: 6px;">
                                            <div style="font-size: 12px; color: #666;">
                                                <strong>Submitted:</strong>
                                                <?php echo e($vehicleForm->created_at->format('d M Y')); ?><br>
                                                <strong>Vehicle:</strong>
                                                <?php echo e($vehicleData['registration_number'] ?? 'N/A'); ?> -
                                                <?php echo e($vehicleData['model_color'] ?? 'N/A'); ?>

                                            </div>
                                        </div>

                                        <!-- Comments Section -->
                                        <?php if($vehicleForm->admin_comment): ?>
                                            <div style="margin-top: 15px;">
                                                <h4 style="color: #004AAD; margin: 0 0 10px 0; font-size: 14px;">Comments &
                                                    Updates</h4>
                                                <button onclick="toggleComments('vehicle-<?php echo e($vehicleForm->id); ?>')"
                                                    style="background: #004AAD; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-size: 11px; margin-bottom: 10px;">
                                                    Show Comments
                                                </button>
                                                <div id="vehicle-<?php echo e($vehicleForm->id); ?>-comments" style="display: none;">
                                                    <!-- Admin Comments -->
                                                    <div
                                                        style="background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 6px; padding: 10px; margin-bottom: 10px;">
                                                        <div style="font-size: 12px; color: #856404;">
                                                            <strong>Admin:</strong>
                                                            <span style="color: #666; font-size: 11px;">
                                                                <?php echo e($vehicleForm->updated_at->format('M j, Y g:i A')); ?>

                                                            </span>
                                                        </div>
                                                        <div
                                                            style="font-size: 13px; color: #333; margin-top: 5px; white-space: pre-line;">
                                                            <?php echo e($vehicleForm->admin_comment); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 10px;">
                                    <a href="<?php echo e(route('forms.vehicle-sticker.create')); ?>"
                                        style="background: #004AAD; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; transition: background 0.3s; white-space: nowrap;">
                                        <?php echo e($hasVehicleSticker ? 'Apply Again' : 'Click to Apply'); ?>

                                    </a>
                                    <div style="text-align: right;">
                                        <div style="font-size: 13px; color: #333; margin-bottom: 3px;">Status:</div>
                                        <?php if($hasVehicleSticker): ?>
                                            <?php
                                                $statusColors = [
                                                    'pending' => [
                                                        'bg' => '#ffc107',
                                                        'text' => '#856404',
                                                        'label' => 'Pending',
                                                    ],
                                                    'under_review' => [
                                                        'bg' => '#17a2b8',
                                                        'text' => 'white',
                                                        'label' => 'Under Review',
                                                    ],
                                                    'approved' => [
                                                        'bg' => '#28a745',
                                                        'text' => 'white',
                                                        'label' => 'Approved',
                                                    ],
                                                    'rejected' => [
                                                        'bg' => '#dc3545',
                                                        'text' => 'white',
                                                        'label' => 'Rejected',
                                                    ],
                                                    'completed' => [
                                                        'bg' => '#6c757d',
                                                        'text' => 'white',
                                                        'label' => 'Completed',
                                                    ],
                                                ];
                                                $color = $statusColors[$vehicleStatus] ?? $statusColors['pending'];
                                            ?>
                                            <span
                                                style="background: <?php echo e($color['bg']); ?>; color: <?php echo e($color['text']); ?>; padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: bold;">
                                                <?php echo e($color['label']); ?>

                                            </span>
                                        <?php else: ?>
                                            <span
                                                style="background: #dc3545; color: white; padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: bold;">
                                                Not Applied
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Facility Report Card -->
                        <div class="form-card"
                            style="
                            background: white;
                            border-radius: 12px;
                            padding: 20px;
                            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                            transition: all 0.3s ease;
                            border: 1px solid #e0e0e0;
                        ">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <div style="flex: 1;">
                                    <h3
                                        style="color: #004AAD; margin-top: 0; margin-bottom: 8px; font-size: 16px; font-weight: bold;">
                                        FACILITY REPORT
                                    </h3>
                                    <p style="color: #666; font-size: 13px; margin-bottom: 8px; font-style: italic;">
                                        Form can be applied multiple times
                                    </p>
                                    <p style="color: #333; font-size: 14px; margin-bottom: 0;">
                                        <strong>Description:</strong> Report issues or damages in rooms or common areas
                                    </p>

                                    <?php if($hasFacilityReport): ?>
                                        <?php
                                            $facilityForm = $facilityForm;
                                        ?>
                                        <div
                                            style="margin-top: 10px; padding: 10px; background: #f8fbff; border-radius: 6px;">
                                            <div style="font-size: 12px; color: #666;">
                                                <strong>Submitted:</strong>
                                                <?php echo e($facilityForm->created_at->format('d M Y')); ?>

                                            </div>
                                        </div>

                                        <!-- Comments Section -->
                                        <?php if($facilityForm->admin_comment): ?>
                                            <div style="margin-top: 15px;">
                                                <h4 style="color: #004AAD; margin: 0 0 10px 0; font-size: 14px;">Comments &
                                                    Updates</h4>
                                                <button onclick="toggleComments('facility-<?php echo e($facilityForm->id); ?>')"
                                                    style="background: #004AAD; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-size: 11px; margin-bottom: 10px;">
                                                    Show Comments
                                                </button>
                                                <div id="facility-<?php echo e($facilityForm->id); ?>-comments"
                                                    style="display: none;">
                                                    <!-- Admin Comments -->
                                                    <div
                                                        style="background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 6px; padding: 10px; margin-bottom: 10px;">
                                                        <div style="font-size: 12px; color: #856404;">
                                                            <strong>Admin:</strong>
                                                            <span style="color: #666; font-size: 11px;">
                                                                <?php echo e($facilityForm->updated_at->format('M j, Y g:i A')); ?>

                                                            </span>
                                                        </div>
                                                        <div
                                                            style="font-size: 13px; color: #333; margin-top: 5px; white-space: pre-line;">
                                                            <?php echo e($facilityForm->admin_comment); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 10px;">
                                    <a href="<?php echo e(route('forms.facility-report.create')); ?>"
                                        style="background: #004AAD; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; transition: background 0.3s; white-space: nowrap;">
                                        <?php echo e($hasFacilityReport ? 'Report Again' : 'Click to Apply'); ?>

                                    </a>
                                    <div style="text-align: right;">
                                        <div style="font-size: 13px; color: #333; margin-bottom: 3px;">Status:</div>
                                        <?php if($hasFacilityReport): ?>
                                            <?php
                                                $color = $statusColors[$facilityStatus] ?? $statusColors['pending'];
                                            ?>
                                            <span
                                                style="background: <?php echo e($color['bg']); ?>; color: <?php echo e($color['text']); ?>; padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: bold;">
                                                <?php echo e($color['label']); ?>

                                            </span>
                                        <?php else: ?>
                                            <span
                                                style="background: #dc3545; color: white; padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: bold;">
                                                Not Applied
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Change Room Request Card -->
                        <div class="form-card"
                            style="
                            background: white;
                            border-radius: 12px;
                            padding: 20px;
                            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                            transition: all 0.3s ease;
                            border: 1px solid #e0e0e0;
                        ">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <div style="flex: 1;">
                                    <h3
                                        style="color: #004AAD; margin-top: 0; margin-bottom: 8px; font-size: 16px; font-weight: bold;">
                                        CHANGE ROOM REQUEST
                                    </h3>
                                    <p style="color: #666; font-size: 13px; margin-bottom: 8px; font-style: italic;">
                                        Form can be applied multiple times
                                    </p>
                                    <p style="color: #333; font-size: 14px; margin-bottom: 0;">
                                        <strong>Description:</strong> Request room change for medical or personal reasons
                                    </p>

                                    <?php if($hasChangeRoom): ?>
                                        <?php

                                            $changeRoomForm = $changeRoomForm;
                                        ?>
                                        <div
                                            style="margin-top: 10px; padding: 10px; background: #f8fbff; border-radius: 6px;">
                                            <div style="font-size: 12px; color: #666;">
                                                <strong>Submitted:</strong>
                                                <?php echo e($changeRoomForm->created_at->format('d M Y')); ?>

                                            </div>
                                        </div>

                                        <!-- Comments Section -->
                                        <?php if($changeRoomForm->admin_comment): ?>
                                            <div style="margin-top: 15px;">
                                                <h4 style="color: #004AAD; margin: 0 0 10px 0; font-size: 14px;">Comments &
                                                    Updates</h4>
                                                <button onclick="toggleComments('change-room-<?php echo e($changeRoomForm->id); ?>')"
                                                    style="background: #004AAD; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-size: 11px; margin-bottom: 10px;">
                                                    Show Comments
                                                </button>
                                                <div id="change-room-<?php echo e($changeRoomForm->id); ?>-comments"
                                                    style="display: none;">
                                                    <!-- Admin Comments -->
                                                    <div
                                                        style="background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 6px; padding: 10px; margin-bottom: 10px;">
                                                        <div style="font-size: 12px; color: #856404;">
                                                            <strong>Admin:</strong>
                                                            <span style="color: #666; font-size: 11px;">
                                                                <?php echo e($changeRoomForm->updated_at->format('M j, Y g:i A')); ?>

                                                            </span>
                                                        </div>
                                                        <div
                                                            style="font-size: 13px; color: #333; margin-top: 5px; white-space: pre-line;">
                                                            <?php echo e($changeRoomForm->admin_comment); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 10px;">
                                    <a href="<?php echo e(route('forms.change-room.create')); ?>"
                                        style="background: #004AAD; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; transition: background 0.3s; white-space: nowrap;">
                                        <?php echo e($hasChangeRoom ? 'Request Again' : 'Click to Apply'); ?>

                                    </a>
                                    <div style="text-align: right;">
                                        <div style="font-size: 13px; color: #333; margin-bottom: 3px;">Status:</div>
                                        <?php if($hasChangeRoom): ?>
                                            <?php
                                                $color = $statusColors[$changeRoomStatus] ?? $statusColors['pending'];
                                            ?>
                                            <span
                                                style="background: <?php echo e($color['bg']); ?>; color: <?php echo e($color['text']); ?>; padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: bold;">
                                                <?php echo e($color['label']); ?>

                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hostel Check-out Form Card -->
                        <div class="form-card"
                            style="
                            background: white;
                            border-radius: 12px;
                            padding: 20px;
                            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                            transition: all 0.3s ease;
                            border: 1px solid #e0e0e0;
                        ">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <div style="flex: 1;">
                                    <h3
                                        style="color: #004AAD; margin-top: 0; margin-bottom: 8px; font-size: 16px; font-weight: bold;">
                                        HOSTEL CHECK-OUT FORM
                                    </h3>
                                    <p style="color: #666; font-size: 13px; margin-bottom: 8px; font-style: italic;">
                                        Form can be applied only once
                                    </p>
                                    <p style="color: #333; font-size: 14px; margin-bottom: 0;">
                                        <strong>Description:</strong> Formal procedure for permanently leaving the hostel
                                    </p>

                                    <?php if($hasCheckOut): ?>
                                        <?php
                                            $checkOutForm = $checkOutForm;
                                        ?>
                                        <div
                                            style="margin-top: 10px; padding: 10px; background: #f8fbff; border-radius: 6px;">
                                            <div style="font-size: 12px; color: #666;">
                                                <strong>Submitted:</strong>
                                                <?php echo e($checkOutForm->created_at->format('d M Y')); ?>

                                            </div>
                                        </div>

                                        <!-- Comments Section -->
                                        <?php if($checkOutForm->admin_comment): ?>
                                            <div style="margin-top: 15px;">
                                                <h4 style="color: #004AAD; margin: 0 0 10px 0; font-size: 14px;">Comments &
                                                    Updates</h4>
                                                <button onclick="toggleComments('checkout-<?php echo e($checkOutForm->id); ?>')"
                                                    style="background: #004AAD; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-size: 11px; margin-bottom: 10px;">
                                                    Show Comments
                                                </button>
                                                <div id="checkout-<?php echo e($checkOutForm->id); ?>-comments"
                                                    style="display: none;">
                                                    <!-- Admin Comments -->
                                                    <div
                                                        style="background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 6px; padding: 10px; margin-bottom: 10px;">
                                                        <div style="font-size: 12px; color: #856404;">
                                                            <strong>Admin:</strong>
                                                            <span style="color: #666; font-size: 11px;">
                                                                <?php echo e($checkOutForm->updated_at->format('M j, Y g:i A')); ?>

                                                            </span>
                                                        </div>
                                                        <div
                                                            style="font-size: 13px; color: #333; margin-top: 5px; white-space: pre-line;">
                                                            <?php echo e($checkOutForm->admin_comment); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 10px;">
                                    <a href="<?php echo e(route('forms.check-out.create')); ?>"
                                        style="background: #004AAD; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; transition: background 0.3s; white-space: nowrap;">
                                        <?php echo e($hasCheckOut ? 'View Application' : 'Click to Apply'); ?>

                                    </a>
                                    <div style="text-align: right;">
                                        <div style="font-size: 13px; color: #333; margin-bottom: 3px;">Status:</div>
                                        <?php if($hasCheckOut): ?>
                                            <?php
                                                $color = $statusColors[$checkOutStatus] ?? $statusColors['pending'];
                                            ?>
                                            <span
                                                style="background: <?php echo e($color['bg']); ?>; color: <?php echo e($color['text']); ?>; padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: bold;">
                                                <?php echo e($color['label']); ?>

                                            </span>
                                        <?php else: ?>
                                            <span
                                                style="background: #dc3545; color: white; padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: bold;">
                                                Not Applied
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

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

            // Hover animation for form cards
            document.querySelectorAll('.form-card').forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-2px)';
                    card.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
                });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0)';
                    card.style.boxShadow = '0 2px 6px rgba(0,0,0,0.1)';
                });
            });

            // Button hover effects
            document.querySelectorAll('a[style*="background: #004AAD"]').forEach(btn => {
                btn.addEventListener('mouseenter', () => {
                    btn.style.background = '#003580';
                });
                btn.addEventListener('mouseleave', () => {
                    btn.style.background = '#004AAD';
                });
            });
        });

        function markNotificationAsRead(notificationId) {
            fetch(`/notifications/${notificationId}/mark-read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const notificationItem = document.querySelector(
                            `.notification-item[data-id="${notificationId}"]`);
                        if (notificationItem) {
                            notificationItem.style.background = 'white';
                            notificationItem.style.fontWeight = 'normal';
                        }
                    }
                });
        }

        function toggleComments(formId) {
            const commentsDiv = document.getElementById(formId + '-comments');
            const button = event.target;

            if (commentsDiv.style.display === 'none') {
                commentsDiv.style.display = 'block';
                button.textContent = 'Hide Comments';
            } else {
                commentsDiv.style.display = 'none';
                button.textContent = 'Show Comments';
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\myFYP\resources\views/students/forms.blade.php ENDPATH**/ ?>