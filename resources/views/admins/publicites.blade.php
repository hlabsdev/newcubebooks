@extends('layouts.header')

@section('css')
    <style>

        #autreCategorieInput {
            display: none;
        }

        @media(min-width: 1480px) {
            .side-bar-left {
                position: absolute;
                top: 60px;
                left: 15%;
                width: 16%;
                bottom: 0;
            }

            .side-bar-right {
                position: absolute;
                top: 60px;
                right: 15%;
                width: 16%;
            }

            .content-center {
                position: absolute;
                top: 60px;
                right: 31%;
                left: 31%;
                padding: 0 20px 20px 20px;
            }
        }

        #editCover {
            display: none;
        }
    </style>
@endsection

@section('content')
    
    <div class="Dosis">
        @include('included.menu_bar_gerant')
    </div>

    <div class="container-fluid white">
        <div class="row">
            <div class="col-12">
                <table class="w-100">
                    <tr>
                        <td>
                            <div class="pt-3 pb-3">
                                <a href="#!" data-toggle="modal" data-target="#modelPubliciteId">
                                    <i class="icofont-plus"></i>
                                    <b class="font-weight-bold">Créer une nouvelle publicité</b>
                                </a>
                            </div>
                        </td>
                        <td width="250">
                            <input type="search" name="search_q" id="search_q" placeholder="Rechercher ..." class="form-control">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" id="livresResult">
            @foreach (App\Publicite::orderByDesc('id')->get() as $store_produit)    
                <div class="col-lg-2">
                    <div class="card z-depth-0">
                        <div style="height: 130px; overflow: hidden;">
                            <img class="card-img-top" src="{{ URL::asset($store_produit->image) }}" alt="">
                        </div>
                        <a href="{{ route('adminCubeStoreDestroyPublicite', $store_produit->id) }}" class="btn btn-danger btn-md btn-block z-depth-0 rounded" onclick="return confirm('Êtes-vous sûre de vouloir supprimer cette publicité ?')">
                            <span class="white-text">Supprimer la publicite</span>
                        </a>
                    </div>
                </div>
                
            @endforeach
        </div><br />
    </div>

    <div class="modal fade" id="modelPubliciteId" tabindex="-1" role="dialog" aria-labelledby="modelTitlePubliciteId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Créer une nouvelle publicité</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('adminCubeStorePublicite') }}" method="post" enctype="multipart/form-data">
                        @csrf
    
                        <smal>Sélectionner une image</smal>
                        <input type="file" name="fichier" class="border border-dark w-100 mt-2 mb-2" required>
                        <br />
                        <button type="submit" class="btn btn-indigo rounded btn-md btn-block z-depth-0">
                            <span class="white-text">Créer la publicite</span>
                        </button>
    
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("js")
	<script>

        new FroalaEditor("#edit", {
            theme: 'royal'
        })

		$(document).ready(function () {

            $('#format3').click(function() {
                $('#editCover').slideToggle()
            })

            $('#categorieSelect').change(function () {
                if ($(this).val() == "autres") {
                    $('#autreCategorieInput').fadeIn();
                } else {
                    $('#autreCategorieInput').fadeOut();
                }
            });

            $('#search_q').keyup(function() {
                if ($(this).val() != "") {
                    $.ajax({
                        type : "GET",
                        url : "{{ route('getLivresAdminResultSearch') }}",
                        data : {'search_q' : $('#search_q').val()},
                        success : function(status) {
                            if (status != "") {
                                $('#livresResult').html(status);
                            }
                        }
                    });
                }
            })
		});
	</script>
@endsection