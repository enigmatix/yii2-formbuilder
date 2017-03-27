<?php
/**
 * Created by PhpStorm.
 * User: joels
 * Date: 27/3/17
 * Time: 9:34 AM
 */

namespace enigmatix\formbuilder;


use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;


class FormBuilder extends Widget
{

    protected $pluginDefaults = [
        'dataType' => 'json',
    ];


    var $pluginOptions = [];

    var $saveAction = 'post';

    public function run() {

        echo Html::tag('div','',['id' => $this->id]);
        
        $this->registerAssets();
    }

    protected function register(){
        $view = $this->view;
        $view->registerJs("$('#$this->id').formBuilder({$this->getJavascriptOptions()});");
        $view->registerJs($this->saveMethod());

        FormBuilderAsset::register($view);
    }

    protected function getJavascriptOptions(){

        return Json::encode(ArrayHelper::merge($this->pluginDefaults, $this->pluginOptions));

    }

    protected function saveMethod(){
        switch ($this->saveAction){
            case 'post':
            default:

                return '
  var saveBtn = document.querySelector(\'.form-builder-save\');
  saveBtn.onclick = function() {
    $.post(\'/\',   $("#'.$this->id.'").data(\'formBuilder\').formData);
  };';
            break;
        }
    }
}