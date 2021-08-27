
<?php
use App\Models\Auteur;
use App\Models\CodeEmail;
use App\Models\Commentaire;
use App\Models\Contact;
use App\Models\Gerant;
use App\Models\LivreNotification;
use App\Models\Manuscrit;
use App\Models\Message;
use App\Models\Pays;
use App\Models\Publication;
use App\Models\Publicite;
use App\Models\ReponseCommentaire;
use App\Models\StoreProduit;
use App\Models\User;
?>

@extends('layouts.header')

@section('css')

    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.2"></script>

    <style>

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
    </style>
@endsection

@section('meta')
    @foreach (StoreProduit::where('nom', $nom)->get() as $store_produit)
        <meta name="description" content="CUBE BOOKS | {{ $store_produit->nom }}">
        <meta property="og:image" content="{{ URL::asset($store_produit->fichier) }}">
    @endforeach
@endsection

@section('content')

    @if (isset($_COOKIE['gerant_id']))
        <div class="Dosis">
            @include('included.menu_bar_gerant')
        </div>
    @else

        @if (isset($_COOKIE['id']))
            @include('included.menu_bar_users')
            <br /><br />
        @else
            @include('included.menu_bar')
            <br /><br />
        @endif

    @endif

    <br /><br />
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                @foreach (StoreProduit::where('id', $id)->get() as $store_produit)
                    <img width="100%" src="{{ URL::asset($store_produit->fichier) }}" alt="">
                    <br /><br />
                    <div class="text-justify">
                        <b class="font-weight-bold">

                            {{ $store_produit->nom }}

                        </b><br />
                        <b class="font-weight-bold">
                            Nom de l'auteur :
                        </b>{{ $store_produit->nom_auteur }}<br />
                        <b class="font-weight-bold">
                            Catégorie :
                        </b>{{ $store_produit->categorie }}<br />

                        <b class="font-weight-bold">
                            Maison d'édition ou compte d'auteur :
                        </b> {{ $store_produit->maison_edition }}<br /><br />

                        {{ $store_produit->details }}

                        <br /><br /><br /><br />

                    </div>
                @endforeach
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-4">
                @foreach (StoreProduit::where('id', $id)->get() as $store_produit)
                    <input type="hidden" value="{{ $store_produit->nom }}" id="nomProduit" />

                    <input type="hidden" value="{{ $store_produit->prix_livre_papier }}" id="prixProduit" />

                    <div class="mb-2 text-center grey lighten-3 pt-2 pb-2 border border-primary">
                        <b><b class="font-weight-bold">Sélectionnez le(s) format(s) que vous voulez</b></b>
                    </div>

                    @if ($store_produit->livre_papier == "on")
                        <table class="w-100">
                            <tr>
                                <td>
                                    <label for="format1" class="font-size-14">Livre papier</label>
                                    <input type="checkbox" name="livre_papier" id="format1">
                                </td>
                                <td class="text-right">
                                    <b class="font-weight-bold">{{ $store_produit->prix_livre_papier }} {{ $store_produit->devise_livre_papier }} --|-- {{ $store_produit->prix_usd_livre_papier }} USD</b>
                                </td>
                            </tr>
                        </table>
                    @endif
                    @if ($store_produit->livre_pdf == "on")
                        <table class="w-100">
                            <tr>
                                <td>
                                    <label for="format2" class="font-size-14">Livre numérique PDF, E-pub ...</label>
                                    <input type="checkbox" name="livre_pdf" id="format2">
                                </td>
                                <td class="text-right">
                                    <b class="font-weight-bold">{{ $store_produit->prix_livre_pdf }} {{ $store_produit->devise_livre_papier }} --|-- {{ $store_produit->prix_usd_livre_pdf }} USD</b>
                                </td>
                            </tr>
                        </table>
                    @endif
                    @if ($store_produit->livre_audio == "on")
                        <table class="w-100">
                            <tr>
                                <td>
                                    <label for="format3" class="font-size-14">Livre audio</label>
                                    <input type="checkbox" name="livre_audio" id="format3">
                                </td>
                                <td class="text-right">
                                    <b class="font-weight-bold">{{ $store_produit->prix_livre_audio }} {{ $store_produit->devise_livre_papier }} --|-- {{ $store_produit->prix_usd_livre_audio }} USD</b>
                                </td>
                            </tr>
                        </table>
                    @endif
                    @if ($store_produit->livre_video == "on")
                        <table class="w-100">
                            <tr>
                                <td>
                                    <label for="format4" class="font-size-14">Livre video</label>
                                    <input type="checkbox" name="livre_video" id="format4">
                                </td>
                                <td class="text-right">
                                    <b class="font-weight-bold">{{ $store_produit->prix_livre_video }} {{ $store_produit->devise_livre_papier }} --|-- {{ $store_produit->prix_usd_livre_video }} USD</b>
                                </td>
                            </tr>
                        </table>
                    @endif
                    @if ($store_produit->abonnement == "on")
                        <table class="w-100">
                            <tr>
                                <td>
                                    <label for="format5" class="font-size-14">Abonnement</label>
                                    <input type="checkbox" name="abonnement" id="format5">
                                </td>
                                <td class="text-right">
                                    <b class="font-weight-bold">{{ $store_produit->prix_abonnement }} {{ $store_produit->devise_livre_papier }} --|-- {{ $store_produit->prix_usd_abonnement }} USD</b>
                                </td>
                            </tr>
                        </table>
                    @endif

                    <br />

                    <div id="smart-button-container">
                        <div style="text-align: center;">
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                    <br />
                    <div class="text-center mb-2">
                        <b class="font-weight-bold">Sélectionnez votre pays pour d'autres moyens de paiement.</b>
                    </div>

                    <select class="custom-select" required name="pays_paiement" id="pays">
                        <option value="1">Bénin</option>
                        <option value="2">Burkina-Faso</option>
                        <option value="3">Burundi</option>
                        <option value="4">Cameroun</option>
                        <option value="5">Cap-Vert</option>
                        <option value="6">Congo Brazaville</option>
                        <option value="7">Côte d'Ivoire</option>
                        <option value="8">Gabon</option>
                        <option value="9">Gambie</option>
                        <option value="10">Ghana</option>
                        <option value="11">Guinée</option>
                        <option value="12">Guinée Bissau</option>
                        <option value="13">Guinée Équatoriale</option>
                        <option value="14">Îles Maurice</option>
                        <option value="15">Kenya</option>
                        <option value="16">Libéria</option>
                        <option value="17">Madagascar</option>
                        <option value="18">Malawi</option>
                        <option value="19">Mali</option>
                        <option value="20">Mauritanie</option>
                        <option value="21">Mozambique</option>
                        <option value="22">Niger</option>
                        <option value="23">Nigeria</option>
                        <option value="24">Ouganda</option>
                        <option value="25">République Centrafricaine</option>
                        <option value="26">République Démocratique du Congo </option>
                        <option value="27">Rwanda</option>
                        <option value="28">Sénégal</option>
                        <option value="29">Seychelles</option>
                        <option value="30">Sierra Leone</option>
                        <option value="31">Soudan du sud</option>
                        <option value="32">Tchad</option>
                        <option value="33">Tanzanie</option>
                        <option value="34" selected>Togo</option>
                        <option value="35">Zambie</option>
                        <option value="36">Zimbabwe</option>
                    </select>
                    <br /><br />
                    <div class="text-center">

                        <div class="pt-2 pb-2">
                            <b>Cliquez sur le moyen de paiement de votre choix.</b>
                        </div>

                        <!--<img src="{{ URL::asset('assets/images/logo-FedaPay.png' ) }}" class="rounded" width="100" style="border: 3px solid blue;" id="fedaPayBtn" data-toggle="modal" data-target="#modelFedaPayId" />-->

                        <a href="https://paygateglobal.com/v1/page?token=c41ecf42-b10d-4cc9-82c9-25622cadcd8a&amount={{ $store_produit->prix }}&description=Frais Produit CubeStore&identifier={{ $store_produit->id }}" . "_" . {{ time() }} . "&url=https://cubestore.saeicube.com">

                            <img src="{{ URL::asset('assets/images/f_t.png') }}" class="rounded" width="110" style="border: 3px solid blue;" id="paygateBtn" />

                        </a>

                        <!--<img src="{{ URL::asset('assets/images/logo.png') }}" class="rounded" width="110" style="border: 3px solid blue;" data-toggle="modal" data-target="#modelWeCashId" />-->

                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modelFedaPayId" tabindex="-1" role="dialog" aria-labelledby="modelTitleFedaPayId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content rounded">
                                <div class="modal-header">
                                    <h5 class="modal-title">Feda Pay</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">

                                    <div id="embed-feda-pay" class="mt-2 rounded" style="width : 100%; height: 450px;">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="modelWeCashId" tabindex="-1" role="dialog" aria-labelledby="modelWeCashId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content rounded">
                                <div class="modal-header">
                                    <h5 class="modal-title">WeCashUp</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body text-center">

                                    <form action="https://cubestore.saeicube.com/Callback.php" method="POST" id="wecashup">

                                        <script async src="https://www.wecashup.com/library/MobileMoney.js" class="wecashup_button"
                                        data-demo
                                        data-sender-lang="en"
                                        data-sender-phonenumber=""
                                        data-receiver-uid="hG5ohVdGclNdNftDUdW0kCPhYQf1"
                                        data-receiver-public-key="pk_live_VMCml2fNb5D3QaIv"
                                        data-transaction-parent-uid=""
                                        data-transaction-receiver-total-amount="{{ $store_produit->prix }}"
                                        data-transaction-receiver-reference="XVT2VBF"
                                        data-transaction-sender-reference="XVT2VBF"
                                        data-sender-firstname="Test"
                                        data-sender-lastname="Test"
                                        data-transaction-method="pull"
                                        data-image="https://cubestore.saeicube.com/{{ $store_produit->fichier }}"
                                        data-name="{{ $store_produit->nom }}"
                                        data-crypto="true"
                                        data-cash="true"
                                        data-telecom="true"
                                        data-m-wallet="true"
                                        data-split="true"
                                        configuration-id="3"
                                        data-marketplace-mode="false"
                                        data-product-1-name="Billet ABJ PRS"
                                        data-product-1-quantity="1"
                                        data-product-1-unit-price="{{ $store_produit->prix }}"
                                        data-product-1-reference="XVT2VBF"
                                        data-product-1-category="Produit"
                                        data-product-1-description="{{ $store_produit->nom }}"
                                        >
                                        </script>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!---->
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section("js")

    <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD" data-sdk-integration-source="button-factory"></script>
    <script>
        function initPayPalButton() {
          paypal.Buttons({
            style: {
              shape: 'rect',
              color: 'gold',
              layout: 'vertical',
              label: 'buynow',

            },

            createOrder: function(data, actions) {
              return actions.order.create({
                purchase_units: [{"description":"Payer","amount":{"currency_code":"USD","value":$('#prixProduit').val()}}]
              });
            },

            onApprove: function(data, actions) {
              return actions.order.capture().then(function(details) {
                alert('Transaction completed by ' + details.payer.name.given_name + '!');
              });
            },

            onError: function(err) {
              console.log(err);
            }
          }).render('#paypal-button-container');
        }
        initPayPalButton();
    </script>

	<script>

	    FedaPay.init({
	        public_key : 'pk_live_KPTetW0BIXcWuXmBJF57lTJf',
	        transaction : {
	            amount : $('#prixProduit').val(),
	            description : $('#nomProduit').val()
	        },
	        container : '#embed-feda-pay'
	    });

		$(document).ready(function () {

		    $('#pays').change(function() {
		        if($(this).val() != "34") {
		            $('#paygateBtn').fadeOut()
		            $('#fedaPayBtn').fadeOut()
		        } else {
		            $('#paygateBtn').fadeIn()
		            $('#fedaPayBtn').fadeIn()
		        }

		        if($(this).val() != "1" && $(this).val() != "7") {
		            $('#fedaPayBtn').fadeOut()
		        } else {
		            $('#fedaPayBtn').fadeIn()
		        }
		    });

            setInterval(() => {
                $.ajax({
                    type : "GET",
                    url : "{{ route('getBadgeNotifications') }}",
                    data : {},
                    success : function(status) {
                        if (status != 0) {
                            $('.nbNotifications').html("<span class='red white-text pl-1 pr-1'>" + status + "</span>");
                        }
                    }
                });
            }, 2000);
		});
	</script>
@endsection
