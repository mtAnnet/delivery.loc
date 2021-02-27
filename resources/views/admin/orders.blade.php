@extends('admin.header')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Заказы
            </h1>
        </div>
    </div>
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-lg-12">
            <form action="{{route('admin.orders.filter')}}" method="post" class="form-inline">
                @csrf
                <input type="date" class="form-control" id="date" name="date" placeholder="Дата">
                    <select class="form-control" name="status">
                        @foreach($statuses as $status)
                            <option value="{{$status->id}}">{{$status->name}}</option>
                        @endforeach
                    </select>
                <button type="submit" class="btn btn-dark"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
    <div class="row justify-content-between">
        <div class="col-lg-12">
            <table class="table table-borderless">
                <tr class="thead-dark">
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Created_at</th>
                    <th></th>
                </tr>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->user->name}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{$order->user->email}}</td>
                        <td>{{$order->address}}</td>
                        <td>{{$order->status->name}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>
                            <form action="{{ route('admin.orders.info', ['id' => $order->id]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-light">
                                    <i class="fas fa-info-circle text-info"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
