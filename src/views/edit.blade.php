@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">{{__('LaravelDbTrans.Edit Translation')}}</div>
    <div class="panel-body">

        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::open([
            'method' => 'PATCH',
            'route'  => ['laravel-db-trans.update', $item->first()->key],
            'class' => 'form-horizontal',
            'files' => true
        ]) !!}

        <input type="hidden" name="page" value="{{request('page')}}">
        <input type="hidden" name="key" value="{{request('key')}}">
        <input type="hidden" name="trans" value="{{request('translation')}}">

        @foreach($supportedLocales as $locale=>$localeData)
          <div class="form-group {{ $errors->has('translation['.$locale.']') ? 'has-error' : ''}}">
              {!! Form::label('translation['.$locale.']', strtoupper($locale), ['class' => 'col-md-4 control-label']) !!}
              <div class="col-md-6">
                  {!! Form::text('translation['.$locale.']', $item->where('locale', $locale)->first() ? $item->where('locale', $locale)->first()->translation : null, ['class' => 'form-control']) !!}
                  {!! $errors->first('translation['.$locale.']', '<p class="help-block">:message</p>') !!}
              </div>
          </div>
        @endforeach



        <div class="form-group">
            <div class="col-md-offset-4 col-md-4">
                {!! Form::submit(__('LaravelDbTrans.Update'), ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}

    </div>
</div>
@endsection
