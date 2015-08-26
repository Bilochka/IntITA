<?php /* @var $this Controller */
$header = new Header();
?>
<!DOCTYPE html>
<html xmlns:og="http://ogp.me/ns#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">
    <!-- for tabs -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- for tabs -->
    <!-- fonts -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fontface.css"/>
    <!-- fonts -->
    <!-- layouts style -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css"/>
    <!--   hamburger menu style -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/hamburgerMenu.css"/>
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/css/images/favicon.ico" type="image/x-icon"/>
    <!-- jQuery -->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/jquery-1.8.3.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/openDialog.js"></script>
    <!-- jQuery -->
    <!-- passEye, jQuery -->
    <script async type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/jquery.passEye.js"></script>
    <!-- passEye, jQuery -->
    <!-- trimEmail-->
    <script async type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/trimField.js"></script>
    <!-- trimEmail -->
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div id="main-wrapper">
<div id="mainheader">
    <?php //$this->renderPartial('/site/_hamburgermenu'); ?>
    <div id='headerUnderline'>
        <div id="navigation" class="down">
            <div class="main">
                <div id="logo_img" class="down">
                    <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">
                        <img id="logo" src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/Logo_small.png"/>
                    </a>
                </div>
                <div id="lang" class="down">
                    <?php
                    if(Yii::app()->session['lg']==NULL) Yii::app()->session['lg']='ua';
                    foreach (["ua", "en", "ru"] as $val) {
                        ?>
                        <a href="<?php echo Yii::app()->createUrl('site/changeLang', array('lg'=>$val)); ?>" <?php echo (Yii::app()->session['lg'] == $val) ? 'class="selectedLang"' : ''; ?>><?php echo $val; ?></a>
                        <?php
                    }
                    ?>
                </div>
                <div id="enterButton">
                    <div id="button_border" class="down">
                    </div>
                    <?php if (Yii::app()->user->isGuest) {
                        echo CHtml::link($header->getEnterButton(), '#', array('id' => 'enter_button', 'class' => 'down', 'onclick' => 'openSignIn();',));
                    } else {
                        ?>
                        <a id="enter_button" href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/site/logout"
                           class="down"><?php echo $header->getLogoutButton(); ?></a>
                    <?php } ?>
                </div>
                <div id="menulist">
                    <ul>
                        <li><a href="<?php echo Yii::app()->config->get('baseUrl').'/courses'; ?>"><?php echo Yii::t('header', '0016'); ?></a></li>
                        <li><a href="<?php echo Yii::app()->config->get('baseUrl').'/teachers' ; ?>"><?php echo Yii::t('header', '0021'); ?></a></li>
                        <li><a href="<?php echo Yii::app()->config->get('baseUrl').'/graduate' ; ?>"><?php echo Yii::t('header', '0137'); ?></a></li>
                        <li><a href="<?php echo Yii::app()->config->get('baseUrl').'/forum' ; ?>"><?php echo Yii::t('header', '0017'); ?></a></li>
                        <li><a href="<?php echo Yii::app()->config->get('baseUrl').'/aboutus'; ?>"><?php echo Yii::t('header', '0018'); ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main">
    <div style="height: 5px; width: auto"></div>
    <?php if (isset($this->breadcrumbs)): ?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links' => $this->breadcrumbs,
            'homeLink' => CHtml::link(Yii::t('breadcrumbs', '0049'), Yii::app()->request->getBaseUrl(true)),
            'htmlOptions' => array(
                'class' => 'my-cool-breadcrumbs'
            )
        )); ?><!-- breadcrumbs -->
    <?php endif ?>

    <?php if (!Yii::app()->user->isGuest && !(Yii::app()->controller->id == 'site'
            && Yii::app()->controller->action->id == 'index') && !(Yii::app()->controller->id == 'aboutus')
    ) {
        $post = StudentReg::model()->findByPk(Yii::app()->user->id);
        ?>
        <div class="profileStatus">
            <a href="<?php echo Yii::app()->createUrl('/studentreg/profile', array('idUser' => Yii::app()->user->id)); ?>">
                <div>
                    <?php echo $post->nickname; ?></br>
                    <?php echo $post->firstName; ?></br>
                    <?php echo $post->secondName; ?></br>
                    <span style="color: #33cc00; font-size: smaller">&#x25A0; online</span>
                </div>
                <div class="minavatar">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'avatars', $post->avatar); ?>"/>
                </div>
            </a>
        </div>
    <?php
    }
    ?>
</div>
<div id="contentBoxMain">
    <?php echo $content; ?>
<!--    <!--SingIn modal-->
<!--    --><?php
//    $openDialog = false;
//    if (isset($_GET['dialog'])) $openDialog = true;
//    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
//        'id' => 'mydialog',
//        'themeUrl' => Yii::app()->request->baseUrl . '/css',
//        'cssFile' => 'jquery-ui.css',
//        'theme' => 'my',
//        'options' => array(
//            'width' => 540,
//            'autoOpen' => $openDialog,
//            'modal' => true,
//            'resizable' => false
//        ),
//    ));
//    //$this->renderPartial('/site/_signinform');
//    $this->endWidget('zii.widgets.jui.CJuiDialog');
//    ?>
<!--    <!--SignIn modal-->
<!--    <!--forgot pass modal-->
<!--    --><?php
//    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
//        'id' => 'forgotpass',
//        'themeUrl' => Yii::app()->request->baseUrl . '/css',
//        'cssFile' => 'jquery-ui.css',
//        'theme' => 'my',
//        'options' => array(
//            'width' => 540,
//            'autoOpen' => false,
//            'modal' => true,
//            'resizable' => false
//        ),
//    ));
//    $this->renderPartial('/site/_forgotpass');
//    $this->endWidget('zii.widgets.jui.CJuiDialog');
//    ?>
    <!--forgot pass modal-->
</div>
</div>
    <?php $footer = new Footer(); ?>
    <div id="mainfooter">
        <div style="height: 90px;display: block;border-bottom: 1px solid #44bdf6;">
            <div class="footercontent">
                <div class="leftfooter">
                    <table>
                        <tr>
                            <td>
                                <a href="https://twitter.com/INTITA_EDU" target="_blank" title="Twitter">
                                    <img
                                        src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'twitter.png'); ?>"/>
                                </a>
                            </td>
                            <td>
                                <a href="http://youtube.com" target="_blank" title="Youtube">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/youtube.png"/>
                                </a>
                            </td>
                            <td>
                                <a href="https://plus.google.com/u/0/116490432477798418410/posts" target="_blank" title="Google+">
                                    <img
                                        src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'googlePlus.png'); ?>"/>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="https://www.facebook.com/pages/INTITA/320360351410183" target="_blank" title="Facebook">
                                    <img
                                        src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'facebook.png'); ?>"/>
                                </a>
                            </td>
                            <td>
                                <a href="https://www.linkedin.com/company/intita?trk=biz-companies-cym" target="_blank" title="Linkedin">
                                    <img
                                        src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'inl.png'); ?>"/>
                                </a>
                            </td>
                            <td>
                                <a href="http://vk.com/intita" target="_blank" title="Vkontakte">
                                    <img
                                        src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'vkontakte.png'); ?>"/>
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="centerfooter">
                    <div class="footerlogo">
                        <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">
                            <img
                                src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'Logo_small.png'); ?>">
                        </a>
                    </div>
                    <div class="footercontact">
                        <p>
                            <?php echo $footer->getTel(); ?><br/>
                            <?php echo $footer->getMobile(); ?><br/>
                            <?php echo $footer->getEmail(); ?><br/>
                            <?php echo $footer->getSkype(); ?><br/>
                        </p>
                    </div>
                    <div class="footermenu">
                        <ul>
                            <li><a href="<?php echo Yii::app()->config->get('baseUrl').'/courses' ; ?>"><?php echo Yii::t('header', '0016'); ?></a></li>
                            <li><a href="<?php echo Yii::app()->config->get('baseUrl').'/teachers'; ?>"><?php echo Yii::t('header', '0021'); ?></a></li>
                            <li><a href="<?php echo Yii::app()->config->get('baseUrl').'/graduate'; ?>"><?php echo Yii::t('header', '0137'); ?></a></li>
                            <li><a href="<?php echo Yii::app()->config->get('baseUrl').'/forum'; ?>"><?php echo Yii::t('header', '0017'); ?></a></li>
                            <li><a href="<?php echo Yii::app()->config->get('baseUrl').'/aboutus'; ?>"><?php echo Yii::t('header', '0018'); ?></a></li>
                        </ul>
                    </div>
                </div>
                <div class="rightfooter">
                    <a onclick='goUp()' ><img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'go_up.gif'); ?>"></a>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
<!-- Humburger script -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/hamburgermenu.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/goToTop.js"></script>
<div id="rocket">
    <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'rocket.png'); ?>"/>
</div>
<div id="exhaust">
    <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'exhaust.png'); ?>"/>
</div>
</body>
</html>