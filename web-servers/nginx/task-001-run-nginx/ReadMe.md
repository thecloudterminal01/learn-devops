

HIGH LEVEL OBJECTIVES 
- Running nginx on local using docker run
- Exploring the config file /etc/nginx/conf.d/default.conf
- Exploring the file /usr/share/nginx/html index.html and 50x.html

### Running nginx using docker and access on port 80 of host

```bash
$ docker run -it --rm -d -p 8080:80 --name web nginx


```

Accessing on [http://localhost/](http://localhost/)


#