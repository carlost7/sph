<?php

/*
 * Modelo en donde se guardaran los horarios del negocio
 */

use LaravelBook\Ardent\Ardent;

class HorarioNegocio extends Ardent {

      protected $table                      = 'horarios_negocio';
      protected $fillable                   = ['lun_ini', 'mar_ini', 'mie_ini', 'jue_ini', 'vie_ini', 'sab_ini', 'dom_ini', 'lun_fin', 'mar_fin', 'mie_fin', 'jue_fin', 'vie_fin', 'sab_fin', 'dom_fin'];
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;
      public static $rules                  = array(
          'lun_ini' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9](?::[0-5][0-9])?$/'),
          'lun_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9](?::[0-5][0-9])?$/'),
          'mar_ini' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9](?::[0-5][0-9])?$/'),
          'mar_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9](?::[0-5][0-9])?$/'),
          'mie_ini' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9](?::[0-5][0-9])?$/'),
          'mie_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9](?::[0-5][0-9])?$/'),
          'jue_ini' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9](?::[0-5][0-9])?$/'),
          'jue_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9](?::[0-5][0-9])?$/'),
          'vie_ini' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9](?::[0-5][0-9])?$/'),
          'vie_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9](?::[0-5][0-9])?$/'),
          'sab_ini' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9](?::[0-5][0-9])?$/'),
          'sab_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9](?::[0-5][0-9])?$/'),
          'dom_ini' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9](?::[0-5][0-9])?$/'),
          'dom_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9](?::[0-5][0-9])?$/'),
      );
      public static $relationsData          = array(
          'negocio' => array(self::BELONGS_TO, 'Negocio'),
      );

      public function getLunIniAttribute($value)
      {
            if($value == null){
                  return "";
            }else{
                  return date('H:i',strtotime($value));
            }
            
      }
      public function getMarIniAttribute($value)
      {
            if($value == null){
                  return "";
            }else{
                  return date('H:i',strtotime($value));
            }
            
      }
      public function getMieIniAttribute($value)
      {
            if($value == null){
                  return "";
            }else{
                  return date('H:i',strtotime($value));
            }
            
      }
      public function getJueIniAttribute($value)
      {
            if($value == null){
                  return "";
            }else{
                  return date('H:i',strtotime($value));
            }
            
      }
      public function getVieIniAttribute($value)
      {
            if($value == null){
                  return "";
            }else{
                  return date('H:i',strtotime($value));
            }
            
      }
      public function getSabIniAttribute($value)
      {
            if($value == null){
                  return "";
            }else{
                  return date('H:i',strtotime($value));
            }
            
      }
      public function getDomIniAttribute($value)
      {
            if($value == null){
                  return "";
            }else{
                  return date('H:i',strtotime($value));
            }
            
      }
      
      public function getLunFinAttribute($value)
      {
            if($value == null){
                  return "";
            }else{
                  return date('H:i',strtotime($value));
            }
            
      }
      public function getMarFinAttribute($value)
      {
            if($value == null){
                  return "";
            }else{
                  return date('H:i',strtotime($value));
            }
            
      }
      public function getMieFinAttribute($value)
      {
            if($value == null){
                  return "";
            }else{
                  return date('H:i',strtotime($value));
            }
            
      }
      public function getJueFinAttribute($value)
      {
            if($value == null){
                  return "";
            }else{
                  return date('H:i',strtotime($value));
            }
            
      }
      public function getVieFinAttribute($value)
      {
            if($value == null){
                  return "";
            }else{
                  return date('H:i',strtotime($value));
            }
            
      }
      public function getSabFinAttribute($value)
      {
            if($value == null){
                  return "";
            }else{
                  return date('H:i',strtotime($value));
            }
            
      }
      public function getDomFinAttribute($value)
      {
            if($value == null){
                  return "";
            }else{
                  return date('H:i',strtotime($value));
            }
            
      }
}
