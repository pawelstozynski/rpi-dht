## rpi-dht22

Run on Raspberry Pi with DHT22 sensor. 

This simple app collects temperature and humidity data and saves it in mysql database by python script. 
Then, presents it on chart on simple php website.


## Setup

You must install apache2, myqsl, php, python3 and adafruit library for python.

Create database. Make sure, your db user can CREATE, SELECT and INSERT.
Put code in /var/www/html/rpi-dht. Type mysql connection data in `conf.php` and `generate.py`.

Then, add `generate.py` to **crontab**, for example:

```
* * * * * /var/www/html/rpi-dht/generate.py
```

This will store data in every minute. 
