###
# requirements:
# - pip scrapy
###


import os
from time import gmtime, strftime

time = strftime("%Y_%m_%d_%H_%M_%S")
outFile = f"{time}.csv"
errFile = f"{time}.err"
cmd = f"scrapy runspider _scrapy.py --output={outFile} --logfile={errFile} --loglevel=WARNING --output-format=csv"

print(cmd)
os.system(cmd)