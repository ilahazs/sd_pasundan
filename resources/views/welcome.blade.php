<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SD Pasundan</title>
    
    <link rel="stylesheet" href="{{asset('landing-page/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('landing-page/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('landing-page/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('landing-page/font-awesome/css/font-awesome.min.css')}}">

    <style>
        .landing-page .header-back.one {
            background: linear-gradient(to bottom, rgb(216 50 0 / 18%) 0, rgb(216 50 0 / 20%) 50%), url("{{asset('landing-page/image/'.$image_1)}}") 50% 50% no-repeat;
            background-size: 100%;
        }
    </style>
</head>
<body id="page-top" class="landing-page">
    <div class="navbar-wrapper">
        <nav class="navbar navbar-default navbar-fixed-top navbar-expand-md" role="navigation">
            <div class="container">
                <a href="#" class="navbar-brand">SD Pasundan</a>
                <div class="navbar-header page-scroll">
                    <button class="navbar-toggler" type="button" data-toogle="collapse" data-target="#navbar">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#page-top" class="nav-link page-scroll">Home</a>
                        </li>
                        <li>
                            <a href="#profile" class="nav-link page-scroll">Profile</a>
                        </li>
                        <li>
                            <a href="#activity" class="nav-link page-scroll">Activity</a>
                        </li>
                        <li>
                            <a href="#team" class="nav-link page-scroll">Team</a>
                        </li>
                        <li>
                            <a href="#greeting" class="nav-link page-scroll">Greeting</a>
                        </li>
                        <li>
                            <a href="#contact" class="nav-link page-scroll">Contact</a>
                        </li>
                        @if(auth()->check())
                            <li>
                                <a href="{{route('login')}}" class="nav-link">{{auth()->user()->name}}</a>
                            </li>
                            <li>
                                <a href="{{route('logout')}}" class="nav-link page-scroll">Logout</a>
                            </li>
                        @else
                            <li>
                                <a href="{{route('login')}}" class="nav-link">Login</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div id="inSlider" class="carousel slide" data-ride="carousel" >
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="container">
                    <div class="carousel-caption col-md-5">
                        <h1>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Autem, voluptatibus.</h1>
                        <p>Lorem, ipsum dolor.</p>
                        <p>
                            <a class="btn btn-lg btn-primary" href="#" role="button">READ MORE</a>
                            <!-- <a class="caption-link" href="#" role="button">Inspinia Theme</a> -->
                        </p>
                    </div>
                    <div class="carousel-image wow zoomIn">
                        <img src="{{asset('landing-page/image/'.$image_2)}}" style="width:180px;" alt="laptop"/>
                    </div>
                </div>
                <!-- Set background for slide in css -->
                <div class="header-back one"></div>
            </div>
        </div>
    </div>
    <section id="profile" class="container services">
        <div class="row">
            <div class="col-sm-3">
                <h2>EASY Learning</h2>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
                <p><a class="navy-link" href="#" role="button">Details &raquo;</a></p>
            </div>
            <div class="col-sm-3">
                <h2>FULL of trick</h2>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
                <p><a class="navy-link" href="#" role="button">Details &raquo;</a></p>
            </div>
            <div class="col-sm-3">
                <h2>MANY Course</h2>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
                <p><a class="navy-link" href="#" role="button">Details &raquo;</a></p>
            </div>
            <div class="col-sm-3">
                <h2>MEET THE EXPERTS</h2>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
                <p><a class="navy-link" href="#" role="button">Details &raquo;</a></p>
            </div>
        </div>
    </section>
    <section  class="container features">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Profil<br/> <span class="navy"> SD Pasundan</span> </h1>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 text-center wow fadeInLeft">
                <div>
                    <div class="features-icon">A</div>
                    <h2>Akreditasi</h2>
                    <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
                </div>
                <div class="m-t-lg">
                    <div class="features-icon">900</div>
                    <h2>Siswa</h2>
                    <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
                </div>
            </div>
            <div class="col-md-6 text-center  wow zoomIn">
                <img src="{{asset('landing-page/image/'.$image_3)}}" style="width:360px;" alt="dashboard" class="img-fluid">
            </div>
            <div class="col-md-3 text-center wow fadeInRight">
                <div>
                    <div class="features-icon">36</div>
                    <h2>Guru</h2>
                    <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
                </div>
                <div class="m-t-lg">
                    <div class="features-icon">20</div>
                    <h2>Kelas</h2>
                    <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="activity">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1>Activity</h1>
                    <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. </p>
                </div>
            </div>
            <div class="row features-block">
                <div class="col-lg-6 features-text wow fadeInLeft">
                    <small>SD Pasundan</small>
                    <h2>Berita terbaru dari SD Pasundan</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <a href="#" class="btn btn-sm btn-primary">Learn more</a>
                </div>
                <div class="col-lg-6 text-right wow fadeInRight">
                    <img src="{{asset('landing-page/image/'.$image_4)}}" alt="dashboard" class="img-fluid float-right">
                </div>
            </div>
        </div>
    </section>
    <section class="gray-section">
        <!-- <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Schedule</h1>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. </p>
            </div>
        </div> -->
        <div class="row features-block">

            <div class="col-lg-12">
                <div id="vertical-timeline" class="vertical-container light-timeline center-orientation">

                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-file-text"></i>
                        </div>

                        <div class="vertical-timeline-content">
                            <h2>Study Tour</h2>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
                            <a href="#" class="btn btn-xs btn-primary"> More info</a>
                            <span class="vertical-date">Jum'at - Minggu<br/> <small>21 - 23 Februari 2021</small> </span>
                        </div>
                    </div>

                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-briefcase"></i>
                        </div>

                        <div class="vertical-timeline-content">
                            <h2>Hari Raya Nyepi</h2>
                            <p>Conference on the sales results for the previous year. Monica please examine sales trends in marketing and products. Below please find the current status of the sale.
                            </p>
                            <a href="#" class="btn btn-xs btn-primary"> More info</a>
                            <span class="vertical-date"> Rabu <br/> <small>25 Maret 2021</small> </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section id="team" class="gray-section team">
        <div class="container">
            <div class="row m-b-lg">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1>Team Management</h1>
                    <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="team-member wow zoomIn">
                        <img src="{{asset('landing-page/image/'.$image_5)}}" class="img-fluid rounded-circle" alt="">
                        <h4><span class="navy">Bapak/Ibu Kepala Sekolah</span> S.Pd</h4>
                        <p>Headmaster</p>
                        <ul class="list-inline social-icon">
                            <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4 wow fadeInRight">
                    <div class="team-member">
                        <img src="{{asset('landing-page/image/'.$image_6)}}" class="img-fluid rounded-circle img-small" alt="">
                        <h4><span class="navy">Bapak/Ibu Wakil Kepala</span> M.M.Pd</h4>
                        <p>Wakasek Kesiswaan</p>
                        <ul class="list-inline social-icon">
                            <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="col-sm-4 wow fadeInRight">
                    <div class="team-member">
                        <img src="img/avatar2.jpg" class="img-fluid rounded-circle img-small" alt="">
                        <h4><span class="navy">Peter</span> Johnson</h4>
                        <p>Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.</p>
                        <ul class="list-inline social-icon">
                            <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div> -->
            </div>
            <div class="row">
                <div class="col-lg-12 text-center m-t-lg m-b-lg">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="greeting" class="navy-section testimonials" style="margin-top: 0">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center wow zoomIn">
                    <i class="fa fa-comment big-icon"></i>
                    <h1>
                        Sambutan Kepala Sekolah
                    </h1>
                    <div class="testimonials-text">
                        <i>"Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)."</i>
                    </div>
                    <div><br>Kepala Sekolah M.Pd</div>
                    <small>
                        <strong>- Kepala Sekolah SD Pasundan -</strong>
                    </small>
                </div>
            </div>
        </div>

    </section>

    <section class="comments" style="margin-top: 0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1>Sambutan Lainnya</h1>
                    <p>Donec sed odio dui. Etiam porta sem malesuada. </p>
                </div>
            </div>
            <div class="row features-block">
                <div class="col-lg-4">
                    <div class="bubble">
                        "Uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)."
                    </div>
                    <div class="comments-avatar">
                        <a href="" class="float-left">
                            <img alt="image" src="{{asset('landing-page/image/'.$image_7)}}">
                        </a>
                        <div class="media-body">
                            <div class="commens-name">
                                Andrew Williams
                            </div>
                            <small class="text-muted">Wakil Kepala Sekolah</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="bubble">
                        "Uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)."
                    </div>
                    <div class="comments-avatar">
                        <a href="" class="float-left">
                            <img alt="image" src="{{asset('landing-page/image/'.$image_8)}}">
                        </a>
                        <div class="media-body">
                            <div class="commens-name">
                                Andrew Williams
                            </div>
                            <small class="text-muted">Company X from California</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="bubble">
                        "Uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)."
                    </div>
                    <div class="comments-avatar">
                        <a href="" class="float-left">
                            <img alt="image" src="{{asset('landing-page/image/'.$image_9)}}">
                        </a>
                        <div class="media-body">
                            <div class="commens-name">
                                Andrew Williams
                            </div>
                            <small class="text-muted">Company X from California</small>
                        </div>
                    </div>
                </div>



            </div>
        </div>

    </section>

    <!-- <section class="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1>More and more extra great feautres</h1>
                    <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. </p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5 col-lg-offset-1 features-text">
                    <small>INSPINIA</small>
                    <h2>Perfectly designed </h2>
                    <i class="fa fa-bar-chart big-icon float-right"></i>
                    <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p>
                </div>
                <div class="col-lg-5 features-text">
                    <small>INSPINIA</small>
                    <h2>Perfectly designed </h2>
                    <i class="fa fa-bolt big-icon float-right"></i>
                    <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5 col-lg-offset-1 features-text">
                    <small>INSPINIA</small>
                    <h2>Perfectly designed </h2>
                    <i class="fa fa-clock-o big-icon float-right"></i>
                    <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p>
                </div>
                <div class="col-lg-5 features-text">
                    <small>INSPINIA</small>
                    <h2>Perfectly designed </h2>
                    <i class="fa fa-users big-icon float-right"></i>
                    <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p>
                </div>
            </div>
        </div>

    </section>
    <section id="pricing" class="pricing">
        <div class="container">
            <div class="row m-b-lg">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1>App Pricing</h1>
                    <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 wow zoomIn">
                    <ul class="pricing-plan list-unstyled">
                        <li class="pricing-title">
                            Basic
                        </li>
                        <li class="pricing-desc">
                            Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.
                        </li>
                        <li class="pricing-price">
                            <span>$16</span> / month
                        </li>
                        <li>
                            Dashboards
                        </li>
                        <li>
                            Projects view
                        </li>
                        <li>
                            Contacts
                        </li>
                        <li>
                            Calendar
                        </li>
                        <li>
                            AngularJs
                        </li>
                        <li>
                            <a class="btn btn-primary btn-xs" href="#">Signup</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 wow zoomIn">
                    <ul class="pricing-plan list-unstyled selected">
                        <li class="pricing-title">
                            Standard
                        </li>
                        <li class="pricing-desc">
                            Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.
                        </li>
                        <li class="pricing-price">
                            <span>$22</span> / month
                        </li>
                        <li>
                            Dashboards
                        </li>
                        <li>
                            Projects view
                        </li>
                        <li>
                            Contacts
                        </li>
                        <li>
                            Calendar
                        </li>
                        <li>
                            AngularJs
                        </li>
                        <li>
                            <strong>Support platform</strong>
                        </li>
                        <li class="plan-action">
                            <a class="btn btn-primary btn-xs" href="#">Signup</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 wow zoomIn">
                    <ul class="pricing-plan list-unstyled">
                        <li class="pricing-title">
                            Premium
                        </li>
                        <li class="pricing-desc">
                            Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.
                        </li>
                        <li class="pricing-price">
                            <span>$160</span> / month
                        </li>
                        <li>
                            Dashboards
                        </li>
                        <li>
                            Projects view
                        </li>
                        <li>
                            Contacts
                        </li>
                        <li>
                            Calendar
                        </li>
                        <li>
                            AngularJs
                        </li>
                        <li>
                            <a class="btn btn-primary btn-xs" href="#">Signup</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row m-t-lg">
                <div class="col-lg-12 text-center m-t-lg">
                    <p>*Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. <span class="navy">Various versions</span>  have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                </div>
            </div>
        </div>

    </section> -->

    <section id="contact" class="gray-section contact">
        <div class="container">
            <div class="row m-b-lg">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1>Contact Us</h1>
                    <p></p>
                </div>
            </div>
            <div class="row m-b-lg justify-content-center">
                <div class="col-lg-3 ">
                    <address>
                        <strong><span class="navy">SD PASUNDAN</span></strong><br/>
                        Jalan Siliwangi KM.15, Manggahang,<br/>
                        Baleendah, Manggahang, Kec. Baleendah, Bandung.<br/>
                        <abbr title="Phone"><i class="fa fa-phone"></i></abbr> (022) - 7303736 <br>
                        <abbr title="Email"><i class="fa fa-envelope"></i></abbr> sdn.pasundan@yahoo.co.id <br>
                        Kab Bandung <br>
                        Provinsi Jawa Barat <br>
                        Indonesia <br>
                    </address>
                </div>
                <div class="col-lg-4">
                    <p class="text-color">
                        Jika kamu ingin mengajukan pertanyaan seputar SD Pasundan bisa dengan cara kirim email ke email kami dengan nama dan email asli kamu.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <a href="mailto:test@email.com" class="btn btn-primary">Send us mail</a>
                    <p class="m-t-sm">
                        Or follow us on social platform
                    </p>
                    <ul class="list-inline social-icon">
                        <li class="list-inline-item"><a href="" target="_blank"><i class="fa fa-youtube"></i></a>
                        </li>
                        <li class="list-inline-item"><a href="" target="_blank"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li class="list-inline-item"><a href="" target="_blank"><i class="fa fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center m-t-lg m-b-lg">
                    <p><strong>&copy; SD Pasundan</strong><br/> consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
                </div>
            </div>
        </div>
    </section>
    <script src="{{asset('landing-page/js/jquery-2.1.1.js')}}"></script>
    <script src="{{asset('landing-page/js/pace.min.js')}}"></script>
    <script src="{{asset('landing-page/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('landing-page/js/classie.js')}}"></script>
    <script src="{{asset('landing-page/js/cbpAnimatedHeader.js')}}"></script>
    <script src="{{asset('landing-page/js/wow.min.js')}}"></script>
    <script src="{{asset('landing-page/js/inspinia.js')}}"></script>
</body>
</html>