<div id="myDIV">
    <table class="table table-hover table-bordered mb-3 text-center">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Détail de la commande</th>
                <th scope="col">Nom client</th>
                <th scope="col">Prix</th>
                <th scope="col">Statut Paiement</th>
                <th scope="col">Heure de la commande</th>
                <th scope="col">Heure de la fin de préparation</th>
                <th scope="col">Statut Préparation</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($products))
                @foreach ($products as $value)
                    @if($value->user_id == Auth::user()->id) <!-- Si on est le bon user -->
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->num_commande }}</td>
                            <td>{{ $value->user_email }}</td>
                            <td>{{ $value->prix_total }}</td>
                            <td>{{ $value->statut_pay }}</td>
                            <td>{{ $value->created_at }}</td>
                            <td>{{ $value->updated_at }}</td>
                            <td>{{ $value->statut_prepa }}</td>
                        </tr>
                    @endif
                @endforeach
            @endif
        </tbody>
    </table>
    @if(!empty($value))
        @if($value->user_id==Auth::user()->id)
            {!! $products->render() !!}
        @endif
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
