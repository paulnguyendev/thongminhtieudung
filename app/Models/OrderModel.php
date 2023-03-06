<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
#Helper
use Illuminate\Support\Str;

class OrderModel extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'id';
    public $timestamps = false;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fieldSearchAccepted = ['email', 'phone', 'fullname'];
    protected $crudNotAccepted = ['_token', 'data_attributes', 'id'];
    protected $fillable = ['discount', 'info_order', 'info_shipping', 'note', 'payment', 'products', 'shipping', 'subtotal', 'total', 'total_weight', 'user_id', 'created_at','code','status','total_point','total_commission','is_affiliate','created_by','is_course_active','parent_id'];
    use HasFactory;
    public function listItems($params = "", $options = "")
    {
        $result = null;
        $query = $this->select('id', 'discount', 'info_order', 'info_shipping', 'note', 'payment', 'products', 'shipping', 'subtotal', 'total', 'total_weight', 'user_id', 'created_at','code','status','total_point','total_commission','is_affiliate','created_by','is_course_active','parent_id');
        if ($options['task'] == 'admin-count-total') {
            $result = $query->where('user_group_id', '3')->count();
        }
        if ($options['task'] == 'list') {
            $result = $query->orderBy('id', 'desc')->get();
        }
        if ($options['task'] == 'user_id') {
            $result = $query->where('user_id', $params['user_id'])->orderBy('id', 'desc')->get();
        }
        if ($options['task'] == 'created_by') {
            $result = $query->where('created_by', $params['user_id'])->orderBy('id', 'desc')->get();
        }
        if ($options['task'] == 'status') {
            $result = $query->where('status', $params['status'])->orderBy('id', 'desc')->get();
        }
        if ($options['task'] == 'list-customer') {
            $result = $query->where('user_id', $params['user_id'])->orderBy('id', 'desc')->get();
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
        $query = $this->select('id', 'discount', 'info_order', 'info_shipping', 'note', 'payment', 'products', 'shipping', 'subtotal', 'total', 'total_weight', 'user_id', 'created_at','code','status','total_point','total_commission','is_affiliate','created_by','is_course_active','parent_id');
        if ($options['task'] == 'taxonomy') {
            $result = $query->where('taxonomy', $params['taxonomy'])->first();
        }
        if ($options['task'] == 'id') {
            $result = $query->where('id', $params['id'])->first();
        }
        if ($options['task'] == 'code') {
            $result = $query->where('code', $params['code'])->first();
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
    public function articles()
    {
        return $this->hasMany(ArticleModel::class, 'user_id', 'id');
    }
    public function products()
    {
        return $this->hasMany(ProductModel::class, 'supplier_id', 'id');
    }
    public function user() {
        return $this->belongsTo(UserModel::class, 'user_id','id');
    }
}
