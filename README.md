Yii2 wrapper for the jQuery formBuilder library by Kevin Chappell
=================================================================
A simple wrapper for the jQuery formBuilder.  This package enables the use of the formBuilder via a yii2 widget.  The package does not ship with a copy of the jQuery library.  Instead it is loaded directly via bower.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist enigmatix/yii2-formbuilder "*"
```

or add

```
"enigmatix/yii2-formbuilder": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \enigmatix\formbuilder\AutoloadExample::widget(); ?>```
