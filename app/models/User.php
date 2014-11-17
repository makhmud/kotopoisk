<?php

use \Illuminate\Auth\UserInterface;

class User extends Eloquent implements UserInterface {

    protected $fillable = ['image'];
    /**
     * Contacts model dependency
     * @return mixed
     */
    public function contacts()
    {
        return $this->belongsTo('Contact', 'id_contacts');
    }

    public function social()
    {
        return $this->hasMany('Social', 'id_user');
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return \Illuminate\Support\Facades\Hash::make( $this->id );
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        // TODO: Implement setRememberToken() method.
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        // TODO: Implement getRememberTokenName() method.
    }
}