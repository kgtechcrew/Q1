# Q1 - ReCaptcha Support

## Contact Form

Developed a contact form to submit the user contact information. This form is validated using a captcha before submission. Used the standard captcha available PHP Yii framework.

### Prereqisites

1. PHP 7.3

### Installation

1. Download the SecurityApp folder from https://github.com/kgtechcrew/Q1.git
2. Unpack the downloaded file to a document root folder.

## Rest API
API Authentication - The API is authenticated using basicAuth & CORS. Any requests from non-registered origins and without a valid credentials will be rejected.

### Prereqisites

1. NodeJS ~12.9.1

### Installation

1. Download or clone the source code (rest-api) from git repo https://github.com/kgtechcrew/Q1.git
2. Run command 'npm install' to install all dependencies in package.json under rest-api/
4. Run 'npm start' to start server under rest-api/
5. Access http://localhost:3000
