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
          <!--  <li class="active"><a href="/">Главное</a></li>-->
            <?php
            foreach ($this->menu as $key => $val) {
                echo  "\n<li class='" . ($key == $_SERVER['REQUEST_URI'] ? 'active' : '') ."'><a href='" . $key . "'> " . $val . "</a></li>";
            }
            ?>
        </ul>
    </nav>
    <div class="heading">
        <h1>Главное</h1>
    </div>
    <div class="row">
        <aside class="col-md-7">
            <ul class="list-group submenu">
                <?php
                    foreach ($this->cats as $cat) {
                        echo "\n<li class=\"list-group-item\"><a href='/c" . $cat['intCategoryID'] ."'>" . $cat['varTitle'] . "</a></li>";
                    }
                ?>
            </ul>
            <div class="panel panel-primary">
                <div class="panel-heading">Рекламная пауза:</div>
                <div class="panel-body">
                    <!--<img src="/themes/finance/images/map.png" class="img-responsive" alt="Our offices">-->
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- Рекламный блок -->
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:230px;height:230px"
                         data-ad-client="ca-pub-3291548361640840"
                         data-ad-slot="4773311019"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                    </p>
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
                <?php echo $content; ?>
            </p>

            <div class="row">
                <div class="col-md-12">
                    <img src="/themes/finance/images/about-1.png" alt="" class="thumbnail">
                </div>
                <div class="col-md-12">
                    <img src="/themes/finance/images/about-2.png" alt="" class="thumbnail">
                </div>
            </div>


           <!-- <h2>Our team</h2>
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
            </div>-->

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