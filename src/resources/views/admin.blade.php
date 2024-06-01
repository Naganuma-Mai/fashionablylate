@extends('layouts.app')
<style>
    svg.w-5.h-5 {
        /*paginateメソッドの矢印の大きさ調整のために追加*/
        width: 30px;
        height: 30px;
    }
</style>

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin2.css') }}">
@endsection

@section('button')
<form class="form" action="/logout" method="post">
    @csrf
    <button class="logout__button">logout</button>
</form>

    <!-- class="logout__button-submit" -->
@endsection

@section('content')
<div class="admin__content">
    <div class="admin__heading">
        Admin
    </div>
    <form class="search-form" action="/contacts/search" method="get">
        @csrf
        <div class="search-form__item">
            <input class="search-form__item-input" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ old('keyword') }}">
            <select class="search-form__item-select" name="gender">
                <option value="" selected>性別</option>
                <option value="">全て</option>
                <option value="1">男性</option>
                <option value="2">女性</option>
                <option value="3">その他</option>
            </select>
            <select class="search-form__item-select" name="category_id">
                <option value="" selected>お問い合わせの種類</option>
                @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                @endforeach
            </select>
            <input class="search-form__item-select" type="date" name="date">
            <button class="search-form__button-submit" type="submit">検索</button>
            <input class="search-form__button-reset" type="reset" value="リセット">
        </div>
    </form>
    {{ $contacts->appends(request()->query())->links() }}
    <div class="contact-table">
        <table class="contact-table__inner">
            <tr class="contact-table__row">
                <th class="contact-table__header">お名前</th>
                <th class="contact-table__header">性別</th>
                <th class="contact-table__header">メールアドレス</th>
                <th class="contact-table__header">お問い合わせの種類</th>
                <th></th>
            </tr>
            @foreach ($contacts as $contact)
            <tr class="contact-table__row">
                <td class="contact-table__text">
                    {{ $contact['last_name'] }}&emsp;{{ $contact['first_name'] }}
                </td>
                <td class="contact-table__text">
                    @switch ($contact['gender'])
                        @case (1)
                            <p>男性</p>
                            @break
                        @case (2)
                            <p>女性</p>
                            @break
                        @default
                            <p>その他</p>
                    @endswitch
                </td>
                <td class="contact-table__text">
                    {{ $contact['email'] }}
                </td>
                <td class="contact-table__text">
                    <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" readonly>
                    {{ $contact['category']['content'] }}
                </td>
                <td class="contact-table__text">
                    <button class="contact-table__button">詳細</button>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
        <!-- <div class="form__button">
            <button class="form__button-submit" type="submit">詳細</button>
        </div> -->
</div>
@endsection
