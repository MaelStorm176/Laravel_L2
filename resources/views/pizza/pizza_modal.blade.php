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
                <div class="modal-header bg-success">
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
                            <br/>
                            <input type="file" name="image" id="image" class="form-control" required style="width:300px; display: inline-block;" onchange="update_Photo();">
                            <input type="hidden" name="image_base" id="image_base">
                            <img id="image_affiche" src="images/img_seed/1.jpg" style="width:150;"/>
                            <br/> <br/>
                            <label>Nom de votre article</label>
                            <input type="text" name="nom_p" placeholder="Nom" id="nom_p" class="form-control" required>
                            <br/>
                            <label>Catégorie de votre article (Pizza, pâtes, dessert...)</label>
                            <select name="categorie" class="custom-select" id="categorie" required>
                                <option value="">-- Catégorie --</option>
                                <option value="pizza">Pizza</option>
                                <option value="pâtes">Pâtes</option>
                                <option value="dessert">Dessert</option>
                            </select>
                            <br/><br/>
                            <label>Description brève de l'article</label>
                            <textarea name="description_courte" id="description_courte" class="form-control" rows="3"></textarea>
                            <br/>
                            <label>Description détaillée de l'article</label>
                            <textarea name="description_longue" id="description_longue" class="form-control" rows="5"></textarea>
                            <br/>
                            <label>Prix (Euros €)</label>
                            <input type="number" name="prix_p" placeholder="Prix" id="prix_p" class="form-control" required>
                            <br/>
                            <input type="hidden" name="id_pizza" id="id_pizza">
                            <label>Disponibilité de votre article</label>
                            <select name="statut_p" class="custom-select" id="statut_p">
                                <option value="">-- Disponibilité --</option>
                                <option value="Disponible">Disponible</option>
                                <option value="Indisponible">Indisponible</option>
                            </select>
                        </div>
                        <br/>
                        <div>
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Sodium (mg)</th>
                                        <th scope="col">Fibres (g)</th>
                                        <th scope="col">Dont_satures (g)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="number" step="0.1" class="form-control" id="sodium" name="sodium" required></td>
                                        <td><input type="number" step="0.1" class="form-control" id="fibres" name="fibres" required></td>
                                        <td><input type="number" step="0.1" class="form-control" id="dont_satures" name="dont_satures" required></td>
                                    </tr>
                                </tbody>
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Lipides (g)</th>
                                        <th scope="col">Dont_sucres (g)</th>
                                        <th scope="col">Glucides (g)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="number" step="0.1" class="form-control" id="lipides" name="lipides" required></td>
                                        <td><input type="number" step="0.1" class="form-control" id="dont_sucres" name="dont_sucres" required></td>
                                        <td><input type="number" step="0.1" class="form-control" id="glucides" name="glucides" required></td>
                                    </tr>
                                </tbody>
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Proteines (g)</th>
                                    <th scope="col">Energies (kcal)</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="number" step="0.1" class="form-control" id="proteines" name="proteines" required></td>
                                        <td><input type="number" step="0.1" class="form-control" id="energies" name="energies" required></td>
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

