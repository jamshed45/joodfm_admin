<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClientLogo;
use App\Models\HeroSlider;
use App\Models\Project;
use Illuminate\Http\Request;

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
                'image'        => asset('storage/' . $slide->image),
            ];
        });

        return response()->json([
            'slides' => $slides,
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function clientLogos()
    {
        $logos = ClientLogo::all()->map(function ($logo) {
            return asset('storage/' . $logo->image);
        });

        return response()->json([
            'logos' => $logos,
        ]);
    }

    public function projects()
    {
        $projects = Project::latest()->get()->map(function ($project) {
            return [
    'id'            => $project->id,
    'en_name'       => $project->en_name,
    'ar_name'       => $project->ar_name,
    'en_location'   => $project->en_location,
    'ar_location'   => $project->ar_location,
    'en_scope'      => $project->en_scope,
    'ar_scope'      => $project->ar_scope,
    'en_objective'  => $project->en_objective,
    'ar_objective'  => $project->ar_objective,
    'image'         => $project->image
        ? asset('storage/' . $project->image)
        : null,
    'created_at'    => $project->created_at,
    'updated_at'    => $project->updated_at,
];

        });

        return response()->json([
            'data'    => $projects,
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

}
