@extends('Layouts.index')
@section('content')
<div class="container">
    <!-- Top-news -->
    @if($widgets)
    @foreach($widgets as  $wid)
        @foreach($wid as $key=>$value)
            @if($value)
            @include('widgets.'.$key,['data'=>$value])
            @endif
        @endforeach
    @endforeach
    @endif
   
  </div>
  @endsection