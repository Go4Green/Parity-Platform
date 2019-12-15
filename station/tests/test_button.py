import RPi.GPIO as GPIO
import time

GPIO.setmode(GPIO.BCM)
button = 16
led = 19
GPIO.setup(button, GPIO.IN, pull_up_down=GPIO.PUD_UP)#Button to GPIO23
GPIO.setup(led, GPIO.OUT)  #LED to GPIO24

try:
    while True:
         button_state = GPIO.input(button)
         if button_state == False:
             GPIO.output(led, True)
             print('Button Pressed...')
             time.sleep(0.2)
         else:
             GPIO.output(led, False)
except:
    GPIO.cleanup()