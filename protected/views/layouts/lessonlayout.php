<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 12.10.2015
 * Time: 19:14
 */
?>
<!DOCTYPE html>
<html xmlns:og="http://ogp.me/ns#">
<head>
    <!--[if lte IE 8]>
    <body class="ie8">
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/json3.min.js'); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.29/angular.min.js"></script>
    <script>
        document.createElement('ng-include');
        document.createElement('ng-switch');
        document.createElement('ng-if');
        document.createElement('ng-pluralize');
        document.createElement('ng-view');

        // needed to enable CSS reference
        document.createElement('ng:view');
    </script>
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="<?php echo Config::getBaseUrl(); ?>">
    <meta name="twitter:image"
          content="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?>">
    <meta property="og:image"
          content="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?>">
    <!-- for tabs -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- for tabs -->
    <!-- fonts -->
    <link rel="stylesheet" href="<?php echo Config::getBaseUrl(); ?>/css/fontface.css"/>
    <!-- fonts -->
    <!-- layouts style -->
    <link rel="stylesheet" type="text/css" href="<?php echo Config::getBaseUrl(); ?>/css/style.css"/>
    <!--   hamburger menu style -->
    <link rel="stylesheet" type="text/css" href="<?php echo Config::getBaseUrl(); ?>/css/hamburgerMenu.css"/>
    <link rel="shortcut icon" href="<?php echo Config::getBaseUrl(); ?>/css/images/favicon.ico" type="image/x-icon"/>
    <script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery-1.8.3.js"></script>
    <script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/openDialog.js"></script>
    <!-- jQuery -->
    <!-- passEye, jQuery -->
    <script async type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery.passEye.js"></script>
    <!-- passEye, jQuery -->
    <!-- trimEmail-->
    <script async type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/trimField.js"></script>
    <!-- trimEmail -->
    <!-- Placeholder for old browser -->
    <script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/placeholder.min.js"></script>
    <!-- Placeholder for old browser -->
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body style="overflow-y: scroll" itemscope itemtype="http://schema.org/Product">

<div id="contentBoxMain">
    <?php echo $content; ?>
    <!--SingIn modal-->
    <?php
    $openDialog = false;
    if (isset($_GET['dialog'])) $openDialog = true;
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'mydialog',
        'themeUrl' => Config::getBaseUrl() . '/css',
        'cssFile' => 'jquery-ui.css',
        'theme' => 'my',
        'options' => array(
            'width' => 540,
            'autoOpen' => $openDialog,
            'modal' => true,
            'resizable' => false
        ),
    ));
    $this->renderPartial('/site/_signinform');
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>
    <!--SignIn modal-->
    <!--forgot pass modal-->
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'forgotpass',
        'themeUrl' => Config::getBaseUrl() . '/css',
        'cssFile' => 'jquery-ui.css',
        'theme' => 'my',
        'options' => array(
            'width' => 540,
            'autoOpen' => false,
            'modal' => true,
            'resizable' => false
        ),
    ));
    $this->renderPartial('/site/_forgotpass');
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>
    <!--forgot pass modal-->
</div>
<!-- footer -->
<!-- Humburger script -->
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/lessonHamburgerMenu.js"></script>
</body>
</html>
