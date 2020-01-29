@section('postCarga')

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="{{ asset('js/jquery-3.4.1.slim.min.js') }}"></script>

    <!-- Popper.JS -->
    <script src="{{ asset('js/popper.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- jQuery Custom Scroller CDN -->
    <script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>

    <!-- JS para botones de selección de archivos y Upload -->
    <script src="{{ asset('js/bootstrap-filestyle.min.js') }}"></script>

    <!-- JS personalizado del proyecto -->
    <script src="{{ asset('js/custom.js') }}"></script>

    <script type="text/javascript">

        $(document).ready(function () {

            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });

            $('[data-toggle="tooltip"]').tooltip();

            function fotoPerfilReadURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#imageProfile').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            
            $("#foto").change(function(){
                fotoPerfilReadURL(this);
            });

        });

    </script>

@endsection