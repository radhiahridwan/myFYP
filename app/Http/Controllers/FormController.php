<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class FormController extends Controller
{
        public function index()
        {
            $allForms = Form::where('user_id', auth()->id())->get();
            
            // Define status colors with proper array structure
            $statusColors = [
                'pending' => [
                    'bg' => '#FFF3CD',
                    'text' => '#856404', 
                    'label' => 'Pending'
                ],
                'approved' => [
                    'bg' => '#D1E7DD',
                    'text' => '#0F5132',
                    'label' => 'Approved'
                ],
                'rejected' => [
                    'bg' => '#F8D7DA',
                    'text' => '#721C24',
                    'label' => 'Rejected'
                ],
                'under_review' => [
                    'bg' => '#CCE5FF',
                    'text' => '#004085',
                    'label' => 'Under Review'
                ],
                'completed' => [
                    'bg' => '#D4EDDA', 
                    'text' => '#155724',
                    'label' => 'Completed'
                ],
            ];
            
            // Get change room status safely
            $changeRoomForm = $allForms->where('type', 'change_room')->first();
            $changeRoomStatus = $changeRoomForm ? $changeRoomForm->status : 'none';
            
            return response()
                ->view('students.forms', [
                    'userForms' => $allForms,
                    'statusColors' => $statusColors,
                    'changeRoomStatus' => $changeRoomStatus, // Pass this to the view
                    'hasChangeRoom' => $changeRoomForm !== null
                ])
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        }

    // Admin view - manage all forms
    public function adminIndex(Request $request)
    {
        $query = Form::with(['user.student'])->latest();

        // Filters
        if ($request->type) {
            $query->where('type', $request->type);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->whereHas('user.student', function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('student_id', 'like', '%'.$request->search.'%');
            });
        }

        $forms = $query->paginate(10);
        
        // Add status colors for admin view too
        $statusColors = [
            'pending' => '#FFA500',
            'approved' => '#008000',
            'rejected' => '#FF0000',
            'under_review' => '#ababcaff',
            'completed' => '#0000ff',
        ];
        
        return view('admin.forms', compact('forms', 'statusColors'));
    }
    // ===== FORM DISPLAY METHODS =====
    public function showVehicleStickerForm()
    {
        return view('students.vehicle-sticker');
    }

    public function showFacilityReportForm()
    {
        return view('students.facility-report');
    }

    public function showChangeRoomForm()
    {
        return view('students.change-room');
    }

    public function showCheckOutForm()
    {
        return view('students.check-out');
    }

    // ===== FORM STORE METHODS =====
    public function storeVehicleSticker(Request $request)
    {
        $validated = $request->validate([
            'vehicle_type' => 'required|string',
            'registration_number' => 'required|string',
            'model_color' => 'required|string',
            'phone' => 'required|string',
            'drivers_license' => 'required|file',
            'vehicle_registration' => 'required|file',
            'insurance' => 'required|file',
            'declaration_accurate' => 'required',
            'declaration_rules' => 'required'
        ]);

        try {
            $driversLicensePath = $request->file('drivers_license')->store('documents', 'public');
            $vehicleRegistrationPath = $request->file('vehicle_registration')->store('documents', 'public');
            $insurancePath = $request->file('insurance')->store('documents', 'public');
            
            $form = Form::create([
                'user_id' => auth()->id(),
                'type' => 'vehicle_sticker',
                'status' => 'pending',
                'data' => json_encode([
                    'vehicle_type' => $request->vehicle_type,
                    'registration_number' => $request->registration_number,
                    'model_color' => $request->model_color,
                    'phone' => $request->phone,
                    'drivers_license' => $driversLicensePath,
                    'vehicle_registration' => $vehicleRegistrationPath, 
                    'insurance_document' => $insurancePath
                ]),
                'admin_comment' => null
            ]);

            \Log::info('Vehicle Sticker Form created:', ['form_id' => $form->id]);
            return redirect()->route('student.forms')->with('success', 'Vehicle sticker application submitted successfully!');

        } catch (\Exception $e) {
            \Log::error('Vehicle Sticker Form error:', ['error' => $e->getMessage()]);
            return back()->with('error', 'Failed to submit application. Please try again.');
        }
    }

    public function storeFacilityReport(Request $request)
    {
        $validated = $request->validate([
            'inventory.kerusi' => 'required|integer|min:0|max:10',
            'inventory.meja' => 'required|integer|min:0|max:10',
            'inventory.almari' => 'required|integer|min:0|max:10',
            'inventory.katil' => 'required|integer|min:0|max:10',
            'inventory.tilam' => 'required|integer|min:0|max:10',
            'condition.lampu' => 'required|string',
            'condition.kipas' => 'required|string',
            'condition.plug_socket' => 'required|string',
            'condition.toilet' => 'required|string',
            'condition.shower' => 'required|string',
            'condition.sink' => 'required|string',
            'condition.langsir' => 'required|string',
            'condition.pintu' => 'required|string',
            'condition.tingkap' => 'required|string',
            'damage_description' => 'required|string|max:2000',
            'media.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi|max:10240',
            'declaration_accurate' => 'required'
        ]);

        try {
            $mediaPaths = [];
            if ($request->hasFile('media')) {
                foreach ($request->file('media') as $file) {
                    $mediaPaths[] = $file->store('facility_reports', 'public');
                }
            }

            $form = Form::create([
                'user_id' => auth()->id(),
                'type' => 'facility_report',
                'status' => 'pending',
                'data' => json_encode([
                    'inventory' => $request->inventory,
                    'condition' => $request->condition,
                    'damage_description' => $request->damage_description,
                    'media' => $mediaPaths,
                    'submitted_at' => now()->format('Y-m-d H:i:s')
                ]),
                'admin_comment' => null
            ]);

            \Log::info('Facility Report created:', ['form_id' => $form->id]);
            return redirect()->route('student.forms')->with('success', 'Facility report submitted successfully!');

        } catch (\Exception $e) {
            \Log::error('Facility Report error:', ['error' => $e->getMessage()]);
            return back()->with('error', 'Failed to submit facility report. Please try again.');
        }
    }

    public function storeChangeRoom(Request $request)
    {
        $validated = $request->validate([
            'reason' => 'required|string',
            'explanation' => 'required|string|max:1000',
            'preferred_room' => 'required|string',
            'preferred_date' => 'nullable|date|after:today',
            'phone' => 'required|string',
            'declaration_accurate' => 'required',
            'declaration_rules' => 'required'
        ]);

        try {
            $form = Form::create([
                'user_id' => auth()->id(),
                'type' => 'change_room',
                'status' => 'pending',
                'data' => json_encode([
                    'current_room' => auth()->user()->student->hostel_room ?? 'N/A',
                    'reason' => $request->reason,
                    'explanation' => $request->explanation,
                    'preferred_room' => $request->preferred_room,
                    'preferred_date' => $request->preferred_date,
                    'phone' => $request->phone,
                    'submitted_at' => now()->format('Y-m-d H:i:s')
                ]),
                'admin_comment' => null
            ]);

            \Log::info('Change Room Form created:', ['form_id' => $form->id]);
            return redirect()->route('student.forms')->with('success', 'Room change application submitted successfully!');

        } catch (\Exception $e) {
            \Log::error('Change Room Form error:', ['error' => $e->getMessage()]);
            return back()->with('error', 'Failed to submit application. Please try again.');
        }
    }

    public function storeCheckOut(Request $request)
    {
        $validated = $request->validate([
            'reason' => 'required|string',
            'checkout_date' => 'required|date|after:today',
            'forwarding_address' => 'required|string|max:500',
            'emergency_contact_name' => 'required|string',
            'emergency_contact_phone' => 'required|string',
            'phone' => 'required|string',
            'key_returned' => 'required',
            'belongings_removed' => 'required',
            'no_damage' => 'required',
            'fees_cleared' => 'required',
            'final_declaration' => 'required'
        ]);

        try {
            $form = Form::create([
                'user_id' => auth()->id(),
                'type' => 'check_out',
                'status' => 'pending',
                'data' => json_encode([
                    'current_room' => auth()->user()->student->hostel_room ?? 'N/A',
                    'reason' => $request->reason,
                    'checkout_date' => $request->checkout_date,
                    'forwarding_address' => $request->forwarding_address,
                    'emergency_contact_name' => $request->emergency_contact_name,
                    'emergency_contact_phone' => $request->emergency_contact_phone,
                    'phone' => $request->phone,
                    'key_returned' => true,
                    'belongings_removed' => true,
                    'no_damage' => true,
                    'fees_cleared' => true,
                    'submitted_at' => now()->format('Y-m-d H:i:s')
                ]),
                'admin_comment' => null
            ]);

            \Log::info('Check-out Form created:', ['form_id' => $form->id]);
            return redirect()->route('student.forms')->with('success', 'Check-out application submitted successfully!');

        } catch (\Exception $e) {
            \Log::error('Check-out Form error:', ['error' => $e->getMessage()]);
            return back()->with('error', 'Failed to submit check-out application. Please try again.');
        }
    }

    // ===== ADMIN METHODS =====
    public function showForm($id)
    {
        $form = Form::with(['user.student'])->findOrFail($id);
        // REMOVE the $formData line - the model cast will handle it automatically!
        
        return view('admin.form-review', compact('form'));
    }
    public function updateStatus(Request $request, $id)
    {
        $form = Form::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,under_review,approved,rejected,completed',
            'admin_comment' => 'nullable|string'
        ]);
        
        $form->update([
            'status' => $request->status,
            'admin_comment' => $request->admin_comment,
            'updated_at' => now()
        ]);
        
        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }

    public function addComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);
        
        $form = Form::findOrFail($id);
        $currentComment = $form->admin_comment ? $form->admin_comment . "\n\n" : '';
        $form->update([
            'admin_comment' => $currentComment . 'Admin: ' . $request->comment . ' (' . now()->format('M j, Y g:i A') . ')'
        ]);
        
        return response()->json(['success' => true, 'message' => 'Comment added successfully']);
    }

    // ===== EXPORT METHODS =====
    public function exportExcel()
    {
        try {
            $forms = Form::with(['user.student'])->get();
            
            $filename = 'forms-export-' . date('Y-m-d') . '.csv';
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];

            $callback = function() use ($forms) {
                $file = fopen('php://output', 'w');
                fwrite($file, "\xEF\xBB\xBF"); // UTF-8 BOM
                
                fputcsv($file, [
                    'ID', 'Student Name', 'Student ID', 'Form Type', 'Status', 
                    'Submission Date', 'Admin Comment', 'Form Specific Data'
                ]);
                
                foreach ($forms as $form) {
                    $formData = json_decode($form->data, true);
                    $formSpecificData = $this->getFormSpecificData($form->type, $formData);
                    
                    fputcsv($file, [
                        $form->id,
                        $form->user->student->name ?? 'N/A',
                        $form->user->student->student_id ?? 'N/A',
                        $this->getFormTypeLabel($form->type),
                        ucfirst($form->status),
                        $form->created_at->format('Y-m-d H:i:s'),
                        $form->admin_comment ?? 'No comment',
                        $formSpecificData
                    ]);
                }
                
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);

        } catch (\Exception $e) {
            \Log::error('Excel export error: ' . $e->getMessage());
            return response('Export failed: ' . $e->getMessage(), 500);
        }
    }

    public function exportPDF($id)
    {
        $form = Form::with(['user.student'])->findOrFail($id);
        $formData = json_decode($form->data, true);
        
        $viewName = match($form->type) {
            'vehicle_sticker' => 'pdf.vehicle-sticker',
            'facility_report' => 'pdf.facility-report',
            'change_room' => 'pdf.change-room',
            'check_out' => 'pdf.check-out',
            default => 'pdf.generic-form'
        };
        
        $pdf = Pdf::loadView($viewName, compact('form', 'formData'));
        
        $filename = str_replace('_', '-', $form->type) . '-' . 
                    ($form->user->student->student_id ?? 'unknown') . '-' . 
                    date('Y-m-d') . '.pdf';
        
        return $pdf->download($filename);
    }

    // ===== HELPER METHODS =====
    private function getFormSpecificData($formType, $formData)
    {
        return match($formType) {
            'vehicle_sticker' => sprintf(
                "Vehicle: %s, Reg: %s, Model: %s, Phone: %s",
                $formData['vehicle_type'] ?? 'N/A',
                $formData['registration_number'] ?? 'N/A',
                $formData['model_color'] ?? 'N/A',
                $formData['phone'] ?? 'N/A'
            ),
            
            'facility_report' => sprintf(
                "Damage: %s | Items: Chair:%s, Table:%s, Wardrobe:%s, Bed:%s, Mattress:%s",
                substr($formData['damage_description'] ?? 'No description', 0, 50),
                $formData['inventory']['kerusi'] ?? 0,
                $formData['inventory']['meja'] ?? 0,
                $formData['inventory']['almari'] ?? 0,
                $formData['inventory']['katil'] ?? 0,
                $formData['inventory']['tilam'] ?? 0
            ),
            
            'change_room' => sprintf(
                "Reason: %s | Preferred Room: %s",
                $formData['reason'] ?? 'N/A',
                $formData['preferred_room'] ?? 'N/A'
            ),
            
            'check_out' => sprintf(
                "Check-out Date: %s | Reason: %s",
                $formData['checkout_date'] ?? 'N/A',
                $formData['reason'] ?? 'N/A'
            ),
            
            default => 'No specific data'
        };
    }

    private function getFormTypeLabel($type)
    {
        return match($type) {
            'vehicle_sticker' => 'Vehicle Sticker',
            'facility_report' => 'Facility Report', 
            'change_room' => 'Change Room',
            'check_out' => 'Check-out',
            default => ucfirst($type)
        };
    }

    // ===== UNUSED METHODS (Can be removed if not needed) =====
    public function showVehicleSticker($id)
    {
        return view('forms.vehicle-sticker-show', compact('id'));
    }

    public function showFacilityReport($id)
    {
        $form = Form::with(['user.student'])->findOrFail($id);
        $formData = json_decode($form->data, true);
        return view('admin.facility-report-show', compact('form', 'formData'));
    }

    public function showChangeRoom($id)
    {
        return view('forms.change-room-show', compact('id'));
    }

    public function showCheckOut($id)
    {
        $form = Form::with(['user.student'])->findOrFail($id);
        $formData = json_decode($form->data, true);
        return view('forms.check-out-show', compact('id'));
    }

    // Simple comment methods (if you want to keep them separate)
    public function addVehicleStickerComment(Request $request, $id)
    {
        return $this->addComment($request, $id);
    }

    public function addFacilityReportComment(Request $request, $id)
    {
        return $this->addComment($request, $id);
    }

    public function addChangeRoomComment(Request $request, $id)
    {
        return $this->addComment($request, $id);
    }

    public function addCheckOutComment(Request $request, $id)
    {
        return $this->addComment($request, $id);
    }

        public function destroy(Form $form)
    {
        try {
            $form->delete();
            return response()->json(['success' => true, 'message' => 'Form deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete form'], 500);
        }
    }
    
}