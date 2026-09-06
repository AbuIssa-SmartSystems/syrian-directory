<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Entity;

class SubmissionController extends Controller
{
    // Show the submit form for users
    public function create()
    {
        return view('submit');
    }

    // Store the submitted portal request
    public function store(Request $request)
    {
        $request->validate([
            'entity_name' => 'required|string|max:255',
            'official_url' => 'required|url',
            'category_name' => 'required|string|max:255',
            'governorate' => 'required|string|max:255', // تأكد من وجوده هنا
            'description' => 'nullable|string',
        ]);

        Submission::create([
            'entity_name' => $request->entity_name,
            'official_url' => $request->official_url,
            'category_name' => $request->category_name,
            'governorate' => $request->governorate, // وتأكد من تخزينه هنا
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Thank you!');
    }
    // Show pending submissions to Admin only
    public function adminIndex()
    {
        if (!auth()->check() || auth()->user()->is_admin != 1) {
            abort(403, 'Unauthorized access. Admins only.');
        }

        $submissions = Submission::where('status', 'pending')->get();
        return view('admin.submissions', compact('submissions'));
    }

    // Approve submission and move it directly to the entities table
    public function approve($id)
    {
        if (!auth()->check() || auth()->user()->is_admin != 1) {
            abort(403, 'Unauthorized access. Admins only.');
        }

        $submission = Submission::findOrFail($id);

        // Create the approved record in the public entities table
        Entity::create([
            'entity_name' => $submission->entity_name,
            'official_url' => $submission->official_url,
            'category_name' => $submission->category_name,
            'governorate' => $submission->governorate,
            'description' => $submission->description,
        ]);

        // Mark submission as approved
        $submission->status = 'approved';
        $submission->save();

        return redirect()->back()->with('success', 'Submission approved and published to the directory successfully!');
    }
}
