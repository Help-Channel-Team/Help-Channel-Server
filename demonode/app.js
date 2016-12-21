'use strict';

const express = require('express');

// Constants
const PORT = 8888;

// App
const app = express();

app.get('/', function (req, res) {
    res.statusCode = 200;
    res.setHeader('Content-Type', 'text/plain');
    res.end("hello" + '\n');

});

app.listen(PORT);

console.log('Running on http://localhost:' + PORT);
