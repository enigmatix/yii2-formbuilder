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
use yii\helpers\Inflector;
use yii\helpers\Json;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;



class FormBuilder extends Widget
{

    protected $pluginDefaults = [
        'dataType'              => 'json',
        'showActionButtons'     => false,
        'disableFields' => [
            'header',
            'paragraph',
            'number',
            'autocomplete',
            'hidden',
            'file',
            'button']
    ];


    var $pluginOptions      = [];

    var $saveButtonSelector = '.form-builder-save';

    var $saveAction         = 'post';

    var $saveUrl;

    var $fieldSelector;

    var $saveMethod         = 'ajax';

    var $formId;

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
        $view->registerJs("window.{$this->getJsID()} = $('#$this->id').formBuilder({$this->getJavascriptOptions()});");
        $view->registerJs($this->prepareSaveMethod());

        FormBuilderAsset::register($view);
    }

    protected function getJavascriptOptions(){

        return Json::encode(ArrayHelper::merge($this->pluginDefaults, $this->pluginOptions));

    }

    public function prepareSaveMethod(){

        $selector           = $this->saveButtonSelector;
        $fieldSelector      = $this->fieldSelector;
        $saveAction         = $this->saveAction;
        $saveUrl            = $this->saveUrl;
        $formBuilderId      = $this->id;
        $method             = $this->saveMethod;
        $jsID               = $this->getJsID();
        $formId             = $this->formId;

        switch ($method){
            case 'field':
                return <<<JS
$('#{$formId}').on('beforeSubmit', function (e) {
	$('{$fieldSelector}').attr('value', window.{$jsID}.formData);
	return true;
});
JS;
                break;
            case 'ajax':
            default:
                return <<<JS
  $("{$selector}").click(function() {
  $.{$saveAction}('{$saveUrl}', window.{$jsID}.formData);
  });
JS;
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

    protected function getJsID(){
        return Inflector::camelize("yii2".$this->id."fb");
    }
}