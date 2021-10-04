<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\AdminDetail;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'referrer_id','name', 'username','email', 'password',
    // ];
    protected $guarded=[];

    public function getReferrer(){
        return $this->belongsTo(User::class, 'referrer_id', 'id');
    }
    public function getAdminRole(){
        return $this->hasOne(AdminDetail::class, 'user_id','id');
    }
    /**
         * A user has a referrer.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function referrer()
        {
            return $this->belongsTo(User::class, 'referrer_id', 'id');
        }

        /**
         * A user has many referrals.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function referrals()
        {
            return $this->hasMany(User::class, 'referrer_id', 'id');
        }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
 */
     protected $appends = ['referral_link'];


     /**
         * Get the user's referral link.
         *
         * @return string
         */
        public function getReferralLinkAttribute()
        {
            return $this->referral_link = route('register', ['ref' => $this->username]);
        }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
