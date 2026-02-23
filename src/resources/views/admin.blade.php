@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('navigation')
<a class="header-nav__button" href="/logout">logout</a>
@endsection


@section('content')
    <main class="admin-main">
        <h2 class="admin-heading">Admin</h2>
        <form method="GET" action="{{ route('contacts.index') }}" class="search-form">
            <div class="search-row">
                <div class="search-group">
                    <input 
                        type="text" 
                        name="keyword" 
                        placeholder="名前やメールアドレスを入力してください" 
                        value="{{ request('keyword') }}"
                        class="search-input search-input-large"
                    >
                </div>

                <div class="search-group">
                    <select name="gender" class="search-select">
                        <option value="">性別</option>
                        <option value="male" {{ request('gender') === 'male' ? 'selected' : '' }}>男性</option>
                        <option value="female" {{ request('gender') === 'female' ? 'selected' : '' }}>女性</option>
                    </select>
                </div>

                <div class="search-group">
                    <select name="category" class="search-select">
                        <option value="">お問い合わせの種類</option>
                        <option value="product" {{ request('category') === 'product' ? 'selected' : '' }}>商品の交換</option>
                        <option value="product_about" {{ request('category') === 'product_about' ? 'selected' : '' }}>商品の交換について</option>
                    </select>
                </div>

                <div class="search-group">
                    <input 
                        type="date" 
                        name="date" 
                        value="{{ request('date') }}"
                        class="search-input"
                    >
                </div>

                <button type="submit" class="btn btn-search">検索</button>
                <a href="{{ route('contacts.index') }}" class="btn btn-reset">リセット</a>
            </div>
        </form>

        <!-- エクスポートボタン -->
        <div class="export-section">
            <a href="{{ route('contacts.export') }}" class="btn btn-export">エクスポート</a>
        </div>

        <!-- テーブル -->
        <div class="table-wrapper">
            <table class="contacts-table">
                <thead>
                    <tr class="table-header">
                        <th class="table-cell">お名前</th>
                        <th class="table-cell">性別</th>
                        <th class="table-cell">メールアドレス</th>
                        <th class="table-cell">お問い合わせ内容</th>
                        <th class="table-cell table-cell-action"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                        <tr class="table-row">
                            <td class="table-cell">{{ $contact->name }}</td>
                            <td class="table-cell">
                                @if($contact->gender === 'male')
                                    男性
                                @elseif($contact->gender === 'female')
                                    女性
                                @else
                                    {{ $contact->gender }}
                                @endif
                            </td>
                            <td class="table-cell">{{ $contact->email }}</td>
                            <td class="table-cell">{{ Str::limit($contact->content, 30) }}</td>
                            <td class="table-cell table-cell-action">
                                <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-detail">詳細</a>
                            </td>
                        </tr>
                    @empty
                        <tr class="table-row">
                            <td colspan="5" class="table-cell table-cell-empty">
                                お問い合わせはまだありません。
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ページネーション -->
        @if($contacts->hasPages())
            <div class="pagination-wrapper">
                {{ $contacts->links() }}
            </div>
        @endif
    </main>
</div>
@endsection