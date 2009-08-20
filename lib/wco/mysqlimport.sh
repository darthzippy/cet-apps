#!/usr/bin/env bash

mysqlimport -u root -p --local cet_apps_development /Users/ericgivens/Desktop/cet-apps/lib/wco/users.txt --verbose --fields-optionally-enclosed-by='"' --fields-terminated-by=',' --columns=id,role,first,middle,last,building,room,on_campus,state,country,zip,email,phone,blank1,barcode,blank2,department,active,updated_at --delete
