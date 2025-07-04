
# 🛒 Laravel API de Productos y Órdenes



> ⚠️ **Requisito previo**: Debes tener instalado Docker y Docker Compose.  
> Puedes descargarlo desde el sitio oficial:  
> 👉 https://www.docker.com/products/docker-desktop

API REST desarrollada con Laravel para la gestión de productos, órdenes de compra, correos transaccionales y generación de PDF.

---

## 🧰 Tecnologías y versiones

- **Laravel**: 12.x
- **PHP**: 8.3 (apache)
- **Composer**: latest
- **Docker Compose**: 3.9

---

## 🌐 URL de desarrollo

Una vez el contenedor esté en ejecución, puedes acceder al proyecto en:

http://localhost:8085


## 📁 Estructura del proyecto

```
app/
├── Http/
│   └── Controllers/
│       ├── Api/
│           ├── ProductController.php
│           ├── OrderController.php
│           └── PdfController.php
app/
├── Models/
│   ├── Product.php
│   ├── Order.php
│   └── Client.php
resources/
├── views/
│   ├── emails/orders/summary.blade.php
│   └── pdf/order.blade.php
routes/
└── api.php
```

---
## 🔗 Endpoints

| Método | Ruta                  | Descripción                                |
|--------|-----------------------|--------------------------------------------|
| GET    | `/api/products?page=1`       | Listado de productos con paginación y búsqueda por nombre (`?search=`) |
| POST   | `/api/orders`         | Crear una orden con cliente y productos    |
| GET    | `/api/orders/{id}/pdf`| Generar PDF con resumen de la orden        |

---

## ⚙️ Instalación (con Docker)

1. Clona el repositorio:

- ```git clone https://github.com/titoelpropio77/salesapptest.git ```
- ```cd salesapptest ```

2. Construye y levanta los contenedores:

``` docker-compose up --build -d```


2. Accede al contenedor para ejecutar comandos de Laravel:

``` docker exec -it salesapptest-app-1 bash ```

3. Dentro del contenedor, ejecuta los siguientes comandos:

- ``` cp .env.example .env```
- ```composer install```
- ```npm install```
- ```npm run build```
- ```php artisan key:generate```
- ```php artisan migrate``` 
- ```chmod 777 database/database.sqlite ```
- ```chmod 777 .env ```

4. Actualizar ENV:  MAIL_USERNAME  y MAIL_PASSWORD
- Debes actaulizar las env del servicio de correo para el correcto funcionamiento


## 📧 Correo transaccional

Cuando se crea una orden (`POST /api/orders`), se envía automáticamente un correo al cliente con un resumen de su compra.

---

## 📄 Generación de PDF

Puedes descargar un resumen de la orden en PDF desde:  
`GET /api/orders/{order_id}/pdf`



## ✅ Ejemplo de orden

```json
{
  "client": {
    "name": "Ana López",
    "email": "ana@example.com"
  },
  "products": [
    { "id": 1, "quantity": 2 },
    { "id": 5, "quantity": 1 }
  ]
}
```
## 🧪 Ejecutar pruebas

``` php artisan test```


## 📦 Dependencias

Durante el proceso de instalación se requiere ejecutar:

composer install para instalar las dependencias de PHP


## ✍️ Autor
Desarrollado por Modesto Saldaña Michalec
