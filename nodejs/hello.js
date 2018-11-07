#!/usr/bin/env nodejs
var http = require('http');
http.createServer(function (request, response) {
   response.writeHead(200, {'Content-Type': 'text/plain'});
   response.end('Hello World! Node.js is working correctly.\n');
}).listen(8080,'172.31.16.0');
console.log('Server running at http://172.31.16.0:8080/');
