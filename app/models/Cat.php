<?php

class Cat extends Eloquent {

    /**
     * Photo model dependency
     * @return mixed
     */
    public function photos()
    {
        return $this->hasMany('Photo', 'id_cats');
    }

    /**
     * User model dependency
     * @return mixed
     */
    public function author()
    {
        return $this->belongsTo('User', 'id_author')->with('contacts')->select(array('id', 'email', 'id_contacts'));
    }

    /**
     * Like model dependency
     * @return mixed
     */
    public function likes()
    {
        return $this->hasMany('Like', 'id_cats');
    }

    /**
     * Time format
     * @TODO: Find out how to rebuild output in Eloquent
     * @return string
     */
    public function time(){
        return \Carbon\Carbon::createFromTimeStamp(strtotime( $this->created_at ))->diffForHumans();
    }

    /**
     * Return object with position reformated
     * @return $this
     */
    public function formatPosition() {
        $tempCoords = explode(',', $this->position);
        $this->position = array(
            'latitude' => $tempCoords[0],
            'longitude' => $tempCoords[1]
        );
        return $this;
    }

    /**
     * Changing output value
     * @param $value
     * @return string
     */
    public function getContentAttribute($value) {
        return e($value);
    }

    /**
     * Changing output value
     * @param $value
     * @return string
     */
    public function getContactsAttribute($value) {
        return e($value);
    }

    public function getLinkAttribute() {
        return 'http://' . Request::server('SERVER_NAME') . '/feed/' . $this->id;
    }

}