#!/usr/bin/python3
#-*- coding: utf-8 -*-

# Lista de Youtube de curso de creación de bots de Telegram con Python
# https://www.youtube.com/playlist?list=PL3lTiK2rXrUEGdvNBfDup4el6v5lSf5ot

import requests
import json
from datetime import datetime
from os.path import exists


TOKEN = '1097954285:AAENTqf5q3XKTNk9SMXYXBkl6vhs5eSdS5k'
CHANEL = "-1001519446927"
BOTNAME = "theasker_bot"
URL="https://api.telegram.org/bot" + TOKEN
URLLOCAL="http://172.22.0.2:8081/bot" + TOKEN + "/"

PROPERTIES = './config.ini'

class TelegramBot():
    def __init__(self):
        self._params = {} # Creo un diccionario para las variables del fichero
        self._url = None
        with open(PROPERTIES, 'r') as file:
            self._params = json.load(file)
            self._url = f"{self._params['url']}{self._params['token']}/"
    
    def get_me(self):
        method = "getme"
        url = URLLOCAL + "/" + method
        response = requests.get(url + method)
        #response = requests.get(self._url + method)
        return json.loads(response.text)

    def get_updates(self):
        # Last updates of the bot in the groups, channels, etc
        method = "getupdates"
        response = requests.get(URLLOCAL + method)
        if response.status_code == 200:
            # Convertimos la salida json en un objeto
            output = json.loads(response.text)
            return output
        return None

    def send_message(self, message, chat_id):
        method = "sendmessage"
        data = {
            'chat_id': chat_id,
            'text': message,
            'parse_mode': 'HTML',
            'disable_web_page_preview': True
            }
        response = requests.post(URLLOCAL + method, data=data)
        return json.loads(response.text)

    def send_media(self, chat_id, filename, caption, type):
        # try open the file for check if exists
        try:
            file = open(filename, 'rb')
            data = {
                    'chat_id': chat_id,
                    'caption': caption
                    }
            if (type == "photo"):
                method = "sendPhoto"
                files = {'photo': file}    
            elif (type == "audio"):
                method = "sendAudio"
                files = {'audio': file}    
            elif (type == "video"):
                method = "sendVideo"
                files = {'video': file} 
            else:
                data = {
                    'chat_id': chat_id,
                    'caption': caption,
                    'disable_content_type_detection': False
                    }
                method = "sendDocument"
                files = {'document': file} 
            
            response = requests.post(URLLOCAL + method, data, files=files)
            return json.loads(response.text)
        except IOError as e:
            print ("I/O error({0}): {1}".format(e.errno, e.strerror))
        except: #handle other exceptions such as attribute errors
            print ("Unexpected error:", sys.exc_info()[0])

    # Chat Updates the last 24 hours  
    def get_updates_chat(self, chat_id):
        method = "getupdates"
        data = {'chat_id': chat_id}
        response = requests.post(URLLOCAL + method, data)
        return json.loads(response.text)



if __name__ == "__main__":
    telegram_bot = TelegramBot()
    #print(telegram_bot.get_me())
    # Imprimo la última actualización
    #print(json.dumps(telegram_bot.get_updates()['result'][-1], indent=2))
    print(telegram_bot.get_updates())
    #print(json.dumps(telegram_bot.get_updates(), indent=2))
    now = datetime.now()
    date_time = now.strftime("%Y/%m/%d, %H:%M:%S")
    # channelId: -1001519446927
    # groupId: -797062014
    print(telegram_bot.send_message(date_time + " <b>Hola canal</b>","-1001519446927"))
    #print(telegram_bot.send_message(date_time + " <a href=\"https://laflordearagon.es\">laflordearagon</a>","-797062014"))
    #print(telegram_bot.send_media("-1001519446927","Eigernordwand.JPG","caption "+date_time, "photo"))
    #print(telegram_bot.send_media("-1001519446927","1-C.E.00ES_Estructura.mp3","audio "+date_time, "audio"))
    #print(telegram_bot.send_media("-1001519446927","1-C.E.00ES_Estructura.mp3","Docu " + date_time, "docu"))
    print(telegram_bot.send_media("-1001519446927","1-C.E.00ES_Estructura.mp3","document "+date_time, "document"))
    print(telegram_bot.send_media("-1001519446927","video.mp4","Video "+date_time, "video"))
    #print(telegram_bot.get_updates_chat("-1001519446927"))
    
    