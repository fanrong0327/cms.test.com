#!/bin/sh
MOD=intra
IP_LIST=(10.44.15.41)

for i in ${IP_LIST[*]}
do
    cd /data/www/web/

    /usr/bin/rsync -RvzrtopgK --progress $1 --exclude=".svn" --exclude="templates_c" rsync://$i/$MOD/
done
