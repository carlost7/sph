<?php

namespace Sph\Storage\Pago;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Pago;

class PagoRepositoryEloquent implements PagoRepository
{

      public function all()
      {
            return Pago::all();
      }

      public function create(array $pago_model)
      {

            $pago = new Pago($pago_model);            
            $pago->client_id = $pago_model['client']->id;
            if ($pago->save())
            {
                  return $pago;
            }
            return null;
      }

      public function delete($id)
      {
            return Pago::destroy($id);
      }

      public function find($id)
      {
            return Pago::find($id);
      }

      public function update($id, array $pago_model)
      {
            $pago = Pago::find($id);

            if (isset($pago))
            {
                  $pago->fill($pago_model);
                  $pago->inicio = new \DateTime($pago_model['inicio']);
                  $pago->fin = new \DateTime($pago_model['fin']);

                  if ($pago->save())
                  {
                        return $pago;
                  }
                  else
                  {
                        return null;
                  }
            }
            return null;
      }

}
