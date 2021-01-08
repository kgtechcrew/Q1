const basicAuth = require('express-basic-auth');

module.exports = function (app) {
    app.use(basicAuth({
        users: { 'admin': 'admin' }
    }))
}