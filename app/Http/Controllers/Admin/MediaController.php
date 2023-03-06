<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
#Request
#Model
use App\Models\UploadModel as MainModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
#Mail
use Illuminate\Support\Facades\Mail;
// use App\Mail\NewUserMail;
#Helper
use Illuminate\Support\Facades\Storage;
class MediaController extends Controller
{
    private $pathViewController     = "admin.pages.media.";
    private $controllerName         = "media";
    private $model;
    private $params                 = [];
    function __construct()
    {
        $this->model = new MainModel();
        View::share('controllerName', $this->controllerName);
    }
    public function folders(Request $request)
    {
        $result = [
            [
                'id' => 1,
                'name' => 'paul',
                'note' => '',
            ],
            [
                'id' => 1,
                'name' => 'giang ga',
                'note' => '',
            ],
        ];
        return response()->json($result);
    }
    public function action(Request $request)
    {
        $result = [];
        $func = $request->func;
        if ($func == 'load_thumbs') {
            $items = $this->model->listItems([],['task' => 'list']);
            $items = $items ? $items->toArray() : [];
          
            $result = [
                'items' => $items,
                "total" => $this->model->count(),
                "page" => 1,
                "ipp" => "30",
                "gtotal" => $this->model->count(),
                'items' => $items,
            ];
        } elseif ($func == 'mlib_get_import_methods') {
            $result = [
                [
                    'id' => 1,
                    'title' => 'Full URL for multiple lines',
                    'content' => '%%url%% [%%fullsize%%]<br />',
                    'contentx' => '%%url%% [%%fullsize%%]<br />',
                ],
            ];
        }
        return response()->json(
            $result,
            200,
            [
                'Content-Type' => 'text/html',
                'Charset' => 'utf-8'
            ]
        );
        // return response()->json($result);
    }
    public function index(Request $request)
    {
        return view(
            "{$this->pathViewController}index",
            []
        );
    }
    public function form(Request $request)
    {
        return view(
            "{$this->pathViewController}form",
            []
        );
    }
    public function upload(Request $request)
    {
        #_Get all file
        $files = Storage::disk('obn_storage')->files('images');
        $params = $request->all();
        $image = $request->file('file');
        $extension = $image->clientExtension();
        $size = $image->getSize();
        $imageName = Str::random(10) . "." .$extension;
        $thumb  = url('public/uploads/images');
        $paramsInsert = [
            "type" => $extension,
            "title" => $imageName,
            "caption" => $imageName,
            "url" => "{$thumb}/{$imageName}",
            "thumb" => "{$thumb}/{$imageName}",
            "time" => time(),
            "size" => $size,
            "disk" => "public",
            "folder_id" => 0,
            "folder" => null,
            "newtime" => date('Y-m-d H:i:s'),
        ];
        $image->storeAs('images',$imageName,'obn_storage');
        $this->model->saveItem($paramsInsert,['task' => 'add-item']);
        $result = [
            'files' => $files,
            'params' => $params,
        ];
        return $result;
    }
}
