<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Password;
use Mail;
use App\Timeslot;
use App\Game;
use App\GameSession;

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

    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class);
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
        return $this->hasOne('App\Profile')->withDefault([
            'location' => 'Parts Unknown',
            'description' => 'A mysterious stranger...',
        ]);
    }

    public function gamesessions()
    {
        return $this->belongsToMany('App\GameSession', 'game_session_user', 'user_id' , 'game_timeslot_id');
    }

    public function games()
    {
        return $this->hasMany('App\Game');
    }

    public function conventions(){
        return $this->belongsToMany('App\Convention');
    }

    public function gamemaster($id) {
        $timeslot = Timeslot::find($id);

        if( $this->games()->has('timeslots')->exists() ) {
            $games = $this->games()->has('timeslots')->get();
            foreach($games as $game) {
                foreach($game->timeslots as $ts) {
                    if($ts->id == $timeslot->id){
                        return $timeslot->gamesession($game);
                    }
                }
            }
        }
        return false;
    }
}
