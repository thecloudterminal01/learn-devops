# Understanding Nginx Conf and HTML dirs

[nginx docker container](https://www.digitalocean.com/community/tutorials/how-to-run-nginx-in-a-docker-container-on-ubuntu-14-04)

**High Level Objectives**
- start the docker container with custom conf and html dirs
- understand the custom conf and html dirs
- hit different endpoints and validate
- understand proxypass and accesslogs

**Skills**
- nginx
- docker
- default.conf
- proxypass
- accesslogs

**Version Stack**

| Stack | Version      |
|-------|--------------|
| nginx | nginx/1.23.2 |

```bash
docker run --rm                            \
--name docker-nginx                   \
-p 8080:80                              \
-d                                    \
--volume $PWD/html:/usr/share/nginx/html    \
--volume $PWD/conf.d:/etc/nginx/conf.d      \
nginx
```

- Check

```bash
$ docker ps -a | egrep -v "k8s"                                                                                                           
CONTAINER ID   IMAGE                                  COMMAND                  CREATED         STATUS         PORTS                                   NAMES
33680e0cb240   nginx                                  "/docker-entrypoint.…"   5 seconds ago   Up 3 seconds   0.0.0.0:8080->80/tcp, :::8080->80/tcp   docker-nginx
```

- Test the endpoint

```bash
❯ curl -s -o /dev/null localhost:8080 -I -w "%{http_code}"
200

❯ curl http://localhost:8080                              
<html>
<head>
    <title>Docker nginx Tutorial</title>
</head>
<body>
<div class="container">
    <h1>Hello Nginx </h1>
    <p>This nginx page is brought to you by Docker</p>
</div>
</body>
</html>

```

- Check if your file is mounted

```bash
$ docker exec -it docker-nginx sh
# ls /usr/share/nginx/html
index.html
# cat /usr/share/nginx/html/index.html
<html>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <title>Docker nginx Tutorial</title>
</head>
<body>
<div class="container">
    <h1>Hello Digital Ocean</h1>
    <p>This nginx page is brought to you by Docker and Digital Ocean</p>
</div>
</body>
</html># 


# ls /etc/nginx/conf.d
default.conf
```

- Test wrong endpoint

```bash
❯ curl http://localhost:8080/50x.html
<!DOCTYPE html>
<html>
<head>
<title>Error</title>
<style>
html { color-scheme: light dark; }
body { width: 35em; margin: 0 auto;
font-family: Tahoma, Verdana, Arial, sans-serif; }
</style>
</head>
<body>
<h1>An error occurred.</h1>
<p>Sorry, the page you are looking for is currently unavailable.<br/>
Please try again later.</p>
<p>If you are the system administrator of this resource then you should check
the error log for details.</p>
<p><em>Faithfully yours, nginx.</em></p>
</body>
</html>
```

- Denyme

```bash
❯ curl -s -o /dev/null localhost:8080/denyme -I -w "%{http_code}"
403
```

- Proxypass

```bash
❯ docker exec -it docker-nginx bash
root@30f660869ee3: apt update
root@30f660869ee3: apt install python3
root@30f660869ee3:/usr/share/nginx/html# ls
50x.html  index.html
root@30f660869ee3: python3 -m http.server 1337 --bind 0.0.0.0
127.0.0.1 - - [17/Mar/2023 11:30:44] "GET /index.html HTTP/1.0" 200 -
.
.


❯ curl http://localhost:8080/proxyme  
<html>
<head>
    <title>Docker nginx Tutorial</title>
</head>
<body>
<div class="container">
    <h1>Hello Nginx </h1>
    <p>This nginx page is brought to you by Docker</p>
</div>
</body>
</html>
```


- Check access logs

```bash
root@30f660869ee3:/usr/share/nginx/html# cd /var/log/nginx/
root@30f660869ee3:/var/log/nginx# tail -4f host.access.log 
172.17.0.1 - - [17/Mar/2023:20:36:43 +0000] "GET /proxyme HTTP/1.1" 502 497 "-" "curl/7.77.0" "-"
172.17.0.1 - - [17/Mar/2023:20:36:47 +0000] "GET /proxypass HTTP/1.1" 404 153 "-" "curl/7.77.0" "-"
172.17.0.1 - - [17/Mar/2023:20:36:50 +0000] "GET / HTTP/1.1" 200 197 "-" "curl/7.77.0" "-"
172.17.0.1 - - [17/Mar/2023:20:36:50 +0000] "GET / HTTP/1.1" 200 197 "-" "curl/7.77.0" "-"
```