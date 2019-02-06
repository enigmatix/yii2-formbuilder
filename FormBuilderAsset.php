<?php
/**
 * Created by PhpStorm.
 * User: Joel Small
 * Date: 13/07/2015
 * Time: 5:29 PM
 */

namespace enigmatix\formbuilder;

use yii\web\AssetBundle;

class FormBuilderAsset extends AssetBundle
{
    public $sourcePath = '@vendor/kevinchappell/form-builder';
    public $css = [
        'src/sass/form-builder.scss',
//        'form-render.min.css',
    ];
    public $js = [
        
        'dist/form-builder.min.js',
//        'form-render.min.js',
    ];
    public $depends = [
        'yii\jui\JuiAsset'
    ];
}
