

<?php $__env->startSection('title', 'Admin Forms'); ?>

<?php $__env->startSection('content'); ?>
    <div class="admin-dashboard"
        style="display: flex; min-height: 100vh; font-family: 'Poppins', sans-serif; background: #f8fbff; overflow-x: hidden;">

        <!-- ===== SIDEBAR ===== -->
        <div id="sidebar"
            style=" width: 250px; background: #004AAD; color: white; position: fixed; top: 0; left: -250px; height: 100%; padding: 20px 0; box-shadow: 4px 0 10px rgba(0,0,0,0.1); transition: left 0.3s ease; z-index: 1000; display: flex; flex-direction: column; justify-content: space-between; ">
            <div>
                <!-- ===== UPTM LOGO ===== -->
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
                            style="color: white; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">
                            Houses</a></li>
                    <li><a href="/admin/forms"
                            style="background: white; color: #004AAD; text-decoration: none; display: block; padding: 8px 10px; border-radius: 6px;">
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
                    <h2 style="color: #004AAD; margin: 0;">Forms Management</h2>
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

            <!-- ===== FORMS CONTENT ===== -->
            <div style="padding: 25px;">

                <!-- Page Header with Stats -->
                <div style="margin-bottom: 30px;">
                    <h1 style="color: #004AAD; margin-bottom: 10px;">Forms Management</h1>
                    <p style="color: #666; margin-bottom: 20px;">Manage and review all student form submissions</p>

                    <!-- Stats Cards - REAL DATA -->
                    <?php
                        $pendingCount = \App\Models\Form::where('status', 'pending')->count();
                        $approvedCount = \App\Models\Form::where('status', 'approved')->count();
                        $rejectedCount = \App\Models\Form::where('status', 'rejected')->count();
                        $totalCount = \App\Models\Form::count();
                    ?>

                    <div
                        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 25px;">
                        <div
                            style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); text-align: center;">
                            <div style="font-size: 24px; font-weight: bold; color: #ffc107;"><?php echo e($pendingCount); ?></div>
                            <div style="font-size: 14px; color: #666;">Pending Review</div>
                        </div>
                        <div
                            style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); text-align: center;">
                            <div style="font-size: 24px; font-weight: bold; color: #28a745;"><?php echo e($approvedCount); ?></div>
                            <div style="font-size: 14px; color: #666;">Approved</div>
                        </div>
                        <div
                            style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); text-align: center;">
                            <div style="font-size: 24px; font-weight: bold; color: #dc3545;"><?php echo e($rejectedCount); ?></div>
                            <div style="font-size: 14px; color: #666;">Rejected</div>
                        </div>
                        <div
                            style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); text-align: center;">
                            <div style="font-size: 24px; font-weight: bold; color: #004AAD;"><?php echo e($totalCount); ?></div>
                            <div style="font-size: 14px; color: #666;">Total Forms</div>
                        </div>
                    </div>
                </div>

                <!-- Forms Filter and Search -->
                <div
                    style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); margin-bottom: 20px;">
                    <form method="GET" action="<?php echo e(route('admin.forms')); ?>">
                        <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                            <div>
                                <label style="display: block; font-size: 14px; color: #333; margin-bottom: 5px;">Form
                                    Type</label>
                                <select name="type"
                                    style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
                                    <option value="">All Forms</option>
                                    <option value="vehicle_sticker"
                                        <?php echo e(request('type') == 'vehicle_sticker' ? 'selected' : ''); ?>>Vehicle Sticker
                                    </option>
                                    <option value="facility_report"
                                        <?php echo e(request('type') == 'facility_report' ? 'selected' : ''); ?>>Facility Report
                                    </option>
                                    <option value="change_room" <?php echo e(request('type') == 'change_room' ? 'selected' : ''); ?>>
                                        Change Room</option>
                                    <option value="check_out" <?php echo e(request('type') == 'check_out' ? 'selected' : ''); ?>>
                                        Check-out</option>
                                </select>
                            </div>
                            <div>
                                <label
                                    style="display: block; font-size: 14px; color: #333; margin-bottom: 5px;">Status</label>
                                <select name="status"
                                    style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
                                    <option value="">All Status</option>
                                    <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Pending
                                    </option>
                                    <option value="under_review"
                                        <?php echo e(request('status') == 'under_review' ? 'selected' : ''); ?>>Under Review</option>
                                    <option value="approved" <?php echo e(request('status') == 'approved' ? 'selected' : ''); ?>>
                                        Approved</option>
                                    <option value="rejected" <?php echo e(request('status') == 'rejected' ? 'selected' : ''); ?>>
                                        Rejected</option>
                                    <option value="completed" <?php echo e(request('status') == 'completed' ? 'selected' : ''); ?>>
                                        Completed</option>
                                </select>
                            </div>
                            <div style="flex: 1; min-width: 200px;">
                                <label
                                    style="display: block; font-size: 14px; color: #333; margin-bottom: 5px;">Search</label>
                                <input type="text" name="search" placeholder="Search by student name or ID..."
                                    value="<?php echo e(request('search')); ?>"
                                    style="width: 100%; padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
                            </div>
                            <div style="align-self: flex-end;">
                                <button type="submit"
                                    style="background: #004AAD; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-size: 14px;">
                                    Apply Filters
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Forms Table - REAL DATA -->
                <div
                    style="background: white; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); overflow: hidden;">
                    <div style="padding: 20px; border-bottom: 1px solid #eee;">
                        <h3 style="color: #004AAD; margin: 0;">Form Submissions</h3>
                    </div>

                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background: #f8fbff;">
                                    <th
                                        style="padding: 12px 15px; text-align: left; font-weight: 600; color: #004AAD; border-bottom: 1px solid #eee;">
                                        Student</th>
                                    <th
                                        style="padding: 12px 15px; text-align: left; font-weight: 600; color: #004AAD; border-bottom: 1px solid #eee;">
                                        Form Type</th>
                                    <th
                                        style="padding: 12px 15px; text-align: left; font-weight: 600; color: #004AAD; border-bottom: 1px solid #eee;">
                                        Submitted</th>
                                    <th
                                        style="padding: 12px 15px; text-align: left; font-weight: 600; color: #004AAD; border-bottom: 1px solid #eee;">
                                        Status</th>
                                    <th
                                        style="padding: 12px 15px; text-align: left; font-weight: 600; color: #004AAD; border-bottom: 1px solid #eee;">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        $student = \App\Models\Student::where('user_id', $form->user_id)->first();
                                    ?>
                                    <tr style="border-bottom: 1px solid #f5f5f5;">
                                        <td style="padding: 12px 15px;">
                                            <?php if($student): ?>
                                                <div style="font-weight: 500; color: #333;"><?php echo e($student->name); ?></div>
                                                <div style="font-size: 12px; color: #666;"><?php echo e($student->student_id); ?>

                                                </div>
                                            <?php else: ?>
                                                <div style="font-weight: 500; color: #333;">Student Not Found</div>
                                                <div style="font-size: 12px; color: #666;">User ID: <?php echo e($form->user_id); ?>

                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td style="padding: 12px 15px; color: #333;">
                                            <?php switch($form->type):
                                                case ('vehicle_sticker'): ?>
                                                    Vehicle Sticker
                                                <?php break; ?>

                                                <?php case ('facility_report'): ?>
                                                    Facility Report
                                                <?php break; ?>

                                                <?php case ('change_room'): ?>
                                                    Change Room
                                                <?php break; ?>

                                                <?php case ('check_out'): ?>
                                                    Check-out
                                                <?php break; ?>

                                                <?php default: ?>
                                                    <?php echo e($form->type); ?>

                                            <?php endswitch; ?>
                                        </td>
                                        <td style="padding: 12px 15px; color: #666;">
                                            <?php echo e($form->created_at->format('d M Y')); ?>

                                        </td>
                                        <td style="padding: 12px 15px;">
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
                                                style="background: <?php echo e($color['bg']); ?>; color: <?php echo e($color['text']); ?>; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: bold; text-transform: capitalize;">
                                                <?php echo e(str_replace('_', ' ', $form->status)); ?>

                                            </span>
                                        </td>
                                        <td style="padding: 12px 15px;">
                                            <div style="display: flex; gap: 5px;">
                                                <button onclick="reviewForm(<?php echo e($form->id); ?>)"
                                                    style="background: #004AAD; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 12px;">
                                                    <?php echo e(in_array($form->status, ['pending', 'under_review']) ? 'Review' : 'View Details'); ?>

                                                </button>
                                                <button onclick="deleteForm(<?php echo e($form->id); ?>)"
                                                    style="background: #dc3545; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 12px;">
                                                    Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="5" style="padding: 20px; text-align: center; color: #666;">
                                                No form submissions found.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <?php if($forms->hasPages()): ?>
                            <div
                                style="padding: 15px 20px; border-top: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
                                <div style="font-size: 14px; color: #666;">
                                    Showing <?php echo e($forms->firstItem()); ?> to <?php echo e($forms->lastItem()); ?> of <?php echo e($forms->total()); ?>

                                    entries
                                </div>
                                <div style="display: flex; gap: 5px;">
                                    <?php if($forms->onFirstPage()): ?>
                                        <button disabled
                                            style="background: #f8f9fa; border: 1px solid #dee2e6; padding: 6px 12px; border-radius: 4px; cursor: not-allowed; font-size: 14px; color: #6c757d;">Previous</button>
                                    <?php else: ?>
                                        <a href="<?php echo e($forms->previousPageUrl()); ?>"
                                            style="background: #f8f9fa; border: 1px solid #dee2e6; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 14px; text-decoration: none; color: #004AAD;">Previous</a>
                                    <?php endif; ?>

                                    <?php $__currentLoopData = $forms->getUrlRange(1, $forms->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($page == $forms->currentPage()): ?>
                                            <span
                                                style="background: #004AAD; color: white; border: 1px solid #004AAD; padding: 6px 12px; border-radius: 4px; font-size: 14px;"><?php echo e($page); ?></span>
                                        <?php else: ?>
                                            <a href="<?php echo e($url); ?>"
                                                style="background: #f8f9fa; border: 1px solid #dee2e6; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 14px; text-decoration: none; color: #004AAD;"><?php echo e($page); ?></a>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($forms->hasMorePages()): ?>
                                        <a href="<?php echo e($forms->nextPageUrl()); ?>"
                                            style="background: #f8f9fa; border: 1px solid #dee2e6; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 14px; text-decoration: none; color: #004AAD;">Next</a>
                                    <?php else: ?>
                                        <button disabled
                                            style="background: #f8f9fa; border: 1px solid #dee2e6; padding: 6px 12px; border-radius: 4px; cursor: not-allowed; font-size: 14px; color: #6c757d;">Next</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
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

                // Table row hover effect
                document.querySelectorAll('tbody tr').forEach(row => {
                    row.addEventListener('mouseenter', () => {
                        row.style.backgroundColor = '#f8fbff';
                    });
                    row.addEventListener('mouseleave', () => {
                        row.style.backgroundColor = 'white';
                    });
                });
            });

            function reviewForm(formId) {
                // Redirect to form details page
                window.location.href = `/admin/forms/${formId}`;
            }

            function deleteForm(formId) {
                if (confirm('Are you sure you want to delete this form? This action cannot be undone.')) {
                    fetch(`/admin/forms/${formId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                                'Content-Type': 'application/json',
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                alert('Form deleted successfully');
                                location.reload();
                            } else {
                                alert('Error deleting form: ' + (data.message || 'Unknown error'));
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error deleting form. Please check the console for details.');
                        });
                }
            }
        </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\myFYP\resources\views/admin/forms.blade.php ENDPATH**/ ?>