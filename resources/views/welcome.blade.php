<!DOCTYPE html>
<html class="js cssanimations csstransforms desktop portrait" lang="en">
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="token" content="{{csrf_token()}}">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Drugoe</title>
    <!-- Standard Favicon-->
    <link href="images/favicon.ico" rel="shortcut icon">
    <!-- Bootstrap CSS Files -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom Fonts Setup via Font-face CSS3 -->
    <link href="css/fonts.css" rel="stylesheet">
    <!-- CSS files for plugins -->
    <link href="css/plugins.css" rel="stylesheet">
    <link href="css/portfolio.css" rel="stylesheet">
    <!-- Home Variant Styles -->
    <link href="css/intro02.css" rel="stylesheet">
    <!-- Main Template Styles -->
    <link href="css/main.css" rel="stylesheet">
    <!-- Main Template BG Images -->
    <link href="css/main-bg.css" rel="stylesheet">
    <!-- Main Template Responsive Styles -->
    <link href="css/main-responsive.css" rel="stylesheet">
    <!-- Main Template Retina Optimizaton Rules -->
    <link href="css/main-retina.css" rel="stylesheet">
    <!-- LESS stylesheet for managing color presets 
    <link href="css/color.less" rel="stylesheet/less">-->
    <!-- LESS JS engine-->
    <script src="js/less-1.7.3.min.js"></script>
    <!-- Google Web Fonts
    <link href="css/css.less" rel="stylesheet" type="text/css">-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if IE 9]><link href="stylesheets/ie9.css" rel="stylesheet"><![endif]-->
    <!-- Modernizr Library-->

    
    <script src="js/modernizr.custom.js"></script>
  </head>
  <body class="pace-done" style="    overflow-y: hidden;">
    <div class="pace pace-inactive">
      <div class="pace-progress" data-progress="99" data-progress-text="100%" style="width: 100%;">
        <div class="pace-progress-inner"></div>
      </div>
      <div class="pace-activity"></div>
    </div><!-- mobile only navigation : starts -->

    <nav class="mobile-nav hidden-lg softwhite-bg">
      
      <ul class="slimmenu" style="display: block;">
        <li><a class="scroll" href="#intro">ГЛАВНАЯ</a></li>
        <li><a class="scroll" href="#about">О НАС</a></li>
        <li><a class="scroll" href="#services">НАШИ УСЛУГИ</a></li>
        <li><a class="scroll" href="#team">КЛИЕНТЫ</a></li>
        <li><a class="scroll" href="#portfolio">ПОРТФОЛИО</a></li>
        <li><a class="scroll" href="#reviews">ОТЗЫВЫ</a></li>
        <li><a class="scroll" href="#contact">КОНТАКТЫ</a></li>
      </ul>
    </nav><!-- mobile only navigation : ends -->
    <!-- masthead-section (this nav bar is initially hidden but will be visible only on inner pages) : starts -->
    <header class="standard-header standard-header-top" id="standard-header" style="opacity: 0;">
      <div class="container">
        <div class="row">
          <article class="col-md-2 text-left">
            <img alt="trinity" class="main-logo img-responsive" src="images/main-logo.png" title="trinity">
          </article>
          <article class="col-md-10 text-right">
            <ul class="standard-nav standard-nav-dark-text">
              @foreach ($menu as $val)
              <li><a class="scroll" href="{{$val->url}}" id="about-linker">{{$val->lable}}</a></li>
              @endforeach
            </ul>
          </article>
        </div>
      </div>
    </header><!-- masthead-section:ends -->

    
    <section class="intro intro-02 text-center parallax" id="intro" style="background-position: 50% 0px;">
      <section class="container">
        <div class="fullheight caption-panel" style="height: 955px;">
          <div class="valign">
            <!-- <h3 class="color font2"><span>websites / branding</span></h3>
            <h1 class="black font5"><strong class=" text-rotator align-inline"></strong></h1>-->
            <div class="rotator-wrap">
              <h1 class="black font5"><span><span class="rotate"><img src="images/main-logo.png" alt=""></span></span></h1>
            </div>
            <!-- <div class="explore-link"><a class="scroll color font4 ease" href="#">Learn More About Us</a></div> -->
          </div>
          <div class="mouse-icon-wrap">
            <a class="scroll" href="#">
              <div class="mouse-icon color hidden-xs" style="opacity: 1;">
                <div class="wheel"></div>
              </div>
            </a>
          </div>
        </div>
      </section>
    </section>
    @if (isset($page['intro']))
    <section class="page page-section about about-bg parallax1" id="about" style="overflow: hidden; background-position: 50% ">
      <div class="container about-content">
        <div class="row">
          <article class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
            <p class="font2 add-top-quarter welcome-text-sub text-sub-modify wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;">{!!$page['intro']->content!!}</p>
            <h4 class="main-heading modify-heading font2 wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;"><span>{!!$page['intro']->title!!}</span></h4>
            <!--<div class="add-top-half wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;"><a class="btn btn-adria btn-adria-white scroll" href="#portfolio">Visit Our Portfolio</a></div>-->
          </article>
        </div>
      </div>
    </section>
    @endif

    @if (isset($page['about']))
    <section class="page page-section services light-whitegray-bg" id="services" style="overflow: hidden;">
      <div class="container">
        <div class="row">
          <article class="col-md-8 col-md-offset-2 text-center">
            <h1 class="main-title service-ttl black wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;">{!!$page['about']->title!!}</h1>
            <h3 class="main-heading green font2 wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;"><span>{!!$page['about']->content!!}</span></h3>
            <!--<p class="promo-text gray font3 wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;">We create stunning things on web and graphics. We produce web designs, brand &amp; identity, graphic design and interactive UX / UI.</p>-->
          </article>
        </div>
        <div class="row">
          <article class="col-md-12 wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;">
            <div class="mi-slider" id="mi-slider">
              <ul class="mi-current">
                <li>
                  <a class="scroll" data-slide-to="0" data-target="#service-details-carousel" href="#service-details">
                    <span class="round-pic-box">
                      <span class="inn"><img src="images/icon09.png" alt=""></span>
                    </span>
                    <h4 class="font4 color">Праздники</h4>
                  </a>
                </li>
                <li>
                  <a class="scroll" data-slide-to="1" data-target="#service-details-carousel" href="#service-details">
                    <span class="round-pic-box">
                      <span class="inn"><img src="images/icon08.png" alt=""></span>
                    </span>
                    <h4 class="font4 color">Деловые</h4>
                  </a>
                </li>
                <li>
                  <a class="scroll" data-slide-to="2" data-target="#service-details-carousel" href="#service-details">
                    <span class="round-pic-box">
                      <span class="inn"><img src="images/icon07.png" alt=""></span>
                    </span>
                    <h4 class="font4 color">Выездные</h4>
                  </a>
                </li>
              </ul>
              <ul>
                <li>
                  <a class="scroll" data-slide-to="3" data-target="#service-details-carousel" href="#service-details">
                    <span class="round-pic-box">
                      <span class="inn"><img src="images/icon06.png" alt=""></span>
                    </span>
                    <h4 class="font4 color">Оформление и декор</h4>
                  </a>
                </li>
                <li>
                  <a class="scroll" data-slide-to="4" data-target="#service-details-carousel" href="#service-details">
                    <span class="round-pic-box">
                      <span class="inn"><img src="images/icon05.png" alt=""></span>
                    </span>
                    <h4 class="font4 color">Фирменный стиль</h4>
                  </a>
                </li>
                <li>
                  <a class="scroll" data-slide-to="5" data-target="#service-details-carousel" href="#service-details">
                    <span class="round-pic-box">
                      <span class="inn"><img src="images/icon04.png" alt=""></span>
                    </span>
                    <h4 class="font4 color">Сувениры</h4>
                  </a>
                </li>

              </ul>
              <ul>
                <li>
                  <a class="scroll" data-slide-to="7" data-target="#service-details-carousel" href="#service-details">
                    <span class="round-pic-box">
                      <span class="inn"><img src="images/icon01.png" alt=""></span>
                    </span>
                    <h4 class="font4 color">Креативные концепции</h4>
                  </a>
                </li>
                <li>
                  <a class="scroll" data-slide-to="8" data-target="#service-details-carousel" href="#service-details">
                    <span class="round-pic-box">
                      <span class="inn"><img src="images/icon02.png" alt=""></span>
                    </span>
                    <h4 class="font4 color">Сценарии</h4>
                  </a>
                </li>
                <li>
                  <a class="scroll" data-slide-to="9" data-target="#service-details-carousel" href="#service-details">
                    <span class="round-pic-box">
                      <span class="inn"><img src="images/icon03.png" alt=""></span>
                    </span>
                    <h4 class="font4 color">Режиссура</h4>
                  </a>
                </li>
              </ul>
              
              <nav>
                <a class="font2 black mi-selected" href="#">МЕРОПРИЯТИЯ</a> 
                <a class="font2 black" href="#">ДИЗАЙН</a> 
                <a class="font2 black" href="#">КРЕАТИВ</a>
              </nav>
            </div>
          </article>
        </div>
      </div>
    </section>
    @endif

    @if (isset($page['team']))
    <section class="page page-section team white-bg" id="team" style="overflow: hidden;">
      <div class="container">
        <div class="row">
          <article class="col-md-8 col-md-offset-2 text-center">
            <h1 class="main-title service-ttl black wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;">{{$page['team']->title}}</h1>
            <h3 class="main-heading green font2 wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;"><span>{!!$page['team']->content!!}</span></h3>
          </article>
        </div>
      </div>
      <article class="col-md-12 wow fadeInDown animated logobox" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;">
        <div id="carousel-example-generic" class="carousel slide text-center logo-carousel" data-ride="carousel">
          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <?php $i = 0 ?>
            @foreach ($clients as $key=>$val)
              @if ($i == 0)
                @if ($key == 0)
                   <div class="item active">
                @else
                   <div class="item">
                @endif
                <div class="row">
              @endif
                 <div class="col-lg-3 col-lg-offset-0  col-sm-3 col-sm-offset-2 col-xs-8 col-xs-offset-2"><a href="{{$val->url}}"><img src="{{$val->image}}" alt=""></a></div>
              @if ($i == 3 or $key == sizeof($clients)-1)
                </div>
              </div>
                <?php $i = 0; ?>
              @else
                <?php $i++; ?>
              @endif
            @endforeach

          </div>
          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </article>
    </section>
    @endif


    @if (isset($page['portfolio']))
    <section class="page page-section remove-pad-bottom portfolio light-whitegray-bg" id="portfolio" style="overflow: hidden;">
      <!-- inner-section:starts -->
      <section class="inner-section">
        <div class="container">
          <div class="row">
            <article class="col-md-8 col-md-offset-2 text-center">
              <h1 class="main-title service-ttl black wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;">{{$page['portfolio']->title}}</h1>
              <h3 class="main-heading green font2 wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;"><span>{!!$page['portfolio']->content!!}</span></h3>
            </article>
          </div>
        </div>
      </section>
      <!-- inner-section:starts -->
      <section class="inner-section add-top-half light-whitegray-bg">
        <!-- Portfolio Plus Filters -->
        <div class="portfolio add-bottom">
          <!-- Portfolio Filters 
          <div class="col-md-12" id="filters">
            <div class="cbp-l-filters-alignCenter wow fadeInDown animated" id="filters-container" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;">
              <div class="cbp-filter-item-active cbp-filter-item filter-name" data-filter="*">ALL</div>
              <div class="cbp-filter-item filter-name" data-filter=".projects">EVENT</div>
              <div class="cbp-filter-item filter-name" data-filter=".images">DESIGN</div>
              <div class="cbp-filter-item filter-name" data-filter=".gallery">TRAVEL</div>
              <div class="cbp-filter-item filter-name" data-filter=".videos">MICE</div>
            </div>
          </div>-->
          <!--/Portfolio Filters -->
          <!-- Portfolio Wrap -->
          <div class="" id="portfolio-wrap">
            <div class="cbp-l-grid-fullScreen cbp cbp-chrome cbp-caption-overlayBottomPush cbp-animation-quicksand cbp-ready cbp-cols-5" id="grid-container" style="height: 570px;">
              <ul class="cbp-wrapper" style="opacity: 1;">
                
                @foreach ($portfolio as $val)
                <li class="cbp-item projects" style="width: 380px; height: 285px; transform: translate3d(0px, 0px, 0px);">
                  <div class="cbp-item-wrapper">
                    <a class="cbp-caption cbp-lightbox"  href="{{$val->image}}">
                      <div class="cbp-caption-defaultWrap">
                        <img alt="" data-no-retina="" src="{{$val->image}}">
                      </div>
                      <div class="cbp-caption-activeWrap color-bg">
                        <div class="cbp-l-caption-alignLeft">
                          <div class="cbp-l-caption-body">
                            <div class="cbp-l-caption-title">{!!$val->lable!!}</div>
                          
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                </li>
                @endforeach

              </ul>
            </div>
          </div><!--/Portfolio Wrap -->
        </div><!--/Portfolio Plus Filters -->
      </section><!-- inner-section:ends -->
    </section>
    @endif

    @if (isset($page['reviews']))
    <section class="page page-section news whitegray-bg" id="reviews" style="overflow: hidden;">
      <div class="container">
          <div class="row">
            <article class="col-md-8 col-md-offset-2 text-center">
              <h1 class="main-title service-ttl black wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;">{{$page['reviews']->title}}</h1>
              <h3 class="main-heading green font2 wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;"><span>{!!$page['reviews']->content!!}</span></h3>
            </article>
          </div>
      </div>
      <div id="carousel1-example-generic" class="carousel slide text-center wow fadeInDown " data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">

          @foreach ($comments as $key=>$val)
            <div class="item @if ($key ==0) active @endif">
              <div class="row">
                <div class="col-xs-8 col-xs-offset-2 col-md-6 col-md-offset-3"><article class="news-post-list">
                  <div class="dark review-text text-left">{!!$val->content!!}</div>
                  <p class="dark font3 review-author text-right">{{$val->user->name}}<br><small>{{$val->user->description}}</small></p>
                </article></div>
              </div>
            </div>
          @endforeach
          
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel1-example-generic" role="button" data-slide="prev">
          <span class="" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel1-example-generic" role="button" data-slide="next">
          <span class="" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <div class="clearfix"></div>
    </section>
    @endif 

    @if (isset($page['reviews']))
    <section class="page page-section contact white-bg" id="contact" style="overflow: hidden;">
      <div class="container">
        <div class="row">
          <article class="col-md-8 col-md-offset-2 text-center">
              <h1 class="main-title service-ttl black wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;">{{$page['reviews']->title}}</h1>
              <h3 class="main-heading green font2 wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;"><span>{!!$page['reviews']->content!!}</span></h3>
          </article>
        </div>
      </div>
      <section class="inner-section dark-bg add-top-half pad-top-half pad-bottom-half contact-triangle">
        <div class="container contact-form-wrap" id="contact-form-wrap">
          <div class="row">
            <article class="col-md-8 col-md-offset-2 main-caps text-center">
              <p class="bluephone wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;">тел. 8 800 444 55 67</p>
              <p class="ultralight-it-18 white wow fadeInDown animated add-bottom-half" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;">Звонок по России бесплатный</p>
              <p class="ultralight-it-18 white wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;">Заполните форму заявки и мы свяжемся с Вами</p><br>
              <article class="col-md-10 col-md-offset-1 main-caps text-center contact-form">
                <h3 class="main-heading modify-heading white font2 wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;"><span>ЗАЯВКА</span></h3>
                <div class="contact-item pad-common">
                  <div class="alert alert-error error color-bg" id="fname" style="display: none;">
                    <p class="white">Поле с именем должно быть заполнено</p>
                  </div>
                  <div class="alert alert-error error color-bg" id="fphone" style="display: none;">
                    <p class="white">Введите корректный телефон</p>
                  </div>
                  <div class="alert alert-error error color-bg" id="femail" style="display: none;">
                    <p class="white">Введите корректный e-mail</p>
                  </div>


                  <form action="/mail/{{$form->name}}?_token={{csrf_token()}}" enctype="multipart/form-data" id="contactForm" method="post" name="myform">
                    
                    @foreach($form->fields as $val)
                      <article>
                      <input class="border-form light wow fadeInDown animated" id="{{$val->name}}" name="{{$val->name}}" placeholder="{{$val->lable}}" size="100" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;" type="text">
                    </article>
                    @endforeach
<!--
                    <article>
                      <input class="border-form light wow fadeInDown animated" id="name" name="name" placeholder="Ваше имя" size="100" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;" type="text">
                    </article>
                    <article>
                      <input class="border-form light wow fadeInDown animated" id="phone" name="phone" placeholder="Ваш телефон" size="30" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;" type="text">
                    </article>
                    <article>
                      <input class="border-form light wow fadeInDown animated" id="email" name="email" placeholder="Ваш email" size="30" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;" type="text">
                    </article>
-->
                    <article>
                      <div class="btn-wrap text-center">
                        <button class="btn btn-adria btn-adria-color wow fadeInDown animated" id="submit" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;" type="submit">ОТПРАВИТЬ</button>
                      </div>
                    </article>
                  </form>

                </div>
              </article>
            </article>
          </div>
        </div>
      </section>

    </section>
    @endif

    <footer class="mastfoot white-bg">
      <div class="container">
        <div class="row">
          <article class="col-md-12 text-center">
            <ul class="foot-social text-center wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown; -webkit-animation-name: fadeInDown;">
              <li><a href="#"><img alt="" src="images/s1.png" title=""></a></li>
              <li><a href="#"><img alt="" src="images/s2.png" title=""></a></li>
              <li><a href="#"><img alt="" src="images/s3.png" title=""></a></li>
            </ul>
            
          </article>
        </div>
      </div>
    </footer>
    <script src="js/jquery.min.js" type="text/javascript"></script> 
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript" src="/bower_components/bootbox/bootbox.js"></script>
  </body>
</html>