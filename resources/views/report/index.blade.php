@extends('layouts.vue_app')

@section('content')
<div id="app">
  <report :agro_id="{{ $agrolytic->id }}" :user_id="{{ Auth::user()->id }}" :role="'{{ Auth::user()->type }}'">
  
  <img src="{{ url('/') }}/images/loader.gif" style="height: 45px;"/>
  
  </report>
</div>
@endsection