<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entity;
use App\Models\Rating;
use Illuminate\Support\Facades\Mail; // تأكد من إضافتها مع الـ Uses فوق

class DirectoryController extends Controller
{

    public function rate(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        \App\Models\Rating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'entity_id' => $id
            ],
            [
                'rating' => $request->rating
            ]
        );

        $entity = \App\Models\Entity::findOrFail($id);
        $userName = auth()->user()->name;
        $userEmail = auth()->user()->email;
        $starCount = $request->rating;

        $adminEmail = env('MAIL_USERNAME');

        Mail::raw("مرحباً أبو عيسى!\n\nهناك تقييم جديد وصل إلى منصتك Syrian Directory:\n\n- اسم المستخدم: {$userName} ({$userEmail})\n- الموقع المقيم: {$entity->entity_name}\n- التقييم: {$starCount} نجوم ⭐\n\nبالتوفيق  !", function ($message) use ($adminEmail) {
            $message->to($adminEmail)
                ->subject('⭐ تقييم جديد وصل للمنصة!');
        });

        return back()->with('success', 'Thank you! Your rating has been submitted and notification sent.');
    }
    public function index(Request $request)
    {
        $query = Entity::query();

        // Search by name or description
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('entity_name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_name', $request->input('category'));
        }

        // Filter by governorate
        if ($request->filled('governorate')) {
            $query->where('governorate', $request->input('governorate'));
        }

        $entities = $query->latest()->get();

        // جلب القوائم للفلترة في القائمة الجانبية
        $categories = Entity::select('category_name')->distinct()->pluck('category_name');
        $governorates = Entity::select('governorate')->distinct()->pluck('governorate');

        return view('dashboard', compact('entities', 'categories', 'governorates'));
    }
}
