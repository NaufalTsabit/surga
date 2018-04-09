#!/bin/bash

if ps aux | grep "[v]2exec.py" > /dev/null
then
    :
else
    python /var/www/surga/ticketing_new/v2exec.py &
fi
