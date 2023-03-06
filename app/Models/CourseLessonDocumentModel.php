<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
#Helper
use Illuminate\Support\Str;
class CourseLessonDocumentModel extends Model
{
    protected $table = 'course_lesson_document';
    protected $primaryKey = 'id';
    public $timestamps = false;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fieldSearchAccepted = ['email', 'phone', 'fullname'];
    protected $crudNotAccepted = ['_token', 'data_attributes','id'];
    protected $fillable = ['title','lesson_id','document_id','course_id','created_at','updated_at'];
    use HasFactory;
    public function listItems($params = "", $options = "")
    {
        $result = null;
        $query = $this->select('id', 'title','lesson_id','document_id','course_id','created_at','updated_at');
        if ($options['task'] == 'admin-count-total') {
            $result = $query->where('user_group_id', '3')->count();
        }
      
        if ($options['task'] == 'list') {
            if(isset($params['start']) && isset($params['length'])) {
                if($params['start'] == 0) {
                    $result = $query->orderBy('id', 'desc')->get();
                }
                else {
                    $result = $query->orderBy('id', 'desc')->skip($params['start'])->take($params['length'])->get();
                }
               
            }
            else {
                $result = $query->orderBy('id', 'desc')->get();
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
        $query = $this->select('id', 'title','lesson_id','document_id','course_id','created_at','updated_at');
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
        return $this->belongsToMany(TaxonomyModel::class,'taxonomy_relationship','product_id','taxonomy_id');
    }
    public function supplier() {
        return $this->belongsTo(SupplierModel::class, 'supplier_id','id' );
    }
}
