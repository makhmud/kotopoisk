<?php

class Translation extends Eloquent {

    public $timestamps = false;

    public $fillable = ['key', 'lng', 'value'];

}