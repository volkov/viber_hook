## Lauch app

```
docker build . -t viber
docker run --network host -e VIBER_TOKEN=token -e LIST_TOKEN=secret viber
```

## Env variables
* `VIBER_TOKEN` - token for viber bot
* `LIST_TOKEN` - secret for getting data from list.php

Also set env:
* `DATABASE_SERVER` - database host and port, default `127.0.0.1:3306`
* `DATABASE_USERNAME` - user, default `viber`
* `DATABASE_PASSWORD` - password, default `viber`
* `DATABASE_NAME` - db name, default `viber`

##Mysql

See [script](tables.sql).

## Register hook

Change url in payload
```
curl 'https://chatapi.viber.com/pa/set_webhook' -d @payload -H 'X-Viber-Auth-Token: <token>' -i
```