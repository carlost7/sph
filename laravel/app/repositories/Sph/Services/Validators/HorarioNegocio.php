<?php

namespace Sph\Services\Validators;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author carlos
 */
use Carbon\Carbon;

class HorarioNegocio extends Validator
{

      public static $rules = array(
          "save" => array(
              'lun_ini' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'lun_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'mar_ini' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'mar_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'mie_ini' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'mie_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'jue_ini' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'jue_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'vie_ini' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'vie_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'sab_ini' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'sab_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'dom_ini' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'dom_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),              
              
          ),
          "update" => array(
              'lun_ini' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'lun_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'mar_ini' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'mar_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'mie_ini' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'mie_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'jue_ini' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'jue_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'vie_ini' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'vie_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'sab_ini' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'sab_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'dom_ini' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
              'dom_fin' => array('regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'),
          ),
      );

}
