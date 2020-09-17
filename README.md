# GESTOR VACACIONES

## Configuración del entorno para desplegar el proyecto
1. Si se desea desplegar el proyecto se debe ejecutar el siguiente comando:

```bash
make deploy
```

2. Si se desea ejecutar los test se debe ejecutar el siguiente comando:

```bash
make php-test
```

3. Si se desea limpiar la caché se debe ejecutar el siguiente comando:

```bash
make clear-cache
```

4. Si se desea levantar el entorno se debe ejecutar el siguiente comando:

```bash
make start
```

5. Si se desea bajar el entorno se debe ejecutar el siguiente comando:

```bash
make stop
```

## Acceso al sistema

Después de desplegar el proyecto correctamente, debe acceder al siguiente enlace

[`http://localhost:8080/login`](http://localhost:8080/login)

Y acceder como administrador con las siguientes credenciales:
* **Email:** admin@admin
* **Password:** admintfm
