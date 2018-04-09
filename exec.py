import httplib
host = "10.151.38.83"
url_api = "/ticketing/api/read_inbox_sms"

conn = httplib.HTTPConnection(host)
conn.request("GET", url_api)
# r1 = conn.getresponse()
# print r1.status, r1.reason
conn.close()
