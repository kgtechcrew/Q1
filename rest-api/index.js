
const express = require('express');
const fs = require('fs');

const bodyParser = require('body-parser');
const { json } = require('body-parser');
const app = express();
const cors = require('./cors')(app);
const basicAuth = require('./auth')(app);
const port = 3000;

app.use(express.json());

app.post('/contact/create', (req, res) => {
    var _name = req.body.name;
    var _subject = req.body.subject;
    var _message = req.body.message;

    console.log('Got body:', req.body);

    let record = req.body;
    var _filename = 'data.json';
    var existing_records = [];

    var _fileData = fs.readFileSync(_filename);
    if (_fileData !== null && _fileData.length > 0) {
        existing_records = JSON.parse(_fileData);
    }

    existing_records.push(record);
    fs.writeFile(_filename, JSON.stringify(existing_records), (err) => {
        if (err) throw err;
        console.log('Data written to file');
    });
    res.sendStatus(200);
});

app.listen(port, () => {
    console.log(`Node app listening at http://localhost:${port}`)
});