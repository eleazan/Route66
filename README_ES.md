# Route66

### Descripción
Route66 es un "router", o "enrutador" simple de PHP

### Uso
Incluye el archivo, y utiliza sus métodos ```get```, ```post```, ```put``` or ```delete```

Puedes usarlo, por ejemplo, algo así

````php
$router = new Route66();

$router->get("/", function() {
  echo 'That\'s the index';
});

$router->get("/blog", function() {
  echo 'Show the blog page';
}

$router->get("/blog/{post_id}", function($post_id) {
  echo 'Show the post: '.$post_id;
}

$router->post("/blog/{post_id}", function($post_id) {
  echo 'Now, we can modify the post: '.$post_id
});

$router->delete("/blog/{post_id}", function($post_id) {
  echo 'We can delete the post: '.$post_id;
});

$router->put("/blog", function() {
  echo 'And this, can be for insert a new post';
}
````
