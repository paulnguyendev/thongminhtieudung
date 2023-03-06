<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
#Helper
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;

class TaxonomyModel extends Model
{
    use NodeTrait;
    protected $table = 'taxonomy';
    protected $primaryKey = 'id';
    public $timestamps = false;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fieldSearchAccepted = ['email', 'phone', 'fullname'];
    protected $crudNotAccepted = ['_token', 'data_attributes','id'];
    protected $fillable = ['name', 'parent_id', 'taxonomy', 'description', 'created_at', 'updated_at', 'thumbnail', 'meta_keyword', 'slug', 'h1'];
    use HasFactory;
    public function listItems($params = "", $options = "")
    {
        $result = null;
        $query = $this->select('id', 'name', 'parent_id', 'taxonomy', 'description', 'created_at', 'updated_at', 'thumbnail',  'meta_keyword', 'slug', 'h1');
        if ($options['task'] == 'admin-count-total') {
            $result = $query->where('user_group_id', '3')->count();
        }
        if ($options['task'] == 'taxonomy') {
            $result = $query->where('taxonomy', $params['taxonomy'])->orderBy('id', 'desc')->get();
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
        $query = $this->select('id', 'name', 'parent_id', 'taxonomy', 'description', 'created_at', 'updated_at', 'thumbnail', 'meta_keyword', 'slug', 'h1');
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
            $parent = self::find($params['parent_id']);
            $result =    self::create($paramsInsert, $parent);
            return $result;
        }
        if ($option['task'] == 'edit-item') {
            $node = self::find($params['id']);
            $paramsUpdate = array_diff_key($params, array_flip($this->crudNotAccepted));
            // self::where('id', $params['id'])->update($paramsUpdate);
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
        if ($option['task'] == 'node-delete') {
            $node = self::find($params['id']);
            $node->delete();
        }
    }
    public function articles()
    {
        return $this->hasMany(ArticleModel::class, 'user_id', 'id');
    }
    public function getNameWithDepthAttribute()
    {
        return str_repeat("¦– –", $this->depth) . $this->name;
    }
    public function product_ids()
    {
        return $this->belongsToMany(ProductModel::class,'taxonomy_relationship','taxonomy_id','product_id');
    }
    public function course_ids()
    {
        return $this->belongsToMany(CourseModel::class,'taxonomy_relationship','taxonomy_id','course_id');
    }
    public function courseInfo()
    {
        return $this->belongsTo(CourseModel::class, 'course_id', 'id');
    }
}
