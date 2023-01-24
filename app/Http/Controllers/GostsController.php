<?php namespace App\Http\Controllers;

use App;
use Fanky\Admin\Models\News;
use Fanky\Admin\Models\NewsTag;
use Fanky\Admin\Models\Page;
//use Request;
use Illuminate\Http\Request;
use Settings;
use View;

class GostsController extends Controller {
	public $bread = [];
	protected $gosts_page;

	public function __construct() {
		$this->gosts_page = Page::whereAlias('gosts')
			->get()
			->first();
		$this->bread[] = [
			'url'  => $this->gosts_page['url'],
			'name' => $this->gosts_page['name']
		];
	}

	public function index(Request $request) {
		$page = $this->gosts_page;
        if (!$page)
            abort(404, 'Страница не найдена');
        $page->setSeo();
		$bread = $this->bread;
        $items = null;

        if (count($request->query())) {
            View::share('canonical', $this->gosts_page->alias);
        }

        return view('gosts.index', [
            'bread' => $bread,
            'items' => $items,
            'text' => $page->text,
        ]);
	}

}
