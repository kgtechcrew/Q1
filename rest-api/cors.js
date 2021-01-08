const cors = require('cors');

module.exports = function (app) {
    var corsOptions = {
        origin: 'http://localhost',
        credentials: true,
        optionsSuccessStatus: 200
    }
    app.use(cors(corsOptions));
}