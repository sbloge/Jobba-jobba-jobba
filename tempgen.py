#!/usr/bin/env python3

import os
import pdf2image
import glob
import time

base_dir = os.path.abspath(os.path.dirname(__file__))

imglist = []

old = glob.glob(os.path.join(base_dir,"tempimgs","*"))

imgs = pdf2image.convert_from_path(os.path.join(base_dir,"uploads","uploaded.pdf"))

def search():
    for x in range(len(filelist)):
        y=x-1
        imgstring = ("<img src='tempimgs/"+filelist[x]+"'>")

        imglist.append(imgstring)
    return imglist

for f in old:
	os.remove(f)

for i in range(len(imgs)):
    imgs[i].save(os.path.join(base_dir,"tempimgs",'page'+str(i)+'.jpg'), 'JPEG')

filelist = [f for f in os.listdir("/var/www/html/tempimgs") if os.path.isfile(os.path.join("/var/www/html/tempimgs", f))]

filelist.sort()

search()

nlimg = str("\n".join(imglist))
