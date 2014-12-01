<?php

class Social extends Eloquent {

    /**
     * Custom table name
     * @var string
     */
    protected $table = 'social';

    protected $fillable = ['uid'];

    public $timestamps = false;

}