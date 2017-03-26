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
    public $sourcePath = '@vendor/bower/formbuilder/dist';
    public $css = [
        'form-builder.min.css',
        'form-render.min.css',
    ];
    public $js = [
        'form-builder.min.js',
        'form-render.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}