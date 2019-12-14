import asyncio
import websockets
from datetime import datetime

from ocpp.routing import on
from ocpp.v20 import ChargePoint as cp
from ocpp.v20 import call_result

class ChargePoint(cp):
    @on('BootNotification')
    def on_boot_notification(self, charging_station, reason, **kwargs):
        return call_result.BootNotificationPayload(
            current_time=datetime.utcnow().isoformat(),
            interval=10,
            status='Accepted'
        )

async def on_connect(websocket, path):
    """ For every new charge point that connects, create a ChargePoint instance
    and start listening for messages.

    """
    charge_point_id = path.strip('/')
    cp = ChargePoint(charge_point_id, websocket)
    print(dir(cp)) # print cp attriibutes
    print(cp.id)  # print Charge Point ID
    print(cp.call)
    print(cp.start)
    print(cp.route_map)
    print(cp.route_message)
    print(cp.on_boot_notification)



    await cp.start()


async def main():
    server = await websockets.serve(
        on_connect,
        '0.0.0.0',
        9000,
        subprotocols=['ocpp2.0']
    )

    await server.wait_closed()


if __name__ == '__main__':
    asyncio.run(main())