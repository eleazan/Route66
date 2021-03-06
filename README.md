# Route66

### Description
Route66 is a simple PHP router standalone.

### Usage
Include the file, and, use his methods ```get```, ```post```, ```put``` or ```delete```

You can use with something like

````php
$router = new Route66();

$router->get("/", function() {
  echo 'That\'s the index';
});

$router->get("/blog", function() {
  echo 'Show the blog page';
});

$router->get("/blog/{post_id}", function($post_id) {
  echo 'Show the post: '.$post_id;
});

$router->post("/blog/{post_id}", function($post_id) {
  echo 'Now, we can modify the post: '.$post_id
});

$router->delete("/blog/{post_id}", function($post_id) {
  echo 'We can delete the post: '.$post_id;
});

$router->put("/blog", function() {
  echo 'And this, can be for insert a new post';
});
````

And a .htaccess like
```
<IfModule mod_rewrite.c>
    RewriteEngine On
   
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d

    RewriteRule ^(.*)$ index.php [L]
</IfModule>
```

####Alternative usage

You can use without anonymous functions:
```php
$router = new Route66();

$router->get("/", "Views::Index"); //Calls the Views class, Method Index
//OR
$router->get("/", "viewsIndex"); //Calls the function viewsIndex
```

### Subdirectory

If you are using a subdirectory, you can use ```setPath()``` for avoid conflicts
```php
$router->setPath("/api");
```

### Put & Delete

If your browser doesn't accept these methods, you can do it with a `POST`, and set the variable `_method` to `PUT` or `DELETE`
