<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
#Helper
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;
class LessonModel extends Model
{
    use NodeTrait;
    protected $table = 'lesson';
    protected $primaryKey = 'id';
    public $timestamps = false;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fieldSearchAccepted = ['email', 'phone', 'fullname'];
    protected $crudNotAccepted = ['_token', 'data_attributes', 'id','redirect'];
    protected $fillable = ['title', 'video', 'content', 'parent_id', '_lft', '_rgt', 'created_at', 'updated_at','is_try','course_id','video_youtube'];
    use HasFactory;
    public function listItems($params = "", $options = "")
    {
        $result = null;
        $query = $this->select('id', 'title', 'video', 'content', 'parent_id', '_lft', '_rgt', 'created_at', 'updated_at','is_try','course_id','video_youtube');
        if ($options['task'] == 'admin-count-total') {
            $result = $query->where('user_group_id', '3')->count();
        }
        if ($options['task'] == 'list') {
            if (isset($params['start']) && isset($params['length'])) {
                if ($params['start'] == 0) {
                    $result = $query->orderBy('id', 'desc')->get();
                } else {
                    $result = $query->orderBy('id', 'desc')->skip($params['start'])->take($params['length'])->get();
                }
            } else {
                $result = $query->orderBy('id', 'desc')->get();
            }
        }
        if ($options['task'] == 'list-in-cart') {
            if (isset($params['ids'])) {
                $result = $query->whereNotIn('id', $params['ids'])->orderBy('id', 'desc')->get();
            } else {
                $result = $query->orderBy('id', 'desc')->get();
            }
        }
        if ($options['task'] == 'search') {
            $result = $query->where('title', 'LIKE', "%{$params['title']}%")->orderBy('id', 'desc')->get();
        }
        if ($options['task'] == 'taxonomy_paginate') {
            $result = $query->where('taxonomy', $params['taxonomy'])->orderBy('id', 'desc')->paginate(10);
        }
        if ($options['task'] == 'list_home') {
            $result = $query->orderBy('id', 'desc')->paginate(10);
        }
        if ($options['task'] == 'list_title') {
            $query = $this->select('id', 'title');
            $result = $query->orderBy('id', 'desc')->get();
        }
        return $result;
    }
    public function getItem($params = [], $options = [])
    {
        $query = $this->select('id', 'title', 'video', 'content', 'parent_id', '_lft', '_rgt', 'created_at', 'updated_at','is_try','course_id','video_youtube');
        if ($options['task'] == 'taxonomy') {
            $result = $query->where('taxonomy', $params['taxonomy'])->first();
        }
        if ($options['task'] == 'id') {
            $result = $query->where('id', $params['id'])->first();
        }
        return $result;
    }
    public function saveItem($params = [], $option = [])
    {
        if ($option['task'] == 'add-item') {
            $paramsInsert = array_diff_key($params, array_flip($this->crudNotAccepted));
            if(isset($params['parent_id'])) {
                $parent = self::find($params['parent_id']);
                $result =    self::create($paramsInsert, $parent);
            }
            else {
                $result =    self::create($paramsInsert);
            }
           
            return $result;
        }
        if ($option['task'] == 'edit-item') {
            $node = self::find($params['id']);
            $paramsUpdate = array_diff_key($params, array_flip($this->crudNotAccepted));
            $node->update($paramsUpdate);
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
        return $this->belongsToMany(TaxonomyModel::class, 'taxonomy_relationship', 'product_id', 'taxonomy_id');
    }
    public function supplier()
    {
        return $this->belongsTo(SupplierModel::class, 'supplier_id', 'id');
    }
    public function course()
    {
        return $this->belongsTo(CourseModel::class, 'course_id', 'id');
    }
}
