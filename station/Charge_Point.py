import sys
import time
import asyncio
import requests
import websockets
import readmifare
import RPi.GPIO as GPIO

from ocpp.v20 import call
from datetime import datetime
from ocpp.v20 import ChargePoint as cp

# ---- Setup GPIO ------
GPIO.setmode(GPIO.BCM)

# Start Button Definition
start_button = 16
GPIO.setup(start_button, GPIO.IN, pull_up_down=GPIO.PUD_UP)

# Start Green LED
start_led = 19
GPIO.setup(start_led, GPIO.OUT)

# Stop Button Definition
stop_button = 26
GPIO.setup(stop_button, GPIO.IN, pull_up_down=GPIO.PUD_UP)

# stop Green LED
stop_led = 13
GPIO.setup(stop_led, GPIO.OUT)

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
        # ============= Stop Charrging button ==================
        try:
            while True:
                button_state = GPIO.input(stop_button)
                if button_state == False:
                    GPIO.output(stop_led, True) # Turn on Start LED
                    GPIO.output(start_led, False) # Turn off Start LED
                    print('Stoped Charging..')
                    now = datetime.now()
                    current_time = now.strftime("%H:%M:%S")
                    print("Stop Time =", current_time)
                    # sys.exit(0)
                    time.sleep(0.2)
        except:
            GPIO.cleanup()
        # =========================================================

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
    GPIO.output(start_led, False) # Turn off Start LED
    GPIO.output(stop_led, False) # Turn off Stop LED
    readmifare.read_nfc() # Read NFC Card/Tag
    print("Press start Button ... ")
    try:
        while True:
            button_state = GPIO.input(start_button)
            if button_state == False:
                GPIO.output(start_led, True)
                print('Charging ...')
                asyncio.run(main())
                time.sleep(0.2)
                GPIO.output(start_led, False)
    except:
        GPIO.cleanup()


    