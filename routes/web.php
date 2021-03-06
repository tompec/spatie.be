<?php

Route::view('/', 'pages/home/index')->name('home');

Route::view('laravel', 'pages/laravel/index')->name('laravel');

Route::view('web-development', 'pages/web-development/index')->name('web-development');

Route::prefix('about-us')->group(function () {
    Route::view('/', 'pages/about/index')->name('about');

    collect(config('team.members'))->each(function (string $personName) {
        Route::permanentRedirect($personName, "/about-us/#{$personName}");
    });
});

Route::prefix('open-source')->group(function () {
    Route::get('/', 'OpenSourceController@index')->name('open-source.index');
    Route::get('postcards', 'PostcardController@index')->name('open-source.postcards');
    Route::get('packages', 'OpenSourceController@packages')->name('open-source.packages');
    Route::get('projects', 'OpenSourceController@projects')->name('open-source.projects');
});

Route::prefix('vacancies')->group(function () {
    Route::permanentRedirect('free-application', '/vacancies/spontaneous-application');

    Route::view('/', 'pages.vacancies.index')->name('vacancies.index');
    Route::view('internships', 'pages.vacancies.internship')->name('vacancies.internship');

    Route::get('{slug}', function ($slug) {
        return view("pages.vacancies.{$slug}");
    })->name('vacancies.show');
});

Route::get('api/instagram-photos', 'Api\InstagramPhotosController')->middleware(\Spatie\Cors\Cors::class);

Route::view('legal', 'pages.legal.index')->name('legal.index');
Route::view('privacy', 'pages.legal.privacy')->name('legal.privacy');
Route::view('disclaimer', 'pages.legal.disclaimer')->name('legal.disclaimer');
Route::view('general-conditions', 'pages.legal.generalConditions')->name('legal.conditions');
Route::view('gdpr', 'pages.legal.gdpr')->name('legal.gdpr');

Route::view('offline', 'errors.offline')->name('offline');
