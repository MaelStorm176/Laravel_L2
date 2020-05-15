<?php
    use App\User;
$var = 1; ?>
@if($request['typeAction'] == 0)
    @foreach($commande as $key)
        <tr id="{{$key->id}}">
            <th scope="row">{{$var}}</th>
            <td><button class="btn btn-outline-primary" onclick="afficher({{$key->id_panier}})" data-toggle="modal" data-target="#commandesModal" >Afficher</button></td>
            <td>{{User::find($key->user_id)->email}}</td>
            <!-- EMAIL USER ici -->
            <td>{{$key->prix_total}} €</td>
            <td>{{$key->statut_pay}}</td>
            <td>{{$key->created_at}}</td>
            <td>{{$key->statut_prepa}}<a class="" onclick="valider({{$key->id}})" style="float:right;margin-right:1em;cursor:pointer;"><i class="far fa-check-square"></i></a></td>
        </tr>
        <?php $var++; ?>
    @endforeach
@elseif($request['typeAction'] == 1 && is_numeric($request['idaffiche']) && $request['idaffiche']>0)
    <table class="table table-hover table-bordered mb-3 text-center">
        <thead class="bg-primary text-white">
            <tr>
                <th> Article </th>
                <th> Quantite </th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $key2)
            <tr>
                <td>{{$key2->nom}}</td>
                <td>{{$key2->quantite}}</td>
            </tr>
            @endforeach
            @foreach($menu as $key3)
                <tr>
                    <td>{{$key3->nom}}</td>
                    <td>{{$key3->quantite}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
