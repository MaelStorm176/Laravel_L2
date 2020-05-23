@extends('layouts.base')
@section('content')

    <div class="container">
        <section class="row">
            <div class="col-12">
                <div class="card bg-one text-one text-center p-3 font-weight-bold font-italic mb-3">
                    <h5 class="mb-0">NOS ENGAGEMENTS</h5>
                </div>
            </div>
            <div class="col-12">
                <div class="row row-cols-1 row-cols-md-3">
                    @foreach($engagements as $key)
                    <div class="col mb-4">
                        <div class="card">
                            <div class="row justify-content-center">
                                <div class="col-8">
                                    <img src="{{$key->photo}}" class="card-img-top rounded-circle pt-3 w-100" style="height:10rem;" alt="">
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{$key->titre}}</h5>
                                <p class="card-text text-justify">{{$key->description_courte}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
