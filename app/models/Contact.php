<?php

class Contact extends Eloquent {

    protected $fillable = ['city', 'web', 'name', 'surname', 'phone'];

    public $timestamps = false;

}