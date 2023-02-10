# CodeIgniter 4 OAuth 2.0 Implementation

This is implementation of OAuth 2.0 on CodeIgniter 4 using BShaffer OAuth 2.0

## How To Use

```shell
git clone git@github.com:suwidadi/Codeigniter4Oauth2.git
cd Codeigniter4Oauth2/
composer update
```
Create Database 

```shell
mysql -u root -p oauthdb < init.sql
```

Curl Example

1. Client Credentials

```Shell
curl --request POST \
  --url http://localhost:8080/authorize/client_credentials \
  --header 'Content-Type: application/x-www-form-urlencoded' \
  --data client_id=[sample_id] \
  --data client_secret=[sample_secret] \
  --data grant_type=client_credentials
```

2. User Credentials

```Shell
curl --request POST \
  --url http://localhost:8080/authorize/user_credentials \
  --header 'Content-Type: application/x-www-form-urlencoded' \
  --data grant_type=password \
  --data username=[sample_username] \
  --data password=[sample_password] \
  --data client_id=[sample_id] \
  --data client_secret=[sample_secret]
```

3. Refresh Token

```Shell
curl --request POST \
  --url http://localhost:8080/authorize/refresh_token \
  --header 'Authorization: Bearer [long_bearer_token]' \
  --header 'Content-Type: application/x-www-form-urlencoded' \
  --data client_id=[sample_id] \
  --data client_secret=[sample_secret] \
  --data grant_type=refresh_token \
  --data refresh_token=[long_sample_refresh_token]
```


