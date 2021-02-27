@extends('admin.header')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Рестораны
        </h1>
    </div>
</div>
<div class="row" style="margin-bottom: 20px;">
    <div class="col-lg-12">
            <form action="{{route('admin.restaurants.search.name')}}" method="post" class="form-inline">
                @csrf
                    <div class="form-group mb-2">
                        <input type="text" name="restaurantSearchByName" class="form-control" placeholder="Введите название ресторана">
                        <button type="submit" class="btn btn-dark"><i class="fa fa-search"></i></button>
                    </div>
            </form>
    </div>
</div>
<div class="row justify-content-between">
    <div class="col-lg-12">
        <table class="table table-borderless">
            <tr class="thead-dark">
                <th>ID</th>
                <th>Name</th>
                <th>Cuisine</th>
                <th>City</th>
                <th></th>
            </tr>
            @foreach($restaurants as $restaurant)
                <tr>
                    <td>{{$restaurant->id}}</td>
                    <td>{{$restaurant->name}}</td>
                    <td>
                        @foreach($restaurant->cuisines as $cuisine)
                        <p>{{$cuisine->name}}</p>
                        @endforeach
                    </td>
                    <td>
                        @foreach($restaurant->cities as $city)
                        <p>{{$city->name}}</p>
                        @endforeach
                    </td>
                    <td>
                        <form action="{{ route('admin.restaurants.delete', ['id' => $restaurant->id]) }}" method="post">
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
<div class="row justify-content-between">
    <div class="col-lg-12">
        <h2>Добавить ресторан</h2>
            <form action="{{route('admin.restaurants.create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="file">Image</label>
                    <input  class="filestyle" data-buttonBefore="true" type="file" name="image" value="{{old('image')}}" required>
                    @error('image')
                    <span class="invalid" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input  class="form-control" type="text" name="name" value="{{old('name')}}" required>
                    @error('name')
                    <span class="invalid" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cuisine">Cuisine</label>
                        @foreach($cuisines as $cuisine)
                            <div class="form-check" style="margin: 10px;">
                                    <input  name="cuisines[]" type="checkbox" class="form-check-input" id="exampleCheck1" value="{{$cuisine->id}}" >
                                    <label style="margin-left: 24px;" class="form-check-label" for="exampleCheck1">{{$cuisine->name}}</label>
                                </div>
                        @endforeach
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    @foreach($cities as $city)
                        <div class="form-check" style="margin: 10px;">
                            <input  name="cities[]" type="checkbox" class="form-check-input" id="exampleCheck1" value="{{$city->id}}" >
                            <label style="margin-left: 24px;" class="form-check-label" for="exampleCheck1">{{$city->name}}</label>
                        </div>
                    @endforeach
                </div>
                <button onclick="return confirm('Вы уверены, что хотите добавить эту запись?')" type="submit" class="btn btn-dark btn-lg">Create</button>
            </form>
    </div>
</div>
@endsection

