<?php
/**
 * Created by PhpStorm.
 * User: joels
 * Date: 27/3/17
 * Time: 9:34 AM
 */

namespace enigmatix\formbuilder;


use yii\base\Widget;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;



class FormBuilder extends Widget
{

    protected $pluginDefaults = [
        'dataType' => 'json',
    ];


    var $pluginOptions      = [];

    var $saveButtonSelector = '.form-builder-save';

    var $saveAction         = 'post';

    var $saveUrl;
    
    var $controller;
    /**
     * @var ActiveRecord
     */
    var $model;

    public function run() {

        $this->registerAssets();

        return Html::tag('div','',['id' => $this->id]);

    }

    protected function registerAssets(){
        $view = $this->view;
        $view->registerJs("$('#$this->id').formBuilder({$this->getJavascriptOptions()});");
        $view->registerJs($this->prepareSaveMethod($this->saveButtonSelector, $this->saveAction));

        FormBuilderAsset::register($view);
    }

    protected function getJavascriptOptions(){

        return Json::encode(ArrayHelper::merge($this->pluginDefaults, $this->pluginOptions));

    }

    public function prepareSaveMethod($saveButtonSelector, $saveAction){

        $saveUrl            = $this->saveUrl;
        $formId             = $this->id;

        switch ($saveAction){
            case 'post':
            default:

                return '
  $("'.$saveButtonSelector.'").click(function() {
    $.post(\''.$saveUrl.'\',   $("#'.$formId.'").data(\'formBuilder\').formData);
  });';

            break;
        }
    }

    public static function getValueList($values)
    {
        $return = [];

        foreach ($values as $value){
            $return[$value['value']] = $value['label'];
        }

        return $return;
    }
}