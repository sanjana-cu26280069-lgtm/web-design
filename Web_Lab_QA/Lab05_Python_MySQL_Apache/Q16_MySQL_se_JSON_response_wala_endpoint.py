#!/var/www/venv/bin/python
import json, pymysql
from dbconfig import DB
conn = pymysql.connect(**DB, cursorclass=pymysql.cursors.DictCursor)
cur = conn.cursor(); cur.execute("SELECT id, name, email, age FROM users")
data = cur.fetchall(); conn.close()
print("Content-Type: application/json\n")
print(json.dumps(data))

curl http://localhost/cgi-bin/api.py
