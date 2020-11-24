# Notas generales

## Comandos de make

> Para generar un model el comando es:

    php artisan make:model Nombre   

> Para generar un controlador el comando es: 

    php artisan make:controller NombreController -r

> Para generar un modelo relacionado a un controlador, el comando es: 

    php artisan make:model Nombre -cr   
    
## Convenciones de nombres

> Cuando utilizamos Eloquent, por convención, asumimos que las tablas van a tener un nombre en plural.  
> En realidad, es más relacionado al modelo, ejemplo:   
> si tenemos una tabla llamada 'regiones' ¿el modelo como debería llamarse?
> Si la respuesta es 'Region', nos encontramos con un problema, Eloquenta asume que la tabla se llama 'regions'.
> ¿cómo se soluciona.  Hay que configurar en el Model un atributo $table:

     protected $table = 'regiones';

> Otro problema con el que nos encontramos, es que Eloquent asume que todas las tablas contienen dos campos para control de actualización y creación.  
> Estos campos son 'updated_at' y 'created_at'. 
> Se puede configurar que estos campos no estás con el atributo 'timestamps'.

    public $timestamps = false;    

> Finalmente, Eloquent asume que el campo primary key en todas las tablas se llama 'id'.
> Y eso se configura con el atributo $primaryKey.  

    protected $primaryKey = 'regID';

