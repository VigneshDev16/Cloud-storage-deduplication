import sys
import hashlib
import sha3

k = hashlib.sha3_512()
k.update(open(sys.argv[1]).read())
print(k.hexdigest())
