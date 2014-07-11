<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Role
 *
 * @author carlos
 */
class Role Extends Eloquent{
    
    protected $table = 'roles';
    
    protected $fillable = array('role');
    
    public function user(){
            return $this->has_many('User','role_id','id');
    }
    
}
