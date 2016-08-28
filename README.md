# meetup.uy Landing

Listados de eventos de IT en Uruguay

## ¿Cómo contribuir?

Tienes dos formas de contribuir. Si no tienes experiencia programando o no te sientes cómodo editando el código de este repositorio, puedes abrir un issue en github pidiendo que se agregue el evento. La otra forma es creando un pull request.

### Pedir que se agregue o quite un evento

Si no te sientes cómodo editando el código de este repositorio, puedes abrir un issue en github e incluir la información del nuevo evento en el issue.

https://github.com/AV4TAr/meetupuy-landing/issues

```
Subject: Conferencia anual ".NET Conf UY v2016"

Nombre: .NET Conf UY v2016
Lugar: Auditorio de Antel
Fecha: Del 29 Setiembre al 1 de Octubre 2016
Horario: de 9:30 a 18:30,
Costo: U$S 20
Link: http://netconf.uy/
Descripcion: workshops + conferencias + expertos + comunidad
Tags: .net, desarrollo, Microsoft, Mobile, Cloud

Otros links

Twitter: https://twitter.com/NETConfUY
Facebook: https://www.facebook.com/NETConfUY
```

### Crear un Pull Request

Si te sientes cómodo editando el código fuente del sitio, entonces puedes agregar el evento tu mismo creando un Pull Request.

Primero debes hacer un fork del repositorio en Github y clonarlo de forma local.

```
$ git clone https://github.com/<username>/meetupuy-landing.git
```

Cambia `<username>` por tu nombre de usuario, por ejemplo

```
$ git clone https://github.com/san650/meetupuy-landing.git
```

#### Agreagar o quitar un evento

Para agreagar o eliminar un evento debes editar el archivo `include/eventos.inc.php`. Hay dos tipos de eventos, anuales que se almacenan en el array de php `$anuales` y mensuales que se almacenan en el array `$mensuales`.

Debes agregar una nueva entrada en el array correspondiente al tipo de evento que deseas registrar. Por ejemplo

```php
$anuales = array(

  // Comienzo de nuevo evento

  'netconfuy' => array(
    'id' => 'netconf',
    'titulo' => '.NET Conf UY v2016',
    'lugar' => 'Auditorio de Antel',
    'fecha' => '29 Setiembre al 1 de Octubre 2016',
    'horario' => '',
    'costo' => 'U$S 20',
    'link' => 'http://netconf.uy/',
    'descripcion' => 'workshops + conferencias + expertos + comunidad',
    'tags' => '.net, desarrollo, Microsoft, Mobile, Cloud',
    'links_otros' => array(
      array(
        'txt' => '@NETConfUY',
        'uri' => 'https://twitter.com/NETConfUY',
        'alt' => 'twitter'
      ),
      array(
        'txt' => 'Facebook',
        'uri' => 'https://www.facebook.com/NETConfUY',
        'alt' => 'Facebook'
      ),
    ),
  ),

  // fin de nuevo evento

  ...
```

Luego debes probar el cambio de forma local. La forma mas sencilla es generando un HTML. Para esto debes tener instaldo `php` y luego ejecutas

```
$ php index.php > output.html
$ open output.html
```

Luego de revisar los datos haces un commit de los cambios (¡__no__ incluir `output.html`!), subir tus cambios a Github y creas un Pull Request.

```
$ git add include/eventos.inc.php
$ git commit -m 'Add AwesomeConf 2020'
$ git push origin master
```

Y eso es todo! Luego alguien revisará tu pull request, hará merge del mismo y publicará el sitio.

## Copyright

© 2013 Meetup.UY
