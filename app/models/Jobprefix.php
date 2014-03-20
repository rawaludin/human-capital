<?php

class Jobprefix extends Morpaworks\Database\Model {
    /**
     * white list column for mass asignment
     * ref : http://laravel.com/docs/eloquent#mass-assignment
     * @var array
     */
    protected $fillable = ['code', 'title'];
}