@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
<style>
  .header { display: none; }
</style>
@endsection

@section('content')
<div class="container">
  <div class="background-text">Thank you</div>
  <div class="content">
    <p>お問い合わせありがとうございました</p>
    <a href="/" class="home-button">HOME</a>
  </div>
</div>
@endsection

