@extends('admin.header')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Пользователи
            </h1>
        </div>
    </div>
    <div class="row justify-content-between" style="margin-bottom: 20px;">
        <div class="col-lg-12">
            <form action="{{route('admin.users.search')}}" method="post" class="form-inline">
                @csrf
                <input type="text" name="adminUserSearchName" class="form-control" placeholder="Введите имя или email">
                <input type="date" class="form-control" id="date" name="adminUserSearchDate" placeholder="Дата">
                <button type="submit" class="btn btn-dark" ><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-borderless">
                <tr class="thead-dark">
                    <th>ID</th>
                    <th>Role</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Promocode</th>
                    <th>Promocode used</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th></th>
                </tr>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->promocode['promocode']}}</td>
                    @if($user->promocode['is_used'] == 1)
                        <td>Да</td>
                    @elseif($user->promocode['is_used'] == 0)
                        <td>Нет</td>
                    @endif
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td>
                        @if($user->role->name === 'admin')
                            <div style="position: relative;left: 12px;"><i class="fa fa-user"></i></div>
                        @else
                        <form action="{{ route('admin.users.delete', ['id' => $user->id]) }}" method="post">
                            @csrf
                            <button onclick="return confirm('Вы уверены, что хотите удалить эту запись?')" type="submit" class="btn btn-outline-light">
                                <i class="fas fa-trash-alt text-danger"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
