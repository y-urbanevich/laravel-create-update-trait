Create/Update trait to Laravel 5.4 
==========

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require urbanevych/laravel-create-update-trait:"dev-master"
```

or add

```json
"urbanevych/laravel5-create-update-trait" : "dev-master"
```

to the require section of your application's `composer.json` file.

Use case
------------

Add in your model "use Urbanevich\CreatedUpdatedTrait;"

```

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Urbanevich\CreatedUpdatedTrait;

class Posts extends Model
{

 use CreatedUpdatedTrait;

}

```


> [Yaroslav Urbanevych](http://exe.kh.ua) 
