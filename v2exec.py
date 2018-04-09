#!/usr/bin/python
import httplib
import time
import MySQLdb
from datetime import datetime
development = False

db = MySQLdb.connect(host="localhost", # your host, usually localhost
                     user="root", # your username
                      passwd="$4dm1n-5urg4", # your password
                      # passwd="", # your password
                      db="ticketing_new") # name of the data base
cur = db.cursor()
cur.execute("SELECT waktu_pengecekan FROM pengaturan")
waktu_pengecekan = 8
for row in cur.fetchall() :
    waktu_pengecekan = row[0]

waktu_pengecekan = waktu_pengecekan.seconds // 3600;
# print waktu_pengecekan

if (development):
	host = "surga.kedirikota.go.id"
	url_api = "/ticketing/api/read_inbox_sms"
	url_cek_notif = "/ticketing/api/cek_notif"
else:
	host = "surga.kedirikota.go.id"
	url_api = "/api/read_inbox_sms"
	url_cek_notif = "/api/cek_notif"

flag = 0
while (1):
	conn = httplib.HTTPConnection(host)
	conn.request("GET", url_api)
	r1 = conn.getresponse()
	print r1.status, r1.reason
	conn.close()

	# pengecekan untuk notif
	print "jam sekarang " + str(datetime.now().hour)
	# if (datetime.now().hour == 0):
	#	flag = 0
	#elif (datetime.now().hour == waktu_pengecekan and flag == 0):
	print "cek notif"
	conn = httplib.HTTPConnection(host)
	conn.request("GET", url_cek_notif)
	conn.close()
	print "read_inbox_sms"
	conn = httplib.HTTPConnection(host)
	conn.request("GET", url_api)
	conn.close()
	flag = 1
	# end

	time.sleep(3)
