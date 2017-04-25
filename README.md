[![Dependency Status](https://www.versioneye.com/user/projects/58fec8db710da23fe20fe996/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/58fec8db710da23fe20fe996) [![Total Downloads](https://poser.pugx.org/sctv/bugsnag/downloads)](https://packagist.org/packages/sctv/bugsnag) [![Build Status](https://travis-ci.org/showcase-tv/bugsnag.svg?branch=master)](https://travis-ci.org/showcase-tv/bugsnag)

## 概要
ログ収集サービスのBugsnagをCodeIgniter等に
サクッとインストールして使いたい人向けのPHPスクリプトです。

## インストール方法

### CodeIgniter編

#### Step1: Composerでインストール

`composer.json`に追加します。

```json
{
    "require": {
        "sctv/bugsnag": "*"
    }
}
```

#### Step2: config.phpの変更

`Composer`の`autoload`を有効にします。

```php
$config['composer_autoload'] = TRUE;
```

`hooks`を有効にします。

```php
$config['enable_hooks'] = TRUE;
```

#### Step3: Bugsnagを起動させる

##### 無名関数を利用する方法

`application/config/hooks.php`に下記を追加。

```php
$hook['pre_controller'][] = function () {
    \SCTV\Bugsnag::getInstance()->createClient(ENTER_YOUR_APIKEY);
};
```

##### クラスファイルを作成してそこで起動する方法

`application/config/hooks.php`に下記を追加。
```php
$hook['pre_controller'][] = array(
    'class' => 'BugsnagSetup',
    'function' => 'set_exception_handler',
    'filename' => 'BugsnagSetup.php',
    'filepath' => 'hooks'
);
```

Bugsnagを起動させる`application/hooks/BugsnagSetup.php`を作成。

```php
class BugsnagSetup
{
    public function set_exception_handler()
    {
        \SCTV\Bugsnag::getInstance()->createClient(ENTER_YOUR_APIKEY);
    }
}
```

---

## 使い方

#### Bugsnagのクライアントオブジェクトを取得してみる
```php
$client = \SCTV\Bugsnag::getInstance()->getClient();
```

#### Bugsnagのコンフィグを取得してみる

```php
$config = \SCTV\Bugsnag::getInstance()->getClient()->getConfig();
```

Bugsnagの詳しい使い方は、[https://www.bugsnag.com/](https://www.bugsnag.com/)を参照してください。

