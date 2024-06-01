@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm3.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        Confirm
    </div>
    <form class="form" action="/thanks" method="post">
        @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}" readonly>
                        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}" readonly>
                        {{ $contact['last_name'] }}&emsp;{{ $contact['first_name'] }}
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        <input type="hidden" name="gender" value="{{ $contact['gender'] }}" readonly>
                        @switch ($contact['gender'])
                            @case (1)
                                男性
                                @break
                            @case (2)
                                女性
                                @break
                            @default
                                その他
                        @endswitch
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        <input type="hidden" name="email" value="{{ $contact['email'] }}" readonly>
                        {{ $contact['email'] }}
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        <!-- <input type="tel" name="tell" value="{{ $contact['first_tell'] }}{{ $contact['second_tell'] }}{{ $contact['third_tell'] }}" readonly> -->
                        <input type="hidden" name="first_tell" value="{{ $contact['first_tell'] }}" readonly>
                        <input type="hidden" name="second_tell" value="{{ $contact['second_tell'] }}" readonly>
                        <input type="hidden" name="third_tell" value="{{ $contact['third_tell'] }}" readonly>
                        {{ $contact['first_tell'] }}{{ $contact['second_tell'] }}{{ $contact['third_tell'] }}
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        <input type="hidden" name="address" value="{{ $contact['address'] }}" readonly>
                        {{ $contact['address'] }}
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        <input type="hidden" name="building" value="{{ $contact['building'] }}" readonly>
                        {{ $contact['building'] }}
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">
                        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" readonly>
                        {{ $category['content'] }}
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        <input type="hidden" name="detail" value="{{ $contact['detail'] }}" readonly>
                        {{ $contact['detail'] }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">送信</button>
            <button class="form__button-back" type="submit" name="back" value="back">修正</button>
        </div>
    </form>
</div>
@endsection
