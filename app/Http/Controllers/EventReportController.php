<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventReportController extends Controller
{
    public function create($eventId)
    {
        $event = Event::findOrFail($eventId);
        
        if ($event->event_date > now()) {
            return redirect()->back()->with('error', 'Report can only be created after the event ends.');
        }

        return view('events.report-create', compact('event'));
    }

    public function store(Request $request, $eventId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'total_attendees' => 'required|integer|min:0',
            'total_participants' => 'required|integer|min:0',
            'outcomes' => 'nullable|string',
            'highlights' => 'nullable|string',
            'report_file' => 'nullable|file|mimes:pdf,doc,docx|max:10240'
        ]);

        $data = $request->except('report_file');
        $data['event_id'] = $eventId;
        $data['created_by'] = Auth::id();

        if ($request->hasFile('report_file')) {
            $data['report_file_path'] = $request->file('report_file')->store('event-reports', 'public');
        }

        EventReport::create($data);

        return redirect()->route('events.show', $eventId)->with('success', 'Event report created successfully!');
    }

    public function show($eventId)
    {
        $event = Event::with('report.creator')->findOrFail($eventId);
        
        if (!$event->report) {
            return redirect()->back()->with('error', 'No report available for this event yet.');
        }

        return view('events.report-view', compact('event'));
    }

    public function downloadFile($reportId)
    {
        $report = EventReport::findOrFail($reportId);
        
        if (!$report->report_file_path) {
            return redirect()->back()->with('error', 'No file attached to this report.');
        }

        $filePath = storage_path('app/public/' . $report->report_file_path);
        return response()->download($filePath);
    }
}
