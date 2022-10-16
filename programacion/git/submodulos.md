# Cómo trabajar con submodules en Git

## Agregar un nuevo submódulo a un proyecto existente

    git submodule add git@theasker.duckdns.org:/mnt/datos/git/pruebas.git submodules/pruebas

Esto añade el repositorio pruebas en la localización `submodules/pruebas` de nuestro proyecto.

Si hacemos un `git status` veremos que se han creado **2 ficheros**, uno es `.gitmodules` y otro un fichero llamado como la ruta del submódulo `submodules/pruebas`

    $ git status
    On branch master
    Your branch is up to date with 'origin/master'.

    Changes to be committed:
    (use "git restore --staged <file>..." to unstage)
        new file:   .gitmodules
        new file:   submodules/pruebas

Si miramos el archivo `.gitmodules` veremos que tiene los metadatos de la información del submódulo, con la ruta donde está clonado y su url:

    $ cat .gitmodules 
    [submodule "submodulo/pruebas"]
        path = submodules/pruebas
        url = git@theasker.duckdns.org:/mnt/datos/git/pruebas.git

Agregamos los nuevos ficheros, para poder consultar lo que hay en esos nuevos ficheros (`.gitmodules` y `submodules/pruebas`):

    $ git add .
    $ git diff --staged
    diff --git a/.gitmodules b/.gitmodules
    new file mode 100644
    index 0000000..e28f9a5
    --- /dev/null
    +++ b/.gitmodules
    @@ -0,0 +1,3 @@
    +[submodule "submodules/pruebas"]
    +       path = submodules/pruebas
    +       url = git@theasker.duckdns.org:/mnt/datos/git/pruebas.git
    diff --git a/submodules/pruebas b/submodules/pruebas
    new file mode 160000
    index 0000000..6bb3588
    --- /dev/null
    +++ b/submodules/pruebas
    @@ -0,0 +1 @@
    +Subproject commit 6bb3588b68e13eb6ea5a7846e5f4e140ee128bf4

Hacemos el commit para tenerlo guardado:

    $ git commit -m "Agregado submodulo"
    $ git push

Si en estos momentos clonáramos el repositorio en otra ubicación:



Bibliografía
------------
 * https://git-scm.com/book/es/v2/Herramientas-de-Git-Subm%C3%B3dulos
 * https://www.youtube.com/watch?v=YVUkxt3Bvwg