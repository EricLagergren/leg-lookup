import urllib
import hashlib
import shutil

senatechecksum = hashlib.md5(open('senate.json').read()).hexdigest()
housechecksum = hashlib.md5(open('house.json').read()).hexdigest()

senate = urllib.urlretrieve('http://api.nytimes.com/svc/politics/v3/us/legislative/congress/113/senate/members/current.json?api-key=d03b1f0e94348b988961bde5c63fd7f9:15:69533710', 'newsenate.json')

house = urllib.urlretrieve('http://api.nytimes.com/svc/politics/v3/us/legislative/congress/113/house/members/current.json?api-key=d03b1f0e94348b988961bde5c63fd7f9:15:69533710', 'newhouse.json')

newsenatechecksum = hashlib.md5(open('newsenate.json').read()).hexdigest()
newhousechecksum = hashlib.md5(open('newhouse.json').read()).hexdigest()

if senatechecksum != newsenatechecksum:
	shutil.copyfile('newsenate.json', 'senate.json')
	print "copied senate"

if housechecksum != newhousechecksum:
	shutil.copyfile('newhouse.json', 'house.json')
	print "copied house"






