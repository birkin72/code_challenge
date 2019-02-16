var express = require('express');
var app = express();

app.get('/', function (req, res) {
      res.end("Hello world 2 server");
 });

var server = app.listen(8081, function () {
   var host = "127.0.0.1"
   var port = server.address().port
});