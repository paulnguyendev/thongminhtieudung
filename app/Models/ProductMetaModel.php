<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
#Helper
use Illuminate\Support\Str;
class ProductMetaModel extends Model
{
    protected $table = 'product_meta';
    protected $primaryKey = 'id';
    public $timestamps = false;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fieldSearchAccepted = ['email', 'phone', 'fullname'];
    protected $crudNotAccepted = ['_token', 'data_attributes','id'];
    protected $fillable = ['product_id','description','content','gallery','created_at','updated_at'];
    use HasFactory;
    public function listItems($params = "", $options = "")
    {
        $result = null;
        $query = $this->select('id','product_id','description','content','gallery','created_at','updated_at');
        if ($options['task'] == 'admin-count-total') {
            $result = $query->where('user_group_id', '3')->count();
        }
        if ($options['task'] == 'list') {
            $result = $query->orderBy('id', 'desc')->get();
        }
        if ($options['task'] == 'search') {
            $result = $query->where('name', 'LIKE', "%{$params['name']}%")->orderBy('id', 'desc')->get();
            if ($result)
                $result = $result->toArray();
        }
        if ($options['task'] == 'taxonomy_paginate') {
            $result = $query->where('taxonomy', $params['taxonomy'])->orderBy('id', 'desc')->paginate(10);
        }
        return $result;
    }
    public function getItem($params = [], $options = [])
    {
        $query = $this->select('id', 'product_id','description','content','gallery','created_at','updated_at');
        if ($options['task'] == 'taxonomy') {
            $result = $query->where('taxonomy', $params['taxonomy'])->first();
        }
        if ($options['task'] == 'product_id') {
            $result = $query->where('product_id', $params['product_id'])->first();
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
            self::where('product_id', $params['product_id'])->update($paramsUpdate);
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
    public function articles()
    {
        return $this->hasMany(ArticleModel::class, 'user_id', 'id');
    }
}
