<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Constants\Locale;

class LocaleController extends Controller
{
    public function switch($locale)
    {
        if (in_array($locale, [Locale::EN_US, Locale::ID_ID])) {
            App::setLocale($locale);
            Session::put('locale', $locale);
        }

        return back();
    }
}
