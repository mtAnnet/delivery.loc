@extends('layouts.app')
@section('main')
<div class="container">
    <section class="restaurants">
        <div class="section-heading">
            <h2 class="section-title">{{$restaurant->name}}</h2>
            <div class="card-info">
                <div class="price">
                    @foreach($restaurant->cities as $city)
                       <span> {{$city->name}}</span>
                    @endforeach
                </div>
                <div class="price">
                    Кухня
                    @foreach($restaurant->cuisines as $cuisine)
                        <span> {{$cuisine->name}}</span>
                    @endforeach
                </div>
                    <div class="rating">
                        @if(Auth::user())
                        <button id="btn-like" value="{{$restaurant->id}}" onclick="likeRestaurant({{$restaurant->id}})" class="like-button">
                            <img src="{{asset('img/thumb-up.svg')}}" alt="rating">
                            @else
                            <img src="{{asset('img/thumb-up.svg')}}" alt="rating">
                            @endif
                        </button>
                        <span class="likes" id="likes-count">{{$restaurant->like->count()}}</span>
                    </div>
            </div>
        </div>
        <div class="cards">
            @foreach($restaurant->dishes as $dish)
                <div class="card" id="card">
                    <img src="{{asset('/storage/' . $dish->image)}}" alt="image" class="card-image">
                    <div class="card-text">
                        <div class="card-heading">
                            <h3 class="card-title card-title-reg">{{$dish->name}}</h3>
                            <span class="card-tag tag">{{$dish->time_for_preparing}} min</span>
                        </div>
                        <div class="card-info">
                            <div class="ingredients">{{$dish->ingredients}}</div>
                        </div>
                        <div class="card-buttons">
                            <strong class="card-price-bold">{{$dish->price}} грн</strong>
                            <form action="{{ route('basket.add', ['id' => $dish->id]) }}" method="post">
                                @csrf
                                <button type="submit" class="button button-primary">
                                    <span class="button-card-text"></span>
                                    <img src="{{asset('img/basket2.svg')}}" alt="shopping-cart" class="button-card-image">
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
<script>
    var actionLike = '{{ route('actionLike')}}';
    var csrf = '{{ csrf_token() }}';
</script>


