## Lauch app

```
docker build . -t viber
docker run --network host -e VIBER_TOKEN=token -e LIST_TOKEN=secret viber
```

## Register hook

Change url in payload
```
curl 'https://chatapi.viber.com/pa/set_webhook' -d @payload -H 'X-Viber-Auth-Token: <token>' -i
```