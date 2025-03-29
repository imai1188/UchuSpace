<?php

// namespace App\Providers;

// use GuzzleHttp\Client;
// use Illuminate\Support\ServiceProvider;
// use Illuminate\View\View; // Viewクラスをインポート
// use Illuminate\Support\Facades\View as ViewFacade; // Viewファサードをインポート

// class TimeOfDayServiceProvider extends ServiceProvider
// {
/**
 * Register services.
 */
// public function register(): void
// {
//     //
// }

/**
 * Bootstrap services.
 */
//     public function boot(): void
//     {
//         ViewFacade::composer('*', function (View $view) { // ViewFacadeを使用
//             // view()->composer('*', function (View $view) {
//             $latitude = 34.6937; // 大阪の緯度
//             $longitude = 135.5023; // 大阪の経度
//             $date = date('Y-m-d');

//             $client = new Client();
//             $response = $client->request('GET', "https://api.sunrise-sunset.org/json?lat={$latitude}&lng={$longitude}&date={$date}");
//             $data = json_decode($response->getBody(), true);

//             $sunrise = new \DateTime($data['results']['sunrise']);
//             $sunset = new \DateTime($data['results']['sunset']);
//             $now = new \DateTime();

//             $timeOfDay = 'day'; // デフォルトは昼

//             if ($now < $sunrise) {
//                 $timeOfDay = 'night';
//             } elseif ($now < $sunrise->getTimestamp() + ($sunset->getTimestamp() - $sunrise->getTimestamp()) / 3) {
//                 $timeOfDay = 'morning';
//             } elseif ($now > $sunset->getTimestamp() + ($sunset->getTimestamp() - $sunrise->getTimestamp()) / 3 * 2) {
//                 $timeOfDay = 'evening';
//             } elseif ($now > $sunset) {
//                 $timeOfDay = 'night';
//             }
//             $view->with('timeOfDay', $timeOfDay);
//         });
//     }
// }
