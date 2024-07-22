#!/bin/bash

# Obtener el tamaño usado del disco duro
disk_usage=$(df -h --output=used /dev/mapper/ubuntu--vg-ubuntu--lv | tail -n 1)

# Conexión a la base de datos MySQL
mysql_host="localhost"
mysql_user="root"
mysql_password="4dm1n1str4d0r"
mysql_database="css_db"

# Insertar el tamaño usado en la base de datos
# INSERT INTO `disk_usage`(`id`, `uso`, `fecha`) VALUES ([value-1],[value-2],[value-3])
mysql -h $mysql_host -u $mysql_user -p$mysql_password -D $mysql_database -e "INSERT INTO disk_usage (id,uso,total) VALUES (0,'$disk_usage',1006);"

echo "Tamaño usado del disco duro insertado en la base de datos."
