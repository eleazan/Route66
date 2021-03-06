# Route66

### Descripción
Route66 es un "router", o "enrutador" simple de PHP

### Uso
Incluye el archivo, y utiliza sus métodos ```get```, ```post```, ```put``` or ```delete```

Puedes usarlo, por ejemplo, algo así

````php
$router = new Route66();

$router->get("/", function() {
  echo 'Esto es el indice';
});

$router->get("/blog", function() {
  echo 'Mostrar la página del blog';
});

$router->get("/blog/{post_id}", function($post_id) {
  echo 'Ver el post: '.$post_id;
});

$router->post("/blog/{post_id}", function($post_id) {
  echo 'Aqui podriamos modificar el post: '.$post_id
});

$router->delete("/blog/{post_id}", function($post_id) {
  echo 'Podemos borrar el post: '.$post_id;
});

$router->put("/blog", function() {
  echo 'Y aqui, por ejemplo, insertar un nuevo post';
});
````

Y un .htaccess como este
```
<IfModule mod_rewrite.c>
    RewriteEngine On
   
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d

    RewriteRule ^(.*)$ index.php [L]
</IfModule>
```

####Uso Alternativo

Puedes utilizar el router sin usar funciones anónimas
```php
$router = new Route66();

$router->get("/", "Views::Index"); //Llama a la clase Views, al método estático Index
//OR
$router->get("/", "viewsIndex"); //Llama a la función viewsIndex
```

### Put & Delete

Si el navegador no soporta los métodos `PUT` y `DELETE`, puedes hacerlo con `POST`, y añadiendo la variable `_method` como PUT o `DELETE`
