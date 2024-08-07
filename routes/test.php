<?php

Route::get('/test', function () {
    try {
        $db = DB::connection()->getPdo();
        echo 'Connected to database!';
    } catch (\Exception $e) {
        echo 'Error connecting to database: ' . $e->getMessage();
    }
});