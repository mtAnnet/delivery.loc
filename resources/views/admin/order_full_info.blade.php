@extends('admin.header')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Заказ #{{$order->id}}
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
                <p>Создан {{$order->created_at}}</p>
                <p>Имя: {{ $order->user->name }}</p>
                <p>Адрес почты: <a href="mailto:{{ $order->user->email }}">{{ $order->user->email }}</a></p>
                <p>Номер телефона: {{ $order->phone }}</p>
                <p>Адрес доставки: {{ $order->address }}</p>
                <p>Статус: {{ $order->status->name }}</p>
                @isset ($order->comment)
                    <p>Комментарий: {{ $order->comment }}</p>
                @endisset
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-borderless">
                <tr class="thead-dark">
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
        </div>
    </div>
    <div class="row d-inline-block align-self-end">
        <div class="col-lg-6">
            <form action="{{ route('admin.orders.cancel', ['id'=>$order->id]) }}" method="post" class="form-inline">
                @csrf
                <button onclick="return confirm('Вы уверены, что хотите отменить заказ?')" type="submit" class="btn btn-danger">Отменить заказ</button>
            </form>
        </div>
        <div class="col-lg-6">
            <form action="{{ route('admin.orders.done', ['id'=>$order->id]) }}" method="post" class="form-inline">
                @csrf
                <button onclick="return confirm('Вы уверены, что хотите выполнить этот заказ?')" type="submit" class="btn btn-success">Заказ выполнен</button>
            </form>
        </div>
    </div>
@endsection
