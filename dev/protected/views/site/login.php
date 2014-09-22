<?php
/*
$this->pageCaption = 'Войти';
$this->pageTitle = Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription = "";
$this->breadcrumbs = array( ); */
?>
<style>


</style>
<div class="">
    <div class="form">

        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'users-Login-form',
            'htmlOptions'=>array(
                'class'=>'form-horizontal',
            ),
            'focus'=>array($model,'username'),
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        )); ?>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Авторизуйтесь:</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form">
                                <fieldset>
                                    <div class="form-group" style="padding: 0 15px">
                                        <!--<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>-->
                                        <?php echo $form->textField($model,'username', array('class'=>'form-control', 'placeholder'=>"Логин", 'style' => '')); ?>
                                        <?php echo $form->error($model,'username'); ?>
                                    </div>

                                    <div class="form-group" style="padding: 0 15px">
                                        <!--<input class="form-control" placeholder="Password" name="password" type="password" value="">-->
                                        <?php echo $form->passwordField($model,'password', array('class'=>'form-control','placeholder'=>"Пароль", 'style' => '')); ?>
                                        <?php echo $form->error($model,'password'); ?>
                                    </div>

                                    <div class="checkbox"  style="padding-bottom: 10px">
                                        <label>
                                            <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-success btn-block">Войти</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endWidget();?>

    </div>

</div>
