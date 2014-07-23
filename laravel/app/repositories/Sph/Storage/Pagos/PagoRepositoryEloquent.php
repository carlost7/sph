<?php

namespace Sph\Storage\Pago;

/**
 * Description of UserRepositoryEloquent
 *
 * @author carlos
 */
use Pago;
use Codigo;

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

      public function checar_codigo($codigo)
      {
            $codigo = Codigo::where('numero', $codigo)->where('usado', false)->first();
            if (isset($codigo))
            {
                  return $codigo;
            }
            else
            {
                  return null;
            }
      }

      public function usar_codigo($id, $codigo_model)
      {
            $codigo = Codigo::find($id);
            $codigo->usado = $codigo_model['usado'];
            $codigo->client_id = $codigo_model['client']->id;
            if ($codigo->save())
            {
                  return $codigo;
            }
            else
            {
                  return null;
            }
      }

}
