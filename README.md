# Desafío técnico por Genube
# Fernando Ariel Orellana

Clonar el repositorio:

   
    git clone https://github.com/FernandoAriel80/genube_desafio_tecnico.git
    cd genube_desafio_tecnico
   
## Requisitos Previos

- **XAMPP** versión 3.3.0
- **PHP** versión 8.2.12

## Uso
1. **Ejecutar las tablas de la base de datos**
    - El nombre de la base de datos es genube_desafio_tecnico
     ```bash
    CREATE DATABASE genube_desafio_tecnico;  
    ```
    - Las tablas estan en en el archivo tables.sql.

2. **Ejecutar el puerto local**
    - Linux:
    - Dar permisos de ejecución (solo la primera vez)
    ```bash
    chmod +x start.sh   
    ./start.sh    
    ```

    - Windows (con Git Bash o WSL):
    ```bash
    ./start.sh         
    ```

    - Windows (con PowerShell):
    - Convierte el script a un archivo .ps1 y usa:
    ```bash
    .\start.ps1         
    ```

    El script se ejecutará en `http://localhost:8000`, para modo local o desarrollo.
