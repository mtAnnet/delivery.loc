@extends('layouts.app')
@section('main')
    <div class="col-md-9">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible mt-0" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ $message }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible mt-0" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="container">
    <form class="checkout-form" method="post" action="{{ route('basket.saveorder') }}">
        @csrf
        <div class="section-heading">
            <h1>Оформить заказ</h1>
        </div>
            <input type="text" class=" input-checkout input " name="phone" placeholder="Номер телефона"
                   required maxlength="255" value="{{ old('phone') ?? '' }}">
            <input type="text" class="input input-checkout" name="address" placeholder="Адрес доставки">
            <input type="text" class="input input-checkout" name="promocode" placeholder="Промокод"
                    maxlength="10">
            <textarea class="input input-checkout" name="comment" placeholder="Комментарий"
                      maxlength="255" rows="2">{{ old('comment') ?? '' }}</textarea>
            <button type="submit" class="button">Оформить</button>
    </form>
    </div>
@endsection
