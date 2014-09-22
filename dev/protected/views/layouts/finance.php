<!DOCTYPE html>
<html>
<head>
    <title>Whitesquare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        Yii::app()->clientScript->registerCSSFile('/themes/finance/css/styles.css');
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerCoreScript('jquery.ui');
    ?>
    <link href="/themes/finance/css/styles.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Oswald:400,300" rel="stylesheet"> <!--hz-->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script> <!--hz-->
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script> <!--hz-->
    <![endif]-->
</head>
<body>
<div class="wrapper container">
    <header>
        <a href="/">WebTrade.com.ua:</a> Финансы в Украине, банки, курсы валют, предложения обмена валют, новости Украины
        <form name="search" action="#" method="get" class="form-inline form-search pull-right">
            <div class="input-group">
                <label class="sr-only" for="searchInput">Search</label>
                <input class="form-control" id="searchInput" type="text" name="search" placeholder="Search">
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-primary">GO</button>
                </div>
            </div>
        </form>
    </header>
    <nav class="navbar navbar-default">
        <ul class="nav navbar-nav">
            <li><a href="#">Главное</a></li>
            <li class="active"><a href="/about/">Валюты</a></li>
            <li><a href="#"></a></li>
            <li><a href="#">Банки</a></li>
            <li><a href="#">Кредиты</a></li>
            <li><a href="#">Депозиты</a></li>
            <li><a href="#">Индексы</a></li>
            <li><a href="#">Контакты</a></li>
        </ul>
    </nav>
    <div class="heading">
        <h1>About us</h1>
    </div>
    <div class="row">
        <aside class="col-md-7">
            <ul class="list-group submenu">
                <li class="list-group-item active">Lorem ipsum</li>
                <li class="list-group-item"><a href="/donec/">Donec tincidunt laoreet</a></li>
                <li class="list-group-item"><a href="/vestibulum/">Vestibulum elit</a></li>
                <li class="list-group-item"><a href="/etiam/">Etiam pharetra</a></li>
                <li class="list-group-item"><a href="/phasellus/">Phasellus placerat</a></li>
                <li class="list-group-item"><a href="/cras/">Cras et nisi vitae odio</a></li>
            </ul>
            <div class="panel panel-primary">
                <div class="panel-heading">Our offices</div>
                <div class="panel-body">
                    <img src="/themes/finance/images/map.png" class="img-responsive" alt="Our offices">
                </div>
            </div>
        </aside>
        <section class="col-md-17">
            <div class="jumbotron">
                <blockquote>
                    <p>
                        &ldquo;Quisque in enim velit, at dignissim est. nulla ul corper, dolor ac pellentesque
                        placerat, justo tellus gravida erat, vel porttitor libero erat.&rdquo;
                    </p>
                    <small>John Doe, Lorem Ipsum</small>
                </blockquote>
            </div>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non neque ac sem accumsan rhoncus ut
                ut turpis. In hac habitasse platea dictumst. Proin eget nisi erat, et feugiat arcu. Duis semper
                porttitor lectus, ac pharetra erat imperdiet nec. Morbi interdum felis nulla. Aenean eros orci,
                pellentesque sed egestas vitae, auctor aliquam nisi. Nulla nec libero eget sem rutrum iaculis.
                Quisque in enim velit, at dignissim est. Nulla ullamcorper, dolor ac pellentesque placerat, justo
                tellus gravida erat, vel porttitor libero erat condimentum metus. Donec sodales aliquam orci id
                suscipit. Proin sed risus sit amet massa ultrices laoreet quis a erat. Aliquam et metus id erat
                vulputate egestas. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus
                mus.
            </p>
            <p>
                Donec vel nisl nibh. Aenean quam tortor, tempus sit amet mattis dapibus, egestas tempor dui. Duis
                vestibulum imperdiet risus pretium pretium. Nunc vitae porta ligula. Vestibulum sit amet nulla quam.
                Aenean lacinia, ante vitae sodales sagittis, leo felis bibendum neque, mattis sagittis neque urna
                vel magna. Sed at sem vitae lorem blandit feugiat.
            </p>
            <p>
                Donec vel orci purus, ut ornare orci. Aenean rutrum pellentesque quam. Quisque gravida adipiscing
                augue, eget commodo augue egestas varius. Integer volutpat, tellus porta tincidunt sodales, lacus
                est tempus odio, fringilla blandit tortor lectus ut sem. Pellentesque nec sem lacus, sit amet
                consequat neque. Etiam varius urna quis arcu cursus in consectetur dui tincidunt. Quisque arcu orci,
                lacinia eget pretium vel, iaculis pellentesque nibh. Etiam cursus lacus eget neque viverra
                vestibulum. Aliquam erat volutpat. Duis pulvinar tellus ut urna facilisis mollis. Maecenas ac
                pharetra dui. Pellentesque neque ante, luctus eget congue eget, rhoncus vel mauris. Duis nisi magna,
                aliquet a convallis non, venenatis at nisl. Nunc at quam eu magna malesuada dignissim. Duis bibendum
                iaculis felis, eu venenatis risus sodales non. In ligula mi, faucibus eu tristique sed, vulputate
                rutrum dolor.
            </p>
            <div class="row">
                <div class="col-md-12">
                    <img src="/themes/finance/images/about-1.png" alt="" class="thumbnail">
                </div>
                <div class="col-md-12">
                    <img src="/themes/finance/images/about-2.png" alt="" class="thumbnail">
                </div>
            </div>
            <h2>Our team</h2>
            <div class="team">
                <div class="row">
                    <div class="col col-md-4">
                        <img src="/themes/finance/images/team/Doe.jpg" alt="John Doe" class="thumbnail">
                        <div class="caption">
                            <h3>John Doe</h3>
                            <p>ceo</p>
                        </div>
                    </div>
                    <div class="col col-md-4 col-md-offset-1">
                        <img src="/themes/finance/images/team/Pittsley.jpg" alt="Saundra Pittsley" class="thumbnail">
                        <div class="caption">
                            <h3>Saundra Pittsley</h3>
                            <p>team leader</p>
                        </div>
                    </div>
                    <div class="col col-md-4 col-md-offset-1">
                        <img src="/themes/finance/images/team/Simser.jpg" alt="Julio Simser" class="thumbnail">
                        <div class="caption">
                            <h3>Julio Simser</h3>
                            <p>senior developer</p>
                        </div>
                    </div>
                    <div class="col col-md-4 col-md-offset-1">
                        <img src="/themes/finance/images/team/Venuti.jpg" alt="Margery Venuti" class="thumbnail">
                        <div class="caption">
                            <h3>Margery Venuti</h3>
                            <p>senior developer</p>
                        </div>
                    </div>
                    <div class="col col-md-4 col-md-offset-1">
                        <img src="/themes/finance/images/team/Tondrea.jpg" alt="Fernando Tondrea" class="thumbnail">
                        <div class="caption">
                            <h3>Fernando Tondrea</h3>
                            <p>developer</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-4">
                        <img src="/themes/finance/images/team/Nobriga.jpg" alt="Ericka Nobriga" class="thumbnail">
                        <div class="caption">
                            <h3>Ericka Nobriga</h3>
                            <p>art director</p>
                        </div>
                    </div>
                    <div class="col col-md-4 col-md-offset-1">
                        <img src="/themes/finance/images/team/Rousselle.jpg" alt="Cody Rousselle" class="thumbnail">
                        <div class="caption">
                            <h3>Cody Rousselle</h3>
                            <p>senior ui designer</p>
                        </div>
                    </div>
                    <div class="col col-md-4 col-md-offset-1">
                        <img src="/themes/finance/images/team/Wollman.jpg" alt="Erik Wollman" class="thumbnail">
                        <div class="caption">
                            <h3>Erik Wollman</h3>
                            <p>senior ui designer</p>
                        </div>
                    </div>
                    <div class="col col-md-4 col-md-offset-1">
                        <img src="/themes/finance/images/team/Shoff.jpg" alt="Dona Shoff" class="thumbnail">
                        <div class="caption">
                            <h3>Dona Shoff</h3>
                            <p>ux designer</p>
                        </div>
                    </div>
                    <div class="col col-md-4 col-md-offset-1">
                        <img src="/themes/finance/images/team/Brunton.jpg" alt="Darryl Brunton" class="thumbnail">
                        <div class="caption">
                            <h3>Darryl Brunton</h3>
                            <p>ui designer</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-8 twitter">
                <h3>Twitter feed</h3>
                <time datetime="2012-10-23"><a href="#">23 oct</a></time>
                <p>
                    In ultricies pellentesque massa a porta. Aliquam ipsum enim, hendrerit ut porta nec, ullamcorper et nulla. In eget mi dui, sit amet scelerisque nunc. Aenean aug
                </p>
            </div>
            <div class="col-md-4 sitemap">
                <h3>Sitemap</h3>
                <div class="row">
                    <div class="col-md-12">
                        <a href="/home/">Home</a>
                        <a href="/about/">About</a>
                        <a href="/services/">Services</a>
                    </div>
                    <div class="col-md-12">
                        <a href="/partners/">Partners</a>
                        <a href="/customers/">Support</a>
                        <a href="/contact/">Contact</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 social">
                <h3>Social networks</h3>
                <a href="http://twitter.com/" class="social-icon twitter"></a>
                <a href="http://facebook.com/" class="social-icon facebook"></a>
                <a href="http://plus.google.com/" class="social-icon google-plus"></a>
                <a href="http://vimeo.com/" class="social-icon-small vimeo"></a>
                <a href="http://youtube.com/" class="social-icon-small youtube"></a>
                <a href="http://flickr.com/" class="social-icon-small flickr"></a>
                <a href="http://instagram.com/" class="social-icon-small instagram"></a>
                <a href="/rss/" class="social-icon-small rss"></a>
            </div>
            <div class="col-md-8 footer-logo">
                <a href="/"><img src="/themes/finance/images/footer-logo.png" alt="Whitesquare logo"></a>
                <p>
                    Copyright &copy; 2012 Whitesquare. A
                    <a href="http://pcklab.com">pcklab</a> creation
                </p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>