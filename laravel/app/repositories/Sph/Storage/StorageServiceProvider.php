<?php

namespace Sph\Storage;

use Illuminate\Support\ServiceProvider;

/**
 * Description of RepositoriesServiceProvider
 *
 * @author carlos
 */
class StorageServiceProvider extends ServiceProvider
{

      public function register()
      {
            $this->app->bind(
                    'Sph\Storage\User\UserRepository', 'Sph\Storage\User\UserRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Cliente\ClienteRepository', 'Sph\Storage\Cliente\ClienteRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Negocio\NegocioRepository', 'Sph\Storage\Negocio\NegocioRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Evento\EventoRepository', 'Sph\Storage\Evento\EventoRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Promocion\PromocionRepository', 'Sph\Storage\Promocion\PromocionRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Pago\PagoRepository', 'Sph\Storage\Pago\PagoRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Marketing\MarketingRepository', 'Sph\Storage\Marketing\MarketingRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Bitacora_cliente\BitacoraClienteRepository', 'Sph\Storage\Bitacora_cliente\BitacoraClienteRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Aviso_cliente\AvisoClienteRepository', 'Sph\Storage\Aviso_cliente\AvisoClienteRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Checkout\CheckoutRepository', 'Sph\Storage\Checkout\CheckoutRepositoryMercadoPago'
            );
      }

}
