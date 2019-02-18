# Salesforce

Salesforce is the master data for many objects used on the website. Below are some important notes regarding the salesforce integration.

## Installation

### Settings / Environment variables

Obtain the following credentials from whoever manages the Salesforce instance, and then update them in your `.env` file in the root of the project:

* SALESFORCE_CLIENT_ID
* SALESFORCE_CLIENT_SECRET
* SALESFORCE_USERNAME
* SALESFORCE_PASSWORD
* SALESFORCE_SECURITY_TOKEN

Visit the `/generate-token.php` path to generate a new token.

Update the `.env` file with the following two bits of information received in the token request response:

* SALESFORCE_ACCESS_TOKEN
* SALESFORCE_INSTANCE_URL