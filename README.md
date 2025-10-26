# 🚀 Backend - Sistema de Gestión de Empleados

## 📋 Descripción
API REST desarrollada en Laravel 10 para la gestión integral de empleados, incluyendo datos personales, laborales y generación de reportes.

---

## 🛠️ Tecnologías Utilizadas

- **Framework**: Laravel 10.49.1
- **PHP**: 8.1 o superior
- **Base de Datos**: MySQL 8.0
- **Almacenamiento**: Sistema de archivos local (storage)
- **Arquitectura**: MVC (Model-View-Controller)

---

## 📁 Estructura del Proyecto

```
GestionEmpleados-Backend/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── Api/
│   │           ├── EmpleadoController.php
│   │           └── ProvinciaController.php
│   └── Models/
│       ├── Empleado.php
│       └── Provincia.php
├── config/
│   └── cors.php
├── database/
│   ├── migrations/
│   │   ├── XXXX_create_provincias_table.php
│   │   └── XXXX_create_empleados_table.php
│   └── seeders/
│       └── ProvinciaSeeder.php
├── routes/
│   └── api.php
├── storage/
│   └── app/
│       └── public/
│           └── empleados/  (fotografías)
└── .env
```

---

## ⚙️ Instalación y Configuración

### **1. Requisitos Previos**
- PHP >= 8.1
- Composer
- MySQL >= 8.0
- Laragon, XAMPP o servidor local

### **2. Clonar/Descargar el Proyecto**
```bash
cd C:\laragon\www
git clone [URL_DEL_REPOSITORIO] GestionEmpleados-Backend
cd GestionEmpleados-Backend
```

### **3. Instalar Dependencias**
```bash
composer install
```

### **4. Configurar Variables de Entorno**
Copia el archivo `.env.example` a `.env`:
```bash
copy .env.example .env
```

Edita el archivo `.env` con tu configuración:
```env
APP_NAME="Gestión de Empleados"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_empleados
DB_USERNAME=root
DB_PASSWORD=
```

### **5. Generar Key de Aplicación**
```bash
php artisan key:generate
```

### **6. Crear Base de Datos**
En HeidiSQL o phpMyAdmin ejecuta:
```sql
CREATE DATABASE gestion_empleados CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### **7. Ejecutar Migraciones**
```bash
php artisan migrate
```

### **8. Ejecutar Seeders (Cargar Provincias)**
```bash
php artisan db:seed --class=ProvinciaSeeder
```

### **9. Crear Enlace Simbólico para Storage**
```bash
php artisan storage:link
```

### **10. Iniciar Servidor**
```bash
php artisan serve
```

El servidor estará disponible en: `http://127.0.0.1:8000`

---

## 🗄️ Estructura de Base de Datos

### **Tabla: provincias**
```sql
CREATE TABLE `provincias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre_provincia` varchar(100) NOT NULL,
  `capital_provincia` varchar(100) NOT NULL,
  `descripcion_provincia` text,
  `poblacion_provincia` decimal(10,2),
  `superficie_provincia` decimal(10,2),
  `latitud_provincia` varchar(20),
  `longitud_provincia` varchar(20),
  `id_region` int,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);
```

### **Tabla: empleados**
```sql
CREATE TABLE `empleados` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `codigo_empleado` varchar(10) UNIQUE NOT NULL,
  -- Datos Personales
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `cedula` varchar(20) UNIQUE NOT NULL,
  `provincia_id` bigint unsigned,
  `fecha_nacimiento` date NOT NULL,
  `email` varchar(150) UNIQUE NOT NULL,
  `observaciones_personales` text,
  `fotografia` varchar(255),
  -- Datos Laborales
  `fecha_ingreso` date NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `departamento` varchar(100) NOT NULL,
  `provincia_laboral_id` bigint unsigned,
  `sueldo` decimal(10,2) NOT NULL,
  `jornada_parcial` tinyint(1) DEFAULT 0,
  `observaciones_laborales` text,
  -- Estado
  `estado` enum('VIGENTE','RETIRADO') DEFAULT 'VIGENTE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`provincia_id`) REFERENCES `provincias`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`provincia_laboral_id`) REFERENCES `provincias`(`id`) ON DELETE SET NULL
);
```

---

## 🔌 Endpoints de la API

### **Base URL**: `http://127.0.0.1:8000/api`

---

## 📍 PROVINCIAS

### **1. Listar todas las provincias**

**Endpoint:**
```
GET /api/provincias
```

**Ejemplo de uso en Postman:**
```
Método: GET
URL: http://127.0.0.1:8000/api/provincias
Headers: (ninguno necesario)
Body: (ninguno)
```

**Respuesta exitosa (200)**:
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "nombre_provincia": "Azuay",
      "capital_provincia": "Cuenca"
    },
    {
      "id": 2,
      "nombre_provincia": "Bolívar",
      "capital_provincia": "Guaranda"
    },
    {
      "id": 19,
      "nombre_provincia": "Pichincha",
      "capital_provincia": "Quito"
    },
    ...
  ],
  "message": "Provincias obtenidas exitosamente"
}
```

---

### **2. Obtener una provincia específica**

**Endpoint:**
```
GET /api/provincias/{id}
```

**Ejemplo de uso en Postman:**
```
Método: GET
URL: http://127.0.0.1:8000/api/provincias/10
Headers: (ninguno necesario)
Body: (ninguno)
```

**Respuesta exitosa (200)**:
```json
{
  "success": true,
  "data": {
    "id": 10,
    "nombre_provincia": "Guayas",
    "capital_provincia": "Guayaquil",
    "descripcion_provincia": "Es el mayor centro comercial e industrial del Ecuador. Con sus 3,8 millones de habitantes, Guayas es la provincia más poblada del país...",
    "poblacion_provincia": "2526927.00",
    "superficie_provincia": "17139.00",
    "latitud_provincia": "-2.2",
    "longitud_provincia": "-79.9667",
    "id_region": 2,
    "created_at": "2025-10-21T10:00:00.000000Z",
    "updated_at": "2025-10-21T10:00:00.000000Z"
  },
  "message": "Provincia encontrada"
}
```

---

## 👥 EMPLEADOS

### **1. Listar todos los empleados**

**Endpoint:**
```
GET /api/empleados
```

**Ejemplo de uso en Postman:**
```
Método: GET
URL: http://127.0.0.1:8000/api/empleados
Headers: (ninguno necesario)
Body: (ninguno)
```

**Respuesta exitosa (200)**:
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "codigo_empleado": "00145",
        "nombres": "Jeyner Alexander",
        "apellidos": "Manzaba Torres",
        "cedula": "1315789456",
        "provincia_id": 10,
        "fecha_nacimiento": "1992-05-15",
        "email": "jeyner.manzaba@provedatos.com",
        "observaciones_personales": "Empleado destacado con excelente desempeño",
        "fotografia": "empleados/jeyner_foto.jpg",
        "fecha_ingreso": "2020-03-10",
        "cargo": "Desarrollador Full Stack Senior",
        "departamento": "Tecnología",
        "provincia_laboral_id": 10,
        "sueldo": "1850.00",
        "jornada_parcial": false,
        "observaciones_laborales": "Especialista en Laravel, Angular y bases de datos",
        "estado": "VIGENTE",
        "created_at": "2025-10-21T10:30:00.000000Z",
        "updated_at": "2025-10-21T10:30:00.000000Z",
        "provincia_residencia": {
          "id": 10,
          "nombre_provincia": "Guayas",
          "capital_provincia": "Guayaquil"
        },
        "provincia_laboral": {
          "id": 10,
          "nombre_provincia": "Guayas",
          "capital_provincia": "Guayaquil"
        }
      }
    ],
    "per_page": 20,
    "total": 1,
    "last_page": 1
  },
  "message": "Empleados obtenidos exitosamente"
}
```

---

### **2. Buscar empleados por nombre o código**

**Endpoint:**
```
GET /api/empleados?search={término}
```

**Ejemplo de uso en Postman:**
```
Método: GET
URL: http://127.0.0.1:8000/api/empleados?search=Jeyner
Headers: (ninguno necesario)
Body: (ninguno)
```

**Parámetros Query disponibles:**
- `search`: Busca por nombres, apellidos o código de empleado
- `estado`: Filtra por "VIGENTE" o "RETIRADO"
- `per_page`: Número de registros por página (default: 20)

**Otros ejemplos:**
```
http://127.0.0.1:8000/api/empleados?search=Manzaba
http://127.0.0.1:8000/api/empleados?search=00145
http://127.0.0.1:8000/api/empleados?estado=VIGENTE
http://127.0.0.1:8000/api/empleados?search=Jeyner&estado=VIGENTE&per_page=10
```

---

### **3. Crear nuevo empleado SIN fotografía**

**Endpoint:**
```
POST /api/empleados
```

**Ejemplo de uso en Postman:**
```
Método: POST
URL: http://127.0.0.1:8000/api/empleados
Headers: (Postman lo configura automáticamente para form-data)
Body: form-data (seleccionar esta opción en Postman)
```

**Body (Form-data) - Ejemplo con Jeyner Manzaba:**
```
KEY                          | VALUE
-----------------------------|-----------------------------------------
nombres                      | Jeyner Alexander
apellidos                    | Manzaba Torres
cedula                       | 1315789456
provincia_id                 | 10
fecha_nacimiento             | 1992-05-15
email                        | jeyner.manzaba@provedatos.com
observaciones_personales     | Empleado destacado con excelente desempeño
fecha_ingreso                | 2020-03-10
cargo                        | Desarrollador Full Stack Senior
departamento                 | Tecnología
provincia_laboral_id         | 10
sueldo                       | 1850.00
jornada_parcial              | false
observaciones_laborales      | Especialista en Laravel, Angular y bases de datos
```

**Respuesta exitosa (201)**:
```json
{
  "success": true,
  "data": {
    "id": 1,
    "codigo_empleado": "00145",
    "nombres": "Jeyner Alexander",
    "apellidos": "Manzaba Torres",
    "cedula": "1315789456",
    "provincia_id": 10,
    "fecha_nacimiento": "1992-05-15",
    "email": "jeyner.manzaba@provedatos.com",
    "observaciones_personales": "Empleado destacado con excelente desempeño",
    "fotografia": null,
    "fecha_ingreso": "2020-03-10",
    "cargo": "Desarrollador Full Stack Senior",
    "departamento": "Tecnología",
    "provincia_laboral_id": 10,
    "sueldo": "1850.00",
    "jornada_parcial": false,
    "observaciones_laborales": "Especialista en Laravel, Angular y bases de datos",
    "estado": "VIGENTE",
    "created_at": "2025-10-21T10:30:00.000000Z",
    "updated_at": "2025-10-21T10:30:00.000000Z",
    "provincia_residencia": {
      "id": 10,
      "nombre_provincia": "Guayas",
      "capital_provincia": "Guayaquil"
    },
    "provincia_laboral": {
      "id": 10,
      "nombre_provincia": "Guayas",
      "capital_provincia": "Guayaquil"
    }
  },
  "message": "Empleado creado exitosamente"
}
```

**Respuesta error validación (422)**:
```json
{
  "success": false,
  "message": "Error de validación",
  "errors": {
    "email": ["El campo email ya ha sido registrado."],
    "cedula": ["El campo cedula ya ha sido registrado."]
  }
}
```

---

### **4. Crear nuevo empleado CON fotografía**

**Endpoint:**
```
POST /api/empleados
```

**Ejemplo de uso en Postman:**
```
Método: POST
URL: http://127.0.0.1:8000/api/empleados
Headers: (Postman lo configura automáticamente para form-data)
Body: form-data (seleccionar esta opción en Postman)
```

**Body (Form-data) - Ejemplo con María Fernández:**
```
KEY                          | TYPE  | VALUE
-----------------------------|-------|------------------------------------------
nombres                      | Text  | María Fernanda
apellidos                    | Text  | Fernández Salazar
cedula                       | Text  | 0924567890
provincia_id                 | Text  | 10
fecha_nacimiento             | Text  | 1995-08-22
email                        | Text  | maria.fernandez@provedatos.com
observaciones_personales     | Text  | Profesional responsable y comprometida
fotografia                   | File  | [Seleccionar archivo de imagen desde tu PC]
fecha_ingreso                | Text  | 2022-06-15
cargo                        | Text  | Analista de Datos
departamento                 | Text  | Business Intelligence
provincia_laboral_id         | Text  | 10
sueldo                       | Text  | 1350.00
jornada_parcial              | Text  | false
observaciones_laborales      | Text  | Experta en SQL y visualización de datos
```

**IMPORTANTE**: Para el campo `fotografia`:
1. En Postman, cambia el tipo de "Text" a "File"
2. Haz click en "Select Files"
3. Elige una imagen JPG, PNG o GIF (máximo 2MB)

**Respuesta exitosa (201)**:
```json
{
  "success": true,
  "data": {
    "id": 2,
    "codigo_empleado": "00289",
    "nombres": "María Fernanda",
    "apellidos": "Fernández Salazar",
    "cedula": "0924567890",
    "provincia_id": 10,
    "fecha_nacimiento": "1995-08-22",
    "email": "maria.fernandez@provedatos.com",
    "observaciones_personales": "Profesional responsable y comprometida",
    "fotografia": "empleados/Xh8kP9mN2lQ4rT6vB1wY.jpg",
    "fecha_ingreso": "2022-06-15",
    "cargo": "Analista de Datos",
    "departamento": "Business Intelligence",
    "provincia_laboral_id": 10,
    "sueldo": "1350.00",
    "jornada_parcial": false,
    "observaciones_laborales": "Experta en SQL y visualización de datos",
    "estado": "VIGENTE",
    "created_at": "2025-10-21T11:00:00.000000Z",
    "updated_at": "2025-10-21T11:00:00.000000Z",
    "provincia_residencia": {
      "id": 10,
      "nombre_provincia": "Guayas",
      "capital_provincia": "Guayaquil"
    },
    "provincia_laboral": {
      "id": 10,
      "nombre_provincia": "Guayas",
      "capital_provincia": "Guayaquil"
    }
  },
  "message": "Empleado creado exitosamente"
}
```

---

### **5. Obtener un empleado específico por ID**

**Endpoint:**
```
GET /api/empleados/{id}
```

**Ejemplo de uso en Postman:**
```
Método: GET
URL: http://127.0.0.1:8000/api/empleados/1
Headers: (ninguno necesario)
Body: (ninguno)
```

**Respuesta exitosa (200)**:
```json
{
  "success": true,
  "data": {
    "id": 1,
    "codigo_empleado": "00145",
    "nombres": "Jeyner Alexander",
    "apellidos": "Manzaba Torres",
    "cedula": "1315789456",
    "provincia_id": 10,
    "fecha_nacimiento": "1992-05-15",
    "email": "jeyner.manzaba@provedatos.com",
    "observaciones_personales": "Empleado destacado con excelente desempeño",
    "fotografia": "empleados/jeyner_foto.jpg",
    "fecha_ingreso": "2020-03-10",
    "cargo": "Desarrollador Full Stack Senior",
    "departamento": "Tecnología",
    "provincia_laboral_id": 10,
    "sueldo": "1850.00",
    "jornada_parcial": false,
    "observaciones_laborales": "Especialista en Laravel, Angular y bases de datos",
    "estado": "VIGENTE",
    "created_at": "2025-10-21T10:30:00.000000Z",
    "updated_at": "2025-10-21T10:30:00.000000Z",
    "provincia_residencia": {
      "id": 10,
      "nombre_provincia": "Guayas",
      "capital_provincia": "Guayaquil"
    },
    "provincia_laboral": {
      "id": 10,
      "nombre_provincia": "Guayas",
      "capital_provincia": "Guayaquil"
    }
  },
  "message": "Empleado encontrado"
}
```

**Respuesta error (404)**:
```json
{
  "success": false,
  "message": "Empleado no encontrado"
}
```

---

### **6. Actualizar empleado (Promoción de Jeyner)**

**Endpoint:**
```
POST /api/empleados/{id}
```

**NOTA**: Usamos POST en lugar de PUT para poder enviar FormData con imágenes.

**Ejemplo de uso en Postman:**
```
Método: POST
URL: http://127.0.0.1:8000/api/empleados/1
Headers: (Postman lo configura automáticamente para form-data)
Body: form-data
```

**Body (Form-data) - Ejemplo actualizando cargo y sueldo de Jeyner:**
```
KEY                          | VALUE
-----------------------------|-----------------------------------------
nombres                      | Jeyner Alexander
apellidos                    | Manzaba Torres
cedula                       | 1315789456
provincia_id                 | 10
fecha_nacimiento             | 1992-05-15
email                        | jeyner.manzaba@provedatos.com
observaciones_personales     | Empleado destacado con excelente desempeño
fecha_ingreso                | 2020-03-10
cargo                        | Tech Lead - Arquitecto de Software
departamento                 | Tecnología
provincia_laboral_id         | 10
sueldo                       | 2500.00
jornada_parcial              | false
observaciones_laborales      | Promovido a Tech Lead por liderazgo y conocimientos técnicos
estado                       | VIGENTE
```

**IMPORTANTE**: 
- Debes enviar TODOS los campos, incluso los que no cambies
- El campo `codigo_empleado` NO se puede modificar
- Si quieres cambiar la foto, agrega el campo `fotografia` de tipo File

**Respuesta exitosa (200)**:
```json
{
  "success": true,
  "data": {
    "id": 1,
    "codigo_empleado": "00145",
    "nombres": "Jeyner Alexander",
    "apellidos": "Manzaba Torres",
    "cargo": "Tech Lead - Arquitecto de Software",
    "sueldo": "2500.00",
    "observaciones_laborales": "Promovido a Tech Lead por liderazgo y conocimientos técnicos",
    "estado": "VIGENTE",
    ...
  },
  "message": "Empleado actualizado exitosamente"
}
```

---

### **7. Cambiar estado del empleado a RETIRADO**

**Endpoint:**
```
POST /api/empleados/{id}
```

**Ejemplo de uso en Postman:**
```
Método: POST
URL: http://127.0.0.1:8000/api/empleados/2
Headers: (Postman lo configura automáticamente para form-data)
Body: form-data
```

**Body (Form-data) - Ejemplo retirando a María:**
```
KEY                          | VALUE
-----------------------------|-----------------------------------------
nombres                      | María Fernanda
apellidos                    | Fernández Salazar
cedula                       | 0924567890
provincia_id                 | 10
fecha_nacimiento             | 1995-08-22
email                        | maria.fernandez@provedatos.com
observaciones_personales     | Profesional responsable y comprometida
fecha_ingreso                | 2022-06-15
cargo                        | Analista de Datos
departamento                 | Business Intelligence
provincia_laboral_id         | 10
sueldo                       | 1350.00
jornada_parcial              | false
observaciones_laborales      | Empleada retirada - Renuncia voluntaria
estado                       | RETIRADO
```

**Respuesta exitosa (200)**:
```json
{
  "success": true,
  "data": {
    "id": 2,
    "codigo_empleado": "00289",
    "nombres": "María Fernanda",
    "apellidos": "Fernández Salazar",
    "estado": "RETIRADO",
    "observaciones_laborales": "Empleada retirada - Renuncia voluntaria",
    ...
  },
  "message": "Empleado actualizado exitosamente"
}
```

---

### **8. Eliminar empleado (Soft Delete)**

**Endpoint:**
```
DELETE /api/empleados/{id}
```

**Ejemplo de uso en Postman:**
```
Método: DELETE
URL: http://127.0.0.1:8000/api/empleados/2
Headers: (ninguno necesario)
Body: (ninguno)
```

**Respuesta exitosa (200)**:
```json
{
  "success": true,
  "message": "Empleado eliminado exitosamente"
}
```

**NOTA**: Este es un "soft delete", el registro NO se elimina físicamente de la base de datos, solo se marca como eliminado con un timestamp en `deleted_at`.

---

### **9. Generar Reporte General de Empleados**

**Endpoint:**
```
GET /api/empleados/reporte
```

**Ejemplo de uso en Postman:**
```
Método: GET
URL: http://127.0.0.1:8000/api/empleados/reporte
Headers: (ninguno necesario)
Body: (ninguno)
```

**Respuesta exitosa (200)**:
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "codigo_empleado": "00145",
      "nombres": "Jeyner Alexander",
      "apellidos": "Manzaba Torres",
      "cedula": "1315789456",
      "provincia_id": 10,
      "fecha_nacimiento": "1992-05-15",
      "email": "jeyner.manzaba@provedatos.com",
      "observaciones_personales": "Empleado destacado con excelente desempeño",
      "fotografia": "empleados/jeyner_foto.jpg",
      "fecha_ingreso": "2020-03-10",
      "cargo": "Tech Lead - Arquitecto de Software",
      "departamento": "Tecnología",
      "provincia_laboral_id": 10,
      "sueldo": "2500.00",
      "jornada_parcial": false,
      "observaciones_laborales": "Promovido a Tech Lead por liderazgo y conocimientos técnicos",
      "estado": "VIGENTE",
      "created_at": "2025-10-21T10:30:00.000000Z",
      "updated_at": "2025-10-21T15:45:00.000000Z",
      "provincia_residencia": {
        "id": 10,
        "nombre_provincia": "Guayas",
        "capital_provincia": "Guayaquil"
      },
      "provincia_laboral": {
        "id": 10,
        "nombre_provincia": "Guayas",
        "capital_provincia": "Guayaquil"
      }
    },
    {
      "id": 3,
      "codigo_empleado": "00312",
      "nombres": "Carlos Alberto",
      "apellidos": "Mendoza Vargas",
      ...
    }
  ],
  "total": 2,
  "message": "Reporte generado exitosamente"
}
```

---

## ⚠️ Validaciones y Reglas de Negocio

### **Campos Requeridos:**
- ✅ nombres
- ✅ apellidos
- ✅ cedula (única)
- ✅ fecha_nacimiento (debe ser menor a hoy)
- ✅ email (único, formato válido)
- ✅ fecha_ingreso
- ✅ cargo
- ✅ departamento
- ✅ sueldo (numérico, mínimo 0)
- ✅ jornada_parcial (true/false)

### **Campos Opcionales:**
- provincia_id
- observaciones_personales
- fotografia
- provincia_laboral_id
- observaciones_laborales

### **Restricciones:**
- Email: formato válido (ejemplo@dominio.com)
- Cédula: máximo 20 caracteres, única
- Fotografía: JPG, PNG, GIF - máximo 2MB
- Estado: solo "VIGENTE" o "RETIRADO"
- Código empleado: se genera automáticamente, NO modificable

---

## 🧪 Códigos de Estado HTTP

| Código | Descripción |
|--------|-------------|
| 200 | OK - Solicitud exitosa |
| 201 | Created - Recurso creado exitosamente |
| 404 | Not Found - Recurso no encontrado |
| 422 | Unprocessable Entity - Error de validación |
| 500 | Internal Server Error - Error del servidor |

---

## 📝 Características Implementadas

### ✅ Validaciones
- Validación de emails (formato correcto)
- Validación de cédula (solo números, único)
- Validación de fechas (formato correcto)
- Validación de archivos (tipo imagen, tamaño máximo 2MB)
- Campos únicos (email, cédula, código empleado)

### ✅ Funcionalidades
- Generación automática de código de empleado único
- Paginación de resultados (20 por página)
- Búsqueda por nombre, apellido o código
- Filtro por estado (VIGENTE/RETIRADO)
- Carga de imágenes (fotografías)
- Soft Delete (eliminación lógica)
- Relaciones entre tablas (Foreign Keys)

### ✅ Buenas Prácticas
- Arquitectura MVC
- Prepared Statements (prevención SQL Injection)
- Respuestas JSON estandarizadas
- Manejo de errores con try-catch
- CORS configurado
- Validación lado servidor
- Codificación UTF-8

---

## 🧪 Guía de Pruebas con Postman

### **Paso a Paso para Probar la API**

#### **PASO 1: Verificar Provincias** 🗺️

**1.1 - Listar todas las provincias**
```
GET http://127.0.0.1:8000/api/provincias
```
✅ Debe retornar 24 provincias del Ecuador

**1.2 - Obtener provincia de Guayas**
```
GET http://127.0.0.1:8000/api/provincias/10
```
✅ Debe retornar la provincia de Guayas con capital Guayaquil

---

#### **PASO 2: Crear Primer Empleado (Jeyner Manzaba)** 👤

**2.1 - Crear empleado SIN foto**
```
POST http://127.0.0.1:8000/api/empleados
Body: form-data

nombres: Jeyner Alexander
apellidos: Manzaba Torres
cedula: 1315789456
provincia_id: 10
fecha_nacimiento: 1992-05-15
email: jeyner.manzaba@provedatos.com
observaciones_personales: Empleado destacado con excelente desempeño
fecha_ingreso: 2020-03-10
cargo: Desarrollador Full Stack Senior
departamento: Tecnología
provincia_laboral_id: 10
sueldo: 1850.00
jornada_parcial: false
observaciones_laborales: Especialista en Laravel, Angular y bases de datos
```
✅ Debe retornar status 201 y generar un código automático (ejemplo: "00145")
✅ Guarda el ID del empleado creado para las siguientes pruebas

---

#### **PASO 3: Verificar que el Empleado fue Creado** ✔️

**3.1 - Listar todos los empleados**
```
GET http://127.0.0.1:8000/api/empleados
```
✅ Debe mostrar 1 empleado en la lista

**3.2 - Obtener empleado por ID**
```
GET http://127.0.0.1:8000/api/empleados/1
```
✅ Debe retornar los datos completos de Jeyner Manzaba

---

#### **PASO 4: Probar Búsquedas y Filtros** 🔍

**4.1 - Buscar por nombre**
```
GET http://127.0.0.1:8000/api/empleados?search=Jeyner
```
✅ Debe encontrar a Jeyner Manzaba

**4.2 - Buscar por apellido**
```
GET http://127.0.0.1:8000/api/empleados?search=Manzaba
```
✅ Debe encontrar a Jeyner Manzaba

**4.3 - Buscar por código (usa el código generado)**
```
GET http://127.0.0.1:8000/api/empleados?search=00145
```
✅ Debe encontrar a Jeyner Manzaba

**4.4 - Filtrar por estado VIGENTE**
```
GET http://127.0.0.1:8000/api/empleados?estado=VIGENTE
```
✅ Debe mostrar a Jeyner Manzaba

---

#### **PASO 5: Crear Segundo Empleado CON Foto** 📸

**5.1 - Crear empleado con fotografía**
```
POST http://127.0.0.1:8000/api/empleados
Body: form-data

nombres: María Fernanda
apellidos: Fernández Salazar
cedula: 0924567890
provincia_id: 10
fecha_nacimiento: 1995-08-22
email: maria.fernandez@provedatos.com
observaciones_personales: Profesional responsable y comprometida
fotografia: [Selecciona una imagen JPG/PNG desde tu PC]
fecha_ingreso: 2022-06-15
cargo: Analista de Datos
departamento: Business Intelligence
provincia_laboral_id: 10
sueldo: 1350.00
jornada_parcial: false
observaciones_laborales: Experta en SQL y visualización de datos
```

**IMPORTANTE**: 
- En Postman, el campo `fotografia` debe ser de tipo "File"
- Selecciona una imagen de tu PC (máximo 2MB)

✅ Debe retornar status 201 con el path de la imagen guardada
✅ La imagen se guarda en `storage/app/public/empleados/`

---

#### **PASO 6: Actualizar Empleado (Promoción)** 📈

**6.1 - Promover a Jeyner Manzaba**
```
POST http://127.0.0.1:8000/api/empleados/1
Body: form-data

nombres: Jeyner Alexander
apellidos: Manzaba Torres
cedula: 1315789456
provincia_id: 10
fecha_nacimiento: 1992-05-15
email: jeyner.manzaba@provedatos.com
observaciones_personales: Empleado destacado con excelente desempeño
fecha_ingreso: 2020-03-10
cargo: Tech Lead - Arquitecto de Software
departamento: Tecnología
provincia_laboral_id: 10
sueldo: 2500.00
jornada_parcial: false
observaciones_laborales: Promovido a Tech Lead por liderazgo y conocimientos técnicos
estado: VIGENTE
```
✅ Debe actualizar el cargo y sueldo
✅ El código de empleado NO debe cambiar

---

#### **PASO 7: Cambiar Estado a RETIRADO** 🚪

**7.1 - Retirar a María Fernández**
```
POST http://127.0.0.1:8000/api/empleados/2
Body: form-data

(Envía TODOS los campos con estado: RETIRADO)
nombres: María Fernanda
apellidos: Fernández Salazar
cedula: 0924567890
provincia_id: 10
fecha_nacimiento: 1995-08-22
email: maria.fernandez@provedatos.com
observaciones_personales: Profesional responsable y comprometida
fecha_ingreso: 2022-06-15
cargo: Analista de Datos
departamento: Business Intelligence
provincia_laboral_id: 10
sueldo: 1350.00
jornada_parcial: false
observaciones_laborales: Empleada retirada - Renuncia voluntaria
estado: RETIRADO
```
✅ Debe cambiar el estado a RETIRADO

**7.2 - Verificar filtro de retirados**
```
GET http://127.0.0.1:8000/api/empleados?estado=RETIRADO
```
✅ Debe mostrar solo a María Fernández

---

#### **PASO 8: Generar Reporte General** 📊

**8.1 - Obtener reporte completo**
```
GET http://127.0.0.1:8000/api/empleados/reporte
```
✅ Debe mostrar TODOS los empleados (VIGENTES y RETIRADOS)
✅ Debe incluir todos los datos completos y relaciones con provincias

---

#### **PASO 9: Probar Validaciones (Errores Esperados)** ❌

**9.1 - Intentar crear empleado con email duplicado**
```
POST http://127.0.0.1:8000/api/empleados
Body: form-data

email: jeyner.manzaba@provedatos.com
(y otros campos requeridos)
```
❌ Debe retornar status 422 con error: "El campo email ya ha sido registrado"

**9.2 - Intentar crear empleado con cédula duplicada**
```
POST http://127.0.0.1:8000/api/empleados
Body: form-data

cedula: 1315789456
(y otros campos requeridos)
```
❌ Debe retornar status 422 con error: "El campo cedula ya ha sido registrado"

**9.3 - Crear empleado sin campos requeridos**
```
POST http://127.0.0.1:8000/api/empleados
Body: form-data

nombres: Juan
(faltan campos requeridos)
```
❌ Debe retornar status 422 con múltiples errores de validación

**9.4 - Email con formato inválido**
```
POST http://127.0.0.1:8000/api/empleados
Body: form-data

email: esto-no-es-un-email
(y otros campos)
```
❌ Debe retornar status 422 con error: "El campo email debe ser una dirección válida"

---

#### **PASO 10: Eliminar Empleado (Opcional)** 🗑️

**10.1 - Soft delete de empleado**
```
DELETE http://127.0.0.1:8000/api/empleados/2
```
✅ Debe retornar status 200
✅ El registro NO se borra físicamente, solo se marca con `deleted_at`

**10.2 - Verificar que ya no aparece en listado**
```
GET http://127.0.0.1:8000/api/empleados
```
✅ NO debe mostrar el empleado eliminado

---

## ✅ Checklist de Pruebas Completadas

Marca cada prueba realizada:

### **Provincias**
- [ ] Listar 24 provincias
- [ ] Obtener provincia por ID (Guayas ID=10)

### **Empleados - CRUD**
- [ ] Crear empleado sin foto (Jeyner Manzaba)
- [ ] Crear empleado con foto (María Fernández)
- [ ] Listar empleados
- [ ] Obtener empleado por ID
- [ ] Actualizar empleado (promoción de Jeyner)
- [ ] Cambiar estado a RETIRADO
- [ ] Eliminar empleado

### **Búsquedas y Filtros**
- [ ] Buscar por nombre
- [ ] Buscar por apellido
- [ ] Buscar por código
- [ ] Filtrar por estado VIGENTE
- [ ] Filtrar por estado RETIRADO

### **Reporte**
- [ ] Generar reporte general

### **Validaciones**
- [ ] Email duplicado (debe fallar)
- [ ] Cédula duplicada (debe fallar)
- [ ] Campos requeridos faltantes (debe fallar)
- [ ] Email inválido (debe fallar)
- [ ] Imagen muy grande >2MB (debe fallar)

---

## 📊 Datos de Prueba Adicionales

Si necesitas crear más empleados para pruebas, aquí hay algunos ejemplos:

### **Empleado 3: Carlos Mendoza**
```
nombres: Carlos Alberto
apellidos: Mendoza Vargas
cedula: 1720345678
provincia_id: 19
fecha_nacimiento: 1988-11-30
email: carlos.mendoza@provedatos.com
fecha_ingreso: 2019-08-20
cargo: Gerente de Ventas
departamento: Comercial
provincia_laboral_id: 19
sueldo: 2100.00
jornada_parcial: false
```

### **Empleado 4: Ana Patricia Solís**
```
nombres: Ana Patricia
apellidos: Solís Ramírez
cedula: 0912456789
provincia_id: 1
fecha_nacimiento: 1993-04-12
email: ana.solis@provedatos.com
fecha_ingreso: 2021-02-01
cargo: Contadora
departamento: Finanzas
provincia_laboral_id: 1
sueldo: 1600.00
jornada_parcial: true
```

### **Empleado 5: Diego Morales**
```
nombres: Diego Fernando
apellidos: Morales Castro
cedula: 1715234567
provincia_id: 10
fecha_nacimiento: 1990-09-25
email: diego.morales@provedatos.com
fecha_ingreso: 2018-05-15
cargo: Diseñador UX/UI
departamento: Diseño
provincia_laboral_id: 10
sueldo: 1450.00
jornada_parcial: false
```

---

## 🐛 Troubleshooting

### Error: "SQLSTATE[HY000] [1045] Access denied"
**Solución**: Verifica las credenciales de base de datos en `.env`

### Error: "The stream or file could not be opened"
**Solución**: 
```bash
php artisan cache:clear
php artisan config:clear
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Error: "No application encryption key has been specified"
**Solución**:
```bash
php artisan key:generate
```

### Error: CORS
**Solución**: Verifica que `config/cors.php` tenga `'allowed_origins' => ['*']`

---

## 📞 Contacto y Soporte

Para dudas o problemas, contacta al equipo de desarrollo.

---

## 📜 Licencia

Este proyecto es de uso educativo/interno.

---

**Última actualización**: Octubre 2025
**Versión**: 1.0.0