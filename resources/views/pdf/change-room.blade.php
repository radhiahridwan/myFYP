<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Change Room Application - {{ $form->user->student->name ?? 'Unknown' }}</title>
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
            height: 70px;
            margin-bottom: 10px;
        }

        .university-info {
            margin-bottom: 10px;
        }

        .university-info h1 {
            color: #004AAD;
            margin: 5px 0;
            font-size: 18px;
        }

        .university-info h2 {
            color: #333;
            margin: 5px 0;
            font-size: 14px;
        }

        .report-info {
            color: #666;
            font-size: 10px;
        }

        .section {
            margin-bottom: 15px;
        }

        .section-title {
            background-color: #004AAD;
            color: white;
            padding: 8px 12px;
            font-weight: bold;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th {
            background-color: #004AAD;
            color: white;
            padding: 8px;
            text-align: left;
            border: 1px solid #004AAD;
            font-weight: bold;
        }

        .table td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .info-row {
            margin-bottom: 8px;
            padding: 5px 0;
        }

        .info-label {
            font-weight: bold;
            display: inline-block;
            width: 180px;
            color: #333;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            color: #666;
            font-size: 9px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-approved {
            background: #d4edda;
            color: #155724;
        }

        .status-rejected {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body>
    <div class="header">
        <!-- UPTM Logo -->
        <div class="logo-container">
            @php
                $logoPath = base_path('public/images/uptm-logo-1.png');
                if (file_exists($logoPath)) {
                    $logoData = base64_encode(file_get_contents($logoPath));
                    $logoBase64 = 'data:image/png;base64,' . $logoData;
                } else {
                    $logoBase64 = '';
                }
            @endphp

            @if ($logoBase64)
                <img src="{{ $logoBase64 }}" alt="UPTM Logo" class="logo">
            @endif
        </div>

        <div class="university-info">
            <h1>UNIVERSITI POLY-TECH MALAYSIA (UPTM)</h1>
            <h2>CHANGE ROOM APPLICATION</h2>
        </div>

        <div class="report-info">
            <strong>Application Report</strong><br>
            Generated on: {{ date('F j, Y g:i A') }}<br>
            Application ID: #{{ $form->id }}
        </div>
    </div>

    <div class="section">
        <div class="section-title">Student Information</div>
        <div class="info-row">
            <span class="info-label">Student Name:</span>
            {{ $form->user->student->name ?? 'N/A' }}
        </div>
        <div class="info-row">
            <span class="info-label">Student ID:</span>
            {{ $form->user->student->student_id ?? 'N/A' }}
        </div>
        <div class="info-row">
            <span class="info-label">Submission Date:</span>
            {{ $form->created_at->format('F j, Y g:i A') }}
        </div>
        <div class="info-row">
            <span class="info-label">Status:</span>
            <span class="status-badge status-{{ $form->status }}">
                {{ ucfirst($form->status) }}
            </span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Room Information</div>
        <table class="table">
            <tr>
                <th>Current Room</th>
                <th>Preferred Room</th>
                <th>Phone Number</th>
            </tr>
            <tr>
                <td>{{ $formData['current_room'] ?? 'N/A' }}</td>
                <td>{{ $formData['preferred_room'] ?? 'N/A' }}</td>
                <td>{{ $formData['phone'] ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Change Request Details</div>
        <table class="table">
            <tr>
                <th>Reason for Change</th>
                <th>Preferred Move Date</th>
            </tr>
            <tr>
                <td>
                    @php
                        $reasonLabels = [
                            'roommate_issues' => 'Roommate Issues',
                            'maintenance' => 'Maintenance Problems',
                            'noisy' => 'Too Noisy',
                            'prefer_floor' => 'Prefer Different Floor',
                            'health' => 'Health Reasons',
                            'other' => 'Other',
                        ];
                    @endphp
                    {{ $reasonLabels[$formData['reason']] ?? ucfirst($formData['reason'] ?? 'N/A') }}
                </td>
                <td>
                    @if (isset($formData['preferred_date']) && $formData['preferred_date'])
                        {{ date('F j, Y', strtotime($formData['preferred_date'])) }}
                    @else
                        Not specified
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Detailed Explanation</div>
        <div style="padding: 15px; background: #f8f9fa; border-radius: 4px; border: 1px solid #ddd; min-height: 80px;">
            {{ $formData['explanation'] ?? 'No explanation provided' }}
        </div>
    </div>

    <div class="section">
        <div class="section-title">Application Timeline</div>
        <table class="table">
            <tr>
                <th>Submitted Date</th>
                <th>Last Updated</th>
                <th>Application ID</th>
            </tr>
            <tr>
                <td>{{ $form->created_at->format('F j, Y g:i A') }}</td>
                <td>{{ $form->updated_at->format('F j, Y g:i A') }}</td>
                <td>#{{ $form->id }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Generated by SISWI Management System | UPTM Hostel Management</p>
        <p>This is an automated report. For any inquiries, please contact the hostel administration.</p>
    </div>
</body>

</html>
