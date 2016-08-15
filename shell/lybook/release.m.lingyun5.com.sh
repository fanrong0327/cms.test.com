#!/bin/sh
MOD=release-m.lingyun5.com
IP_LIST=(10.172.235.229 10.170.232.127 10.163.1.154 10.171.129.168 10.44.139.160 10.51.57.18 10.44.201.132)

for i in ${IP_LIST[*]}
do
    cd /data/www/web/lybook/m.lingyun5.com/

    /usr/bin/rsync -RvzrtopgK --progress $1 --exclude=".svn" --exclude="templates_c" rsync://$i/$MOD/
done
