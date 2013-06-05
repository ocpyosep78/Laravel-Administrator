<?php namespace Frozennode\Administrator;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Config;

class AdministratorServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('frozennode/administrator');

		//set the config items if a user has provided an application config
		foreach (Config::get('administrator::administrator', array()) as $key => $option)
		{
			Config::set('administrator::administrator.'.$key, Config::get('administrator.'.$key, Config::get('administrator::administrator.'.$key)));
		}

		include __DIR__.'/../../filters.php';
		include __DIR__.'/../../viewComposers.php';
		include __DIR__.'/../../routes.php';

		Event::fire('administrator.ready');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}