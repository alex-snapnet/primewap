@extends('layouts.vue_app')

@section('content')
<div id="app">
  <report 
  :user_id="{{ Auth::user()->id }}"
  :date_days="'{{ request()->input('date_days',0)  }}'" :role="'{{ Auth::user()->type }}'">
  <img src="{{ url('/') }}/images/loader.gif" style="height: 45px;"/>
  </report>
</div>
@endsection