@section('footer')
    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area section-padding-100-0" style="background-color: #00983b">
        <div class="container classmenu">
            <div class="row">

                <!-- Single Footer Widget -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-footer-widget mb-100">
                        <h5 class="widget-title">About Us</h5>
                        <!-- Nav -->
                        <nav>
                            <ul>
                                <li><a href="#">Homepage</a></li>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Services &amp; Offers</a></li>
                                <li><a href="#">Portfolio Presentation</a></li>
                                <li><a href="#">The News</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- Single Footer Widget -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-footer-widget mb-100">
                        <h5 class="widget-title">Solutions</h5>
                        <!-- Nav -->
                        <nav>
                            <ul>
                                <li><a href="#">Our Loans</a></li>
                                <li><a href="#">Trading &amp; Commerce</a></li>
                                <li><a href="#">Banking &amp; Private Equity</a></li>
                                <li><a href="#">Industrial &amp; Factory</a></li>
                                <li><a href="#">Financial Solutions</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- Single Footer Widget -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-footer-widget mb-100">
                        <h5 class="widget-title">Our Loans</h5>
                        <!-- Nav -->
                        <nav>
                            <ul>
                                <li><a href="#">Our Loans</a></li>
                                <li><a href="#">Trading &amp; Commerce</a></li>
                                <li><a href="#">Banking &amp; Private Equity</a></li>
                                <li><a href="#">Industrial &amp; Factory</a></li>
                                <li><a href="#">Financial Solutions</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- Single Footer Widget -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-footer-widget mb-100">
                        <h5 class="widget-title">Latest News</h5>

                        <!-- Single News Area -->
                        <div class="single-latest-news-area d-flex align-items-center">
                            <div class="news-thumbnail">
                                <img src="{{ asset('img/bg-img/7.jpg') }}" alt="">
                            </div>
                            <div class="news-content">
                                <a href="#">How to get the best loan?</a>
                                <div class="news-meta">
                                    <a href="#" class="post-author"style="color: black;"><img src="{{ asset('img/core-img/pencil.png') }}" alt=""> Jane Smith</a>
                                    <a href="#" class="post-date" style="color: black;"><img src="{{ asset('img/core-img/calendar.png') }}" alt=""> April 26</a>
                                </div>
                            </div>
                        </div>

                        <!-- Single News Area -->
                        <div class="single-latest-news-area d-flex align-items-center">
                            <div class="news-thumbnail">
                                <img src="{{ asset('img/bg-img/8.jpg') }}" alt="">
                            </div>
                            <div class="news-content">
                                <a href="#">A new way to get a loan</a>
                                <div class="news-meta">
                                    <a href="#" class="post-author" style="color: black;"><img src="{{ asset('img/core-img/pencil.png') }}" alt=""> Jane Smith</a>
                                    <a href="#" class="post-date" style="color: black;"><img src="{{ asset('img/core-img/calendar.png') }}" alt=""> April 26</a>
                                </div>
                            </div>
                        </div>

                        <!-- Single News Area -->
                        <div class="single-latest-news-area d-flex align-items-center">
                            <div class="news-thumbnail">
                                <img src="{{ asset('img/bg-img/9.jpg') }}" alt="">
                            </div>
                            <div class="news-content">
                                <a href="#">Finance you home</a>
                                <div class="news-meta">
                                    <a href="#" class="post-author" style="color: black;"><img src="{{ asset('img/core-img/pencil.png') }}" alt="" style="color: black;"> Jane Smith</a>
                                    <a href="#" class="post-date" style="color: black;"><img src="{{ asset('img/core-img/calendar.png') }}" alt=""> April 26</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Copywrite Area -->
        <div class="copywrite-area" style="background-color: #ffffff">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="copywrite-content d-flex flex-wrap justify-content-between align-items-center">
                            <!-- Footer Logo -->
                            <a href="{{ url ('/') }}" class="footer-logo"><img src="{{ asset('img/gobernacion.png') }}" alt="" width="300"></a>

                            <!-- Copywrite Text -->
                            <p class="copywrite-text"><a href="#"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### All Javascript Script ##### -->
    <script src="{{ asset('js/jquery/jquery-2.2.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('js/bootstrap/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    <!-- All Plugins js -->
    <script src="{{ asset('js/plugins/plugins.js') }}"></script>
    <!-- Active js -->
    <script src="{{ asset('js/active.js') }}"></script>
    <!-- jQuery-2.2.4 js -->
@endsection