#Linux:
# chmod +x start.sh  // Dar permisos de ejecución (solo la primera vez)
# ./start.sh         // Ejecutar el script en el puerto http://localhost:8000

# Windows (con Git Bash o WSL):
# ./start.sh // Ejecutar el script en el puerto http://localhost:8000

# Windows (con PowerShell):
# Convierte el script a un archivo .ps1 y usa:
# .\start.ps1 // Ejecutar el script en el puerto http://localhost:8000

#!/bin/bash
php -S localhost:8000 -t public