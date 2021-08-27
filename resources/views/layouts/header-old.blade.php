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

<!DOCTYPE html>
<html lang="fr">

<head>
    @yield('meta')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/icofont/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/froala/froala_blocks.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/mdb/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/mdb/css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ URL::asset('assets/froala/css/froala_editor.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/froala/css/froala_style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/froala/css/plugins/code_view.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/froala/css/plugins/colors.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/froala/css/plugins/emoticons.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/froala/css/plugins/image_manager.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/froala/css/plugins/image.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/froala/css/plugins/line_breaker.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/froala/css/plugins/table.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/froala/css/plugins/char_counter.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/froala/css/plugins/video.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/froala/css/plugins/fullscreen.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/froala/css/plugins/quick_insert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/froala/css/plugins/file.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/froala/css/themes/royal.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/file-upload/css/fileinput.min.css') }}">
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/cubebooks.jpg') }}" type="image/x-icon">
    @yield('css')
    <title>CUBE BOOKS</title>
</head>

<body class="body">

    @yield('content')

    <script src="{{ URL::asset('assets/mdb/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/mdb/js/popper.min.js') }}"></script>
    <script src="{{ URL::asset('assets/mdb/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/mdb/js/mdb.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/adminlte.min.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/froala_editor.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/align.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/code_beautifier.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/code_view.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/colors.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/draggable.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/emoticons.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/font_size.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/font_family.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/image.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/file.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/image_manager.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/line_breaker.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/link.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/lists.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/paragraph_format.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/paragraph_style.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/video.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/table.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/url.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/entities.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/char_counter.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/inline_style.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/quick_insert.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/save.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/fullscreen.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/froala/js/plugins/quote.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/toastr/toastr.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/datatables/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/datatables/dataTables.bootstrap4.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/file-upload/js/fileinput.min.js') }}"></script>

    <script>
        (function() {
            new FroalaEditor("#edit", {
                theme: 'royal'
            })
        })()
    </script>
    @yield('js')
    <script>
        $(document).ready(function() {
            $('.icofont-navigation-menu').click(function() {
                $('.sub-menu').slideToggle();
            });

            setInterval(() => {
                $.ajax({
                    type: "GET",
                    url: "{{ route('usersGetCountMessages') }}",
                    data: {},
                    success: function(status) {
                        if (status != "0") {
                            $('#countUnreadMessages').html(
                                "<small><span class='badge badge-pill badge-danger z-depth-0'>" +
                                status + "</span></small>")
                        }
                    }
                });
            }, 2000);


            $('#usersSearch').focusin(function() {
                $('#resultSearch').fadeIn()
            })

            $('#resultSearchClose').click(function() {
                $('#resultSearch').fadeOut()
            })

            $('#usersSearch').keyup(function() {
                if ($(this).val() != "") {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('usersGetResultSearch') }}",
                        data: {
                            'search_q': $(this).val()
                        },
                        success: function(status) {
                            if (status != "") {
                                $('#resultSearchRows').html(status)
                            }
                        }
                    });
                }
            })
        });
    </script>
</body>

</html>
