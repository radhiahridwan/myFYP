<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Student List - <?php echo e(date('Y-m-d')); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #004AAD;
            padding-bottom: 15px;
        }

        .logo {
            height: 80px;
            margin-bottom: 10px;
        }

        .university-info {
            margin-bottom: 10px;
        }

        .university-info h1 {
            color: #004AAD;
            margin: 5px 0;
            font-size: 20px;
        }

        .university-info h2 {
            color: #333;
            margin: 5px 0;
            font-size: 16px;
        }

        .report-info {
            color: #666;
            font-size: 11px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            table-layout: fixed;
            /* Added for consistent column widths */
        }

        .table th {
            background-color: #004AAD;
            color: white;
            padding: 10px;
            text-align: left;
            border: 1px solid #004AAD;
            font-weight: bold;
        }

        .table td {
            padding: 8px 10px;
            border: 1px solid #ddd;
            word-wrap: break-word;
            /* Ensure long text wraps */
        }

        /* Column width adjustments */
        .table th:nth-child(1),
        /* No. */
        .table td:nth-child(1) {
            width: 5%;
        }

        .table th:nth-child(2),
        /* Student ID */
        .table td:nth-child(2) {
            width: 12%;
        }

        .table th:nth-child(3),
        /* Name */
        .table td:nth-child(3) {
            width: 15%;
        }

        .table th:nth-child(4),
        /* Email - SMALLER */
        .table td:nth-child(4) {
            width: 18%;
        }

        .table th:nth-child(5),
        /* Phone Number */
        .table td:nth-child(5) {
            width: 12%;
        }

        .table th:nth-child(6),
        /* Room Number */
        .table td:nth-child(6) {
            width: 10%;
        }

        .table th:nth-child(7),
        /* Address - LARGER */
        .table td:nth-child(7) {
            width: 28%;
        }

        .table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .table tr:hover {
            background-color: #f1f3f4;
        }

        .summary {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8fbff;
            border-radius: 5px;
            border-left: 4px solid #004AAD;
        }

        .summary h3 {
            color: #004AAD;
            margin: 0 0 10px 0;
            font-size: 14px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            color: #666;
            font-size: 10px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
        }

        /* Email specific styling to make it more compact */
        .email-cell {
            font-size: 11px;
            line-height: 1.2;
        }

        /* Address specific styling to utilize the extra space */
        .address-cell {
            font-size: 11px;
            line-height: 1.3;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo-container">
            <img src="C:\xampp\htdocs\myFYP\public\images\uptm-logo-1.png" alt="UPTM Logo" class="logo">
        </div>

        <div class="university-info">
            <h1>UNIVERSITI POLY-TECH MALAYSIA (UPTM)</h1>
            <h2>STUDENT MANAGEMENT SYSTEM</h2>
        </div>

        <div class="report-info">
            <strong>Student List Report</strong><br>
            Generated on: <?php echo e(date('F j, Y g:i A')); ?><br>
            Total Students: <?php echo e(count($students)); ?>

        </div>
    </div>

    <?php if(count($students) > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Room Number</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($index + 1); ?></td>
                        <td><?php echo e($student->student_id ?? 'N/A'); ?></td>
                        <td><?php echo e($student->name ?? 'N/A'); ?></td>
                        <td class="email-cell"><?php echo e($student->email ?? 'N/A'); ?></td>
                        <td><?php echo e($student->phone_number ?? 'N/A'); ?></td>
                        <td><?php echo e($student->hostel_room ?? 'Not Assigned'); ?></td>
                        <td class="address-cell"><?php echo e($student->address ?? 'N/A'); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div class="summary">
            <h3>SUMMARY</h3>
            <p><strong>Total Students:</strong> <?php echo e(count($students)); ?></p>
            <p><strong>Assigned to Rooms:</strong> <?php echo e($students->where('hostel_room', '!=', null)->count()); ?></p>
            <p><strong>Unassigned Students:</strong> <?php echo e($students->where('hostel_room', null)->count()); ?></p>
        </div>
    <?php else: ?>
        <div class="no-data">
            <h3>No Students Found</h3>
            <p>There are no students in the system at the moment.</p>
        </div>
    <?php endif; ?>

    <div class="footer">
        <p>Generated by SISWI Management System </p>
        <p>This is an automated report. For any discrepancies, please contact the hostel administration.</p>
    </div>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\myFYP\resources\views/pdf/students.blade.php ENDPATH**/ ?>