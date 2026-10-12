import pymysql
from dbconfig import DB
conn = pymysql.connect(**DB); cur = conn.cursor()
user_id, new_email, new_age = 1, "amit.new@example.com", 25
cur.execute("UPDATE users SET email = %s, age = %s WHERE id = %s", (new_email, new_age, user_id))
conn.commit()
print(cur.rowcount, "row(s) updated")
conn.close()
