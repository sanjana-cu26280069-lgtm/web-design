import logging, pymysql
from datetime import datetime
from dbconfig import DB

logging.basicConfig(filename="/tmp/pyweb.log", level=logging.INFO,
                    format="%(asctime)s %(levelname)s %(message)s")
logging.info("Request received at %s", datetime.now())
try:
    conn = pymysql.connect(**{**DB, "password": "wrong"})
except pymysql.MySQLError as e:
    logging.error("DB connection failed: %s", e)

cat /tmp/pyweb.log
