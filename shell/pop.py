#-*- encoding: utf-8 -*-
import os, sys, string
import poplib

if len(sys.argv)!=3:
        print 0
        exit(1)

host = "pop.exmail.qq.com"
username = sys.argv[1]+"@cmyd8.com"
password = sys.argv[2]
port = 995

pp = poplib.POP3_SSL(host,port)
#pp.set_debuglevel(1)
try:
	pp.user(username)
	pp.pass_(password)
	print 1
except BaseException as e:
	print 0

pp.quit()
