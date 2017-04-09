<?php

namespace Goszowski\LaravelDbTrans;

use Illuminate\Http\Request;
use Goszowski\LaravelDbTrans\LaravelDbTrans;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LaravelDbTransController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = new LaravelDbTrans;

        if(request('key'))
        {
          $items = $items->where('key', 'like', '%'.request('key').'%');
        }

        if(request('translation'))
        {
          $items = $items->where('translation', 'like', '%'.request('translation').'%');
        }

        $items = $items->groupBy('key')->paginate();
        return view('laravel-db-trans::index', compact('items'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($key)
    {
        $item = LaravelDbTrans::where('key', $key)->get();
        $supportedLocales = LaravelLocalization::getSupportedLocales();

        return view('laravel-db-trans::edit', compact('item', 'supportedLocales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $key)
    {
        foreach($request->input('translation') as $locale=>$translation)
        {
          if(! LaravelDbTrans::where('key', $key)->where('locale', $locale)->count())
          {
            LaravelDbTrans::create([
              'key' => $key,
              'locale' => $locale,
              'translation' => '',
            ]);
          }

          LaravelDbTrans::where('key', $key)->where('locale', $locale)->update([
            'translation' => $translation,
          ]);
        }

        return redirect(route('laravel-db-trans.index') . '?page=' . request('page') . '&key=' . request('key') . '&translation=' . request('trans'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($key)
    {
        LaravelDbTrans::where('key', $key)->delete();
        return redirect(route('laravel-db-trans.index') . '?page=' . request('page') . '&key=' . request('key') . '&translation=' . request('trans'));
    }
}
