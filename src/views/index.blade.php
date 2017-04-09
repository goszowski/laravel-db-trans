@extends('layouts.app')

@section('content')
  <div class="panel panel-default">
      <div class="panel-heading">{{__('LaravelDbTrans.Translations')}}</div>
      <div class="panel-body">
          <div class="table-responsive">
              <table class="table table-borderless">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Key</th>
                          <th>Translations</th>
                          <th>Actions</th>
                      </tr>
                      {!! Form::open(['route'=>'laravel-db-trans.index', 'method'=>'get']) !!}
                      <tr>
                          <th></th>
                          <th>
                            <div class="form-group">
                              <input type="text" name="key" class="form-control" value="{{request('key')}}">
                            </div>
                          </th>
                          <th>
                            <div class="form-group">
                              <input type="text" name="translation" class="form-control" value="{{request('translation')}}">
                            </div>
                          </th>
                          <th>
                            <div class="form-group">
                              <button type="submit" class="btn btn-primary">{{__('LaravelDbTrans.Search')}}</button>
                            </div>
                          </th>
                      </tr>
                      {!! Form::close() !!}
                  </thead>
                  <tbody>
                  @foreach($items as $item)
                      <tr>
                          <td>{{ $item->id }}</td>
                          <td>
                            @if(request('key'))
                              {!! preg_replace("/\w*?".request('key')."\w*/i", "<b class='text-danger' style='background-color: #f6bdbd'>$0</b>", $item->key) !!}
                            @else
                              {{$item->key}}
                            @endif
                          </td>
                          <td>
                            @foreach($item->variants() as $variant)
                              <span class="label label-default" title="{{$variant->locale}}" data-toggle="tolltip">
                                @if(request('translation'))
                                  {!! preg_replace("/\p{L}*?".preg_quote(request('translation'))."\p{L}*/ui", "<b class='text-danger' style='background-color: #f6bdbd'>$0</b>", $variant->translation) !!}
                                @else
                                  {{$variant->translation}}
                                @endif
                              </span>
                            @endforeach
                          </td>
                          <td>
                              <a href="{{ route('laravel-db-trans.edit' , ['id' => $item->key] ) }}?page={{request('page')}}&key={{request('key')}}&translation={{request('translation')}}"  class="btn btn-primary btn-xs" title="Edit Career"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                              {!! Form::open([
                                  'method'=>'DELETE',
                                  'route' => ['laravel-db-trans.edit', $item->id],
                                  'style' => 'display:inline'
                              ]) !!}
                              {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Career" />', array(
                                  'type' => 'submit',
                                  'class' => 'btn btn-danger btn-xs',
                                  'title' => 'Delete Career',
                                  'onclick'=>'return confirm("Confirm delete?")'
                              )) !!}
                              {!! Form::close() !!}
                          </td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
              <div class="pagination-wrapper"> {!! $items->appends(['key'=>request('key'), 'translation'=>request('translation')])->render() !!} </div>
          </div>
      </div>
  </div>
@endsection
