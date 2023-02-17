<?php namespace App\Http\Controllers;

use DB;
use Fanky\Admin\Models\Catalog;
use Fanky\Admin\Models\City;
use Fanky\Admin\Models\Feedback;
use Fanky\Admin\Models\Order as Order;
use Fanky\Admin\Models\Page;
use Fanky\Admin\Models\Product;
use Fanky\Admin\Models\ProductChar;
use Fanky\Admin\Models\Setting;
use Illuminate\Http\Request;
use Mail;
use Mailer;

//use Settings;
use Cart;
use Session;
use Settings;
use SiteHelper;
use Validator;

class AjaxController extends Controller {
    private $fromMail = 'info@bms.ru';
    private $fromName = 'LEVERING';

    //РАБОТА С КОРЗИНОЙ
    public function postAddToCart(Request $request): array {
        $id = $request->get('id');
        $size = $request->get('size');
        $weight = $request->get('weight');

        /** @var Product $product */
        $product = Product::find($id);
        if ($product) {
            $product_item = $product->toArray();
            $product_item['current_price'] = $product->getMeasurePrice();
            $product_item['count'] = $size;
            $product_item['round_k'] = $product->round_k;
            if (!$weight) {
                $product_item['weight'] = $product_item['count'] * $product_item['round_k'];
            } else {
                $product_item['weight'] = $weight;
            }
            if ($product_item['measure'] == 'м') {
                $product_item['weight'] = $size;
                $product_item['count'] = $weight;
            }

            $product_item['url'] = $product->url;
            Cart::add($product_item);
        }
        $header_cart = view('blocks.header_cart')->render();

        return [
            'header_cart' => $header_cart,
        ];
    }

    public function postEditCartProduct(Request $request): array {
        $id = $request->get('id');
        $count = $request->get('count', 1);
        /** @var Product $product */
        $product = Product::find($id);
        if ($product) {
            $product_item['image'] = $product->showAnyImage();
            $product_item = $product->toArray();
            $product_item['count_per_tonn'] = $count;
            $product_item['url'] = $product->url;

            Cart::add($product_item);
        }

        $popup = view('blocks.cart_popup', $product_item)->render();

        return ['cart_popup' => $popup];
    }

    public function postUpdateToCart(Request $request): array {
        $id = $request->get('id');
        $count = $request->get('count');

        $product = Product::find($id);

        $product_item = $product->toArray();
        $product_item['url'] = $product->url;

        if ($product_item['measure'] == 'т') {
            $product_item['weight'] = $count;
        } elseif ($product_item['measure'] == 'кг') {
            $product_item['weight'] = $count;
        } elseif ($product_item['measure'] == 'м') {
            $product_item['count'] = $count;
        } else {
            $product_item['count'] = $count;
        }

        Cart::updateCount($id, $count);

        $cur_summ = view('cart.table_row_summ', ['item' => $product_item])->render();
        $order_total = view('cart.blocks.order_total')->render();

        return [
            'cur_summ' => $cur_summ,
            'order_total' => $order_total,
        ];
    }

    public function postRemoveFromCart(Request $request) {
        $id = $request->get('id');
        Cart::remove($id);

        $sum = Cart::sum();

        $header_cart = view('blocks.header_cart')->render();
        $cart_values = view('blocks.cart_values', ['sum' => $sum])->render();

        return ['header_cart' => $header_cart, 'cart_values' => $cart_values];
    }

    public function postPurgeCart() {
        Cart::purge();

        $header_cart = view('blocks.header_cart')->render();
        $order_total = view('cart.blocks.order_total', [
            'total_weight' => Cart::total_weight(),
            'sum' => Cart::sum()
        ])->render();

        return [
            'header_cart' => $header_cart,
            'order_total' => $order_total,
        ];
    }

    //заявка в свободной форме
    public function postRequest(Request $request) {
        $data = $request->only(['name', 'phone', 'email', 'text']);
        $valid = Validator::make($data, [
            'name' => 'required',
            'phone' => 'required',
            'text' => 'required'
        ], [
            'name.required' => 'Не заполнено поле Имя',
            'phone.required' => 'Не заполнено поле Телефон',
            'text.required' => 'Не заполнено поле Сообщение',
        ]);

        if ($valid->fails()) {
            return ['errors' => $valid->messages()];
        } else {
            $feedback_data = [
                'type' => 1,
                'data' => $data
            ];
            $feedback = Feedback::create($feedback_data);
            Mail::send('mail.feedback', ['feedback' => $feedback], function ($message) use ($feedback) {
                $title = $feedback->id . ' | Заявка в свободной форме | LEVERING';
                $message->from($this->fromMail, $this->fromName)
                    ->to(Settings::get('feedback_email'))
                    ->subject($title);
            });

            return ['success' => true];
        }
    }

    //заказать звонок
    public function postCallback(Request $request) {
        $data = $request->only(['name', 'phone', 'time']);
        $valid = Validator::make($data, [
            'name' => 'required',
            'phone' => 'required',
            'time' => 'required',
        ], [
            'name.required' => 'Не заполнено поле Имя',
            'phone.required' => 'Не заполнено поле Телефон',
            'time.required' => 'Не заполнено поле Удобное время',
        ]);

        if ($valid->fails()) {
            return ['errors' => $valid->messages()];
        } else {
            $feedback_data = [
                'type' => 3,
                'data' => $data
            ];
            $feedback = Feedback::create($feedback_data);
            Mail::send('mail.feedback', ['feedback' => $feedback], function ($message) use ($feedback) {
                $title = $feedback->id . ' | Заказать звонок | LEVERING>';
                $message->from($this->fromMail, $this->fromName)
                    ->to(Settings::get('feedback_email'))
                    ->subject($title);
            });

            return ['success' => true];
        }
    }

    //получить консультацию
    public function postConsultation(Request $request) {
        $data = $request->only(['name', 'phone']);
        $valid = Validator::make($data, [
            'name' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => 'Не заполнено поле Имя',
            'phone.required' => 'Не заполнено поле Телефон',
        ]);

        if ($valid->fails()) {
            return ['errors' => $valid->messages()];
        } else {
            $feedback_data = [
                'type' => 3,
                'data' => $data
            ];
            $feedback = Feedback::create($feedback_data);
            Mail::send('mail.feedback', ['feedback' => $feedback], function ($message) use ($feedback) {
                $title = $feedback->id . ' | Консультация | LEVERING';
                $message->from($this->fromMail, $this->fromName)
                    ->to(Settings::get('feedback_email'))
                    ->subject($title);
            });

            return ['success' => true];
        }
    }

    //предложим оптимальное решение
    public function postOptimalDecision(Request $request) {
        $data = $request->only(['name', 'phone']);
        $file = $request->file('file');
        $valid = Validator::make($data, [
            'name' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => 'Не заполнено поле имя',
            'phone.required' => 'Не заполнено поле телефон',
        ]);

        if ($valid->fails()) {
            return ['errors' => $valid->messages()];
        } else {
            if ($file) {
                $file_name = md5(uniqid(rand(), true)) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path(Feedback::UPLOAD_URL), $file_name);
                $data['file'] = '<a target="_blanc" href=\'' . Feedback::UPLOAD_URL . $file_name . '\'>' . $file_name . '</a>';
            }

            $feedback_data = [
                'type' => 4,
                'data' => $data
            ];

            $feedback = Feedback::create($feedback_data);
            Mail::send('mail.feedback', ['feedback' => $feedback], function ($message) use ($feedback) {
                $title = $feedback->id . ' | Оптимальное решение | LEVERING';
                $message->from($this->fromMail, $this->fromName)
                    ->to(Settings::get('feedback_email'))
                    ->subject($title);
            });

            return ['success' => true];
        }
    }

    //консультация с файлом
    public function postProductConsult(Request $request) {
        $data = $request->only(['name', 'phone', 'message']);
        $file = $request->file('dfile');
        $valid = Validator::make($data, [
            'name' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => 'Не заполнено поле имя',
            'phone.required' => 'Не заполнено поле телефон',
        ]);

        if ($valid->fails()) {
            return ['errors' => $valid->messages()];
        } else {
            if ($file) {
                $file_name = md5(uniqid(rand(), true)) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path(Feedback::UPLOAD_URL), $file_name);
                $data['file'] = '<a target="_blanc" href=\'' . Feedback::UPLOAD_URL . $file_name . '\'>' . $file_name . '</a>';
            }

            $feedback_data = [
                'type' => 2,
                'data' => $data
            ];

            $feedback = Feedback::create($feedback_data);
            Mail::send('mail.feedback', ['feedback' => $feedback], function ($message) use ($feedback) {
                $title = $feedback->id . ' | Консультация по товару | LEVERING';
                $message->from($this->fromMail, $this->fromName)
                    ->to(Settings::get('feedback_email'))
                    ->subject($title);
            });

            return ['success' => true];
        }
    }

    //комплексное решение
    public function postComplexDecision(Request $request) {
        $data = $request->only(['name', 'phone', 'message']);
        $file = $request->file('cfile');
        $valid = Validator::make($data, [
            'name' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ], [
            'name.required' => 'Не заполнено поле имя',
            'phone.required' => 'Не заполнено поле телефон',
        ]);

        if ($valid->fails()) {
            return ['errors' => $valid->messages()];
        } else {
            if ($file) {
                $file_name = md5(uniqid(rand(), true)) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path(Feedback::UPLOAD_URL), $file_name);
                $data['file'] = '<a target="_blanc" href=\'' . Feedback::UPLOAD_URL . $file_name . '\'>' . $file_name . '</a>';
            }

            $feedback_data = [
                'type' => 7,
                'data' => $data
            ];

            $feedback = Feedback::create($feedback_data);
            Mail::send('mail.feedback', ['feedback' => $feedback], function ($message) use ($feedback) {
                $title = $feedback->id . ' | Комплексное решение | LEVERING';
                $message->from($this->fromMail, $this->fromName)
                    ->to(Settings::get('feedback_email'))
                    ->subject($title);
            });

            return ['success' => true];
        }
    }

    //запрос менеджеру
    public function postManagerRequest(Request $request) {
        $data = $request->only(['name', 'phone', 'message']);
        $valid = Validator::make($data, [
            'name' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => 'Не заполнено поле Имя',
            'phone.required' => 'Не заполнено поле Телефон',
        ]);

        if ($valid->fails()) {
            return ['errors' => $valid->messages()];
        } else {
            $feedback_data = [
                'type' => 6,
                'data' => $data
            ];
            $feedback = Feedback::create($feedback_data);
            Mail::send('mail.feedback', ['feedback' => $feedback], function ($message) use ($feedback) {
                $title = $feedback->id . ' | Запрос менеджеру | LEVERING';
                $message->from($this->fromMail, $this->fromName)
                    ->to(Settings::get('feedback_email'))
                    ->subject($title);
            });

            return ['success' => true];
        }
    }

    //ОФОРМЛЕНИЕ ЗАКАЗА
    public function postOrder(Request $request) {
        $data = $request->only([
            'payer_type',
            'name',
            'email',
            'phone',
            'company',
            'delivery_item_id',
            'payment',
            'callback',
        ]);

        array_get($data, 'callback') == 'on' ? $data['callback'] = 1 : $data['callback'] = 0;

        $messages = array(
            'payer_type' => 'Не указан тип плательщика',
            'email.required' => 'Не указан ваш e-mail адрес!',
            'email.email' => 'Не корректный e-mail адрес!',
            'name.required' => 'Не заполнено поле Имя',
            'phone.required' => 'Не заполнено поле Телефон',
            'delivery_item_id.required' => 'Не выбран способ доставки',
            'payment.required' => 'Не выбран способ оплаты',
        );

        $valid = Validator::make($data, [
            'payer_type' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'company' => 'required_if:payer_type,2',
            'delivery_item_id' => 'required',
        ], $messages);
        if ($valid->fails()) {
            return ['errors' => $valid->messages()];
        }

        $data['summ'] = Cart::sum();
        $data['total_weight'] = Cart::total_weight();

        $order = Order::create($data);
        $items = Cart::all();

        foreach ($items as $item) {
            if ($item['weight'] == 0) {
                $itemPrice = $item['count'] * $item['current_price'];
            } elseif ($item['measure'] == 'кг') {
                $itemPrice = $item['weight'] * $item['current_price'];
                $item['weight'] = $item['weight'] / 1000;
            } else {
                $itemPrice = $item['weight'] * $item['current_price'];
            }

            $order->products()->attach($item['id'], [
                'count' => $item['count'],
                'weight' => $item['weight'],
                'price' => $itemPrice
            ]);
        }

//        $data['total_sum'] = Cart::getRawTotalSum();
//        $order = Order::create($data);
//        $cart = Cart::getCart();
//        foreach ($cart as $item){
//            $product = array_get($item, 'model');
//            $product->update(['order_count' => $product->order_count +1]);
//            $size = array_get($item, 'size') ? array_get($item, 'size'): $product->param_size;
//            $order_item_data = [
//                'order_id'	=> $order->id,
//                'product_id'	=> array_get($item, 'id'),
//                'product_name'	=> $product->name,
//                'size'	=> $size,
//                'count'	=> array_get($item, 'count'),
//                'price'	=> array_get($item, 'price'),
//            ];
//            OrderItem::create($order_item_data);
//        }

//        if($data['payment_method'] == 3) {
//            return ['success' => true, 'redirect' => route('pay.order', ['id' => $order->id])];
//        }

        Mail::send('mail.new_order', ['order' => $order], function ($message) use ($order) {
            $title = $order->id . ' | Новый заказ | LEVERING';
            $message->from($this->fromMail, $this->fromName)
                ->to(Settings::get('feedback_email'))
                ->subject($title);
        });

        Cart::purge();

        return ['success' => true];
    }

    //РАБОТА С ГОРОДАМИ
    public function postSetCity($id) {
        $city_id = Request::get('city_id');
        $city = City::find($city_id);
        session(['change_city' => true]);
        if ($city) {
            $result = [
                'success' => true,
            ];
            session(['city_alias' => $city->alias]);

            return response(json_encode($result))->withCookie(cookie('city_id', $city->id));
        } elseif ($city_id == 0) {
            $result = [
                'success' => true,
            ];
            session(['city_alias' => '']);

            return response(json_encode($result))->withCookie(cookie('city_id', 0));
        }

        return ['success' => false, 'msg' => 'Город не найден'];
    }

    public function postGetCorrectRegionLink() {
        $city_id = Request::get('city_id');
        $city = City::find($city_id);
        $cur_url = Request::get('cur_url');

        if ($cur_url != '/') {
            $url = $cur_url;
            $path = explode('/', $cur_url);
            $cities = getCityAliases();
            /* проверяем - региональная ссылка или федеральная */
            if (in_array($path[0], $cities)) {
                if ($city) {
                    $path[0] = $city->alias;
                } else {
                    array_shift($path);
                }
            } else {
                if ($city && !in_array($path[0], Page::$excludeRegionAlias)) {
                    array_unshift($path, $city->alias);
                }
            }
            $url = '/' . implode('/', $path);
        } else { //Если на главной
//			if($city){
//				$url = '/' . $city->alias;
//			} else {
//				$url = $cur_url;
//			}
            $url = '/';
        }

        return ['redirect' => $url];
    }

    public function showCitiesPopup() {
        $cities = City::query()->orderBy('name')
            ->get(['id', 'alias', 'name', DB::raw('LEFT(name,1) as letter')]);
        $citiesArr = [];
        if (count($cities)) {
            foreach ($cities as $city) {
                $citiesArr[$city->letter][] = $city; //Группировка по первой букве
            }
        }

        $mainCities = City::query()->orderBy('name')
            ->whereIn('id', [
                3, // msk
                5, //spb
            ])->get(['id', 'alias', 'name']);
        $curUrl = url()->previous() ?: '/';
        $curUrl = str_replace(url('/') . '/', '', $curUrl);

        $current_city = SiteHelper::getCurrentCity();

        return view('blocks.popup_cities', [
            'cities' => $citiesArr,
            'mainCities' => $mainCities,
            'curUrl' => $curUrl,
            'current_city' => $current_city,
        ]);
    }

    public function setCity() {
        $id = Request::get('id');
        $city = City::findOrFail($id);
        if ($city) {
            session(['current_city' => $city]);
        } else {
            session(['current_city' => null]);
        }
        return ['success' => true, 'city' => $city->name];
    }

    public function confirmCity() {
        session(['confirm_city' => true]);

        return ['success' => true];
    }

    public function unConfirmCity() {
        session(['confirm_city' => null]);

        return ['success' => true];
    }

    public function search(Request $request) {
        $data = $request->only(['search']);

        $items = null;

        $page = Page::getByPath(['search']);
        $bread = $page->getBread();

        return [
            'success' => true,
            'redirect' => url('/search', [
                'bread' => $bread,
                'items' => $items,
                'data' => $data,
            ])];

//        return view('search.index', [
//            'bread' => $bread,
//            'items' => $items,
//            'data' => $data,
//        ]);

    }

    public function changeProductsPerPage(Request $request) {
        $count = $request->only('num');

        $setting = Setting::find(9);
        if ($setting) {
            $setting->value = $count['num'];
            $setting->save();
            return ['result' => true];
        } else {
            return ['result' => false];
        }
    }

    public function postSetView($view) {
        $view = $view == 'list' ? 'list' : 'grid';
        session(['catalog_view' => $view]);

        return ['success' => true];
    }
}
