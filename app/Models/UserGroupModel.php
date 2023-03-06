<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
#Helper
use Illuminate\Support\Str;
class UserGroupModel extends Model
{
    protected $table = 'user_group';
    protected $primaryKey = 'id';
    public $timestamps = false;
    const CREATED_AT = 'time_added';
    const UPDATED_AT = 'modified';
    protected $fieldSearchAccepted = ['email', 'phone', 'fullname'];
    protected $crudNotAccepted = ['_token','parent_code','password_confirmation','old_password','status_old','url'];
    protected $fillable = ['name', 'is_default','discount','sales','monthly_income','group_commission','is_show','created_at'];
    use HasFactory;
    public function listItems($params = "", $options = "")
    {
        $result = null;
        $query = $this->select('id', 'name', 'is_default','discount','sales','monthly_income','group_commission','is_show','created_at');
        if($options['task'] == 'admin-count-total') {
            $result = $query->where('user_group_id','3')->count();
        }
        if($options['task'] == 'admin-list-user') {
            $result = $query->where('user_group_id','3')->orderBy('date_added','desc')->paginate(10);
        }
        if ($options['task'] == 'list') {
            $result = $query->orderBy('id', 'desc')->get();
        }
        return $result;
    }
    public function getItem($params = [], $options = [])
    {
        $query = $this->select('id','name', 'is_default','discount','sales','monthly_income','group_commission','is_show','created_at');
        if ($options['task'] == 'user-login') {
            $result = $query->where('username', $params['username'])->where('password', md5($params['password']))->first();
        }
        if ($options['task'] == 'code') {
            if(isset($params['code'])) {
                $code = $params['code'];
            }
            elseif(isset($params['parent_code'])) {
                $code = $params['parent_code'];
            }
            else {
                $code = null;
            }
            $result = $query->where('status', 'active')->where('code', $code)->first();
        }
        if ($options['task'] == 'email') {
            $result = $query->where('email', $params['email'])->first();
        }
        if ($options['task'] == 'username') {
            $result = $query->where('username', $params['username'])->first();
        }
        if ($options['task'] == 'token') {
            $result = $query->where('token', $params['token'])->first();
        }
        if ($options['task'] == 'group_id') {
            $result = $query->where('id', $params['group_id'])->first();
        }
        return $result;
    }
    public function saveItem($params = [],$option = []) {
        if($option['task'] == 'add-item') {
            $paramsInsert = array_diff_key($params,array_flip($this->crudNotAccepted));
            $result = self::insert($paramsInsert);
            return $result;
        }
        if($option['task'] == 'edit-item') {
            if(isset($params['image'])) {
                $image = $params['image'];
                $params['image'] = Str::random('10') .  "." . $params['image']->clientExtension();
                $image->storeAs("/user", $params['image'], "mb_storage_image");
            }
            $paramsUpdate = array_diff_key($params,array_flip($this->crudNotAccepted));
            self::where('id', $params['id'])->update($paramsUpdate);
        }
        if($option['task'] == 'active-by-token') {
            $paramsUpdate = array_diff_key($params,array_flip($this->crudNotAccepted));
            self::where('token', $params['token'])->update($paramsUpdate);
        }
    }
    public function articles()
    {
        return $this->hasMany(ArticleModel::class, 'user_id', 'id');
    }
}
