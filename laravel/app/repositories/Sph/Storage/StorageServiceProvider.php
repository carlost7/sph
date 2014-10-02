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
                    'Sph\Storage\Administrador\AdministradorRepository', 'Sph\Storage\Administrador\AdministradorRepositoryEloquent'
            );            
            $this->app->bind(
                    'Sph\Storage\Aviso_cliente\AvisoClienteRepository', 'Sph\Storage\Aviso_cliente\AvisoClienteRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Bitacora_cliente\BitacoraClienteRepository', 'Sph\Storage\Bitacora_cliente\BitacoraClienteRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Categoria\CategoriaRepository', 'Sph\Storage\Categoria\CategoriaRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Codigo\CodigoRepository', 'Sph\Storage\Codigo\CodigoRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Checkout\CheckoutRepository', 'Sph\Storage\Checkout\CheckoutRepositoryMercadoPago'
            );
            $this->app->bind(
                    'Sph\Storage\Cliente\ClienteRepository', 'Sph\Storage\Cliente\ClienteRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Estado\EstadoRepository', 'Sph\Storage\Estado\EstadoRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Evento\EventoRepository', 'Sph\Storage\Evento\EventoRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Evento_Especial\EventoEspecialRepository', 'Sph\Storage\Evento_Especial\EventoEspecialRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\HorarioNegocio\HorarioNegocioRepository', 'Sph\Storage\HorarioNegocio\HorarioNegocioRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Imagen\ImagenRepository', 'Sph\Storage\Imagen\ImagenRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Marketing\MarketingRepository', 'Sph\Storage\Marketing\MarketingRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\MasinfoEvento\MasinfoEventoRepository', 'Sph\Storage\MasinfoEvento\MasinfoEventoRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\MasinfoNegocio\MasinfoNegocioRepository', 'Sph\Storage\MasinfoNegocio\MasinfoNegocioRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Miembro\MiembroRepository', 'Sph\Storage\Miembro\MiembroRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Negocio\NegocioRepository', 'Sph\Storage\Negocio\NegocioRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Negocio_Especial\NegocioEspecialRepository', 'Sph\Storage\Negocio_Especial\NegocioEspecialRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Pago\PagoRepository', 'Sph\Storage\Pago\PagoRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Promocion\PromocionRepository', 'Sph\Storage\Promocion\PromocionRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Rank\RankRepository', 'Sph\Storage\Rank\RankRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Subcategoria\SubcategoriaRepository', 'Sph\Storage\Subcategoria\SubcategoriaRepositoryEloquent'
            );            
            $this->app->bind(
                    'Sph\Storage\User\UserRepository', 'Sph\Storage\User\UserRepositoryEloquent'
            );
            $this->app->bind(
                    'Sph\Storage\Zona\ZonaRepository', 'Sph\Storage\Zona\ZonaRepositoryEloquent'
            );            
      }
}
