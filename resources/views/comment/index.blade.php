@extends('layouts.vue_app')

@section('content')
<div id="app">
  <comment :agro_id="{{ $agrolytic->id }}" :user_id="{{ Auth::user()->id }}">
  <img src="{{ url('/') }}/images/loader.gif" style="height: 45px;"/>

  </comment>
</div>
@endsection