<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function switch($locale)
    {
        if (in_array($locale, ['en', 'id'])) {
            App::setLocale($locale);
            Session::put('locale', $locale);
        }

        return back();
    }
}
