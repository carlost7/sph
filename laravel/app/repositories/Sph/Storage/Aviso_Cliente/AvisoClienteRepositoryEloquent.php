<?php

namespace Sph\Storage\Aviso_cliente;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Aviso_cliente;

class AvisoClienteRepositoryEloquent implements AvisoClienteRepository
{

      public function all()
      {
            return Aviso_cliente::all();
      }

      public function create(array $aviso_model)
      {
            
            $aviso = new Aviso_cliente();
            $aviso->cliente_id = $aviso_model['client']->id;
            $aviso->avisable_type = get_class($aviso_model['object']);
            $aviso->avisable_id = $aviso_model['object']->id;
            if($aviso->save()){
                  return $aviso;
            }else{
                  return null;
            }
      }

      public function delete($id)
      {
            return Aviso_cliente::destroy($id);
      }

      public function find($id)
      {
            return Aviso_cliente::find($id);
      }

      public function update($id, array $aviso_model)
      {
            $aviso = new Aviso_cliente();
            $aviso->cliente = $aviso_model['client']->id;
            $aviso->avisable = $aviso_model['object'];
            if($aviso->save()){
                  return $aviso;
            }else{
                  return null;
            }
      }
}
