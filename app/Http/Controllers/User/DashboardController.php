<?php
namespace App\Http\Controllers\User;
use App\Helpers\Package\AffiliatePackage;
use App\Helpers\User;
use App\Http\Controllers\Controller;
#Request
#Model
use App\Models\UserModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
#Mail
use Illuminate\Support\Facades\Mail;
// use App\Mail\NewUserMail;
#Helper
class DashboardController extends Controller
{
    private $pathViewController     = "user.pages.dashboard";
    private $controllerName         = "dashboard";
    private $model;
    private $params                 = [];
    function __construct()
    {
        $this->model = new UserModel();
        View::share('controllerName', $this->controllerName);
    }
    public function index(Request $request)
    {
        $user_id = User::getInfo('', 'id');
        $user = UserModel::find($user_id);
        #_Total Income
        $totalIncome = AffiliatePackage::getBalance($user_id, 'pending');
        #_Total Order
        $totalOrder = $user->order()->count();
        #_Total Order Success
        $totalOrderSuccess = $user->order()->where('status', 'complete')->count();
        $is_affiliate = $user['is_affiliate'] ?? 0;
        #_Total Course 
        $totalCourse =   $user->courseOrder()->count();
        return view(
            "{$this->pathViewController}/index",
            [
                'totalIncome' => $totalIncome,
                'totalOrder' => $totalOrder,
                'totalOrderSuccess' => $totalOrderSuccess,
                'is_affiliate' => $is_affiliate,
                'totalCourse' => $totalCourse,
            ]
        );
    }
    public function test(Request $request)
    {
        $id = 64;
        $parents = $this->model::withDepth()->reversed()->ancestorsOf($id)->toArray();
        $levels = [
            'dstt' => [
                'name' => 'Đại sứ tri thức',
            ],
            'dstt_1sao' => [
                'name' => 'Đại sứ tri thức 1 sao',
            ],
            'dstt_2sao' => [
                'name' => 'Đại sứ tri thức 2 sao',
            ],
            'dstt_3sao' => [
                'name' => 'Đại sứ tri thức 3 sao',
            ],
        ];
        $conditions = [
            'level_1' => [
                'dstt' => [
                    'percent' => 20,
                    'has_condition' => 0,
                    'conditions' => []
                ],
                'dstt_1sao' => [
                    'percent' => 30,
                    'has_condition' => 0,
                    'conditions' => []
                ],
                'dstt_2sao' => [
                    'percent' => 35,
                    'has_condition' => 0,
                    'conditions' => []
                ],
                'dstt_3sao' => [
                    'percent' => 40,
                    'has_condition' => 0,
                    'conditions' => []
                ],
            ],
            'level_2' => [
                'dstt_1sao' => [
                    'percent' => 10,
                    'has_condition' => 0,
                    'conditions' => []
                ],
                'dstt_2sao' => [
                    'percent' => 35,
                    'has_condition' => 1,
                    'conditions' => [
                        [
                            'level_depth' => 1,
                            'level_key' => 'dstt',
                            'percent' => 15,
                        ],
                        [
                            'level_depth' => 1,
                            'level_key' => 'dstt_1sao',
                            'percent' => 5,
                        ],
                    ]
                ],
                'dstt_3sao' => [
                    'percent' => 35,
                    'has_condition' => 1,
                    'conditions' => [
                        [
                            'level_depth' => 1,
                            'level_key' => 'dstt_1sao',
                            'percent' => 10,
                        ],
                        [
                            'level_depth' => 1,
                            'level_key' => 'dstt',
                            'percent' => 20,
                        ],
                    ]
                ],
            ],
            'level_3' => [
                'dstt_1sao' => [
                    'percent' => 10,
                    'has_condition' => 0,
                    'conditions' => []
                ],
                'dstt_2sao' => [
                    'percent' => 5,
                    'has_condition' => 0,
                    'conditions' => []
                ],
                'dstt_3sao' => [
                    'percent' => 35,
                    'has_condition' => 1,
                    'conditions' => [
                        [
                            'level_depth' => 2,
                            'level_key' => 'dstt_1sao',
                            'percent' => 10,
                        ],
                        [
                            'level_depth' => 2,
                            'level_key' => 'dstt_2sao',
                            'percent' => 5,
                        ],
                    ]
                ],
            ],
        ];
        foreach ($parents as $key => $parent) {
            $level = $key + 1;
            $levelKey = null;
            if ($level == 1) {
                $levelKey = "dstt_1sao";
            } elseif ($level == 2) {
                $levelKey = "dstt_2sao";
            } elseif ($level == 3) {
                $levelKey = "dstt_3sao";
            }
            $parentKey = "level";
            $parents[$key][$parentKey] = $level;
            $parents[$key]['level_key'] = $levelKey;
            $affiliate = $conditions["level_{$level}"];
            $affiliateDetail = $affiliate[$levelKey] ?? [];
            // $parents[$key]['affiliate'] = $affiliateDetail;
            $percent = 0;
            $has_condition = $affiliateDetail['has_condition'] ?? 0;
            $affiliateConditions = [];
            $parentBefore = [];
            $levelBefore = null;
            $conditionDetail = [];
            if ($has_condition == 1) {
                $affiliateConditions = $affiliateDetail['conditions'];
                $levelBefore = $level - 1;
                $parentBefore = array_filter($parents,function($item) use($levelBefore) {
                    $levelParent = $item['level'] ?? "";
                    if($levelParent == $levelBefore) {
                        return $item;
                    }
                });
                $parentBefore = array_shift($parentBefore);
                // $parents[$key]['parentBefore'] = $parentBefore;
                $conditionDetail = array_filter($affiliateConditions,function($item) use($levelBefore, $parentBefore) {
                    $levelKeyParentBefore = $parentBefore['level_key'] ?? "";
                    if($item['level_depth'] == $levelBefore && $item['level_key'] == $levelKeyParentBefore) {
                        return $item;
                    }
                });
                $conditionDetail = array_shift($conditionDetail);
                $percent = $conditionDetail['percent'] ?? 0;
            }
            else {
                $percent = $affiliateDetail['percent'] ?? 0;
            }
            $parents[$key]['percent'] = $percent;
            $parents[$key]['has_condition'] = $has_condition;
            $parents[$key]['levelBefore'] = $levelBefore;
        }
        $percents = array_column($parents,'percent');
        $totalPercent = array_sum($percents);
        return $parents;
        echo "<h1>Khi giới thiệu 1 ĐSTT vào hệ thống</h1>";
        foreach ($parents as $parent) {
            $parentLevel = $parent['level_key'];
            $levelName = $levels[$parentLevel]['name'] ?? "-";
            echo "Cấp: {$parent['level']} <br>";
            echo "Tên level: {$levelName} <br>";
            echo "% hoa hồng được hưởng: {$parent['percent']} % <br>";
            echo "--------------<br>";
        }
        echo "<h3>Tổng % hoa hồng chi trả cho nhánh này: {$totalPercent} %</h3> ";
        // echo '<pre>';
        // print_r($parents);
        // echo '</pre>';
    }
    public function seniority(Request $request) {
        $levels = [
            'ma' => [
                'name' => 'Mortgage Ambassador',
                'percent_direct' => [
                    'type' => 'percent',
                    'number' => 50,
                ],
            ],
            'sma' => [
                'name' => 'Senior MA',
                'percent_direct' => [
                    'type' => 'percent',
                    'number' => 55,
                ],
            ],
            'ema' => [
                'name' => 'Elite MA',
                'percent_direct' => [
                    'type' => 'percent',
                    'number' => 60,
                ],
            ],
            'gma' => [
                'name' => 'Grand MA',
                'percent_direct' => [
                    'type' => 'percent',
                    'number' => 65,
                ],
            ],
            'rbm' => [
                'name' => 'District Leader',
                'percent_direct' => [
                    'type' => 'percent',
                    'number' => 70,
                ],
            ],
            'ebm' => [
                'name' => 'Regional Leader',
                'percent_direct' => [
                    'type' => 'percent',
                    'number' => 80,
                ],
            ],
            'nb' => [
                'name' => 'National Branch Leader',
                'percent_direct' => [
                    'type' => 'percent',
                    'number' => 90,
                ],
            ],
        ];
        return $levels;
        $conditions = [

        ];
    }
}
