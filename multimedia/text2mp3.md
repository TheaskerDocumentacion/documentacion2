# Convertir texto a audio


	emerge -va espeak mbrola soundconverter




	#!/bin/bash
	
	#convertimos el fichero de texto introducido como parámetro a audio wav
	espeak -v mb-es1 -p 99 -s 165 -f $1 -w $1.wav
	
	# convertimos el wav a ogg y eliminamos el wav
	oggenc $1.wav
	rm $1.wav
	
	# reproducimos el archivo ogg
	ogg123 $1.ogg

