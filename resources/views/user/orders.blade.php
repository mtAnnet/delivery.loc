@extends('layouts.app')
@section('main')
    <div class="container">
        <h1>Ваши заказы</h1>
        @foreach($orders as $order)
            <h2>{{$order->created_at}}</h2>
        <table class="table">
            <tr>
                <th>№</th>
                <th>Наименование</th>
                <th>Цена</th>
                <th>Кол-во</th>
                <th>Стоимость</th>
            </tr>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ number_format($item->price, 2, '.', '') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->cost, 2, '.', '') }}</td>
                </tr>
            @endforeach
            <tr>
                <th colspan="4" class="text-right">Итого</th>
                <th>{{ number_format($order->amount, 2, '.', '') }}</th>
            </tr>
        </table>

        <h2>Ваши данные</h2>
        <p>Имя, фамилия: {{ $order->user->name }}</p>
        <p>Адрес почты: <a href="mailto:{{ $order->user->email }}">{{ $order->user->email }}</a></p>
        <p>Номер телефона: {{ $order->phone }}</p>
        <p>Адрес доставки: {{ $order->address }}</p>
        <p>Статус: {{ $order->status->name }}</p>
        @isset ($order->comment)
            <p>Комментарий: {{ $order->comment }}</p>
        @endisset
        @endforeach
    </div>
@endsection
