<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
#Helper
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;

class UserModel extends Model
{
    use NodeTrait;
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;
    const CREATED_AT = 'time_added';
    const UPDATED_AT = 'modified';
    protected $fieldSearchAccepted = ['email', 'phone', 'fullname'];
    protected $crudNotAccepted = ['_token', 'parent_code', 'password_confirmation', 'old_password', 'status_old', 'url', 'is_affiliate', 'has_id', 'is_exist'];
    protected $fillable = ['name', 'avatar', 'username', 'password', 'email', 'birthday', 'gender', 'address', 'phone', 'code', 'token', 'secret', 'parent_id', 'role', 'group_id', 'status', 'created_at', 'aff_number', 'is_affiliate', 'level_id', 'level'];
    use HasFactory;
    public function listItems($params = "", $options = "")
    {
        $result = null;
        $query = $this->select('id', 'name', 'avatar', 'username', 'password', 'email', 'birthday', 'gender', 'address', 'phone', 'code', 'token', 'secret', 'parent_id', 'role', 'group_id', 'status', 'created_at', 'aff_number', 'is_affiliate', 'level_id', 'level');
        if ($options['task'] == 'admin-count-total') {
            $result = $query->where('user_group_id', '3')->count();
        }
        if ($options['task'] == 'admin-list-user') {
            $result = $query->where('user_group_id', '3')->orderBy('date_added', 'desc')->paginate(10);
        }
        if ($options['task'] == 'list') {
            
            if (isset($params['start']) && isset($params['length'])) {
                if ($params['start'] == 0) {
                    $result = $query->orderBy('id', 'desc')->get();
                } else {
                    $result = $query->where('role', 'user')->orderBy('id', 'desc')->skip($params['start'])->take($params['length'])->get();
                }
            } else {
                $result = $query->where('role', 'user')->orderBy('id', 'desc')->get();
            }
        }
        if ($options['task'] == 'parent') {
            $query = $this->select('id', 'name',  'username', 'email', 'phone', 'code',  'parent_id', 'level');
            $result = $query->where('role', 'user')->orderBy('id', 'desc')->get();
        }
        if ($options['task'] == 'parent_id') {
            $query = $this->select('id', 'name',  'username', 'email', 'phone', 'code',  'parent_id', 'level');
            $result = $query->where('role', 'user')->where('parent_id',$params['parent_id'])->orderBy('id', 'desc')->get();
        }
        if ($options['task'] == 'search') {
            $result = $query->where('name', 'LIKE', "%{$params['title']}%")->orWhere('email', 'LIKE', "%{$params['title']}%")->orWhere('phone', 'LIKE', "%{$params['title']}%")->orderBy('id', 'desc')->get();
           
        }
        return $result;
    }
    public function getItem($params = [], $options = [])
    {
        $query = $this->select('id', 'name', 'avatar', 'username', 'password', 'email', 'birthday', 'gender', 'address', 'phone', 'code', 'token', 'secret', 'parent_id', 'role', 'group_id', 'status', 'created_at', 'aff_number', 'is_affiliate', 'level_id', 'level');
        if ($options['task'] == 'user-login') {
            $result = $query->where('username', $params['username'])->where('password', md5($params['password']))->first();
        }
        if ($options['task'] == 'code') {
            if (isset($params['code'])) {
                $code = $params['code'];
            } elseif (isset($params['parent_code'])) {
                $code = $params['parent_code'];
            } else {
                $code = null;
            }
            $result = $query->where('status', 'active')->where('code', $code)->first();
        }
        if ($options['task'] == 'email') {
            $result = $query->where('email', $params['email'])->first();
        }
        if ($options['task'] == 'phone') {
            $result = $query->where('phone', $params['phone'])->first();
        }
        if ($options['task'] == 'username') {
            $result = $query->where('username', $params['username'])->first();
        }
        if ($options['task'] == 'root') {
            $result = $query->where('role', 'root')->first();
        }
        if ($options['task'] == 'id') {
            $result = $query->where('id', $params['user_id'])->first();
        }
        if ($options['task'] == 'token') {
            $result = $query->where('token', $params['token'])->first();
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
            if (isset($params['image'])) {
                $image = $params['image'];
                $params['image'] = Str::random('10') .  "." . $params['image']->clientExtension();
                $image->storeAs("/user", $params['image'], "mb_storage_image");
            }
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
    public function articles()
    {
        return $this->hasMany(ArticleModel::class, 'user_id', 'id');
    }
    public function payment_history()
    {
        return $this->hasMany(PaymentHistoryModel::class, 'user_id', 'id');
    }
    public function child()
    {
        return $this->hasMany(UserModel::class, 'parent_id', 'id');
    }
    public function order()
    {
        return $this->hasMany(OrderModel::class, 'created_by', 'id');
    }
    public function ticket()
    {
        return $this->hasMany(TicketModel::class, 'user_id', 'id');
    }
    public function courseOrder()
    {
        return $this->hasMany(OrderCourseUserModel::class, 'user_id', 'id');
    }
    public function transaction()
    {
        return $this->hasMany(TransactionModel::class, 'user_id', 'id');
    }
}
