@extends('admin.header')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Управление данными
        </h1>
    </div>
</div>
<div class="row justify-content-between">
    <div class="col-lg-6">
        <h2>Города</h2>
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-lg-6">
                <form action="{{route('admin.tables.city.search')}}" method="post" class="form-inline">
                    @csrf
                    <input type="text" name="adminCitySearch" class="form-control" placeholder="Введите название города" required>
                    <button type="submit" class="btn btn-dark"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <div class="col-lg-6">
                <form action="{{route('admin.tables.city.add')}}" method="post" enctype="multipart/form-data" class="form-inline">
                    @csrf
                    <div class="form-group">
                        <input  class="form-control" type="text" name="newCity" value="{{old('name')}}" placeholder="Добавить город" required>
                        @error('name')
                        <span class="invalid" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                        <button onclick="return confirm('Вы уверены, что хотите добавить эту запись?')" type="submit" class="btn btn-outline-success">
                            <i class="fas fa-plus text-success"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-borderless">
                    <tr class="thead-dark">
                        <th>ID</th>
                        <th>Name</th>
                        <th></th>
                    </tr>
                    @foreach($cities as $city)
                        <tr>
                            <td>{{$city->id}}</td>
                            <td>{{$city->name}}</td>
                            <td>
                                <form action="{{ route('admin.tables.city.delete', ['id' => $city->id]) }}" method="post">
                                    @csrf
                                    <button onclick="return confirm('Вы уверены, что хотите удалить эту запись?')" type="submit" class="btn btn-outline-light">
                                        <i class="fas fa-trash-alt text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <h2>Кухни</h2>
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-lg-6">
                <form action="{{route('admin.tables.cuisine.search')}}"  method="post" class="form-inline">
                    @csrf
                    <input type="text" name="adminCuisineSearch" class="form-control" placeholder="Введите название кухни" required>
                    <button type="submit" class="btn btn-dark" ><i class="fa fa-search"></i></button>
                </form>
            </div>
            <div class="col-lg-6">
                <form action="{{route('admin.tables.cuisine.add')}}" method="post" enctype="multipart/form-data" class="form-inline">
                    @csrf
                    <div class="form-group">
                        <input  class="form-control" type="text" name="newCuisine" value="{{old('name')}}" placeholder="Добавить кухню" required>
                        @error('name')
                        <span class="invalid" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                        <button onclick="return confirm('Вы уверены, что хотите добавить эту запись?')" type="submit" class="btn-outline-success btn">
                            <i class="fas fa-plus text-success"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-borderless">
                    <tr class="thead-dark">
                        <th>ID</th>
                        <th>Name</th>
                        <th></th>
                    </tr>
                    @foreach($cuisines as $cuisine)
                        <tr>
                            <td>{{$cuisine->id}}</td>
                            <td>{{$cuisine->name}}</td>
                            <td>
                                <form action="{{ route('admin.tables.cuisine.delete', ['id' => $cuisine->id]) }}" method="post">
                                    @csrf
                                    <button onclick="return confirm('Вы уверены, что хотите удалить эту запись?')" type="submit" class="btn btn-outline-light">
                                        <i class="fas fa-trash-alt text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
