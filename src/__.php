<?php
use Goszowski\LaravelDbTrans\LaravelDbTrans;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

function __($str)
{
    $groupName = null;
    $translation = $str;
    $currentLocale = LaravelLocalization::getCurrentLocale();

    if(mb_strpos($translation, '.'))
    {
        $tmp = explode('.', $translation);
        $groupName = $tmp[0];

        unset($tmp[0]);
        $translation = implode('.', $tmp);
    }

    $key = $groupName.'.'.str_slug($translation);

    $dbTranslation = LaravelDbTrans::where('key', $key)->where('locale', $currentLocale)->first();

    if(! count($dbTranslation))
    {
      foreach(LaravelLocalization::getSupportedLocales() as $locale=>$localeData)
      {
        LaravelDbTrans::create([
          'key' => $key,
          'locale' => $locale,
          'translation' => $translation,
        ]);
      }

      return __($str);
    }

    return $dbTranslation->translation;
}
