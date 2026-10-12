import re, html, pymysql
from dbconfig import DB

def clean_user(name, email, age):
    name = html.escape(name.strip())
    if not re.fullmatch(r"[A-Za-z ]{2,50}", name):
        raise ValueError("Invalid name")
    if not re.fullmatch(r"[^@\s]+@[^@\s]+\.[a-z]{2,}", email.strip(), re.I):
        raise ValueError("Invalid email")
    age = int(age)
    if not 1 <= age <= 120:
        raise ValueError("Invalid age")
    return name, email.strip().lower(), age

try:
    vals = clean_user("  Rahul ", "rahul@example.com", "24")
    conn = pymysql.connect(**DB); cur = conn.cursor()
    cur.execute("INSERT INTO users (name, email, age) VALUES (%s, %s, %s)", vals)
    conn.commit(); conn.close(); print("Saved", vals)
except ValueError as e:
    print("Rejected:", e)
