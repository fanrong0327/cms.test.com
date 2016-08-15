#!/bin/sh
MOD=release-grant.lingyun5.com
IP_LIST=(10.171.129.168)

for i in ${IP_LIST[*]}
do
    cd /data/www/web/Common/grant.lingyun5.com/

    /usr/bin/rsync -RvzrtopgK --progress $1 --exclude=".svn" --exclude="templates_c" rsync://$i/$MOD/
done
