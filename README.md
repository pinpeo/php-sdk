Pinpeo API - PHP SDK
========================

Requerimientos
==============

- [PHP >= 5.6](http://www.php.net/)
- [Composer](https://getcomposer.org/)
- [PHP cURL extension](http://php.net/manual/en/book.curl.php)
- [PHP JSON extension](http://php.net/manual/en/book.json.php)

Instalación
===========

## Instalación por Composer

Puede descargar el SDK directamente desde el repositorio de **Composer** con el siguiente comando:

```bash
composer require pinpeo/php-sdk && composer -o dumpautoload
```

O si lo prefiere, puede incluir directamente en su archivo `composer.json` el siguiente código:

```json
{
    "require" : {
        "pinpeo/php-sdk": "*"
    }
}
```

Posteriormente deberá instalar las dependencias usando el siguiente comando:
```bash
composer install
```

## Instalación por Github
Puede descargar alguna de las versiones que hemos publicado aquí:
- [Versiones publicadas en GitHub](https://github.com/pinpeo/pinpeo-php/releases)

O si lo desea puede clonar nuestro repositorio de la siguiente forma:

```bash
# Repositorio en su estado actual (Puede ser una versión inestable)
git clone https://github.com/pinpeo/pinpeo-php.git
```
