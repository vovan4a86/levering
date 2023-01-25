<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Fanky\Admin\Models\Catalog;
use Fanky\Admin\Models\CatalogParam;
use Fanky\Admin\Models\Param;
use Fanky\Admin\Models\Product;
use Fanky\Admin\Models\ProductImage;
use Fanky\Admin\Text;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use SiteHelper;
use Symfony\Component\DomCrawler\Crawler;
use SVG\SVG;
use App\Traits\ParseFunctions;

class CableProducts extends Command {

    use ParseFunctions;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:cable-products';
    private $basePath = ProductImage::UPLOAD_URL . 'cable-products/';
    public $client;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Парсим кабельную продукцию';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->client = new Client([
            'headers' => ['User-Agent' => Arr::random($this->userAgents)],
        ]);
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        foreach ($this->categoryList() as $categoryName => $categoryUrl) {
            $this->parseCategory($categoryName, $categoryUrl, 1);
        }
        $this->info('The command was successful!');
    }

    public function categoryList(): array {
        return [
            'Кабели силовые с ПВХ изоляцией' => 'https://rus-kab.ru/catalog/kabeli-silovye-s-pvkh-izolyatsiey/',
//            'Кабели гибкие с резиновой изоляцией' => 'https://rus-kab.ru/catalog/kabeli-gibkie-s-rezinovoy-izolyatsiey/',
//            'Авиационный провод' => 'https://rus-kab.ru/catalog/aviatsionnyy-provod/',
//            'Автомобильный провод' => 'https://rus-kab.ru/catalog/avtomobilnyy-provod/',
//            'Волоконно-оптический кабель' => 'https://rus-kab.ru/catalog/volokonno-opticheskiy-kabel/',
//            'Кабели бронированные' => 'https://rus-kab.ru/catalog/kabeli-bronirovannye/',
//            'Кабели и провода монтажные' => 'https://rus-kab.ru/catalog/kabeli-i-provoda-montazhnye/',
//            'Кабели контрольные' => 'https://rus-kab.ru/catalog/kabeli-kontrolnye/',
//            'Кабели связи' => 'https://rus-kab.ru/catalog/kabeli-svyazi/',
//            'Кабели сигнальные огнестойкие' => 'https://rus-kab.ru/catalog/kabeli-signalnye-ognestoykie/',
//            'Кабели силовые с бумажной изоляцией' => 'https://rus-kab.ru/catalog/kabeli-silovye-s-bumazhnoy-izolyatsiey/',
//            'Кабели управления' => 'https://rus-kab.ru/catalog/kabeli-upravleniya/',
//            'Провода для воздушных линий' => 'https://rus-kab.ru/catalog/provoda-dlya-vozdushnykh-liniy/',
//            'Провода изолированные самонесущие' => 'https://rus-kab.ru/catalog/provoda-izolirovannye-samonesushchie-sip/',
//            'Провода обмоточные' => 'https://rus-kab.ru/catalog/provoda-obmotochnye/',
//            'Провода установочные' => 'https://rus-kab.ru/catalog/provoda-ustanovochnye/',
//            'Радиочастотный кабель (коаксиальный)' => 'https://rus-kab.ru/catalog/radiochastotnyy-kabel-koaksialnyy/',
//            'Судовой кабель' => 'https://rus-kab.ru/catalog/sudovoy-kabel/',
        ];
    }

}
