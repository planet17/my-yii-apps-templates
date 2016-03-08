<?php
namespace planet17\ssu\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Nickolas Lyzhov <7.fast.cookies@gmail.com>
 * @since alpha
 */
class UpAsset extends AssetBundle
{
    /** @var null public $sourcePath = null; */
    public $basePath = '@path-demo-up';
    public $baseUrl = '@link-demo-up';

    public $css = ['css/site.css'];
    public $cssOptions = ['position' => View::POS_HEAD, 'noscript' => false];

    public $js = ['js/sign-up.js'];
    public $jsOptions = ['position' => View::POS_END];

    public $depends = ['planet17\ssu\assets\GoogleAsset', 'yii\web\JqueryAsset'];
}
