<?php

class Jobprefix extends Morphaworks\Database\Model {
    /**
     * white list column for mass asignment
     * ref : http://laravel.com/docs/eloquent#mass-assignment
     * @var array
     */
    protected $fillable = ['code', 'title'];

    /**
     * Model validation rules
     * ref : app\Morphaworks\Database\Model.php
     *       http://laravel.com/docs/validation
     * @var array
     */
    public static $rules = array(
        // Validation rule: code field is required and must unique in jobprefixes
        // table in column code. But ignore code value for given id (for update)
        'code' => 'required|unique:jobprefixes,code,:id',
        'title' => 'required|unique:jobprefixes,title,:id',
    );

}