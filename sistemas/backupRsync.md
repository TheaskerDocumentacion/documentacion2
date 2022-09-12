rsync -avzhb --delete --backup-dir=/home/ubuntu/temp/incrementales/copia_$(date +%d%m%Y%H%M%S) ubuntu@laflordearagon.es:/home/ubuntu/temp/ ./backups/
rsync -avzh ubuntu@laflordearagon.es:/home/ubuntu/temp ./backups/

## Array en bash (para array de )
```
myArray=("cat" "dog" "mouse" "frog)

for str in ${myArray[@]}; do
  echo $str
done
```


## Bibliografía
* https://linuxconfig.org/how-to-create-incremental-backups-using-rsync-on-linux