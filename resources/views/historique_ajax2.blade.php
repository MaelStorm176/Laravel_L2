<?php
    use App\User;
$var = 1; ?>
@if($request['typeAction'] == 0)
    @foreach($commande as $key)
        <tr id="{{$key->id}}">
            <th class="align-middle" scope="row">{{$var}}</th>
            <td class="align-middle"><button class="btn btn-outline-primary" onclick="afficher({{$key->id_panier}})" data-toggle="modal" data-target="#commandesModal" >Afficher</button></td>
            <td class="align-middle">{{User::find($key->user_id)->email}}</td>
            <!-- EMAIL USER ici -->
            <td class="align-middle">{{$key->prix_total}} €</td>
            <td class="align-middle">{{$key->statut_pay}}</td>
            <td class="align-middle">{{$key->created_at}}</td>
            <td class="align-middle">{{$key->statut_prepa}}</td>
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
