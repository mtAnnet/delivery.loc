@extends('layouts.app')
@section('main')
    <div class="container">
    @if (count($dishes))
        @php
            $basketCost = 0;
        @endphp
        <div class="section-heading"><h1>Ваша корзина</h1>
            <div class="buttons">
                <form action="{{ route('basket.clear') }}" method="post" class="text-right">
                    @csrf
                    <button onclick="return confirm('Вы уверены, что хотите очистить корзину?')" type="submit" class="button button-primary" style="margin-right: 10px;">
                        Очистить корзину
                    </button>
                </form>
                <a href="{{route('basket.checkout')}}" class="button">
                    <span class="button-text">Оформить заказ</span>
                </a>
            </div>
        </div>
        <table class="table">
            <tr>
                <th>№</th>
                <th>Наименование</th>
                <th>Цена</th>
                <th>Кол-во</th>
                <th>Стоимость</th>
                <th></th>
            </tr>
            @foreach($dishes as $dish)
                @php
                    $itemPrice = $dish->price;
                    $itemQuantity =  $dish->pivot->quantity;
                    $itemCost = $itemPrice * $itemQuantity;
                    $basketCost = $basketCost + $itemCost;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <span>
                            {{ $dish->name }}
                        </span>
                    </td>
                    <td>{{ number_format($itemPrice, 2, '.', '') }}</td>
                    <td id="td-control">
                        <form action="{{ route('basket.minus', ['id' => $dish->id]) }}"
                              method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="btn-control">
                                <i class="fas fa-minus-square"></i>
                            </button>
                        </form>
                        <span class="mx-1">{{ $itemQuantity }}</span>
                        <form action="{{ route('basket.plus', ['id' => $dish->id]) }}"
                              method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="btn-control">
                                <i class="fas fa-plus-square"></i>
                            </button>
                        </form>
                    </td>
                    <td>{{ number_format($itemCost, 2, '.', '') }}</td>
                    <td>
                        <form action="{{ route('basket.remove', ['id' => $dish->id]) }}"
                              method="post">
                            @csrf
                            <button onclick="return confirm('Вы уверены, что хотите удалить это блюдо из корзины?')" type="submit" class="btn-trash">
                                <i class="fas fa-trash-alt text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <th colspan="4" class="text-right">Итого</th>
                <th>{{ number_format($basketCost, 2, '.', '') }}</th>
                <th></th>
            </tr>
        </table>
    @else
        <h1>Ваша корзина</h1>
        <p>Ваша корзина пуста</p>
    @endif
    </div>
@endsection
