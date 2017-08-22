<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Account extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fullname', 'smart_link_id', 'email', 'password', 'status', 'changed_password', 'remember_token', 'role', 'created_user', 'updated_user', 'username'];

    public function smartLink()
    {
        return $this->belongsTo('App\Models\SmartLink', 'smart_link_id');
    }
}