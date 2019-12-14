import asyncio
import websockets
import RPi.GPIO as GPIO
import time
import requests

from datetime import datetime
from ocpp.v20 import call
from ocpp.v20 import ChargePoint as cp

GPIO.setmode(GPIO.BCM)
start_button = 16
GPIO.setup(start_button, GPIO.IN, pull_up_down=GPIO.PUD_UP)#Button to GPIOstart_button

stop_button = 26
GPIO.setup(stop_button, GPIO.IN, pull_up_down=GPIO.PUD_UP)#Button to GPIOstop_button

class ChargePoint(cp):

    async def send_boot_notification(self):
        request = call.BootNotificationPayload(
                charging_station={
                    'model': 'Wallbox XYZ',
                    'vendor_name': 'anewone'
                },
                reason="PowerUp"
        )
        response = await self.call(request)

        if response.status == 'Accepted':
            print("Connected to central system.")
            print(request)
            print(response)

        try:
            while True:
                button_state = GPIO.input(stop_button)
                if button_state == False:
                    # GPIO.output(26, True)
                    print('Stoped Charging..')
                    now = datetime.now()
                    current_time = now.strftime("%H:%M:%S")
                    print("Stop Time =", current_time)
                    time.sleep(0.2)
        except:
            GPIO.cleanup()


async def main():
    url = "http://172.16.176.206:8000/transactions"
    payload = "{\n\t\"charging_station_id\": 1\n}"
    headers = {
        'Content-Type': "application/json"
    }
    response = requests.request("POST", url, data=payload, headers=headers)
    print(response.text)
    
    async with websockets.connect(
        'ws://localhost:9000/CP_1',
         subprotocols=['ocpp2.0']
    ) as ws:

        cp = ChargePoint('CP_1', ws)

        await asyncio.gather(cp.start(), cp.send_boot_notification())


if __name__ == '__main__':
    print("Press start")
    try:
        while True:
            button_state = GPIO.input(start_button)
            if button_state == False:
                #  GPIO.output(26, True)
                print('Charging...')
                asyncio.run(main())
                time.sleep(0.2)
    except:
        GPIO.cleanup()


    