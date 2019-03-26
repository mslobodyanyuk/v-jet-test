A task:
=====================
Goal:
-----------------------
It is necessary, in pure PHP, to implement a public mini-blog in which any guest can create records, and other guests have the right to comment on the entries.
Authorization is not needed.
There are two pages in the functional: a list of the last records and one entry.

On the list of the most recent entries, the slider is "popular" from the 5 most commented entries.
Below - entries in the statutory order of publication, which must contain

* author's name,
* short publication text (trimming 100 characters),
* date of publication,
* number of comments and
* a link to go to the full record.

Also on this page there must be a form for sending the publication, which indicates

* username and
* the text of the publication.

The full publication page shows everything the same as in the short publication, only the text of the publication should be complete,
and

* comments on this publication and

The form for adding a new comment is

* the name of the author and
* the text of the publication.

The choice of the way information is stored and the visual component is at the discretion of the candidate.

Provide a task in an open repository, with documentation available for installation and configuration.

Actions on deployment of the project:
-------------------------------------

* configure domain settings `hosts` file, `httpd.conf`.

* make a new database - test_blog for example ( utf8_general_ci encoding )

* database settings in `config/conf.php` file

```php
        $databaseParameters = [
            'host' => "localhost",
            'name' => "root",
            'password' => "",
            'database' => "test_blog"
        ];
```

* folder with uploaded images is set in the same way in the `config/conf.php` file

```php
 $uplPath = $_SERVER['DOCUMENT_ROOT'].'/upl/images/';
``` 

* The database dump is located in the `public` folder.

* useful links: 

[Учим PHP за 1 Час! ► Часть 3 ► Делаем свой блог! #От Профессионала](https://www.youtube.com/watch?v=xihMCwARRpk)

<http://php.net/manual/ru/features.file-upload.post-method.php>

[PHP: function arguments, marker in PHP 5.6](http://php.net/manual/en/functions.arguments.php#example-151)
	
	
[Sanitize Output in PHP - HTMLEntities](https://www.youtube.com/watch?v=ESJTIMD3buM)
	
[PHP Best Practices:Sanitising Output](https://www.youtube.com/watch?v=LM25Sm2z-Mk)

[Sanitize filters](http://php.net/manual/en/filter.filters.sanitize.php)