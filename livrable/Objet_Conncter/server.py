#!/usr/bin/env python3.7
import os
from flask import Flask, render_template, request

import wiringpi
import json
import sys
import signal
import ip


wiringpi.wiringPiSetupPhys()
wiringpi.pinMode(12, 1)
wiringpi.pinMode(11, 1)
wiringpi.pinMode(16, 1)
wiringpi.pinMode(15, 1)
wiringpi.pinMode(18, 1)
wiringpi.pinMode(22, 1)
wiringpi.pinMode(7, 1)
wiringpi.pinMode(13, 1)
wiringpi.digitalWrite(12, 1)
wiringpi.digitalWrite(11, 1)
wiringpi.digitalWrite(16, 1)
wiringpi.digitalWrite(15, 1)
wiringpi.digitalWrite(18, 1)
wiringpi.digitalWrite(22, 1)
wiringpi.digitalWrite(7, 1)
wiringpi.digitalWrite(13, 1)

app = Flask(__name__, template_folder="template")
dis = {}
fonct = {"action":[
        {'id': 0, 'name': "Prise 1", 'url': "prise_1="},
        {'id': 1, 'name': "Prise 2", 'url': "prise_2="},
        {'id': 2, 'name': "Prise 3", 'url': "prise_3="},
        {'id': 3, 'name': "Prise 4", 'url': "prise_4="},
        {'id': 4, 'name': "Prise 5", 'url': "prise_5="},
        {'id': 5, 'name': "Prise 6", 'url': "prise_6="},
        {'id': 6, 'name': "Prise 7", 'url': "prise_7="},
        {'id': 7, 'name': "Prise 8", 'url': "prise_8=" },
]
}
result = ip.info()
eternet = result["eternet"]
print(eternet['wlan0'])
add2 = eternet['wlan0']

@app.route("/", methods=["GET"])
def index():
    if request.method == "GET":
        if str(request.values.get("msg")) == "exit":
            os.kill(os.getpid(), signal.SIGINT)
            return "server off"

        if str(request.values.get("prise_1")) != "" and bool(request.values.get("prise_1")):
            if request.values.get("prise_1") == "1":
                wiringpi.digitalWrite(7, 0)
            if request.values.get("prise_1") == "0":
                wiringpi.digitalWrite(7, 1)

        if str(request.values.get("prise_2")) != "" and bool(request.values.get("prise_2")):
            if request.values.get("prise_2") == "1":
                wiringpi.digitalWrite(12, 0)
            if request.values.get("prise_2") == "0":
                wiringpi.digitalWrite(12, 1)

        if str(request.values.get("prise_3")) != "" and bool(request.values.get("prise_3")):
            if request.values.get("prise_3") == "1":
                wiringpi.digitalWrite(11, 0)
            if request.values.get("prise_3") == "0":
                wiringpi.digitalWrite(11, 1)

        if str(request.values.get("prise_4")) != "" and bool(request.values.get("prise_4")):
            if request.values.get("prise_4") == "1":
                wiringpi.digitalWrite(16, 0)
            if request.values.get("prise_4") == "0":
                wiringpi.digitalWrite(16, 1)

        if str(request.values.get("prise_5")) != "" and bool(request.values.get("prise_5")):
            if request.values.get("prise_5") == "1":
                wiringpi.digitalWrite(13, 0)
            if request.values.get("prise_5") == "0":
                wiringpi.digitalWrite(13, 1)

        if str(request.values.get("prise_6")) != "" and bool(request.values.get("prise_6")):
            if request.values.get("prise_6") == "1":
                wiringpi.digitalWrite(15, 0)
            if request.values.get("prise_6") == "0":
                wiringpi.digitalWrite(15, 1)

        if str(request.values.get("prise_7")) != "" and bool(request.values.get("prise_7")):
            if request.values.get("prise_7") == "1":
                wiringpi.digitalWrite(18, 0)
            if request.values.get("prise_7") == "0":
                wiringpi.digitalWrite(18, 1)

        if str(request.values.get("prise_8")) != "" and bool(request.values.get("prise_8")):
            if request.values.get("prise_8") == "1":
                wiringpi.digitalWrite(22, 0)
            if request.values.get("prise_8") == "0":
                wiringpi.digitalWrite(22, 1)

        dis["Prise 1"] = bool(0) if bool(wiringpi.digitalRead(7)) else bool(1)
        dis["Prise 2"] = bool(0) if bool(wiringpi.digitalRead(12)) else bool(1)
        dis["Prise 3"] = bool(0) if bool(wiringpi.digitalRead(11)) else bool(1)
        dis["Prise 4"] = bool(0) if bool(wiringpi.digitalRead(16)) else bool(1)
        dis["Prise 5"] = bool(0) if bool(wiringpi.digitalRead(13)) else bool(1)
        dis["Prise 6"] = bool(0) if bool(wiringpi.digitalRead(15)) else bool(1)
        dis["Prise 7"] = bool(0) if bool(wiringpi.digitalRead(18)) else bool(1)
        dis["Prise 8"] = bool(0) if bool(wiringpi.digitalRead(22)) else bool(1)
        
        print(json.dumps(dis))
        return json.dumps(dis)

@app.route("/info")
def init():
    return ip.info(fonct)

@app.route("/ip")
def ipp():
    ip1 = ip.ipscan("192.168.1.")
    return ip.idip(ip1)

@app.route("/stop")
def stop():
    os.kill(os.getpid(), signal.SIGINT)
    return "server off"

if __name__ == "__main__":
    app.run(debug=True, host=add2)
