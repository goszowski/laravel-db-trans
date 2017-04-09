<?php
namespace Goszowski\LaravelDbTrans;

use Illuminate\Database\Eloquent\Model as Eloquent;

class LaravelDbTrans extends Eloquent {

  protected $table      = 'goszowski_db_trans';
  protected $fillable   = ['key', 'locale', 'translation'];

  public function variants()
  {
    return LaravelDbTrans::where('key', $this->key)->get();
  }
}
