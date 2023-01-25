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
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use SiteHelper;
use Symfony\Component\DomCrawler\Crawler;
use SVG\SVG;
use App\Traits\ParseFunctions;

class CableSystems extends Command {

    use ParseFunctions;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:cable-systems';
    private $basePath = ProductImage::UPLOAD_URL . 'cable-systems/';
    public $baseUrl = 'https://asd-e.ru';
    public $client;

    public $chars = [
        'Высота, мм' => 'height',
        'Ширина, мм' => 'width',
        'Длина, мм' => 'length',
        'Толщина металла, мм' => 'depth'
    ];

    public $docs = [
        'Сертификат соответствия' => 'certificate_image',
        'ТУ' => 'tu_image'
    ];

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
            $this->parseCategoryCableSystems($categoryName, $categoryUrl, 2);
        }
//        $this->info($this->getDescriptionWithNewImage($data, '/upload/1.jpg'));
//        $catalog = Catalog::find(17);
//        $this->parseListProductsCableSystems($catalog, 'https://asd-e.ru/product/gem/lotki-lestnichnye-nl/lotki-lestnichnye-pryamye-nl/', null);
        $this->info('The command was successful!');
    }

    public function categoryList(): array {
        return [
//            'ГЭМ' => 'https://asd-e.ru/product/gem/',
            'СТАНДАРТ' => 'https://asd-e.ru/product/kabelenesushchie-sistemy/',
//            'PROMTRAY' => 'https://asd-e.ru/product/promtray/',
        ];
    }

    public function parseCategoryCableSystems($categoryName, $categoryUrl, $parentId) {
        $this->info($categoryName . ' => ' . $categoryUrl);
        $catalog = $this->getCatalogByName($categoryName, $parentId);
        $uploadPath = $this->basePath . $catalog->alias . '/';

        try {
            $res = $this->client->get($categoryUrl);
            $html = $res->getBody()->getContents();
            $sectionCrawler = new Crawler($html); //section page from url

            //текст раздела
            if ($sectionCrawler->filter('.text_after_items')->count() != 0) {
                if ($sectionCrawler->filter('.text_after_items b')->count() > 0) {
                    $text = $sectionCrawler->filter('.text_after_items')->outerHtml();
                    $sectionCrawler->filter('.text_after_items img')->count();
                    if ($sectionCrawler->filter('.text_after_items img')->count() != 0) {
                        $imgArr = [];
                        $sectionCrawler->filter('.text_after_items img')->each(function (Crawler $img, $n) use (&$imgArr, $catalog, $uploadPath) {
                            $imageSrc = $this->baseUrl . $img->attr('src');
                            $ext = $this->getExtensionFromSrc($imageSrc);
                            $fileName = 'section_' . $catalog->id . '_text_img_' .$n . $ext;
                            $this->downloadJpgFile($imageSrc, $uploadPath, $fileName);
                            $imgArr[$img->attr('src')] = $fileName;
                        });
                        var_dump($imgArr);
                        $catalog->text = $this->getUpdatedTextWithNewImages($text, $imgArr);
                        $catalog->save();
                    }
                } else {
                    $catalog->text = null;
                    $catalog->save();
                }
            }

            if ($sectionCrawler->filter('.item-views.catalog.sections .title a.dark-color')->count() != 0) {
                $sectionCrawler->filter('.item-views.catalog.sections .title a.dark-color')->each(function (Crawler $sectionInnerCrawler) use ($catalog) {
                    $name = trim($sectionInnerCrawler->text());
                    $url = $this->baseUrl . $sectionInnerCrawler->attr('href');
                    $this->parseCategoryCableSystems($name, $url, $catalog->id);
                });
            } else {
                //парсим товары
//                try {
                    $this->parseListProductsCableSystems($catalog, $categoryUrl);
//                } catch (\Exception $e) {
//                    $this->error('Error Parse Products from section: ' . $e->getMessage());
//                    $this->error('See line: ' . $e->getLine());
//                }
            }
        } catch (GuzzleException $e) {
            $this->error('Error Parse Sections: ' . $e->getMessage());
        }
    }

    public function parseListProductsCableSystems($catalog, $categoryUrl) {
        $this->info('Parse products from: ' . $catalog->name);

        try {
            $res = $this->client->get($categoryUrl);
            $html = $res->getBody()->getContents();
            $crawler = new Crawler($html); //products page from url

            $uploadPath = $this->basePath . $catalog->alias . '/';

            if($crawler->filter('.catalog.item-views.table.many')->count() != 0) {
                $table = $crawler->filter('.catalog.item-views.table.many')->first(); //table of products
                $table->filter('a.dark-color')
                    ->reduce(function (Crawler $none, $i) {
                        return ($i < 1); //по одному товару на странице
                    })
                    ->each(function (Crawler $node, $n) use ($catalog, $uploadPath) {
                        $data = [];
                        try {
                            $url = $this->baseUrl . trim($node->attr('href'));
                            $data['name'] = trim($node->text());
                            $data['h1'] = $node->text();
                            $data['title'] = $node->text();
                            $data['alias'] = Text::translit($node->text());

                            $this->info(++$n . ') ' . $data['name']);

                            $product = Product::whereParseUrl($url)->first();

                            if (!$product) {
                                $productPage = $this->client->get($url);
                                $productHtml = $productPage->getBody()->getContents();
                                $productCrawler = new Crawler($productHtml); //product page

                                $order = $catalog->products()->max('order') + 1;
                                $newProd = Product::create(array_merge([
                                    'catalog_id' => $catalog->id,
                                    'parse_url' => $url,
                                    'published' => 1,
                                    'order' => $order,
                                ], $data));

                                //текстовое описание товара
                                if ($productCrawler->filter('.content')->count() != 0) {
                                    $text = $productCrawler->filter('.content')->outerHtml();
                                    if ($productCrawler->filter('.content img')->count() != 0) {
                                        $imgUrl = $productCrawler->filter('.content img')->first()->attr('src');
                                        $imageSrc = $this->baseUrl . $imgUrl;
                                        $ext = $this->getExtensionFromSrc($imageSrc);
                                        $fileName = 'product_' . $newProd->id . '_text_img' . $ext;
                                        $res = $this->downloadJpgFile($imageSrc, $uploadPath, $fileName);
                                        if ($res) {
                                            $newProd->text = $this->getTextWithNewImage($text, $this->basePath . $fileName);
                                            $newProd->save();
                                        }
                                    } else {
                                        $newProd->text = $text;
                                        $newProd->save();
                                    }
                                }

                                //характеристики
                                if ($productCrawler->filter('#props tr.char')->count() != 0) {
                                    $chars = [];
                                    $productCrawler->filter('#props tr.char')->each(function (Crawler $char) use (&$chars) {
                                        $name = $char->filter('.char_name span')->text();
                                        $value = $char->filter('.char_value span')->text();
                                        $chars[$this->chars[$name]] = $value;
                                    });
                                    $newProd->update($chars);
                                    $newProd->save();
                                }

                                //сертификаты и ту
                                if ($productCrawler->filter('#docs a')->count() != 0) {
                                    $docs = [];
                                    $productCrawler->filter('#docs a')->each(function (Crawler $img) use ($newProd, $uploadPath, &$docs) {
                                        $name = $img->text();
                                        $url = $this->baseUrl . $img->attr('href');
                                        $ext = $this->getExtensionFromSrc($url);
                                        $fileName = 'product_' . $newProd->id . '_' . $this->docs[$name] . $ext;
                                        $this->downloadJpgFile($url, $uploadPath, $fileName);
                                        $docs[$this->docs[$name]] = $uploadPath . $fileName;
                                    });
                                    $newProd->update($docs);
                                    $newProd->save();
                                }

                                //сохраняем изображения товара
                                $productCrawler->filter('.slides.items li img')->each(function ($img) use ($newProd, $catalog, $uploadPath) {
                                    $imageSrc = $this->baseUrl . $img->attr('src');
                                    $ext = $this->getExtensionFromSrc($imageSrc);
                                    $fileName = md5(uniqid(rand(), true)) . '_' . time() . $ext;
                                    $res = $this->downloadJpgFile($imageSrc, $uploadPath, $fileName);
                                    if ($res) {
                                        ProductImage::create([
                                            'product_id' => $newProd->id,
                                            'image' => $fileName,
                                            'order' => ProductImage::where('product_id', $newProd->id)->max('order') + 1,
                                        ]);
                                    }
                                });
                            } else {
                                $product->update($data);
                                $product->save();
                            }
                        } catch (\Exception $e) {
                            $this->warn('error: ' . $e->getMessage());
                            $this->warn('see line: ' . $e->getLine());
                        }
                        sleep(rand(0, 2));
                    });
            }

            //проход по страницам
            if($crawler->filter('.next a')->count() != 0) {
                $nextUrl = $crawler->filter('.next a');
                $nextUrl = $this->baseUrl . $nextUrl->attr('href');
                $this->info('parse next url: ' . $nextUrl);
                $this->parseListProductsCableSystems($catalog, $nextUrl);
            }
        } catch (GuzzleException $e) {
            $this->error('Error Parse Product: ' . $e->getMessage());
            $this->error('See: ' . $e->getLine());
        }
    }

}
