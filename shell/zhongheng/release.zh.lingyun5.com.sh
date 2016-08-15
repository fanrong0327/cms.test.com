#!/bin/sh
MOD=release
IP_LIST=(bookshop.chinacloudapp.cn)

for i in ${IP_LIST[*]}
do
    cd /data/www/web/zhongheng/zh.lingyun5.com/
    /usr/bin/rsync -RvzrtopgK --progress $1 --exclude=".svn" --exclude="templates_c" -e 'ssh -p 22' idotest@$i:/media/www/
done
