<?php

class Photo extends Eloquent {

    /**
     * Custon table name
     * @var string
     */
    protected $table = 'photo';

    protected $fillable = ['path'];

    public $timestamps = false;

}