import pymysql
from dbconfig import DB
try:
    conn = pymysql.connect(**DB); cur = conn.cursor()
    cur.execute("DELETE FROM users WHERE id = %s", (3,))
    conn.commit()
    print("Deleted rows:", cur.rowcount)
except pymysql.MySQLError as e:
    print("Database error:", e)
    conn.rollback()
finally:
    conn.close()
