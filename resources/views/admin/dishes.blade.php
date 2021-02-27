@extends('admin.header')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
               Блюда
            </h1>
        </div>
    </div>
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-lg-12">
            <form action="{{route('admin.dishes.search.name')}}" method="post" class="form-inline">
                @csrf
                <div class="form-group mb-2">
                    <input type="text" name="dishSearchByName" class="form-control" placeholder="Введите название блюда">
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
                    <th>Price</th>
                    <th>Ingredients</th>
                    <th>Time for preparing</th>
                    <th>Restaurant</th>
                    <th></th>
                </tr>
                @foreach($dishes as $dish)
                    <tr>
                        <td>{{$dish->id}}</td>
                        <td>{{$dish->name}}</td>
                        <td>{{$dish->price}}</td>
                        <td>{{$dish->ingredients}}</td>
                        <td>{{$dish->time_for_preparing}}</td>
                        <td>{{$dish->restaurant->name}}</td>
                        <td>
                            <form action="{{ route('admin.dishes.delete', ['id' => $dish->id]) }}" method="post">
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
            <h3>Добавить блюдо</h3>
            <form action="{{route('admin.dishes.create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="restaurant">Restaurant</label>
                    <select class="form-control" name="restaurant" required>
                        @foreach($restaurants as $restaurant)
                            <option value="{{$restaurant->id}}" >{{$restaurant->name}}</option>
                        @endforeach
                    </select>
                </div>
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
                    <label for="name">Price</label>
                    <input  class="form-control" type="text" name="price" value="{{old('price')}}" required>
                    @error('price')
                    <span class="invalid" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Ingredients</label>
                    <input  class="form-control" type="text" name="ingredients" value="{{old('ingredients')}}" required>
                    @error('ingredients')
                    <span class="invalid" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Time for preparing</label>
                    <input  class="form-control" type="text" name="time_for_preparing" value="{{old('time_for_preparing')}}" required>
                    @error('time_for_preparing')
                    <span class="invalid" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button onclick="return confirm('Вы уверены, что хотите добавить эту запись?')" type="submit" class="btn btn-dark btn-lg">Create</button>
            </form>
        </div>
    </div>
@endsection


