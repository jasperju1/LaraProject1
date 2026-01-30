<?php

use App\Mail\Timetable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mailable', function () {
    $cachedResponse = Cache::remember('timetable', now()->addHour(), function () {
        return Http::get('https://tahveltp.edu.ee/hois_back/timetableevents/timetableSearch', [
            'from' => now()->startOfWeek()->toIso8601String(),
            'lang' => 'ET',
            'page' => '0',
            'schoolId' => '38',
            'size' => '50',
            'studentGroups' => '4b26d1e5-11ac-4c63-840e-46c450c529ee',
            'thru' =>  now()->endOfWeek()->toIso8601String(),
        ])->json();
    });

    $content = data_get($cachedResponse, 'content', []);

    $items = [];

    foreach ($content as $item) {

        $date = Carbon::parse(data_get($item, 'date'))->locale('et');

        $items[$date->dayName][] = [
            'name' => data_get($item, 'nameEt'),
            'date' => $date->translatedFormat('d. F Y'),
            'start' => data_get($item, 'timeStart'),
            'end' => data_get($item, 'timeEnd'),
            'room' => data_get($item, 'rooms.0.roomCode'),
        ];
    }

    return new Timetable($items);
});

