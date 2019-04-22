import math, operator , json
import hashlib
from PIL import Image

def compare(file1, file2):
    image1 = Image.open(file1)
    image2 = Image.open(file2)
    h1 = image1.histogram()
    #print (hashlib.md5(open(file1).read()).hexdigest())
    h2 = image2.histogram()
    rms = math.sqrt(reduce(operator.add,
                           map(lambda a,b: (a-b)**2, h1, h2))/len(h1))
    return rms

if __name__=='__main__':
    import sys
    f="0"

    if compare(sys.argv[2],sys.argv[1]) !=0:
	 f="0"        
    else:
         f="1"
         
    print(f)

