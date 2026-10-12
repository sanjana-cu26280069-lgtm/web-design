import pymysql
from dbconfig import DB
conn = pymysql.connect(**DB); cur = conn.cursor()
cur.execute("SELECT COUNT(*), AVG(age), MIN(age), MAX(age) FROM users")
cnt, avg, mn, mx = cur.fetchone()
print(f"Total users: {cnt}\nAverage age: {avg:.1f}\nYoungest: {mn}\nOldest: {mx}")
cur.execute("SELECT age, COUNT(*) FROM users GROUP BY age ORDER BY age")
for age, c in cur.fetchall():
    print(f"Age {age}: {c} user(s)")
conn.close()
