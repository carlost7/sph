<?php namespace Sph\Storage;

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
    }

}
