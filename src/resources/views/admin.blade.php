@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('navigation')
<form action="/logout" method="post">
    @csrf
    <button class="header-nav__button">logout</button>
</form>
@endsection

@section("content")
<div class="admin__content">
    <div class="admin__heading">
        <h2 class="admin__title">Admin</h2>
    </div>
    <div class="search-form__wrapper">
        <form class="search-form" action="/admin/search" method="get">
         @csrf
        <div class="search-form__group">
        <input type="text" class="search-form__input" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request("keyword")}}">
        <select class="search-form__select" name="gender">
          <option value="" disabled {{ request('gender') === null ? 'selected' : '' }}>性別</option>
          <option value="0" {{ request('gender') == '0' ? 'selected' : '' }}>全て</option>
          <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
          <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
          <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
        </select>
        <select class="search-form__select" name="category_id">
          <option value="" disabled {{ request('category_id') === null ? 'selected' : '' }}>お問い合わせの種類</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}"{{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
          @endforeach
        </select>
        <input type="date" class="search-form__input--date" name="date" value="{{ request("date")}}">
        <button class="search-form__button--submit" type="submit">検索</button>
        <a href="/admin" class="search-form__button--reset">リセット</a>
        </div>
        </form>
    </div>
  <div class="table-utilities">
    <form action="/export" method="post">
        @csrf
        <button class="export-button">エクスポート</button>
    </form>
    {{ $contacts->appends(request()->query())->links() }}
  </div>
  <div class="admin-table__wrapper">
    <table class="admin-table">
      <thead>
        <tr>
          <th>お名前</th>
          <th>性別</th>
          <th>メールアドレス</th>
          <th>お問い合わせの種類</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
         @foreach ($contacts as $contact)
        <tr>
          <td>{{ $contact->last_name }} {{ $contact->first_name }} </td>
          <td>{{ $contact->gender_text }}</td>
          <td>{{ $contact->email }}</td>
          <td>{{ $contact->category->content }}</td>
          <td>
            <button class="detail-button" data-id="{{ $contact->id }}">詳細</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div id="modal-overlay" class="modal-overlay" style="display:none;">
  <div class="modal">
    <button class="modal__close" id="modal-close">&#x2715;</button>
    <table class="modal-table">
      <tr><th>お名前</th><td id="modal-name"></td></tr>
      <tr><th>性別</th><td id="modal-gender"></td></tr>
      <tr><th>メールアドレス</th><td id="modal-email"></td></tr>
      <tr><th>電話番号</th><td id="modal-tel"></td></tr>
      <tr><th>住所</th><td id="modal-address"></td></tr>
      <tr><th>建物名</th><td id="modal-building"></td></tr>
      <tr><th>お問い合わせの種類</th><td id="modal-category"></td></tr>
      <tr><th>お問い合わせ内容</th><td id="modal-detail"></td></tr>
    </table>
    <form id="modal-delete-form" action="" method="post" style="text-align:center; margin-top:20px;">
      @csrf
      @method('DELETE')
      <button type="submit" class="modal__delete-button">削除</button>
    </form>
  </div>
</div>

<script>
document.querySelectorAll('.detail-button').forEach(function(btn) {
  btn.addEventListener('click', function() {
    const id = this.dataset.id;
    fetch('/admin/' + id)
      .then(res => res.json())
      .then(data => {
        document.getElementById('modal-name').textContent     = data.last_name + '　' + data.first_name;
        document.getElementById('modal-gender').textContent   = data.gender_text;
        document.getElementById('modal-email').textContent    = data.email;
        document.getElementById('modal-tel').textContent      = data.tel;
        document.getElementById('modal-address').textContent  = data.address;
        document.getElementById('modal-building').textContent = data.building ?? '';
        document.getElementById('modal-category').textContent = data.category.content;
        document.getElementById('modal-detail').textContent   = data.detail;
        document.getElementById('modal-delete-form').action   = '/admin/' + id;
        document.getElementById('modal-overlay').style.display = 'flex';
      });
  });
});

document.getElementById('modal-close').addEventListener('click', function() {
  document.getElementById('modal-overlay').style.display = 'none';
});

document.getElementById('modal-overlay').addEventListener('click', function(e) {
  if (e.target === this) this.style.display = 'none';
});
</script>
@endsection
