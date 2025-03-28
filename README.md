# Proyecto de Logística de Camiones

![PHP](https://img.shields.io/badge/PHP-8-blue) ![MySQL](https://img.shields.io/badge/MySQL-8-blue) ![PDO](https://img.shields.io/badge/PDO-Enabled-blue) ![MVC](https://img.shields.io/badge/MVC-Pattern-blue) ![HTML](https://img.shields.io/badge/HTML-5-orange) ![CSS](https://img.shields.io/badge/CSS-3-blue) ![Bootstrap](https://img.shields.io/badge/Bootstrap-5-purple)

Este es un sistema MVC en PHP con MySQL (usando PDO) para gestionar la logística de camiones en una fábrica. Permite administrar roles, usuarios, tonelaje, carga/descarga, destinos, recorridos y pausas.

## 🚀 Instalación en Local con XAMPP

### 1️⃣ Requisitos Previos
- Tener [XAMPP](https://www.apachefriends.org/es/index.html) instalado.
- Asegurarse de que Apache y MySQL estén activos en el panel de control de XAMPP.

### 2️⃣ Clonar el Repositorio
```sh
 git clone https://github.com/TuUsuario/TuRepositorio.git
```

### 3️⃣ Configurar la Base de Datos
- Copia el archivo del proyecto en `C:\xampp\htdocs\logistica_camiones`.
- Abre `phpMyAdmin` (http://localhost/phpmyadmin).
- Crea una base de datos llamada `logistica`.
- Importa el archivo `database.sql` incluido en el proyecto.

### 4️⃣ Configurar la Conexión a la Base de Datos
Edita el archivo `config/database.php` y ajusta los valores:
```php
$host = 'localhost';
$dbname = 'transportes';
$user = 'root'; // Usuario por defecto en XAMPP
$pass = ''; // Contraseña vacía en XAMPP
```

### 5️⃣ Iniciar el Proyecto
- Abre tu navegador y accede a: 
  ```
  http://localhost/logistica_camiones/
  ```
- Inicia sesión o regístrate.
- ¡Listo para gestionar la logística! 🚛

## 📌 Tecnologías Usadas
- **PHP 8** con **PDO** para conexión segura a MySQL.
- **MVC** para una arquitectura organizada.
- **Bootstrap 5** para estilos responsivos.
- **HTML5 & CSS3** para la interfaz.

---
### 📩 Contribuciones
Si deseas mejorar el proyecto, ¡haz un fork y envía un pull request!

---
📌 *Desarrollado con ❤️ por David Milanés Moreno*
