const express = require('express');
const app = express();
const helmet = require('helmet')
const morgan = require('morgan')
const compression = require('compression')
const cors = require('cors')
const userlogger = require('./logs/logger.log');




//user middleware
app.use(helmet())
app.use(morgan('combined'))
// compress responses
app.use(compression())
// cors
const allowedOrigins = ['http://localhost', 'https://ari-sound.aurumai.io', 'https://ari-sound-dev.aurumai.io', 'http://deepsound:80'];

const corsOptions = {
          origin: function (origin, callback) {
                    if (!origin || allowedOrigins.includes(origin)) {
                              callback(null, true);
                    } else {
                              callback(new Error('Not allowed by CORS'));
                    }
          }
};

app.use(cors(corsOptions));

// add body-parser
app.use(express.json())
app.use(express.urlencoded({
          extended: true
}))

//router
app.use(require('./routes/api.router'))

// Error Handling Middleware called

app.use((req, res, next) => {
          const error = new Error("Not found");
          error.status = 404;
          userlogger.error('Not found', { context: "Handling Middleware called", metadata: error });
          next(error);
});


// error handler middleware
app.use((error, req, res, next) => {
          res.status(error.status || 500).send({
                    error: {
                              status: error.status || 500,
                              message: error.message || 'Internal Server Error',
                    },
          });
});

module.exports = app;