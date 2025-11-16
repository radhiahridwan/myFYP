<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Vehicle Sticker Application - {{ $form->user->student->name ?? 'Unknown' }}</title>
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

        .document-container {
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            overflow: hidden;
        }

        .document-header {
            background: #f8fbff;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            color: #004AAD;
        }

        .document-preview {
            padding: 10px;
            text-align: center;
            background: white;
        }

        .document-image {
            max-width: 300px;
            max-height: 200px;
            border: 1px solid #eee;
            border-radius: 4px;
        }

        .document-info {
            padding: 8px 10px;
            background: #f9f9f9;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #eee;
        }

        .file-icon {
            font-size: 48px;
            color: #004AAD;
            margin: 10px 0;
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
            <h2>VEHICLE STICKER APPLICATION</h2>
        </div>

        <div class="report-info">
            <strong>Vehicle Sticker Application Report</strong><br>
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
        <div class="section-title">Vehicle Information</div>
        <div class="info-row">
            <span class="info-label">Vehicle Type:</span>
            {{ ucfirst($formData['vehicle_type'] ?? 'N/A') }}
        </div>
        <div class="info-row">
            <span class="info-label">Registration Number:</span>
            {{ $formData['registration_number'] ?? 'N/A' }}
        </div>
        <div class="info-row">
            <span class="info-label">Model & Color:</span>
            {{ $formData['model_color'] ?? 'N/A' }}
        </div>
        <div class="info-row">
            <span class="info-label">Phone Number:</span>
            {{ $formData['phone'] ?? 'N/A' }}
        </div>
    </div>

    <div class="section">
        <div class="section-title">Uploaded Documents</div>

        @php
            // Function to check if file is an image
            function isImageFile($filename)
            {
                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                return in_array($ext, $imageExtensions);
            }
        @endphp

        @if (isset($formData['drivers_license']) && $formData['drivers_license'])
            <div class="document-container">
                <div class="document-header">Driver's License</div>
                <div class="document-preview">
                    @php
                        $licensePath = storage_path('app/public/' . $formData['drivers_license']);
                    @endphp
                    @if (file_exists($licensePath) && isImageFile($formData['drivers_license']))
                        @php
                            $licenseData = base64_encode(file_get_contents($licensePath));
                            $licenseBase64 = 'data:image/png;base64,' . $licenseData;
                        @endphp
                        <img src="{{ $licenseBase64 }}" alt="Driver's License" class="document-image">
                    @else
                        <div class="file-icon">📄</div>
                        <div style="font-size: 11px; color: #666;">Document File</div>
                    @endif
                </div>
                <div class="document-info">
                    File: {{ basename($formData['drivers_license']) }}<br>
                    Uploaded: {{ $form->created_at->format('M j, Y') }}
                </div>
            </div>
        @endif

        @if (isset($formData['vehicle_registration']) && $formData['vehicle_registration'])
            <div class="document-container">
                <div class="document-header">Vehicle Registration</div>
                <div class="document-preview">
                    @php
                        $registrationPath = storage_path('app/public/' . $formData['vehicle_registration']);
                    @endphp
                    @if (file_exists($registrationPath) && isImageFile($formData['vehicle_registration']))
                        @php
                            $registrationData = base64_encode(file_get_contents($registrationPath));
                            $registrationBase64 = 'data:image/png;base64,' . $registrationData;
                        @endphp
                        <img src="{{ $registrationBase64 }}" alt="Vehicle Registration" class="document-image">
                    @else
                        <div class="file-icon">📄</div>
                        <div style="font-size: 11px; color: #666;">Document File</div>
                    @endif
                </div>
                <div class="document-info">
                    File: {{ basename($formData['vehicle_registration']) }}<br>
                    Uploaded: {{ $form->created_at->format('M j, Y') }}
                </div>
            </div>
        @endif

        @if (isset($formData['insurance_document']) && $formData['insurance_document'])
            <div class="document-container">
                <div class="document-header">Insurance Document</div>
                <div class="document-preview">
                    @php
                        $insurancePath = storage_path('app/public/' . $formData['insurance_document']);
                    @endphp
                    @if (file_exists($insurancePath) && isImageFile($formData['insurance_document']))
                        @php
                            $insuranceData = base64_encode(file_get_contents($insurancePath));
                            $insuranceBase64 = 'data:image/png;base64,' . $insuranceData;
                        @endphp
                        <img src="{{ $insuranceBase64 }}" alt="Insurance Document" class="document-image">
                    @else
                        <div class="file-icon">📄</div>
                        <div style="font-size: 11px; color: #666;">Document File</div>
                    @endif
                </div>
                <div class="document-info">
                    File: {{ basename($formData['insurance_document']) }}<br>
                    Uploaded: {{ $form->created_at->format('M j, Y') }}
                </div>
            </div>
        @endif

        @if (
            !isset($formData['drivers_license']) &&
                !isset($formData['vehicle_registration']) &&
                !isset($formData['insurance_document']))
            <div style="padding: 20px; text-align: center; color: #666; background: #f8f9fa; border-radius: 6px;">
                No documents uploaded for this application.
            </div>
        @endif
    </div>



    <div class="footer">
        <p>Generated by SISWI Management System | UPTM Hostel Management</p>
        <p>This is an automated report. For any inquiries, please contact the hostel administration.</p>
    </div>
</body>

</html>
