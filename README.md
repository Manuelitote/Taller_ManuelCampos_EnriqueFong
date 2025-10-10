# 🖥️ Mini Proyecto 1 - Ingeniería Web

Este repositorio contiene el desarrollo completo del **Mini Proyecto 1** del curso de **Ingeniería Web** de la **Universidad Tecnológica de Panamá (UTP)**. El proyecto consiste en la solución de 10 problemas utilizando el lenguaje PHP, aplicando estructuras de control, formularios HTML, clases, funciones matemáticas, validaciones y visualización de datos con gráficos.

---

## 📌 Introducción

El objetivo principal de este proyecto fue aplicar de forma práctica conceptos fundamentales de programación en PHP. A través de 10 ejercicios diferentes, se utilizaron estructuras de control (`if`, `switch`, `for`, `foreach`), manejo de formularios, definición de funciones personalizadas, validaciones, clases con métodos estáticos y uso de sesiones para simular funcionalidades reales. 

Además, se incorporó la librería externa **Chart.js** para representar gráficamente algunos resultados, mejorando la interpretación visual de los datos generados.

---

## 🧰 Tecnologías Utilizadas

- **Lenguaje principal:** PHP 8.x
- **HTML5 + CSS3** para la estructura y estilos del frontend
- **Chart.js** para generación de gráficas (barras y pastel)
- **Servidor local:** XAMPP / Apache
- **Editor recomendado:** Visual Studio Code

---

## 🧑‍🤝‍🧑 Estudiantes del Grupo

Grupo 1SF131
- **Manuel Campos** - [manuel.campos1@utp.ac.pa]
- **Enrique Fong** - [chenenrique.fong@utp.ac.pa]  

---

## 📆 Fecha de Realización

- 9 de Octubre de 2025

---

## 📚 Curso

- **Asignatura:** Ingeniería Web  
- **Universidad:** Universidad Tecnológica de Panamá  
- **Profesor:** Irina Fong

---

## 🧠 Programación Orientada a Objetos (POO)

Se aplicó un enfoque **modular y orientado a objetos**, con clases específicas para manejar distintos tipos de operaciones:

### 📦 Clases definidas:

- `Estadisticas.php`: Contiene funciones para cálculo de media, desviación estándar, mínimo y máximo.
- `OperacionesMatematicas.php`: Maneja funciones como potencias y distribución porcentual.
- `CalculadoraEstaciones.php`: Determina la estación del año a partir de una fecha.
- `Navegacion.php`: Muestra un botón reutilizable para volver al menú principal.
  
Todas las clases utilizan **métodos estáticos**, permitiendo llamarlas.

---

## ➕ Funciones Matemáticas Utilizadas

Algunas de las funciones implementadas fueron:

```php
// Calcula el promedio de un arreglo numérico
public static function calcularMedia($numeros)

// Calcula la desviación estándar
public static function calcularDesviacionEstandar($numeros)

// Obtiene el valor mínimo de una lista
public static function obtenerMinimo($numeros)

// Genera N potencias de una base
public static function obtenerPotencias($base, $cantidad)

Estas funciones se utilizaron para resolver problemas estadísticos y cálculos numéricos precisos. 
```
### Funciones de Validación y Sanitización

Se creó un archivo validaciones.php con funciones personalizadas para validar entradas del usuario:
```php
// Verifica si un número es positivo (> 0)
function validarNumeroPositivo($num)

// Verifica si un número es cero o positivo
function validarNumeroNoNegativo($num)


También se usó checkdate() para verificar fechas válidas en el problema de estaciones del año.

Para proteger la presentación de datos y evitar errores por entradas maliciosas, se utilizó:

htmlspecialchars($valor)
```

Esto evitó posibles problemas de inyección o visualización errónea de caracteres especiales.

### 🧭 Navegación del Proyecto

El proyecto incluye un menú principal (index.php) con botones visuales que enlazan a cada uno de los 10 problemas, permitiendo una navegación sencilla y directa.

Entre los 10 problemas, se cuenta con:

- Formularios de entrada

- Validación de datos

- Procesamiento de resultados

- Visualización (en texto, tablas o gráficas)

- Botón para regresar al menú principal