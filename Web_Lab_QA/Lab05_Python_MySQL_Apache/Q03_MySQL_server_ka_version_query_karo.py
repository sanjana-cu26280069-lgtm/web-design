import pymysql
from dbconfig import DB
conn = pymysql.connect(**DB)
cur = conn.cursor()
cur.execute("SELECT VERSION()")
print("MySQL version:", cur.fetchone()[0])
conn.close()
