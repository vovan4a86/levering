<?php namespace App\Providers;

use App\Classes\SiteHelper;
use Fanky\Admin\Models\Catalog;
use Fanky\Admin\Models\City;
use Request;
use Cache;
use DB;
use Fanky\Admin\Models\News;
use Illuminate\Support\ServiceProvider;
use View;
use Cart;
use Fanky\Admin\Models\Page;

class SiteServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		// пререндер для шаблона
		View::composer(['template'], function (\Illuminate\View\View $view) {
		    $overlayNavigation = Catalog::getTopLevel();

			$topMenu = Page::query()
                ->public()
                ->where('on_top_menu', 1)
                ->orderBy('order')
                ->get();
			$mainMenuPages = Page::query()
                ->public()
                ->where('on_menu', 1)
                ->orderBy('order')
                ->get();
            $mainMenuCats = Catalog::query()
                ->public()
                ->where('on_menu', 1)
                ->orderBy('order')
                ->get();
            $mainMenu = collect();
            $mainMenu = $mainMenu->merge($mainMenuPages)->merge($mainMenuCats);

            $cities = City::query()->orderBy('name')
                ->get(['id', 'alias', 'name', DB::raw('LEFT(name,1) as letter')]);

            if($alias = session('city_alias')) {
                $city = City::whereAlias($alias)->first();
                $current_city = $city->name;
            } else {
                $current_city = null;
            }

			$view->with(compact(
                'topMenu',
                'mainMenu',
                'cities',
                'current_city',
                'overlayNavigation',
                'mainMenuCats'
            ));
		});

        View::composer(['blocks.footer'], function ($view) {
            $footerCatalog = Catalog::public()
                ->where('on_footer_menu', 1)
                ->where('parent_id', 0)
                ->orderBy('order')
                ->get();

            $footerMenu = Page::query()
                ->public()
                ->where('parent_id', 1)
                ->where('on_footer_menu', 1)
                ->orderBy('order')
                ->get();

            $mobileMenu = Page::query()
                ->public()
                ->where('parent_id', 1)
                ->where('on_mobile_menu', 1)
                ->orderBy('order')
                ->get();

            $view->with(compact(
                'footerMenu',
                'footerCatalog',
                'mobileMenu'
            ));
        });

        View::composer(['blocks.header_cart'], function ($view) {
            $items = Cart::all();
            $sum = 0;
            $count = count(Cart::all());
            foreach ($items as $item) {
                $sum += $item['price'];
//                $count += $item['count'];
            }
            $count .= ' ' . SiteHelper::getNumEnding($count, ['товар', 'товара', 'товаров']);

            $view->with([
                'items' => $items,
                'sum'   => $sum,
                'count' => $count
            ]);
        });
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register() {
		$this->app->singleton('settings', function () {
			return new \App\Classes\Settings();
		});
		$this->app->bind('sitehelper', function () {
			return new \App\Classes\SiteHelper();
		});
		$this->app->alias('settings', \App\Facades\Settings::class);
		$this->app->alias('sitehelper', \App\Facades\SiteHelper::class);
	}
}
