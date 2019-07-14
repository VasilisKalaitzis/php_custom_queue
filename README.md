This is a simple example of queue implementation.

# Applications

consumer: handles the queue and the requests of the producer

producer: handles the requests of the webserver, pushes messages to the queue or send requests to the consumer's api

webserver: the front end of the application

# HOW TO INSTALL

## Database creation

First you need to create the database. You can find the database commands on the database folder,which contains a .mysql file. Install this

## PHP consumer and producer

Add the consumer and the producer to the server (apache)

## Configure the database

Both consumer and producer contains a db.php file. Modify it accordingly to match the server's db

## Configure the URLS

The are some hardcoded URLs on the code.

1. On producer/classes/user.php, CURLOPT_URL should be reflecting the consumer's URL
2. On webserver/index.html, url variable should reflecting the producer's URL

## Start the queue

Execute the queue.php file found on the consumer. This will start a background job which will constantly checks the db for new records

## Start the webserver

You will need to initiallize a webserver on webserver's directory.
One way to do this is to follow the steps bellow:

1. Open a command line and get inside the webserver folder
2. > install http-server -g
3. > http-server -p8000
