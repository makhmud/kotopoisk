<?php

class Social extends Eloquent {

    /**
     * Custon table name
     * @var string
     */
    protected $table = 'social';

    protected $fillable = ['uid'];

    public $timestamps = false;

}