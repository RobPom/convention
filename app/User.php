<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Password;
use Mail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'firstname' , 'lastname','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
    * @param string|array $roles
    */

    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || 
                    abort(403, 'This action is unauthorized.');
        }

        return $this->hasRole($roles) || abort(403, 'This action is unauthorized.');
    }

    /**
    * Check multiple roles
    * @param array $roles
    */

    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
    * Check one role
    * @param string $role
    */

    public function hasRole($role)
    {
    return null !== $this->roles()->where('name', $role)->first();
    }


//----------------------------------------------------------------------


    /**
    * generate a random password for a new user account created by 
    * an organizer
    */
    public static function generatePassword()
    {
      // Generate random string and encrypt it. 
      return bcrypt(str_random(35));
    }

    /**
    * send and email to a new user when an account is created
    * by an organizer
    */

    public static function sendWelcomeEmail($user)
    {
      // Generate a new reset password token
      $token = Password::getRepository()->create($user);
      
      // Send email
      Mail::send('emails.tokenaccount', ['user' => $user, 'token' => $token], function ($m) use ($user) {
        $m->from('registrar@intriguecon.com', 'Registrar');
        $m->to($user->email, $user->name)->subject('Welcome to IntrigueCon');
      });
    }

//----------------------------------------------------------------------

    /**
    * One to one relationship with VerifyUser
    */
    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }

    public function profile()
    {
        return $this->hasOne('App\profile')->withDefault([
            'location' => 'Parts Unknown',
            'description' => 'A mysterious stranger...',
        ]);
    }


}
