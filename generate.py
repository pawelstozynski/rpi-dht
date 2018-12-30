#!/usr/bin/python3

import mysql.connector
import Adafruit_DHT as dht

# CONFIG DATA
db_host='localhost'
db_user='phpmyadmin'
db_pass=''
db_name='dht'
dht_sensor=dht.DHT22
dht_pin=4



conn = mysql.connector.connect(host=db_host, user=db_user, passwd=db_pass, database=db_name)
cur = conn.cursor()

cur.execute('SHOW TABLES;')
table_exists=False
for tab in cur:
    if 'data' in tab:
        table_exists=True

if not table_exists:
    cur.execute('CREATE TABLE data (id INT AUTO_INCREMENT PRIMARY KEY, humidity NUMERIC(4,1), temperature NUMERIC(3,1), time TIMESTAMP DEFAULT NOW());')


hum,temp=dht.read_retry(dht_sensor, dht_pin)
cur.execute('INSERT INTO data (humidity, temperature) VALUES (%s, %s);', (hum, temp))
conn.commit()


cur.close()
conn.close()
