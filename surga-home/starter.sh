#!/bin/bash

if ps aux | grep "[v]2exec.py" > /dev/null
then
    :
else
    python /home/adminpde/v2exec.py &
fi