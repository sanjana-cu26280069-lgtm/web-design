from mysql.connector import pooling
from dbconfig import DB

pool = pooling.MySQLConnectionPool(pool_name="webpool", pool_size=5, **DB)

def get_users():
    conn = pool.get_connection()          # pool se connection lo
    try:
        cur = conn.cursor()
        cur.execute("SELECT id, name FROM users")
        return cur.fetchall()
    finally:
        conn.close()                      # pool ko wapas return hota hai, band nahi hota

print(get_users())
