 # Varios multimedia
 
 * GNOME Network Displays => Envía nuestro escritorio a la TV 
   ``` 
   yay -S gnome-network-displays
   ```
 * Descargar canciones de spotify con docker
   ```
   docker run --rm -v $(pwd):/music spotdl/spotify-downloader download <url_spotify>
   ```