<?php

namespace planet17\ssu\assets;

use yii\web\AssetBundle;

/**
 * @author Nickolas Lyzhov <7.fast.cookies@gmail.com>
 * @since alpha
 */
class GoogleAsset extends AssetBundle
{
    public $sourcePath = null;
    public $basePath = false;
    public $baseUrl = false;
    public $css = [
        '//fonts.googleapis.com/css?family=Roboto:400,300,100,500,700',
        '//fonts.googleapis.com/icon?family=Material+Icons'
    ];
    public $js = [];
    public $depends = [];
}
