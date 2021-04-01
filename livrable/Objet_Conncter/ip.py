#!/usr/bin/python3.7
import os
import sys
import subprocess
import socket
import requests


def ipscan(ip, depart=1, arriver=254):
    '''
    @ip "192.168.1." defaut
    @depart = 1 defaut
    @arriver = 254 defaut
    '''
    liste = []
    t = 1
    i = 0
    print(ip)
    for ping in range(depart, arriver):
        address = ip + str(ping)
        socket.setdefaulttimeout(1)

        try:
            #hostname, alias, addresslist = socket.gethostbyaddr(address)
            add = socket.gethostbyaddr(address)
            liste.append(add[-1])
        except:
            t + i
            #addresslist = address

    return liste


def info(param = ''):
    dic = {}
    listip = {}
    dic['fonction'] = param
    # os.system('cat /etc/dhcpcd.conf | grep ip_address > ip.txt')
    os.system(
        'ip a | grep eth | grep inet > ip.txt ; sudo ip a | grep wlan | grep inet > echo >> ip.txt')
    host = open("/etc/hostname", "r")
    hostname = host.read()
    hostname = hostname.split("\n")
    hostname = hostname[0]
    inet = open("ip.txt", "r")
    ipp = inet.read()
    et = ipp.split("\n")
    
    dic['hostname'] = hostname

    for valut in et:
        res = valut.split("inet ")
        res = res[-1].split("/")
        for vet in res:
            resul = vet.split(" ")
            nameIP = resul[-1]
            if str(nameIP) != res[0]:
                listip[nameIP] = res[0]
        print(res)

    #az = et.split("inet")

    dic['eternet'] = listip
   

    return dic


def idip(id):
    port = "5000"
    url = "http://"
    t = 1
    i = 0
    for valut in id:
        try:
            #hostname, alias, addresslist = socket.gethostbyaddr(address)
            add = requests.get(url + valut + port + "/")
            print(add)
            # liste.append(add[-1])
        except:
            t + i
            #addresslist = address
