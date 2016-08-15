#!/bin/sh
MOD=intra-www.lingyun5.com
IP_LIST=(10.44.15.41)

for i in ${IP_LIST[*]}
do
    cd /data/www/web/lybook/www.lingyun5.com/

    /usr/bin/rsync -RvzrtopgK --progress $1 --exclude=".svn" --exclude="templates_c" rsync://$i/$MOD/
done
