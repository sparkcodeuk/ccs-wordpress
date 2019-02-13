# CCS Salesforce / Wordpress data connector

1. Enter the following details into the .env file

```
    ####### Details required to obtain token #######
    SALESFORCE_CLIENT_ID=
    SALESFORCE_CLIENT_SECRET=
    SALESFORCE_USERNAME=
    SALESFORCE_PASSWORD=
    SALESFORCE_SECURITY_TOKEN=
```

2. Generate a token by going to the URL:

http://CONFIGURED_URL/salesforce-test/generate-token.php

This should automatically inject the new Access Token and Instance Url into the .env file. If not, do this manually now.

3.
