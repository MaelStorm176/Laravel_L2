<button type="button"  class="btn btn-outline-primary" data-toggle="modal" onclick="myFunction()">
    Afficher historique des commandes 2
</button>
<div  id="myDIV" >
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Type pizza</th>
        <th scope="col">Nom client</th>
        <th scope="col">Prix</th>
        <th scope="col">Statut Paiement</th>
        <th scope="col">Heure de la commande</th>
        <th scope="col">Heure de la fin de préparation</th>
        <th scope="col">Statut Préparation</th>
    </tr>
    </thead>
    <tbody>
    <?php echo Auth::user()->name; ?>
    @foreach ($products as $value)
        @if($value->user_id==Auth::user()->id)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->nom_p }}</td>
                    <td>{{ $value->user_name }}</td>
                    <td>{{ $value->prix_p }}</td>
                    <td>{{ $value->statut_p }}</td>
                    <td>{{ $value->created_at }}</td>
                    <td>{{ $value->updated_at }}</td>
                    <td>{{ $value->statut_prepa }}</td>

                </tr>
            @else

        @endif
    @endforeach
    </tbody>
</table>
    @if($value->user_id==Auth::user()->id)
{!! $products->render() !!}
        @endif
</div>
<script>
    function myFunction() {
        var x = document.getElementById("myDIV");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>
