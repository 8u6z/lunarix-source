<?php
namespace App\Http\Controllers\RBXApis;
use Illuminate\Http\Request;

class Locale
{
    public function getLocale(Request $request)
    {
        return response()->json(['data' => [['locale' => ['id' => 1, 'locale' => 'en_us', 'name' => 'English(US)', 'nativeName' => 'English', 'language' => [ 'id' => 41, 'name' => 'Inglês', 'nativeName' => 'English', 'languageCode' => 'en']], 'isEnabledForFullExperience' => true, 'isEnabledForSignupAndLogin' => true, 'isEnabledForInGameUgc' => true]]]);
    }

    public function getUserLocale(Request $request)
    {
        $locale = ['id' => 1, 'locale' => 'en_us', 'name' => 'English (United States)', 'nativeName' => 'English (United States)', 'language' => ['id' => 41, 'name' => 'English', 'nativeName' => 'English', 'languageCode' => 'en', 'isRightToLeft' => false]];
        return response()->json(['signupAndLogin' => $locale, 'generalExperience' => $locale, 'ugc' => $locale, 'showRobloxTranslations' => false]);
    }
}