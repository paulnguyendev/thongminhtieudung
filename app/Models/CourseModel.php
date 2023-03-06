<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
#Helper
use Illuminate\Support\Str;
class CourseModel extends Model
{
    protected $table = 'course';
    protected $primaryKey = 'id';
    public $timestamps = false;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fieldSearchAccepted = ['email', 'phone', 'fullname'];
    protected $crudNotAccepted = ['_token', 'data_attributes','id','cat_id','other_cat_ids','action'];
    protected $fillable = ['title','slug','thumbnail','code','point','price','price_sale','description','content','is_best_seller','is_certificate','video_intro','time','is_published','created_at','updated_at','level_id','teacher_id'];
    use HasFactory;
    public function listItems($params = "", $options = "")
    {
        $result = null;
        $query = $this->select('id', 'title','slug','thumbnail','code','point','price','price_sale','is_best_seller','is_certificate','video_intro','time','is_published','created_at','updated_at','level_id','teacher_id');
        if ($options['task'] == 'admin-count-total') {
            $result = $query->where('user_group_id', '3')->count();
        }
      
        if ($options['task'] == 'list') {
            if(isset($params['is_free'])) {
                if($params['is_free'] == 0) {
                    $query = $query->where('price','!=',0);
                }
                else {
                    $query = $query->where('price',0);
                }
            }
            if(isset($params['start']) && isset($params['length'])) {
                if($params['start'] == 0) {
                    $result = $query->orderBy('sort', 'asc')->get();
                }
                else {
                    $result = $query->orderBy('sort', 'asc')->skip($params['start'])->take($params['length'])->get();
                }
               
            }
            else {
                $result = $query->orderBy('sort', 'asc')->get();
            }
           
        }
        if ($options['task'] == 'list-in-cart') {
            if(isset($params['ids'])) {
                $result = $query->whereNotIn('id', $params['ids'])->orderBy('id', 'desc')->get();
            }
            else {
                $result = $query->orderBy('id', 'desc')->get();
            }
           
        }
        if ($options['task'] == 'search') {
            $result = $query->where('title', 'LIKE', "%{$params['title']}%")->orderBy('id', 'desc')->get();
           
        }
        if ($options['task'] == 'liveSearch') {
            $result = $query->where('title', 'LIKE', "%{$params['searchText']}%")->orderBy('id', 'desc')->get();
           
        }
        if ($options['task'] == 'taxonomy_paginate') {
            $result = $query->where('taxonomy', $params['taxonomy'])->orderBy('id', 'desc')->paginate(10);
        }
        if ($options['task'] == 'list_home') {
            $result = $query->orderBy('id', 'desc')->paginate(10);
        }
        return $result;
    }
    public function getItem($params = [], $options = [])
    {
        $query = $this->select('id', 'title','slug','thumbnail','code','point','price','price_sale','description','content','is_best_seller','is_certificate','video_intro','time','is_published','created_at','updated_at','level_id','teacher_id');
        if ($options['task'] == 'taxonomy') {
            $result = $query->where('taxonomy', $params['taxonomy'])->first();
        }
        if ($options['task'] == 'id') {
            $result = $query->where('id', $params['id'])->first();
        }
        if ($options['task'] == 'slug') {
            $result = $query->where('slug', $params['slug'])->first();
        }
       
        return $result;
    }
    public function saveItem($params = [], $option = [])
    {
        if ($option['task'] == 'add-item') {
            $paramsInsert = array_diff_key($params, array_flip($this->crudNotAccepted));
            $dataInsert = self::create($paramsInsert);
            $result =  $dataInsert->id;
            return $result;
        }
        if ($option['task'] == 'edit-item') {
           
            $paramsUpdate = array_diff_key($params, array_flip($this->crudNotAccepted));
            self::where('id', $params['id'])->update($paramsUpdate);
        }
        if ($option['task'] == 'active-by-token') {
            $paramsUpdate = array_diff_key($params, array_flip($this->crudNotAccepted));
            self::where('token', $params['token'])->update($paramsUpdate);
        }
    }
    public function deleteItem($params = "", $option = "")
    {
        if ($option['task'] == 'delete') {
            $this->where('id', $params['id'])->delete();
        }
    }
    public function taxonomy()
    {
        return $this->belongsToMany(TaxonomyModel::class,'taxonomy_relationship','course_id','taxonomy_id');
    }
    public function student()
    {
        return $this->hasMany(OrderCourseUserModel::class,'course_id','id');
    }
    public function lesson()
    {
        return $this->hasMany(LessonModel::class,'course_id','id');
    }
    public function totalLesson()
    {
        return $this->hasMany(LessonModel::class,'course_id','id')->count();
    }
    public function lessonIsTry()
    {
        return $this->hasMany(LessonModel::class,'course_id','id')->where('is_try','1')->first();
    }
    public function combo()
    {
        
        return $this->hasMany(ComboCourseModel::class,'course_id','id');
    }
   
    public function supplier() {
        return $this->belongsTo(SupplierModel::class, 'supplier_id','id' );
    }
    public function teacher() {
        return $this->belongsTo(TeacherModel::class, 'teacher_id','id' );
    }
    public function level() {
        return $this->belongsTo(LevelModel::class, 'level_id','id' );
    }
    
   
}
