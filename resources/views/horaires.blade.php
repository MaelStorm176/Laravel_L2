@extends('layouts.base')
@section('content')

    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card bg-success text-white text-center p-3 font-weight-bold font-italic mb-3">
                    <h5 class="mb-0">NOS HORAIRES</h5>
                </div>
                <table class="table table-hover table-bordered mb-3 text-center">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col">Jours</th>
                            <th scope="col">Midi</th>
                            <th scope="col">Soir</th>
                            @auth
                                @if(Auth::user()->role == 'admin')
                                    <th scope="col">Action</th>
                                @endif
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($horaires as $key)
                        <tr>
                            <th class="bg-info text-white" scope="row">{{$key->jour}} </th>
                            <td id="{{$key->jour}}_midi" @if($key->midi == 'Fermé') class="bg-danger text-white" @else class="bg-success text-white" @endif>{{$key->midi}}</td>
                            <td id="{{$key->jour}}_soir" @if($key->soir == 'Fermé') class="bg-danger text-white" @else class="bg-success text-white" @endif>{{$key->soir}}</td>
                            @auth @if(Auth::user()->role == 'admin')<td class="bg-info text-white"><i class="fas fa-edit btn" id="bouton_ajout" onclick="modifier('{{$key->jour}}',{{$key->id}})" data-toggle="modal" data-target="#exampleModalCenterCode"></i></td>@endif @endauth
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    @auth
        @if(Auth::user()->role == 'admin')
            <!-- MODAL -->
            <div class="modal fade" id="exampleModalCenterCode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title" id="exampleModalLongTitleCode">Modifier un horaire</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('horaires.modif') }}" id="formucode" method="POST" enctype="multipart/form-data">
                                @csrf
                                <table class="table table-bordered text-center">
                                    <thead class="bg-primary text-white ">
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Midi</th>
                                        <th scope="col">Soir</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th id="jour_modif" class="bg-info text-white" scope="row"></th>
                                        <td><input name="midi_modif" id="midi_modif" class="form-control" placeholder="Entrez un horaire" required></td>
                                        <td><input name="soir_modif" id="soir_modif" class="form-control" placeholder="Entrez un horaire" required></td>
                                        <input name="id_modif" id="id_modif" type="hidden" value="">
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="submit" id="upload" class="btn btn-primary">Modifier</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth
@endsection

<script type="text/javascript">
function modifier(nom,id){
    $('#jour_modif').html(nom);
    $('#id_modif').val(id);
}
</script>
