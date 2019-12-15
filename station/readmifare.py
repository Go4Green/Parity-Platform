import sys
import binascii
import Adafruit_PN532 as PN532

def read_nfc():
    CS   = 18
    MOSI = 23
    MISO = 24
    SCLK = 25
    pn532 = PN532.PN532(cs=CS, sclk=SCLK, mosi=MOSI, miso=MISO)
    pn532.begin()
    ic, ver, rev, support = pn532.get_firmware_version()
    print('Found PN532 with firmware version: {0}.{1}'.format(ver, rev))
    pn532.SAM_configuration()
    print('Please Approach NFC card...')
    flag = True
    while flag == True:
        # Check if a card is available to read.
        uid = pn532.read_passive_target()
        # Try again if no card is available.
        if uid is None:
            continue
        print('Found card with UID: 0x{0}'.format(binascii.hexlify(uid)))
        # Authenticate block 4 for reading with default key (0xFFFFFFFFFFFF).
        if not pn532.mifare_classic_authenticate_block(uid, 4, PN532.MIFARE_CMD_AUTH_B,
                                                    [0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF]):
            print('Failed to authenticate block 4!')
            continue
        # Read block 4 data.
        data = pn532.mifare_classic_read_block(4)
        if data is None:
            print('Failed to read block 4!')
            continue
        # Note that 16 bytes are returned, so only show the first 4 bytes for the block.
        print('Read block 4: 0x{0}'.format(binascii.hexlify(data[:4])))
        flag = False
        
if __name__ == '__main__':
    read_nfc()