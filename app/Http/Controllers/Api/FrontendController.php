<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\CareerMail;
use App\Mail\ContactMail;
use App\Models\ClientLogo;
use App\Models\HeroSlider;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function translations(Request $request)
    {
        $lang = $request->query('lang', 'en'); // default to 'en'

        $translations = [
            'en' => [
                'whoWeAre'   => 'Who We Are?',
                'aboutTitle' => 'Jood FM ® is an integrated Facilities Management company',
                'aboutDesc'  => 'Jood FM ® is an integrated Facilities Management company that provides complete solutions/services to all kind of businesses and government sectors. Due to the increase demand and the great success the Quick Kangaroo ® brand has accomplished during the past years by providing an outstanding maintenance services to residential customers of compounds and housing owners/tenants; the board of directors decided to diversify with a new brand named Jood FM ® to focus only on commercial sector aiming to provide higher standard in facility management services.',
            ],
            'ar' => [
                'whoWeAre'   => 'من نحن؟',
                'aboutTitle' => 'جود إف إم ® هي شركة إدارة مرافق متكاملة',
                'aboutDesc'  => 'جود إف إم ® هي شركة متكاملة لإدارة المرافق، تقدم حلولًا وخدمات شاملة لجميع أنواع الأعمال والقطاعات الحكومية. ونظرًا لزيادة الطلب والنجاح الكبير الذي حققته علامة الكنغر السريع ® خلال السنوات الماضية من خلال تقديم خدمات صيانة متميزة للعملاء السكنيين في المجمعات السكنية وأصحاب/مستأجري المنازل؛ قرر مجلس الإدارة التنويع بإطلاق علامة تجارية جديدة باسم جود إف إم ® للتركيز فقط على القطاع التجاري، بهدف تقديم مستوى أعلى من خدمات إدارة المرافق.',
            ],
        ];

        return response()->json($translations[$lang] ?? $translations['en']);
    }

    public function heroSlides()
    {
        $slides = HeroSlider::all()->map(function ($slide) {
            return [
                'en_title'     => $slide->en_title,
                'en_sub_title' => $slide->en_sub_title,
                'ar_title'     => $slide->ar_title,
                'ar_sub_title' => $slide->ar_sub_title,
                'link'         => $slide->link,
                'image'        => asset('uploads/hero_sliders/' . $slide->image),
            ];
        });

        return response()->json([
            'slides' => $slides,
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function clientLogos()
    {
        $logos = ClientLogo::all()->map(function ($logo) {
            return asset('uploads/logos/' . $logo->image);
        });

        return response()->json([
            'logos' => $logos,
        ]);
    }

    public function projects()
    {
        $projects = Project::latest()->get()->map(function ($project) {
            return [
                'id'           => $project->id,
                'en_name'      => $project->en_name,
                'ar_name'      => $project->ar_name,
                'en_location'  => $project->en_location,
                'ar_location'  => $project->ar_location,
                'en_scope'     => $project->en_scope,
                'ar_scope'     => $project->ar_scope,
                'en_objective' => $project->en_objective,
                'ar_objective' => $project->ar_objective,
                'image'        => $project->image
                    ? asset('uploads/projects/' . $project->image)
                    : null,
                'created_at'   => $project->created_at,
                'updated_at'   => $project->updated_at,
            ];

        });

        return response()->json([
            'data' => $projects,
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function contactUs(Request $request)
    {
        $data = $request->all();

        try {
            Mail::to('jamshed76@gmail.com')
                ->cc(['info@joodfm.com'])
                ->send(new ContactMail($data));

            return response()->json(['status' => 'success', 'message' => 'Email sent successfully!']);
        } catch (Exception $e) {

            Log::error('Mail sending failed: ' . $e->getMessage());

            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to send email. Please try again later.',
            ], 500);
        }
    }

    public function Career(Request $request)
    {
        $validated = $request->validate([
            'name'                 => 'required|string|max:255',
            'email'                => 'required|email',
            'phone'                => 'required|string|max:20',
            'position_of_interest' => 'required|string|max:255',
            'cv_upload'            => 'required|file|mimes:pdf,doc,docx|max:2048', // 2MB limit
        ]);

        try {
            // Store uploaded CV temporarily
            $filePath = $request->file('cv_upload')->store('temp');

            // Add the path to the data array
            $data            = $validated;
            $data['cv_path'] = storage_path('app/' . $filePath);

            Mail::to('jamshed76@gmail.com') // destination email
                ->send(new CareerMail($data));

            return response()->json(['status' => 'success', 'message' => 'Application sent successfully!']);
        } catch (Exception $e) {
            Log::error('Career mail failed: ' . $e->getMessage());

            return response()->json(['status' => 'error', 'message' => 'Failed to send. Please try again later.'], 500);
        }
    }

}
