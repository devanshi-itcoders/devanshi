<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    {{-- datepicker --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> --}}

    {{-- ckeditor --}}
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js" defer></script>



    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Custom styles for this template -->
    <!-- <link href="navbar-static-top.css" rel="stylesheet"> -->

    @vite(['resources/sass/wizard.scss'])
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google tag (gtag.js) -->

    {{-- @vite(['resources/plugins/richtexteditor/rte.js', 'resources/plugins/richtexteditor/plugins/all_plugins.js']); --}}
    {{-- <script type="" src="http://127.0.0.1:5173/resources/plugins/richtexteditor/rte.js"></script> --}}
</head>


<body data-prismjs-copy-timeout="500">
    <!-- Static navbar -->
    @include('admin/elements/navigation')

    <div class="container">
        @yield('content')

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/javascript-obfuscator/dist/index.browser.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/9000.0.1/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>



    {{-- datepicker --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    @yield('script')

    <script>
        $(function() {
            // CKEDitor_loaded = false;
            // CKEDITOR.on('instanceReady', function(){ CKEditor_loaded = true; }); 
            // master filter 
            $('#masterFilterYear').on('change', function(curr) {
                const selectedMasterYear = $(this).val();
                let currentURL = new URL(window.location.href);
                if (currentURL.searchParams.has('year')) {
                    currentURL.searchParams.set('year', selectedMasterYear);
                } else {
                    currentURL.searchParams.append('year', selectedMasterYear);
                }
                window.location.href = currentURL;
            });

            // navbar
            $('ul li  ').click(function(event) {
                // event.preventDefault();
                $('ul li ').removeClass("active");
                $(this).toggleClass("active");
            });

            // slug
            var slug = function(str) {
                var $slug = '';
                var trimmed = $.trim(str);
                $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
                replace(/-+/g, '-').
                replace(/^-|-$/g, '');
                return $slug.toLowerCase();
            }

            $('.slug-input').keyup(function() {
                var takedata = $('.slug-input').val()
                $('.slug-output').val(slug(takedata));
            });

            $('.click').click(function() {
                var websitetext = $('.website').text();
                var slugtext = $('.slug-output').val();
                var maintext = "http://" + websitetext + "/" + slugtext;
                var siteurl = maintext.trim()
                $('.generated-url').text(siteurl).attr("href", siteurl);
            });

            // Delete data
            $(document).on('click', '#delete', function(e) {
                console.log('ssere');
                var form = $(this).closest("form");
                var name = $(this).data("name");
                e.preventDefault();
                swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel plx!",
                        closeOnConfirm: false,
                        closeOnCancel: false

                    })
                    .then((willDelete) => {
                        if (willDelete && willDelete.value) {
                            form.submit();
                        } else {
                            swal("Cancelled", "Your imaginary file is safe :)", "error");
                        }

                    });

            });
        });
    </script>
    <script></script>
</body>

</html>
