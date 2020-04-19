<link href="css/pizza.css" rel="stylesheet">
<!-- CAROUSEL -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style='width:50%'>
<ol class="carousel-indicators">
    <!-- {{$count = 0}} -->
    @foreach($pizza as $key)
        @if($count==0)
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        @else
        <li data-target="#carouselExampleIndicators" data-slide-to='.$count.'></li>
        @endif
        <!-- {{$count++}} -->
    @endforeach
</ol>
<div class="carousel-inner">
    {{$count = 0}}
    @foreach($pizza as $key){
        @if($count==0)
        <div class="carousel-item active">
            <a href="{{route("pizza_all")}}"> <img class="d-block w-100" src="{{$key->photo}}" alt="First slide"></a>
            <div class="carousel-caption d-none d-md-block">
                <h5>{{$key->nom}}</h5>
                <p>{{$key->description}}</p>
            </div>
        </div>
        @else
        <div class="carousel-item">
            <img class="d-block w-100" src="{{$key->photo}}" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>{{$key->nom}}</h5>
                <p>{{$key->description}}</p>
            </div>
        </div>
        @endif
        <!-- {{$count++}} -->
    @endforeach

    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>
</div>

<!-- FIN DU CAROUSEL -->
