<?php
/**
 * Created by PhpStorm.
 * User: joels
 * Date: 27/3/17
 * Time: 9:34 AM
 */

namespace enigmatix\formbuilder;


use yii\base\Widget;
use yii\helpers\Html;



class FormBuilder extends Widget
{
    public function run() {

        echo Html::tag('div','',['id' => $this->id]);
        
        $this->view->registerJs("jQuery('#$this->id').formBuilder();'");

    }
}