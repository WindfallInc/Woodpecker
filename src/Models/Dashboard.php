<?php

namespace App\Woodpecker;

use App\Notifications\DashboardResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dashboard extends Authenticatable
{
    use Notifiable;

    const CONFIRMED = 1;
    const UNCONFIRMED = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','confirmed'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new DashboardResetPassword($token));
    }

    public function canEditType($id)
    {
          if($this->admin == 1)
          {
            return true;
          }
  				else {
            $permission = Permission::where('dashboard_id',$this->id)->where('type_id',$id)->first();
            if(isset($permission))
            {
              return true;
            }
            return false;
          }
  	}
    public function canEdit($id)
    {
          // admins can edit anything
          if($this->admin == 1)
          {
            return true;
          }
          // if not admin
  				else
          {
            $content = Content::find($id);
            $type = $content->type;
            if($this->canEditType($type->id))
            {
              return true;
            }
            else
            {
              $permission = Permission::where('dashboard_id',$this->id)->where('content_id',$id)->first();
              if(isset($permission))
              {
                return true;
              }
              return false;
            }
          }
  	}
    public function canEditForms()
    {
      if($this->forms == 1)
      {
        return true;
      }
      return false;
    }
    public function canEditMenus()
    {
      if($this->menus == 1)
      {
        return true;
      }
      return false;
    }
    public function isAdmin()
    {
      if($this->admin == 1)
      {
        return true;
      }
      return false;
    }

    public function permissions() {
          return $this->hasMany('App\Woodpecker\Permission');
  	}
}
