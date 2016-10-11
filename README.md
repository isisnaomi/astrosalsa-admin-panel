# Proyecto AstroSalsa

## Issues
1. Modificar los métodos del Administrador para que no retornen report, sino que se le soliciten con un método getReport();
1. Es necesario un método de verificación de report en ReportInterpreter
1. Los controladores (especialmente del lado de Javascript) tienen muy pobres sistemas de manejo de excepciones
1. Resolver diseño: ¿Cómo se manejará el proceso de realizar una inscripción de estudiante? ¿Debe generarse una subscripción al momento de inscribirlo o se manejará como dos procesos separados?
    - Hacer: Los reportes deben devolver los registros afectados (o seleccionados) como un array asociativo
1. Lectura del código y verificación de nombres de variables y estandares de organización
1. Definir estándar para el manejo de estructuras de control de una sola línea
1. Aplicar el siguiente estándar para la organización de if-elses:

```Javascript
if ( condition ) {
  // Do something...
} else {
  // Do some other thing...
}
```
