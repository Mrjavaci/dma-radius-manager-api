# dma-radius-manager-api
DMA Software Radius Manager unofficial api. I will continue to develop this project. 

#Features
- Get connection status  

#Usage
- Change config.php
- Post request api/getConnectionInfo.php


#Example requests
##Connection Status

###URL -> api/getConnectionInfo.php
###Params -> {one: false}
###Response ->
```json
[{"username":"xxxxx@xxxxx","connection":false},{"username":"xxxxx@xxxxx","connection":true}]
``` 

###URL -> api/getConnectionInfo.php
###Params -> {one: true,userName: radiusUserName}
###Response ->
```json
{"connection":true}
``` 

