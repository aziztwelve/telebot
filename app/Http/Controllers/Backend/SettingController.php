<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Setting;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
//use function GuzzleHttp\Psr7\str;

class SettingController extends Controller
{
    public function index()
    {
        return view('backend.setting', Setting::getSettings());
    }

    public function store(Request $request)
    {
        Setting::where('key', '!=', NULL)->delete();


        foreach ($request->except('_token') as $key=>$value){
//        dd($value);
            $setting = new Setting();
            $setting->key = $key;
            $setting->value = $value;
            $setting->save();
        }

        return redirect()->route('admin.setting.index');

    }

    public function setwebhook(Request $request)
    {
        $result = $this->sendTelegramData('setwebhook', [
            'query' => ['uri' => $request->url().'/'. \Telegram::getAccessToken()]
        ]);

        return redirect()->route('admin.setting.index')->with('status', $result);
    }

    public function getwebhookinfo(Request $request)
    {
        $result = $this->sendTelegramData('getWebhookInfo');
        return redirect()->route('admin.setting.index')->with('status', $result);
    }

    public function sendTelegramData($route = '', $params = [], $method = 'POST')
    {

        $client = new Client(['base_uri' => 'https://api.telegram.org/bot'. \Telegram::getAccessToken().'/' ]);
        $result = $client->request($method, $route, $params);
        return (string) $result->getBody();
    }
}
