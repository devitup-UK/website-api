var FtpDeploy = require('ftp-deploy');
var ftpDeploy = new FtpDeploy();
var dotenv = require('dotenv');
var request = require('request-promise');
var zip = require('bestzip');
var fs = require('fs');

dotenv.config();

var currentStage = typeof process.argv.slice(2)[0] === 'undefined' ? 'staging' : process.argv.slice(2)[0]; // This gets the stage set, if it isn't set, then we fall back to staging.

console.log('Starting deployment to ' + process.env.APP_TITLE + ' server using "' + currentStage + '" settings.');

var config = {
    user: process.env.FTP_USER,
    password: process.env.FTP_PASSWORD,
    host: process.env.FTP_HOST,
    port: process.env.FTP_PORT,
    localRoot: __dirname + process.env.FTP_LOCAL_ROOT,
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

// First we will run the release.php script to zip up all of the existing code.
request(process.env.APP_URL + '/release.php').finally(() => {
    // Now we will zip the folder.
    zip({
        source: ['./*'],
        destination: './release.zip'
    }).then(() => {
        ftpDeploy.deploy(config)
        .then(res => {
            console.log('Deployment complete using ' + currentStage.toUpperCase() + ' configuration stage at ' + process.env.APP_URL);
            request(process.env.APP_URL + '/install.php').then((body) => {
                let result = JSON.parse(body);
                console.log(result.message);
                console.log('Deleting release zip folder, it\'s no longer needed for this release.');
                fs.unlink('./release.zip', (err) => {
                    if (err) throw err;
                    console.log('Zip has been deleted, clean up is completed.');
                });
            });
        })
        .catch(err => console.log(err));
    }).catch(function(err) {
        console.error(err.stack);
        process.exit(1);
    });
});


