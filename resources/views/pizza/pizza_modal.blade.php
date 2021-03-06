<!-- Modal -->
<!-- MODAL AJOUT ARTICLES -->
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
                        <small><i>(Selectionnez une image aux dimensions carrées, ex : 200 x 200)</i></small>
                        <br/>
                        <input type="file" name="image" id="image" class="form-control" required style="width:300px; display: inline-block;" onchange="update_Photo();">
                        <input type="hidden" name="image_base" id="image_base">
                        <img id="image_affiche" src="{{asset('images/img_seed/1.jpg')}}" style="width:150;"/>
                        <br/> <br/>
                        <label>Nom de votre article</label>
                        <input type="text" name="nom_p" placeholder="Nom" id="nom_p" class="form-control" required>
                        <br/>
                        <label>Catégorie de votre article (Pizza, pâtes, dessert...)</label>
                        <select name="categorie" class="custom-select" id="categorie" required>
                            <option value="">>-- Choisissez une catégorie --<</option>
                            @foreach($categorie as $cate)
                                <option value="{{$cate->nom}}">{{$cate->nom}}</option>
                            @endforeach
                        </select>
                        <br/><br/>
                        <label>Description brève de l'article</label>
                        <small><i>(Optionnel)</i></small>
                        <textarea name="description_courte" id="description_courte" class="form-control" rows="3"></textarea>
                        <br/>
                        <label>Description détaillée de l'article</label>
                        <small><i>(Optionnel)</i></small>
                        <textarea name="description_longue" id="description_longue" class="form-control" rows="5"></textarea>
                        <br/>
                        <label>Prix (Euros €)</label>
                        <input type="number" step="0.01" name="prix_p" placeholder="Prix" id="prix_p" class="form-control" required>
                        <br/>
                        <input type="hidden" name="id_pizza" id="id_pizza">
                        <label>Disponibilité de votre article</label>
                        <select name="statut_p" class="custom-select" id="statut_p">
                            <option value="">>-- Disponibilité --<</option>
                            <option value="Disponible">Disponible</option>
                            <option value="Indisponible">Indisponible</option>
                        </select>
                    </div>
                    <br/>
                    <div>
                        <label>Valeurs nutritionnelles</label>
                        <small><i>(Optionnel)</i></small>
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
                                <td><input type="number" step="0.1" class="form-control" id="sodium" name="sodium" min="0" ></td>
                                <td><input type="number" step="0.1" class="form-control" id="fibres" name="fibres" min="0" ></td>
                                <td><input type="number" step="0.1" class="form-control" id="dont_satures" name="dont_satures" min="0" ></td>
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
                                <td><input type="number" step="0.1" class="form-control" id="lipides" name="lipides" min="0" ></td>
                                <td><input type="number" step="0.1" class="form-control" id="dont_sucres" name="dont_sucres" min="0" ></td>
                                <td><input type="number" step="0.1" class="form-control" id="glucides" name="glucides" min="0" ></td>
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
                                <td><input type="number" step="0.1" class="form-control" id="proteines" name="proteines" min="0" ></td>
                                <td><input type="number" step="0.1" class="form-control" id="energies" name="energies" min="0" ></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" id="upload" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- CODE MODAL -->
<div class="modal fade" id="exampleModalCenterCode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitleCode">Ajouter un code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('code.upload') }}" id="formucode" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label id="remise_label">Remise que le code applique sur la commande (en %)</label>
                        <input type="text" name="remise" placeholder="Remise" id="remise" class="form-control" required>
                        </br>
                        <label id="date_label">Date limite du code</label>
                        <input type="date" name="date_limite" id="date_limite">
                        </br>
                        <input type="hidden" name="id_code" id="id_code">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" id="upload" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- FIN DU MODAL -->
    <div class="modal fade" id="MenuModal" tabindex="-1" role="dialog" aria-labelledby="MenuModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="overflow:scroll; height:750px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="MenuModalLongTitle">Création d'un menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('menu.upload') }}" id="formulaire_menu" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label>Nom du menu</label>
                            <input type="text" name="nom_m" placeholder="Nom" id="nom_m" class="form-control" required>
                            <br/>

                            <label>Contenu du menu</label>
                            <ul>
                            @foreach($categorie as $cate)
                                <li>
                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                        <input type="checkbox" name="categorie" class="custom-control-input" id="check_box_{{$cate->nom}}" value="{{$cate->nom}}">
                                        <label class="custom-control-label" for="check_box_{{$cate->nom}}">{{$cate->nom}}</label>
                                    </div>
                                </li>
                                <ul>
                                    <li>
                                        <div id="aff_{{$cate->nom}}">

                                        </div>
                                    </li>
                                </ul>
                            @endforeach
                            </ul>
                            <br/>

                            <label>Description détaillée du menu</label>
                            <small><i>(Optionnel)</i></small>
                            <textarea name="description_m" id="description_m" class="form-control" rows="5"></textarea>
                            <br/>

                            <label>Prix (Euros €)</label>
                            <input type="number" step="0.01" name="prix_m" placeholder="Prix" id="prix_m" class="form-control" required>
                            <br/>
                            <label>Disponibilité de votre menu</label>
                            <select name="statut_m" class="custom-select" id="statut_m">
                                <option value="">>-- Disponibilité --<</option>
                                <option value="Disponible">Disponible</option>
                                <option value="Indisponible">Indisponible</option>
                            </select>
                            <input type="hidden" name="id_menu" id="id_menu">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" id="upload_menu" class="btn btn-primary">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN DU MODAL -->

