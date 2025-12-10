<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Registration;
use App\Models\Event;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function generate($eventId)
    {
        $event = Event::with(['registrations' => function($query) {
            $query->where('status', 'attended');
        }, 'registrations.user'])->findOrFail($eventId);

        if ($event->event_date > now()) {
            return redirect()->back()->with('error', 'Certificates can only be generated after the event ends.');
        }

        $count = 0;
        foreach ($event->registrations as $registration) {
            // Check if certificate already exists
            if (!Certificate::where('registration_id', $registration->id)->exists()) {
                $certificateNumber = 'CERT-' . strtoupper(uniqid());
                
                Certificate::create([
                    'registration_id' => $registration->id,
                    'certificate_number' => $certificateNumber,
                    'issued_at' => now()
                ]);
                $count++;
            }
        }

        return redirect()->back()->with('success', "$count certificates generated successfully!");
    }

    public function download($registrationId)
    {
        $registration = Registration::with(['event', 'user', 'certificate'])->findOrFail($registrationId);
        
        if (!$registration->certificate) {
            return redirect()->back()->with('error', 'Certificate not yet generated for this event.');
        }

        // Check if dompdf package is installed
        if (!class_exists('Barryvdh\\DomPDF\\Facade\\Pdf')) {
            return redirect()->back()->with('error', 'PDF package not installed. Please run: composer require barryvdh/laravel-dompdf');
        }

        $data = [
            'name' => $registration->user->name,
            'event' => $registration->event->title,
            'date' => $registration->event->event_date->format('F d, Y'),
            'certificate_number' => $registration->certificate->certificate_number
        ];

        $pdf = Pdf::loadView('certificates.template', $data);
        return $pdf->download('certificate-' . $registration->certificate->certificate_number . '.pdf');
    }

    public function view($registrationId)
    {
        $registration = Registration::with(['event', 'user', 'certificate'])->findOrFail($registrationId);
        
        if (!$registration->certificate) {
            return redirect()->back()->with('error', 'Certificate not yet generated for this event.');
        }

        $data = [
            'name' => $registration->user->name,
            'event' => $registration->event->title,
            'date' => $registration->event->event_date->format('F d, Y'),
            'certificate_number' => $registration->certificate->certificate_number
        ];

        return view('certificates.view', $data);
    }
}
