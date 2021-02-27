@extends('layouts.app')
@section('main')
    <div class="container">
        <section class="promo">
            <h1 class="promo-title">Онлайн-сервис <br/>доставки еды на дом</h1>
            <p class="promo-text">Получите ваш персональный промокод на скидку 20% при регистрации</p>
        </section>
        <section class="restaurants">
            <div class="section-heading">
                <h2 class="section-title">Рестораны</h2>
                <form class="search-form" id="search_form" action="{{ route('article_search') }}" method="post" role="search">
                    @csrf
                    <ul class="topmenu">
                        <li>
                            <input class="input input-search" placeholder="Введите название ресторана" type="text" id="search_field"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="search"
                                   autocomplete="off"
                                   oninput="autoPredictorFunction('{{ route('SearchOptions')}}'); hiddenList()"
                                   onclick="hiddenList()"
                                   value="{{ isset($characterSearch) ? $characterSearch : '' }}"/>
                            <ul class="submenu" id="search_field_list" aria-labelledby="search_field"></ul>
                        </li>
                    </ul>
                    <button type="submit" value="" class="search-btn"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <div class="cards">
                @foreach($restaurants as $restaurant)
                <div  class="card">
                    <img src="{{ asset('/storage/' . $restaurant->image)}}" alt="image" class="card-image">
                    <div class="card-text">
                        <div class="card-heading">
                            <a href="{{route('restaurant_dishes', ['restaurant_slug'=>$restaurant->slug])}}" class="card-title">
                                <h3 >{{$restaurant->name}}</h3>
                            </a>
                            <div class="card-tag tag" style="overflow: hidden">
                                @foreach($restaurant->cities as $city)
                                    <span>{{$city->name}}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-info">
                            <div class="category">
                                @foreach($restaurant->cuisines as $cuisine)
                                <span>{{$cuisine->name}}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="pages">{{$restaurants->links()}}</div>
        </section>
    </div>
@endsection
