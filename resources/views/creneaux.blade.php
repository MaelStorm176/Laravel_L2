@extends('layouts.base')
<style>

    input[type="radio"]{
        visibility: hidden;
        height: 0;
        width: 0;
    }

    label {
        display: table-cell;
        vertical-align: middle;
        text-align: center;
        cursor: pointer;
        background-color: #454545;
        color: white;
        padding: 5px 10px;
        border-radius: 3px;
    .transition;
    }
    input[type="radio"]:checked + label{
        background-color: #40E7D0;
    }


</style>
@section('content')
    <?php use App\User; ?>
    <?php
        if(!empty($creneau_get)){
            $var=0;
            foreach ($creneau_get as $key){
                $array[]= $key->creneaux;
                $array2[$array[$var]] = $key->livreur_matin;
                $array4[$array[$var]] = $key->livreur_soir;

                if (!isset($creneau_livreur_matin)){
                    $creneau_livreur_matin =0;
                }
                if(!isset($creneau_livreur_soir)){
                    $creneau_livreur_soir=0;
                }
                
                $array3[$array[$var]] = $creneau_livreur_matin;
                $array5[$array[$var]] = $creneau_livreur_soir;
                $var++;
            }
            //print_r($array2);echo '<br>';
        } else { 
            $array=[];
        }
    ?>
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-one mb-3">
                    <div class="card-header bg-one text-one">
                        RESERVER UNE TABLE<span class="fas fa-calendar-plus mt-1 float-right"></span>
                    </div>
                    <form method="GET" class="w-100 bg-two" action="#">
                        <select name="jour" class="form-control rounded-0 bg-two text-two border-two" onchange="this.form.submit();">
                            <option>Choisir un jour</option>
                            @foreach($global2 as $key)
                                <option value="{{$key->jour}}">{{$key->jour}}</option>
                            @endforeach
                        </select> 
                    </form>
                    <div class="card-body py-0">
                        @guest
                            <h3>Vous devez être connecté</h3>
                        @endguest
                        @auth
                            <section class="row">
                                <div class="col-12">
                                    <div class="card text-center rounded-0 bg-one text-one border-dark p-2">
                                        <h1 class="mb-0">{{$jour}}@if($jour == "") Jour @endif</h1>
                                    </div> 
                                </div>
                                    <div class="col-6">
                                    <form action="{{route('creneaux.reserver')}}" method="GET" class="w-100">
                                        <section class="row">
                                            <div class="col-12 pr-0">
                                                <div class="card text-center rounded-0 mb-3 bg-two text-two border-dark p-2"><h3 class="mb-0">Midi</h3></div>
                                            </div>
                                            @if($deb_matin=="Fe")
                                                <div class="col-12">
                                                    <input type="radio" name="size"  value="small" disabled/>
                                                    <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="">Matin Fermé</label>
                                                </div>
                                            @elseif($fin_matin=="Fe")
                                                <div class="col-12">
                                                    <input type="radio" name="size"  value="small" disabled/>
                                                    <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="">Matin Fermé</label>
                                                </div>
                                            @else
                                                @for($i=$deb_matin;$i<$fin_matin+1;$i++)
                                                    @if($deb_matin1=='0')
                                                        @for($j=0;$j<4;$j=$j+3)
                                                            @if($fin_matin==$i && ($j=='3' || $j=='0' ))
                                                                    @if($fin_matin1=='30')
                                                                        @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array2[$i.' H '.$j.'0'] == $array3[$i.' H '.$j.'0']))
                                                                            @if($j==0)
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                                                    <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @else
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled />
                                                                                    <label class="w-100"  style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @endif
                                                                        @else
                                                                            @if($j==0)
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                                                    <label class="w-100"  for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @else
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0" />
                                                                                    <label class="w-100" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array2[$i.' H '.$j.'0'] == $array3[$i.' H '.$j.'0']))
                                                                            @if($j==0)
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                                                    <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @else
                                                                            @endif
                                                                        @else
                                                                            @if($j==0)
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                                                    <label class="w-100" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @else
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array2[$i.' H '.$j.'0'] == $array3[$i.' H '.$j.'0']))
                                                                        @if($j==0)
                                                                            <div class="col-md-6 col-lg-3">
                                                                                <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                                                <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                            </div>
                                                                        @else
                                                                            <div class="col-md-6 col-lg-3">
                                                                                <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled />
                                                                                <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                            </div>
                                                                        @endif
                                                                    @else
                                                                        @if($j==0)
                                                                            <div class="col-md-6 col-lg-3">
                                                                                <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                                                <label class="w-100" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                            </div>
                                                                        @else
                                                                            <div class="col-md-6 col-lg-3">
                                                                                <input type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0" />
                                                                                <label class="w-100" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endfor
                                                        @else
                                                            @for($j=0;$j<4;$j=$j+3)
                                                                @if($deb_matin==$i && ($j=='3' || $j=='0' ))
                                                                    @if($deb_matin1=='30')
                                                                        @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array2[$i.' H '.$j.'0'] == $array3[$i.' H '.$j.'0']))
                                                                            @if($j==0)
                                                                                <!--<div class="col-md-6 col-lg-3">
                                                                                    <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                                                    <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>-->
                                                                            @else
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled />
                                                                                    <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @endif
                                                                        @else
                                                                            @if($j==0)
                                                                            <!--
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                                                    <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            -->
                                                                        @else
                                                                            <div class="col-md-6 col-lg-3">
                                                                                <input type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0" />
                                                                                <label class="w-100" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array2[$i.' H '.$j.'0'] == $array3[$i.' H '.$j.'0']))
                                                                        @if($j==0)
                                                                            <div class="col-md-6 col-lg-3">
                                                                                <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                                                <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                            </div>
                                                                        @else
                                                                        @endif
                                                                    @else
                                                                        @if($j==0)
                                                                            <div class="col-md-6 col-lg-3">
                                                                                <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                                                <label class="w-100" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                            </div>
                                                                        @else
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @elseif($fin_matin == $i)
                                                                @if($fin_matin==$i && ($j=='3' || $j=='0' ))
                                                                    @if($fin_matin1=='0')
                                                                        @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array2[$i.' H '.$j.'0'] == $array3[$i.' H '.$j.'0']))
                                                                            @if($j==0)
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                                                    <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @else
                                                                            @endif
                                                                        @else
                                                                            @if($j==0)
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                                                    <label class="w-100" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @else
                                                                            @endif
                                                                       @endif
                                                                    @else
                                                                        @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array2[$i.' H '.$j.'0'] == $array3[$i.' H '.$j.'0']))
                                                                            @if($j==0)
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                                                    <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @else
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled />
                                                                                    <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @endif
                                                                        @else
                                                                            @if($j==0)
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                                                    <label class="w-100" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @else
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0" />
                                                                                    <label class="w-100" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @else
                                                                @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array2[$i.' H '.$j.'0'] == $array3[$i.' H '.$j.'0']))
                                                                    @if($j==0)
                                                                        <div class="col-md-6 col-lg-3">
                                                                            <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                                            <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                        </div>
                                                                    @else
                                                                        <div class="col-md-6 col-lg-3">
                                                                            <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled />
                                                                            <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                    @if($j==0)
                                                                        <div class="col-md-6 col-lg-3">
                                                                            <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                                            <label class="w-100"  for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                        </div>
                                                                    @else
                                                                        <div class="col-md-6 col-lg-3">
                                                                            <input type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0" />
                                                                            <label class="w-100"  for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endfor
                                                    @endif
                                                @endfor
                                            @endif
                                        </section>
                                    </div>
                                    <div class="col-6">
                                        <section class="row">
                                            <div class="col-12 pl-0">
                                                <div class="card text-center rounded-0 bg-two text-two border-dark mb-3 p-2"><h3 class="mb-0">Soir</h3></div>
                                            </div>
                                                @if($deb_soir=="Fe")
                                                    <div class="col-12">
                                                        <input type="radio" name="size"  value="small" disabled/>
                                                        <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="">Soir Fermé</label>
                                                    </div>
                                                @elseif($fin_soir=="Fe")
                                                    <div class="col-12">
                                                        <input type="radio" name="size"  value="small" disabled/>
                                                        <label class="w-100"  style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="">Soir Fermé</label>
                                                    </div>
                                                @else
                                                    @for($i=$deb_soir;$i<$fin_soir+1;$i++)
                                                        @if($deb_soir1=='0')
                                                            @for($j=0;$j<4;$j=$j+3)
                                                                @if($fin_soir==$i && ($j=='3' || $j=='0' ))
                                                                    @if($fin_soir1=='30')
                                                                        @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array4[$i.' H '.$j.'0'] == $array5[$i.' H '.$j.'0']))
                                                                            @if($j==0)
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                                                    <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @else
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled />
                                                                                    <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @endif
                                                                        @else
                                                                            @if($j==0)
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                                                    <label class="w-100" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @else
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0" />
                                                                                    <label class="w-100" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if(isset($array) && in_array($i.' H '.$j.'0',$array))
                                                                            @if($j==0)
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                                                    <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @else
                                                                            @endif
                                                                        @else
                                                                            @if($j==0)
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                                                    <label class="w-100" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @else
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array4[$i.' H '.$j.'0'] == $array5[$i.' H '.$j.'0']))
                                                                        @if($j==0)
                                                                            <div class="col-md-6 col-lg-3">
                                                                                <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                                                <label class="w-100"  style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                            </div>
                                                                        @else
                                                                            <div class="col-md-6 col-lg-3">
                                                                                <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled />
                                                                                <label class="w-100"  style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                            </div>
                                                                        @endif
                                                                    @else
                                                                        @if($j==0)
                                                                            <div class="col-md-6 col-lg-3">
                                                                                <input type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                                                <label class="w-100" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                            </div>
                                                                        @else
                                                                            <div class="col-md-6 col-lg-3">
                                                                                <input type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0" />
                                                                                <label class="w-100" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endfor
                                                        @else
                                                            @for($j=0;$j<4;$j=$j+3)
                                                                @if($deb_soir==$i && ($j=='3' || $j=='0' ))
                                                                    @if($deb_soir1=='30')
                                                                        @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array4[$i.' H '.$j.'0'] == $array5[$i.' H '.$j.'0']))
                                                                            @if($j==0)
                                                                                <!--<div class="col-md-6 col-lg-3">
                                                                                    <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                                                    <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>-->
                                                                            @else
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled />
                                                                                    <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @endif
                                                                        @else
                                                                            @if($j==0)
                                                                                <!--
                                                                                    <div class="col-md-6 col-lg-3">
                                                                                        <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                                                        <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                    </div>
                                                                                -->
                                                                            @else
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0" />
                                                                                    <label class="w-100" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array4[$i.' H '.$j.'0'] == $array5[$i.' H '.$j.'0']))
                                                                            @if($j==0)
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                                                    <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @else
                                                                            @endif
                                                                        @else
                                                                            @if($j==0)
                                                                                <div class="col-md-6 col-lg-3">
                                                                                    <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                                                    <label class="w-100"  for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                </div>
                                                                            @else
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @elseif($fin_soir == $i)
                                                                    @if($fin_soir==$i && ($j=='3' || $j=='0' ))
                                                                        @if($fin_soir1=='0')
                                                                            @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array4[$i.' H '.$j.'0'] == $array5[$i.' H '.$j.'0']))
                                                                                @if($j==0)
                                                                                    <div class="col-md-6 col-lg-3">
                                                                                        <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                                                        <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                    </div>
                                                                                @else
                                                                                @endif
                                                                            @else
                                                                                @if($j==0)
                                                                                    <div class="col-md-6 col-lg-3">
                                                                                        <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                                                        <label class="w-100" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                    </div>
                                                                                @else
                                                                                @endif
                                                                            @endif
                                                                        @else
                                                                            @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array4[$i.' H '.$j.'0'] == $array5[$i.' H '.$j.'0']))
                                                                                @if($j==0)
                                                                                    <div class="col-md-6 col-lg-3">
                                                                                        <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                                                        <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="col-md-6 col-lg-3">
                                                                                        <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled />
                                                                                        <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                    </div>
                                                                                @endif
                                                                            @else
                                                                                @if($j==0)
                                                                                    <div class="col-md-6 col-lg-3">
                                                                                        <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                                                        <label class="w-100" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="col-md-6 col-lg-3">
                                                                                        <input type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0" />
                                                                                        <label class="w-100" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                                    </div>
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array4[$i.' H '.$j.'0'] == $array5[$i.' H '.$j.'0']))
                                                                        @if($j==0)
                                                                            <div class="col-md-6 col-lg-3">
                                                                                <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                                                <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                            </div>
                                                                        @else
                                                                            <div class="col-md-6 col-lg-3">
                                                                                <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled />
                                                                                <label class="w-100" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                            </div>
                                                                        @endif
                                                                    @else
                                                                        @if($j==0)
                                                                            <div class="col-md-6 col-lg-3">
                                                                                <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                                                <label class="w-100" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                            </div>
                                                                        @else
                                                                            <div class="col-md-6 col-lg-3">
                                                                                <input type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0" />
                                                                                <label class="w-100" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endfor
                                                        @endif
                                                    
                                                    @endfor
                                                @endif
                                            
                                        </section>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <button class="btn btn-one w-100" type="submit">Réserver ce créneau</button>
                                    </div>
                                <input type="hidden" name="jour" value="{{$jour}}">
                                </form>
                        @endauth
                    </div>
                    </section>
                </div>
            </div>
            <div class="container">
                <div class="card border-one w-100 mb-3">
                    <div class="card-header bg-one text-one">
                        MES RERSERVATION A VENIR<span class="fas fa-calendar-check mt-1 float-right"></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-0 text-center">
                            <thead class="bg-tab text-tab">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Midi</th>
                                <th scope="col">Soir</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($table_creneaux as $key)
                                <?php
                                    $test = substr($key->creneaux,-7,2);
                                ?>
                                <tr id="{{$key->id}}">
                                    <th class="align-middle" scope="row">{{$key->jour}}</th>
                                    @if($test < 16)
                                        <td class="align-middle" id="{{$key->jour}}_midi">{{$key->creneaux}}</td>
                                        <td class="align-middle" id="{{$key->jour}}_soir" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);">x</td>
                                    @else
                                        <td class="align-middle" id="{{$key->jour}}_midi" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);">x</td>
                                        <td class="align-middle" id="{{$key->jour}}_soir">{{$key->creneaux}}</td>
                                    @endif
                                    <td id="{{$key->jour}}_soir"><span class="fas fa-trash-alt btn" onclick="supprimer({{$key->id}})"></span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
<script>
    function supprimer(id) {
        var dummy = Date.now();
        $.ajax({
            url : 'supprimer_reservation',
            type : 'GET',
            dataType : 'html',
            data : {dummy:dummy, id:id},
            success : function(code_html, statut){
                $('tr[id="'+id+'"]').remove();
            },

            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },
        });
    }
</script>
