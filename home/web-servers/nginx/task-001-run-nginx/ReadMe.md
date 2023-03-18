# Run Nginx on local 

- [docs.docker.com/samples/nginx](https://docs.docker.com/samples/nginx)
- [docs.nginx.com/nginx/admin-guide/installing-nginx/installing-nginx-docker](https://docs.nginx.com/nginx/admin-guide/installing-nginx/installing-nginx-docker)
- [hub.docker.com/_/nginx](https://hub.docker.com/_/nginx)

**High Level Objectives**
- Running nginx on local using docker run
- Exploring files /etc/nginx/conf.d/default.conf,/usr/share/nginx/html index.html and 50x.html
- Copy the files to local directory

**Skills**
- nginx
- docker
- default.conf


**Version Stack**

| Stack | Version      |
|-------|--------------|
| nginx | nginx/1.23.2 |


### Running nginx using docker and access on port 80 of host

```bash
❯ docker run -it --rm -d -p 8080:80 --name nginx nginx
92268273c3173345ac4a00a480cc05971de55bd5280b85b03e0968af4e600e9e

❯ docker ps -a                                        
CONTAINER ID   IMAGE     COMMAND                  CREATED          STATUS          PORTS                  NAMES
92268273c317   nginx     "/docker-entrypoint.…"   22 seconds ago   Up 21 seconds   0.0.0.0:8080->80/tcp   nginx
```

Accessing on [http://localhost:8080](http://localhost:8080)

```bash
❯ curl -s -o /dev/null localhost:8080 -I -w "%{http_code}"
200
```

## Exploring the files

```bash
❯ docker exec -it nginx bash
root@92268273c317:/# ls /etc/nginx/conf.d/
default.conf
root@92268273c317:/# ls /usr/share/nginx/html
50x.html  index.html
root@92268273c317:/# exit
❯ 
```

## Copy the files to local

```bash
❯  docker cp nginx:/usr/share/nginx/html/50x.html 50x.html
❯ docker cp nginx:/usr/share/nginx/html/index.html index.html 
❯ docker cp nginx:/etc/nginx/conf.d/default.conf default.conf 
❯ ls
50x.html     ReadMe.md    default.conf index.html
```

