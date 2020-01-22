#!/bin/bash
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
sed -i 's/localhost/192.168.8.152/g' $DIR/dump/shop.sql
cd $DIR
docker-compose up --build -d
