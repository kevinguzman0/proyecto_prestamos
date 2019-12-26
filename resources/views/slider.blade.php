 @section('myslider')
    <!-- ##### Hero Area Start ##### -->
    <div class="hero-area">
        <div class="hero-slideshow owl-carousel">
            <!-- Single Slide -->
            <div class="single-slide bg-img">
                <!-- Background Image-->
                <div class="slide-bg-img bg-img bg-overlay" style="background-image: url({{ asset('img/bg-img/1.jpg') }});"></div>
                <!-- Welcome Text -->
                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-12 col-lg-9">
                            <div class="welcome-text text-center">
                                <h2 data-animation="fadeInUp" data-delay="300ms">Préstamos de  <span style="color: #ff8c00;">Libre</span> Inversión</h2>
                                <p data-animation="fadeInUp" data-delay="500ms">
                                    Esta es la Sede electrónica de la Gobernación de Risaralda, un espacio donde usted podrá realizar sus préstamos en línea y encontrar información de los demas servicios que la entidad tiene disponibles.</p>
                                <a href="{{ url('/tabla') }}" class="btn credit-btn mt-50 class_boton" data-animation="fadeInUp" data-delay="700ms" style="background-color: #ff8c00;">Empezar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide Duration Indicator -->
                <div class="slide-du-indicator"></div>
            </div>

            <!-- Single Slide -->
            <div class="single-slide bg-img">
                <!-- Background Image-->
                <div class="slide-bg-img bg-img bg-overlay" style="background-image: url({{ asset('img/bg-img/5.jpg') }});"></div>
                <!-- Welcome Text -->
                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-12 col-lg-9">
                            <div class="welcome-text text-center">
                                <h2 data-animation="fadeInDown" data-delay="300ms">Solicita ya tu<span> préstamo</span></h2>
                                <p data-animation="fadeInDown" data-delay="500ms">Regístrate y entra</p>
                                <a href="{{ url('/') }}" class="btn credit-btn mt-50 class_boton" style="background-color: #ff8c00;" data-animation="fadeInDown" data-delay="700ms">Empezar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide Duration Indicator -->
                <div class="slide-du-indicator"></div>
            </div>

            <!-- Single Slide -->
            <div class="single-slide bg-img">
                <!-- Background Image-->
                <div class="slide-bg-img bg-img bg-overlay" style="background-image: url({{ asset('img/bg-img/1.jpg') }});"></div>
                <!-- Welcome Text -->
                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-12 col-lg-9">
                            <div class="welcome-text text-center">
                                <h2 data-animation="fadeInUp" data-delay="300ms">Servicios <span>Institucionales</span></h2>
                                <p data-animation="fadeInUp" data-delay="500ms">Para comenzar, debes ser un usuario registrado. ingresa o regístrate.</p>
                                <a href="{{ url('/logueo') }}" class="btn credit-btn mt-50 class_boton" data-animation="fadeInUp" data-delay="700ms" style="background-color: #ff8c00;">Empezar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide Duration Indicator -->
                <div class="slide-du-indicator"></div>
            </div>

        </div>
    </div>
    <!-- ##### Hero Area End ##### -->
@endsection