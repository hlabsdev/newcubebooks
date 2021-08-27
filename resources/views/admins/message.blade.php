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

    <div class="white container-fluid">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <br />

                <h5><b class="font-weight-bold">Envoyer un message de diffusion</b></h5>

                <div class="text-justify border-bottom pb-3 mb-3">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid a,
                    eligendi vitae architecto sapiente esse quas nobis non quod itaque
                    sint debitis, dolorum animi ipsam hic nihil? Neque, odio ullam.
                </div>

                <form action="" method="post">
                    @csrf

                    <textarea name="message" id="message" class="form-control" placeholder="Saisir le message ici" rows="5"></textarea><br />

                    <button type="submit" class="btn btn-blue-grey btn-md btn-block z-depth-0 rounded">
                        <span class="white-text">Envoyer le message</span>
                    </button>

                </form><br />

            </div>
            <div class="col-lg-4"></div>
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