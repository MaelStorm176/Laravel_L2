@extends('layouts.base')
@section('content')
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
}
else{
    $array=[];
}

?>
@guest
    <h3>Vous devez être connecté</h3>
@endguest
@auth
<form method="GET" action="#">
    <select name="jour" onchange="this.form.submit();">
        <option>Choisir un jour</option>
        @foreach($global2 as $key)
            <option value="{{$key->jour}}">{{$key->jour}}</option>
        @endforeach
    </select>
</form>
<form action="{{route('creneaux.reserver')}}" method="GET">
    <table>
        <tbody>
        <h1>{{$jour}}</h1>
        <h3>Midi</h3>
        @if($deb_matin=="Fe")
            <td>
                <input type="radio" name="size"  value="small" disabled/>
                <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="">Matin Fermé</label>
            </td>
        @elseif($fin_matin=="Fe")
            <td>
                <input type="radio" name="size"  value="small" disabled/>
                <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="">Matin Fermé</label>
            </td>
        @else
            @for($i=$deb_matin;$i<$fin_matin+1;$i++)
                <tr>

                    @if($deb_matin1=='0')
                        @for($j=0;$j<4;$j=$j+3)
                            @if($fin_matin==$i && ($j=='3' || $j=='0' ))
                                @if($fin_matin1=='30')
                                    @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array2[$i.' H '.$j.'0'] == $array3[$i.' H '.$j.'0']))
                                        @if($j==0)
                                            <td>
                                                <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @else
                                            <td>
                                                <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled />
                                                <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @endif
                                    @else
                                        @if($j==0)
                                            <td>
                                                <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @else
                                            <td>
                                                <input type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0" />
                                                <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @endif
                                    @endif
                                @else
                                    @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array2[$i.' H '.$j.'0'] == $array3[$i.' H '.$j.'0']))
                                        @if($j==0)
                                            <td>
                                                <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @else

                                        @endif
                                    @else
                                        @if($j==0)
                                            <td>
                                                <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @else

                                        @endif
                                    @endif
                                @endif
                            @else
                                @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array2[$i.' H '.$j.'0'] == $array3[$i.' H '.$j.'0']))
                                    @if($j==0)
                                        <td>
                                            <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                            <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                        </td>
                                    @else
                                        <td>
                                            <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled />
                                            <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                        </td>
                                    @endif
                                @else
                                    @if($j==0)
                                        <td>
                                            <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                            <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                        </td>
                                    @else
                                        <td>
                                            <input type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0" />
                                            <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                        </td>
                                    @endif
                                @endif
                            @endif
                        @endfor
                </tr>
                @else
                    @for($j=0;$j<4;$j=$j+3)
                        @if($deb_matin==$i && ($j=='3' || $j=='0' ))
                            @if($deb_matin1=='30')
                                @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array2[$i.' H '.$j.'0'] == $array3[$i.' H '.$j.'0']))
                                    @if($j==0)
                                        <!--<td>
                                            <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                            <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                        </td>-->
                                    @else
                                        <td>
                                            <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled />
                                            <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                        </td>
                                    @endif
                                @else
                                    @if($j==0)
                                        <!--
                                        <td>
                                            <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                            <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>

                                        </td>-->
                                    @else
                                        <td>
                                            <input type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0" />
                                            <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                        </td>
                                    @endif
                                @endif
                            @else
                                @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array2[$i.' H '.$j.'0'] == $array3[$i.' H '.$j.'0']))
                                    @if($j==0)
                                        <td>
                                            <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                            <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                        </td>
                                    @else

                                    @endif
                                @else
                                    @if($j==0)
                                        <td>
                                            <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                            <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                        </td>
                                    @else

                                    @endif
                                @endif
                            @endif
                        @elseif($fin_matin == $i)
                            @if($fin_matin==$i && ($j=='3' || $j=='0' ))
                                @if($fin_matin1=='0')
                                    @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array2[$i.' H '.$j.'0'] == $array3[$i.' H '.$j.'0']))
                                        @if($j==0)
                                            <td>
                                                <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @else
                                        @endif
                                    @else
                                        @if($j==0)

                                        <td>
                                            <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                            <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>

                                        </td>
                                        @else
                                        @endif
                                    @endif
                                @else
                                    @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array2[$i.' H '.$j.'0'] == $array3[$i.' H '.$j.'0']))
                                        @if($j==0)
                                            <td>
                                                <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @else
                                            <td>
                                                <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled />
                                                <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @endif
                                    @else
                                        @if($j==0)
                                            <td>
                                                <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @else
                                            <td>
                                                <input type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0" />
                                                <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @endif
                                    @endif
                                @endif
                                @endif
                        @else
                            @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array2[$i.' H '.$j.'0'] == $array3[$i.' H '.$j.'0']))
                                @if($j==0)
                                    <td>
                                        <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                        <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                    </td>
                                @else
                                    <td>
                                        <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled />
                                        <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                    </td>
                                @endif
                            @else
                                @if($j==0)
                                    <td>
                                        <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                        <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                    </td>
                                @else
                                    <td>
                                        <input type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0" />
                                        <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                    </td>
                                @endif
                            @endif
                        @endif

                    @endfor
                @endif
            @endfor
        @endif

        </tbody>
    </table>
    <table>
        <tbody>
        <h3>Soir</h3>
        @if($deb_soir=="Fe")
            <td>
                <input type="radio" name="size"  value="small" disabled/>
                <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="">Soir Fermé</label>
            </td>
        @elseif($fin_soir=="Fe")
            <td>
                <input type="radio" name="size"  value="small" disabled/>
                <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="">Soir Fermé</label>
            </td>
        @else
            @for($i=$deb_soir;$i<$fin_soir+1;$i++)
                <tr>
                    @if($deb_soir1=='0')
                        @for($j=0;$j<4;$j=$j+3)
                            @if($fin_soir==$i && ($j=='3' || $j=='0' ))
                                @if($fin_soir1=='30')
                                    @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array4[$i.' H '.$j.'0'] == $array5[$i.' H '.$j.'0']))
                                        @if($j==0)
                                            <td>
                                                <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @else
                                            <td>
                                                <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled />
                                                <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @endif
                                    @else
                                        @if($j==0)
                                            <td>
                                                <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @else
                                            <td>
                                                <input type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0" />
                                                <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @endif
                                    @endif
                                @else
                                    @if(isset($array) && in_array($i.' H '.$j.'0',$array))
                                        @if($j==0)
                                            <td>
                                                <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @else

                                        @endif
                                    @else
                                        @if($j==0)
                                            <td>
                                                <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @else

                                        @endif
                                    @endif
                                @endif
                            @else
                                @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array4[$i.' H '.$j.'0'] == $array5[$i.' H '.$j.'0']))
                                    @if($j==0)
                                        <td>
                                            <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                            <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                        </td>
                                    @else
                                        <td>
                                            <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled />
                                            <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                        </td>
                                    @endif
                                @else
                                    @if($j==0)
                                        <td>
                                            <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                            <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                        </td>
                                    @else
                                        <td>
                                            <input type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0" />
                                            <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                        </td>
                                    @endif
                                @endif
                            @endif
                        @endfor
                </tr>
                @else
                    @for($j=0;$j<4;$j=$j+3)
                        @if($deb_soir==$i && ($j=='3' || $j=='0' ))
                            @if($deb_soir1=='30')
                                @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array4[$i.' H '.$j.'0'] == $array5[$i.' H '.$j.'0']))
                                    @if($j==0)
                                        <!--<td>
                                            <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                            <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                        </td>-->
                                    @else
                                        <td>
                                            <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled />
                                            <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                        </td>
                                    @endif
                                @else
                                    @if($j==0)
                                        <!--
                                        <td>
                                            <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                            <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>

                                        </td>-->
                                    @else
                                        <td>
                                            <input type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0" />
                                            <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                        </td>
                                    @endif
                                @endif
                            @else
                                @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array4[$i.' H '.$j.'0'] == $array5[$i.' H '.$j.'0']))
                                    @if($j==0)
                                        <td>
                                            <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                            <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                        </td>
                                    @else

                                    @endif
                                @else
                                    @if($j==0)
                                        <td>
                                            <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                            <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                        </td>
                                    @else

                                    @endif
                                @endif
                            @endif
                        @elseif($fin_soir == $i)
                            @if($fin_soir==$i && ($j=='3' || $j=='0' ))
                                @if($fin_soir1=='0')
                                    @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array4[$i.' H '.$j.'0'] == $array5[$i.' H '.$j.'0']))
                                        @if($j==0)
                                            <td>
                                                <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @else
                                        @endif
                                    @else
                                        @if($j==0)

                                            <td>
                                                <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>

                                            </td>
                                        @else
                                        @endif
                                    @endif
                                @else
                                    @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array4[$i.' H '.$j.'0'] == $array5[$i.' H '.$j.'0']))
                                        @if($j==0)
                                            <td>
                                                <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                                <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @else
                                            <td>
                                                <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled />
                                                <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @endif
                                    @else
                                        @if($j==0)
                                            <td>
                                                <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                                <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @else
                                            <td>
                                                <input type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0" />
                                                <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                            </td>
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @else
                            @if(isset($array) && in_array($i.' H '.$j.'0',$array) && ($array4[$i.' H '.$j.'0'] == $array5[$i.' H '.$j.'0']))
                                @if($j==0)
                                    <td>
                                        <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled/>
                                        <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                    </td>
                                @else
                                    <td>
                                        <input type="radio" name="size" id="size_{{$i}}_{{$j}}0" value="small" disabled />
                                        <label style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);" for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                    </td>
                                @endif
                            @else
                                @if($j==0)
                                    <td>
                                        <input  type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0"/>
                                        <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                    </td>
                                @else
                                    <td>
                                        <input type="radio" name="creneaux" id="size_{{$i}}_{{$j}}0" value="{{$i}} H {{$j}}0" />
                                        <label for="size_{{$i}}_{{$j}}0">{{$i}} H {{$j}}0</label>
                                    </td>
                                @endif
                            @endif
                        @endif

                    @endfor
                @endif
            @endfor
        @endif
        </tbody>
    </table>
    <button type="submit">Réserver ce créneau</button>
    <input type="hidden" name="jour" value="{{$jour}}">
</form>
@endauth
@endsection
