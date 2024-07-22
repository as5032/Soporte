
#!/bin/bash

##Definir las variables
# Directorio de origen
SOURCE=/var/www/html
# Directorio de destino
DEST=/mnt/dtic/
# Fecha actual
DATE=$(date +%Y%m%d)

#sudo mount -t cifs -o username=gsimon,password=s1m0n23,domain=consejeria.gob //172.17.232.126/general /mnt/dtic
sudo mount -t cifs -o username=gsimon,password=s1m0n23,domain=consejeria.gob //172.17.232.126/general/bd /mnt/dtic

#Recorrer las carpetas del directorio de origen

for FOLDER in $SOURCE/*; do
  #Obtener el nombre de la carpeta sin la ruta
  NAME=$(basename $FOLDER)

  #Crear un archivo comprimido con el nombre de la carpeta y la fecha
  tar czvf $NAME-$DATE.tar.gz $FOLDER

  #Copiar el archivo comprimido al directorio de destino
  cp $NAME-$DATE.tar.gz $DEST

  #Eliminar el archivo comprimido del directorio actual
  rm $NAME-$DATE.tar.gz
done

#Desmontar la unidad de red de Windows
sudo umount /mnt/dtic

#Mostrar un mensaje de finalización
echo "Respaldo completado"
