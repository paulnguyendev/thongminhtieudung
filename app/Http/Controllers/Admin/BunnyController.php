<?php
namespace App\Http\Controllers\Admin;
use App\Helpers\Obn;
use App\Http\Controllers\Controller;
use App\Models\CourseModel;
use App\Models\LevelModel;
use App\Models\ProductMetaModel;
use App\Models\SupplierModel;
use App\Models\TaxonomyModel;
#Request
#Model
use App\Models\LessonModel as MainModel;
use App\Models\TaxonomyRelationshipModel;
use App\Models\TeacherModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
#Mail
use Illuminate\Support\Facades\Mail;
// use App\Mail\NewUserMail;
#Helper
use Illuminate\Support\Facades\Http;
class BunnyController extends Controller
{
    private $pathViewController     = "admin.pages.lesson.";
    private $controllerName         = "admin_lesson";
    private $title         = "Bài học";
    private $model;
    private $params                 = [];
    private $teacherModel;
    private $taxonomyRelationshipModel;
    private $productMetaModel;
    private $supplierModel;
    private $taxonomyModel;
    private $levelModel;
    private $courseModel;
    private $libraryId = "87177";
    private $apiKey = "0df7e856-eca1-414c-b9a5a02491d4-c4e7-4cfb";
    function __construct()
    {
        $this->model = new MainModel();
        View::share('controllerName', $this->controllerName);
        View::share('title', $this->title);
    }
    public function uploadVideo(Request $request)
    {
        #_1: Create Video
        $url_createVideo = "https://video.bunnycdn.com/library/87177/videos";
        $response = Http::withHeaders(
            [
                'AccessKey' => $this->apiKey,
                'Accept'     => 'application/json',
                'content-type'      => 'application/*+json'
            ]
        )->post($url_createVideo, [
            'title' => "test 123",
        ]);
        $result_createVideo = $response->json();
        $videoID = isset( $result_createVideo['guid']) ?  $result_createVideo['guid'] : "";
        #_2 Upload Video
        
       
        $result = [
            'videoID' => $videoID,
        ];
        return $result;
      
    }
}
