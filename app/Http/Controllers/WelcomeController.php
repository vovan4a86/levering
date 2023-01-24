<?php namespace App\Http\Controllers;

use Fanky\Admin\Models\Catalog;
use Fanky\Admin\Models\City;
use Fanky\Admin\Models\Page;
use SEOMeta;
use Settings;

class WelcomeController extends Controller {
    public function index() {
        City::current();
        /** @var Page $page */
        $page = Page::find(1);
        $page->ogGenerate();
        $page->setSeo();
        $categories = Catalog::getTopOnMain();
        $ekb = City::whereAlias('ekb')->first();
        if(!session('city_alias')) {
            session('city_alias', $ekb->alias);
        }

        return response()->view('pages.index', [
            'page' => $page,
            'text' => $page->text,
            'h1' => $page->getH1(),
            'categories' => $categories,
        ]);
    }
}
