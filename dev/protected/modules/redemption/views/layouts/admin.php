<?php
/**
 * @var $cs CClientScript
 * @var string $content
 */
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta charset="utf-8" />
	<meta name="language" content="ru" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta content="" name="description">
	<meta content="" name="author">

	<title><?= CHtml::encode($this->pageTitle); ?></title>
	<?php
		Yii::app()->clientScript->registerCoreScript('jquery');
		Yii::app()->clientScript->registerCoreScript('jquery.ui');

		Yii::app()->clientScript->registerCSSFile(Yii::app()->theme->baseUrl . '/css/styles.css');
		Yii::app()->clientScript->registerCSSFile(Yii::app()->theme->baseUrl . '/css/bootstrap-theme.min.css');
		Yii::app()->clientScript->registerCSSFile(Yii::app()->theme->baseUrl . '/css/bootstrap.min.css');

		Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap.min.js',CClientScript::POS_END);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/scripts.js',CClientScript::POS_END);


	?>
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="<?=Yii::app()->theme->baseUrl . '/js/html5shiv.js';?>"></script>
			<script src="<?=Yii::app()->theme->baseUrl . '/js/respond.min.js';?>"></script>
		<![endif]-->
        <script type="text/javascript">
            jQuery(document).ready(function($){
                var url = window.location.href;
                var myPageName = '/' +url.substring(url.lastIndexOf('/') + 1);
                $('.nav a[href="'+myPageName+'"]').parent().addClass('active');
            });
        </script>
</head>
<body>
<?php if(!Yii::app()->user->isGuest): ?>
    <div class="container-fluid">
        <div class="row">
            <div class="navbar navbar-inverse">
                <div class="container">
                    <!-- <a class="brand" href="/"><?=CHtml::encode(Yii::app()->name); ?> </a> -->
                    <div class="navbar-header">

                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu">
                            <span class="sr-only">Открыть навигацию</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse" id="responsive-menu">
                        <ul class="nav navbar-nav">
                            <li><a href="">Главное</a></li>
                            <li><a href="news">Статьи</a></li>
                            <li><a href="category">Рубрики</a></li>
                            <?php if(Yii::app()->user->isAdmin == 1): ?><li><a href="editions">Выпуски</a></li><?php endif ?>
                            <li><a href="newsComments">Комментарии <span id="countNewComment" style="color: red"></span></a></li>
                            <li><a href="newsRating">Рейтинг статей</a></li>
                            <?php if(Yii::app()->user->isAdmin == 1): ?><li><a href="users">Пользователи</a></li><?php endif ?>

                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Аналитика <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="http://www.google.com.ua/intl/ru/analytics/" target="_blank">Google Analytics</a></li>
                                </ul>


                            <li class="" style="margin-left: 100px"><a href="#"><?=Yii::app()->user->username ?></a></li>
                            <li class=""><a href="logout">Выйти</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

    <div class="container">
        <?php if (isset($this->breadcrumbs) ): ?>
            <?php
            $this->widget('BsBreadcrumb', array(
                'links' => $this->breadcrumbs,
                'homeLink' => '',
                'separator' => '  ',
            ));
            ?><!-- breadcrumbs -->
        <?php endif ?>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2 hidden-sm hidden-xs"></div>
        </div>
    </div>


    <div class="container">
        <div class="appcontent">
            <div class="row">
                <div class="">
                    <?php echo $content; ?>
                </div>
            </div>
        </div>
    </div> <!-- /container -->


    <footer class="footer">
    </footer>

</body>
</html>