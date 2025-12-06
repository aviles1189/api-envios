Arquitectura / Patrón Utilizado

Se utiliza el patrón Strategy + Repository Pattern:

Strategy Pattern:
Cada proveedor implementa QuoteProviderInterface.
El sistema puede agregar más proveedores sin modificar el core.

Repository Pattern (Doctrine):
Permite acceder a shipping_providers de forma limpia.

DTOs y Servicios
Para separar lógica de negocio del controlador.
	

1. Requisitos previos
	Antes de empezar, asegúrate de tener instalados:
	PHP 8.x (compatible con Symfony 6)
	Composer
	MySQL (o MariaDB)
	XAMPP / LAMP / MAMP (para entorno local)
	VS Code u otro IDE

2. Clonar el repositorio https://github.com/aviles1189/api-envios
	git clone https://github.com/aviles1189/api-envios.git

2.1. Entrar al proyecto
	cd api-envios

3. Instalar dependencias con Composer
	composer install

4. Configurar el entorno
	4.1. Modifica las variables de conexión a la base de datos en el archivo .env
	DATABASE_URL="mysql://usuario:contraseña@127.0.0.1:3306/dev_api_envios?serverVersion=10.4.32-MariaDB&charset=utf8mb4"

	Cambia usuario y contraseña por tus credenciales de MySQL.
	dev_api_envios será el nombre de la base de datos.

5. Crear la base de datos dev_api_envios
	php bin/console doctrine:database:create
	Esto creará la base de datos dev_api_envios según lo definido en el .env

6. Crear y ejecutar migraciones
	6.1 Ejecutar migraciones:
	php bin/console doctrine:migrations:migrate

	Symfony preguntará: Are you sure you want to execute the migration? (yes/no)
	Responde yes.
	Esto creará todas las tablas en la base de datos, incluyendo shipping_providers.

7. Cargar datos iniciales (Seeders / Fixtures)
	php bin/console doctrine:fixtures:load

	Symfony preguntará si deseas vaciar la base de datos antes de cargar.
	Responde yes.
	Esto insertará los proveedores definidos en ProviderFixture.php (ProviderA y ProviderB) con sus endpoints y campo active.

8. Probar el endpoint de la API
	Correr el servidor local de Symfony:
	php bin/console server:run


	El servidor levantará la API en:
	http://127.0.0.1:8000

	Probar el endpoint con POST /api/quote usando Postman o curl:

	POST http://127.0.0.1:8000/api/quote

	Body:
	Content-Type: application/json

	{
	    "originZipcode": "97000",
	    "destinationZipcode": "97010"
	}

	Respuesta esperada:
	{
	  "ProviderA": { ... },
	  "ProviderB": { ... }
	}

	La respuesta será un JSON con los resultados de los proveedores activos (ProviderA y ProviderB), incluyendo simulación de éxito o error.