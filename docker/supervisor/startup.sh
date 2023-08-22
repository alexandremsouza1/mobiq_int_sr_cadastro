#!/bin/bash

echo "Starting Supervisor"
/usr/bin/supervisord -c /etc/supervisor/supervisord.conf &

echo "Starting Apache2"
apache2-foreground
