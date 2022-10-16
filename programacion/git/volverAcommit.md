# Volver a un commit anterior

    $ git log --oneline
    e4cd6b4 (HEAD -> main, origin/main) my change
    99541ed second change
    41f1f2a first change

Para revertir los 2 últimos commits

    git revert e4cd6b4 99541ed


También podemos ejecutar el comando git revert de la siguiente manera.

    $ git revert HEAD~2..HEAD

Luego guardamos el commit con la información:

    $ git commit -m "reverted commits e4cd6b4 99541ed"

Bibliografía
------------
 * https://www.delftstack.com/es/howto/git/git-go-back-to-previous-commit/#:~:text=aplicar%20al%20repositorio.-,Uso%20de%20git%20revert%20para%20volver%20a%20un%20commit%20anterior,para%20anular%20el%20commit%20anterior.