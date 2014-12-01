<?php

class Photo extends Eloquent {

    /**
     * Custom table name
     * @var string
     */
    protected $table = 'photo';

    protected $fillable = ['path'];

    public $timestamps = false;

}