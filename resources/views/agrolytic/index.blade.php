@extends('layouts.vue_app')

@section('content')
<div id="app">
  <agrolytic :user_id = "{{ Auth::user()->id }}" :role="'{{ Auth::user()->type }}'" :sec_id="{{ request()->input('sec_id',0) }}" :cat_id="{{ request()->input('cat_id',0) }}"></agrolytic>
</div>
@endsection