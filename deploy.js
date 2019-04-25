var FtpDeploy = require('ftp-deploy');
var ftpDeploy = new FtpDeploy();
var dotenv = require('dotenv');
var request = require('request');
var zip = require('bestzip');
var fs = require('fs');

// require('nightwatch/bin/runner.js');

dotenv.config();

var currentStage = typeof process.argv.slice(2)[0] === 'undefined' ? 'staging' : process.argv.slice(2)[0]; // This gets the stage set, if it isn't set, then we fall back to staging.

console.log('- Starting deployment to ' + process.env.APP_TITLE + ' server using "' + currentStage + '" settings.');

var config = {
    user: process.env.FTP_USER,
    password: process.env.FTP_PASSWORD,
    host: process.env.FTP_HOST,
    port: process.env.FTP_PORT,
    localRoot: __dirname + process.env.FTP_LOCAL_ROOT,
    // deleteRemote: true,
    forcePasv: true,
    include: [
        'release.zip',
        'public/**',
        '_extensions/**'
    ]
}

switch(currentStage) {
    case 'staging':
        config.remoteRoot = '/staging.api.devitup.co.uk/current/';
    break;
    case 'production':
        config.remoteRoot = '/api.devitup.co.uk/current/';
    break;
}

// First we will zip the folder.
zip({
    source: './',
    destination: './release.zip'
}).then(() => {
        ftpDeploy.deploy(config)
        .then(res => {
            console.log('- Deployment complete using ' + currentStage.toUpperCase() + ' configuration stage at https://' + config.remoteRoot);
            request(process.env.APP_URL + '/install.php', function (error, response, body) {
                if (!error && response.statusCode == 200) {
                    console.log(body);
                    fs.unlink('./release.zip', (err) => {
                        if (err) throw err;
                        console.log('successfully deleted release zip');
                    });
                }
            });
        })
        .catch(err => console.log(err));
    }).catch(function(err) {
        console.error(err.stack);
        process.exit(1);
    });
