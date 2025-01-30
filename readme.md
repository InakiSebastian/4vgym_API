# 4V GYM API (Eduardo e Iñaki)

## Descripción
API para gestionar las actividades de 4V GYM. Permite manejar los tipos de actividades, monitores y actividades disponibles en el gimnasio.

## Información General
- **Versión**: 1.0.0
- **Contacto**: [Cuatrovientos](mailto:cuatrovientos@cuatrovientos.org)
- **Servidor Base**: `127.0.0.1:8000`

## Endpoints

### Tipos de Actividades (`/activity-types`)
- `GET /activity-types`: Obtiene todos los tipos de actividades.
- `POST /activity-types`: Crea un nuevo tipo de actividad.
- `PUT /activity-types/{activityTypeId}`: Actualiza un tipo de actividad existente.
- `DELETE /activity-types/{activityTypeId}`: Elimina un tipo de actividad.

### Monitores (`/monitors`)
- `GET /monitors`: Obtiene todos los monitores disponibles.
- `POST /monitors`: Añade un nuevo monitor.
- `PUT /monitors/{monitorId}`: Actualiza un monitor existente.
- `DELETE /monitors/{monitorId}`: Elimina un monitor.

### Actividades (`/activities`)
- `GET /activities`: Obtiene todas las actividades disponibles, con opción de filtrar por fecha.
- `POST /activities`: Añade una nueva actividad.
- `PUT /activities/{activityId}`: Actualiza una actividad existente.
- `DELETE /activities/{activityId}`: Elimina una actividad.

## Modelos de Resultado

### `ActivityType`
```json
{
  "id": 10,
  "name": "BodyPump",
  "number_monitors": 2
}
```

### `Monitor`
```json
{
  "id": 10,
  "name": "Miguel Goyena",
  "email": "miguel_goyena@cuatrovientos.org",
  "phone": "654767676",
  "photo": "http://foto.com/miguel.goyena"
}
```

### `Activity`
```json
{
  "id": 10,
  "activity_type": { "id": 10, "name": "BodyPump" },
  "monitors": [{ "id": 10, "name": "Miguel Goyena" }],
  "date_start": "2023-01-01T10:00:00",
  "date_end": "2023-01-01T11:00:00"
}
```

### `ActivityNew`
```json
{
  "id": 10,
  "activity_type_id": 10,
  "monitors_id": [10],
  "date_start": "2023-01-01T10:00:00",
  "date_end": "2023-01-01T11:00:00"
}
```


