@extends('layouts.vue_app')

@section('content')
<div id="app">
  <comment :agro_id="{{ $agrolytic->id }}" :user_id="{{ Auth::user()->id }}"></comment>
</div>
@endsection