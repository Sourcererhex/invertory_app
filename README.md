# Sistema de Inventario PHP + MySQL + Tailwind

## Estructura

- `config/` conexión y autenticación
- `partials/` cabecera, navegación y mensajes
- `categoria/` CRUD de `categoria`
- `proveedor/` CRUD de `proveedor`
- `unidad_m/` CRUD de `unidad_m`
- `usuarios/` CRUD de `usuarios` (Administrador)
- `material/` CRUD de `material`
- `sql/` archivos relacionados con la base de datos

## Seguridad

La contraseña se almacena usando `password_hash()` y se valida con `password_verify()`.
No se usa SHA1/MD5 para nuevas contraseñas.

Todas las consultas que reciben datos del usuario usan consultas preparadas PDO.

## Importante

El esquema recibido contiene estas tablas y relaciones:

- `material.ID_CATEGORIA` -> `categoria.ID_CATEGORIA`
- `material.ID_PRO` -> `proveedor.ID_PRO`
- `material.ID_UM` -> `unidad_m.ID_UM`

`ID_CATEGORIA` e `ID_PRO` pueden ser NULL debido a `ON DELETE SET NULL`.

## Tailwind

El ejemplo carga Tailwind mediante CDN para facilitar el desarrollo. Para producción conviene instalar Tailwind y generar un CSS local.

## Login

Crear un usuario inicial desde el entorno PHP:

```bash
php sql/create_first_user.php admin 'TuClaveSegura' Administrador
```

Asegúrate de que las variables de conexión (`DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASSWORD`) sean correctas.
