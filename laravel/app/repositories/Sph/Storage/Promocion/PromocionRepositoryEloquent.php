<?php

namespace Sph\Storage\Promocion;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Promocion;

class PromocionRepositoryEloquent implements PromocionRepository
{

      public function all()
      {
            return Promocion::all();
      }

      public function create(array $promocion_model)
      {

            $promocion = new Promocion($promocion_model);
            $promocion->inicio = new \DateTime($promocion_model['inicio']);
            $promocion->fin = new \DateTime($promocion_model['fin']);
            $promocion->client_id = $promocion_model['client']->id;

            if ($promocion->save())
            {
                  return $promocion;
            }
            return null;
      }

      public function delete($id)
      {
            return Promocion::destroy($id);
      }

      public function find($id)
      {
            return Promocion::find($id);
      }

      public function update($id, array $promocion_model)
      {
            $promocion = Promocion::find($id);

            if (isset($promocion))
            {
                  $promocion->fill($promocion_model);
                  $promocion->inicio = new \DateTime($promocion_model['inicio']);
                  $promocion->fin = new \DateTime($promocion_model['fin']);

                  if ($promocion->save())
                  {
                        return $promocion;
                  }
                  else
                  {
                        return null;
                  }
            }
            return null;
      }

}
