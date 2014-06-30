import urllib
import hashlib
import shutil
from subprocess import call

senatechecksum = hashlib.md5(open('senate.json').read()).hexdigest()
housechecksum = hashlib.md5(open('house.json').read()).hexdigest()

senate = urllib.urlretrieve('http://api.nytimes.com/svc/politics/v3/us/legislative/congress/113/senate/members.json?api-key=d03b1f0e94348b988961bde5c63fd7f9:15:69533710', 'newsenate.json')

house = urllib.urlretrieve('http://api.nytimes.com/svc/politics/v3/us/legislative/congress/113/house/members.json?api-key=d03b1f0e94348b988961bde5c63fd7f9:15:69533710', 'newhouse.json')

call('sed -i -e 1,12d senate.json && head -n -4 senate.json', shell=True)
call('sed -i -e 1,12d house.json && head -n -4 house.json', shell=True)

with open('newsenate.json', 'a') as file:
	file.write(',')

newsenatechecksum = hashlib.md5(open('newsenate.json').read()).hexdigest()
newhousechecksum = hashlib.md5(open('newhouse.json').read()).hexdigest()

if senatechecksum != newsenatechecksum:
	shutil.copyfile('newsenate.json', 'senate.json')
	print "copied senate"

if housechecksum != newhousechecksum:
	shutil.copyfile('newhouse.json', 'house.json')
	print "copied house"

call('sed -i -e 1,12d senate.json && head -n -4 senate.json', shell=True)
call('sed -i -e 1,12d house.json && head -n -4 senate.json', shell=True)
call('cat senate.json house.json > congress.json', shell=True)





