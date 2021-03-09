<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Full stack</title>

        <link rel="stylesheet" href="/css/all.css">
        <script>
            (function (){
                window.Laravel = {
                    csrfToken: '{{ csrf_token()}}'
                };
            })();

        </script>
     
    </head>
    <body>
        <div id="app">
            
            <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
                <div class="container">
                    <a class="navbar-brand js-scroll-trigger" href="#page-top">CISBSI</a>
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto my-2 my-lg-0">
                            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About</a></li>
                            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#services">Services</a></li>
                            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#portfolio">Portfolio</a></li>
                            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contact</a></li>
                            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/auth">SIGN IN</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
   
            <header class="masthead">
                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-center text-center">
                        <div class="col-lg-10 align-self-end">
                            <h1 class="text-uppercase text-white font-weight-bold">Welcome to Barangay San Ignacio</h1>
                            <hr class="divider my-4" />
                        </div>
                        <div class="col-lg-8 align-self-baseline">
                            <p class="text-white-75 font-weight-light mb-5">Hi there! :) </p>
                            <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Find Out More</a>
                        </div>
                    </div>
                </div>
            </header>
        
            <section class="page-section bg-primary" id="about">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center">
                            <h2 class="text-white mt-0">ABOUT</h2>
                            <p  class="text-white-50 mb-4">
                                Computerized Information System for Barangay San Ignacio is a computer Based System that will upgrade the services in said barangay.
                                 This system is developed to provide specific information about San Ignacio   
                            </p>
                            <a class="btn btn-light btn-xl js-scroll-trigger" href="#services">Read more...</a>
                        </div>
                    </div>
                </div>
            </section>
           
            <section class="page-section" id="services">
                <div class="container">
    
                    <div class="row">
                        <div class="col-lg-4 col-md-6 text-center">
                            <div class="mt-5">
                                <i class="fas fa-4x fa-gem text-primary mb-4"></i>
                                <a href="#"><h3 class="h4 mb-2">ANNOUNCEMENTS</h3></a>
                                <p class="text-muted mb-0">Our themes are updated regularly to keep them bug free!</p>
                    
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 text-center">
                            <div class="mt-5">
                                <i class="fas fa-4x fa-laptop-code text-primary mb-4"></i>
                                <a href="#"><h3 class="h4 mb-2">EVENTS</h3></a>
                                <p class="text-muted mb-0">All dependencies are kept current to keep things fresh.</p>
                    
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 text-center">
                            <div class="mt-5">
                                <i class="fas fa-4x fa-globe text-primary mb-4"></i>
                                <a href="#"><h3 class="h4 mb-2">PROJECTS</h3></a>
                                <p class="text-muted mb-0">You can use this design as is, or you can make changes!</p>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        
            <div id="portfolio">
                <div class="container-fluid p-0">
                    <div class="row no-gutters">
            
                        <div class="col-lg-4 col-sm-6">
                            <a class="portfolio-box" href="assets/img/portfolio/fullsize/44.jpg">
                                <img class="img-fluid" src="assets/img/portfolio/thumbnails/44.jpg" alt="" />
                                <div class="portfolio-box-caption">
                                    <div class="project-category text-white-50">Category</div>
                                    <div class="project-name">Please insert the project name</div>
                                    
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <a class="portfolio-box" href="assets/img/portfolio/fullsize/c.jpg">
                                <img class="img-fluid" src="assets/img/portfolio/thumbnails/c.jpg" alt="" />
                                <div class="portfolio-box-caption">
                                    <div class="project-category text-white-50">Category</div>
                                    <div class="project-name">Please insert the project name</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <a class="portfolio-box" href="assets/img/portfolio/fullsize/d.jpg">
                                <img class="img-fluid" src="assets/img/portfolio/thumbnails/d.jpg" alt="" />
                                <div class="portfolio-box-caption">
                                    <div class="project-category text-white-50">Category</div>
                                    <div class="project-name">Please insert the project name</div>
                                </div>
                            </a>
                        </div>
    
                    </div>
                </div>
            </div>
  
            <section class="page-section bg-dark text-white">
                <div class="container text-center">
                    <h2 class="mb-4">MISSION</h2>
                    <p>Mag implementar sin mga programa kaiba an pribadong sector para sa karahayan kan konstituentes asin kapalibutan</p>
                    <h2 class="mb-4 mt-5">VISION</h2>
                    <p>Produktibong barangay na may pagkamoot sadiyos marhay na salud, residente ng edukado na minasuporta san silag na pagogobyerno na namumuhay sa matoninong na kapalibutan</p>
                </div>
            </section>
   
            <section class="page-section" id="contact">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center">
                            <h2 class="mt-0">Let's Get In Touch!</h2>
                            <hr class="divider my-4" />
                            <p class="text-muted mb-5">Ready to start your next project with us? Give us a call or send us an email and we will get back to you as soon as possible!</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                            <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                            <div>09277388545</div>
                        </div>
                        <div class="col-lg-4 mr-auto text-center">
                            <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                            <a class="d-block" href="mailto:jesnarerpe3@gmail.com">jesnarerpe3@gmail.com</a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Footer-->
            <footer class="bg-light py-5">
                <div class="container"><div class="small text-center text-muted">Copyright © 2021 - CISBSI</div></div>
            </footer>
     
        </div>
    </body>
    {{-- <script src="{{mix('js/app.js')}}"></script> --}}
</html>
