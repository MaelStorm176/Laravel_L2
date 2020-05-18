@extends('layouts.adm')
@section('titre')
    CODE PROMOTIONELS<span class="fas fa-gift mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Générer un code supplémentaire<span class="fas fa-plus-circle mt-1 float-right"></span></div>
                    <div class="card-body">
                        <form action="{{ route('code.upload') }}" id="formucode" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_code" id="id_code">
                            <section class="row">
                                <div class="col-lg-6 mb-4">
                                    <label for="remise">Remise en %</label>
                                    <input type="text" name="remise" placeholder="Remise" id="remise" class="form-control" required>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="date_limite">Date de fin</label>
                                    <input type="date" name="date_limite" id="date_limite" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary text-white w-100">GENERER</button>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Codes promotionels actifs<span class="fas fa-bars mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-3 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="align-middle" scope="col">CODE</th>
                                    <th class="align-middle" scope="col">REMISE</th>
                                    <th class="align-middle" scope="col">DATE DE FIN</th>
                                    <th class="align-middle" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($coupons as $coupon)
                                <tr id="{{$coupon->id}}">
                                    <td class="align-middle">{{$coupon->code}}</td>
                                    <td class="align-middle">{{$coupon->remise}}%</td>
                                    <td class="align-middle">{{$coupon->date_limite}}</td>
                                    <td class="align-middle" onclick="supprimer({{$coupon->id}})"><span class="fas fa-trash-alt btn"></span></td>
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
    function supprimer(id){
        var dummy = Date.now();
        $.ajax({
            url :'{{route('code.supprimer')}}',
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
