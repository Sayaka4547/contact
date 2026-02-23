@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
  <div class="confirm__heading">
    <h2 class="confirm__title">Confirm</h2>
  </div>
  <form class="form" action="/contacts" method="post">
    @csrf
    <div class="confirm-table">
      <table class="confirm-table__inner">
        <tr class="confirm-table__row">
          <th class="confirm-table__header">お名前</th>
          <td class="confirm-table__text">
            {{$contact['first_name']}} {{$contact['last_name']}} 
             <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}" />
             <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}" />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">性別</th>
          <td class="confirm-table__text">
            @php
            $genderLabels = [1 => '男性', 2 => '女性', 3 => 'その他'];
            @endphp
            {{$genderLabels[$contact['gender']] ?? '未選択' }}
            <input type="hidden" name="gender" value="{{ $contact['gender'] }}" />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">メールアドレス</th>
          <td class="confirm-table__text">
            {{$contact['email']}}
            <input type="hidden" name="email" value="{{ $contact['email'] }}" />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">電話番号</th>
          <td class="confirm-table__text">
            {{$contact['tel'] }}
            <input type="hidden" name="tel" value="{{ $contact['tel'] }}">
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">住所</th>
          <td class="confirm-table__text">
            {{$contact['address'] }}
            <input type="hidden" name="address" value="{{ $contact['address'] }}" />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">建物</th>
          <td class="confirm-table__text">
            {{$contact['building'] }}
            <input type="hidden" name="building" value="{{ $contact['building'] }}" />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">お問い合わせの種類</th>
          <td class="confirm-table__text">
            {{ $category->content }}
            <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">お問い合わせ内容</th>
          <td class="confirm-table__text">
            {{$contact['detail'] }}
            <input type="hidden" name="detail" value="{{ $contact['detail'] }}" />
          </td>
        </tr>
      </table>
    </div>
    <div class="form__button">
      <button class="form__button-submit" type="submit" formaction="/contact/thanks">送信</button>
      <button class="form__button-edit" type="submit" formaction="/contact/back">修正</button>
    </div>
  </form>
</div>
@endsection
