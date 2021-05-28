#!/bin/bash
chown -R vsftpd /var/www/html/*
chgrp -R nogroup /var/www/html/*
chmod -R 775 /var/www/html/*