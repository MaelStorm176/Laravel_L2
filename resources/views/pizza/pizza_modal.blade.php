@auth
    @if(Auth::user()->id==1 && Auth::user()->username=="admin")
    <!-- Button trigger modal -->
    <button type="button" id="bouton_ajout" onclick="ajouter()" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModalCenter">
        Ajouter une pizza
    </button>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="overflow:scroll; height:750px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ajouter une pizza</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    <form action="{{ route('pizza.upload') }}" id="formu" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label>Image de votre article</label>
                            <input type="file" name="image" id="image" class="form-control">
                            </br>
                            <label>Nom de votre article</label>
                            <input type="text" name="nom_p" placeholder="Nom" id="nom_p" class="form-control">
                            </br>
                            <select name="categorie" id="categorie">
                                <option value="">-- Catégorie --</option>
                                <option value="pizza">Pizza</option>
                                <option value="pâtes">Pâtes</option>
                                <option value="dessert">Dessert</option>
                            </select>
                            </br>
                            <label>Description brève de l'article</label>
                            <textarea name="description_longue" id="description_courte" class="form-control" rows="3"></textarea>
                            </br>
                            <label>Description détaillée de l'article</label>
                            <textarea name="description_longue" id="description_longue" class="form-control" rows="5"></textarea>
                            </br>
                            <label>Prix (Euros €)</label>
                            <input type="number" name="prix_p" placeholder="Prix" id="prix_p" class="form-control">
                            </br>
                            <input type="hidden" name="id_pizza" id="id_pizza">
                            <select name="statut_p" id="pet-select">
                                <option value="">-- Disponibilité --</option>
                                <option value="Disponible">Disponible</option>
                                <option value="Indisponible">Indisponible</option>
                            </select>
                        </div>
                        </br>
                        <div>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Sodium</th>
                                    <th scope="col">Fibres</th>
                                    <th scope="col">Dont_satures</th>
                                    <th scope="col">Lipides</th>
                                    <th scope="col">Dont_sucres</th>
                                    <th scope="col">Glucides</th>
                                    <th scope="col">Proteines</th>
                                    <th scope="col">Energies</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>caca</td>
                                        <td>caca2</td>
                                        <td>cac3</td>
                                        <td>caca</td>
                                        <td>caca</td>
                                        <td>caca</td>
                                        <td>caca</td>
                                        <td>caca</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="upload" class="btn btn-primary">Upload</button>
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN DU MODAL -->
@endif
@endauth

