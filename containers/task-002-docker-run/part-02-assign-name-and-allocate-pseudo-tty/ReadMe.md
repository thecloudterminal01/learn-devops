## Assign name and allocate pseudo tty

[docs.docker.com/engine/reference/commandline/run](https://docs.docker.com/engine/reference/commandline/run/#assign-name-and-allocate-pseudo-tty---name--it)

- Let's begin


```bash
docker run --name test -it debian

root@d6c0fe130dba:/# exit 13
echo $?
13
docker ps -a | grep test
d6c0fe130dba        debian:7            "/bin/bash"         26 seconds ago      Exited (13) 17 seconds ago                         test
```