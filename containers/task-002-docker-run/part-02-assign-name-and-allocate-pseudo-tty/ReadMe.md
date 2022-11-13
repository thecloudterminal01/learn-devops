## Assign name and allocate pseudo tty

[docs.docker.com/engine/reference/commandline/run](https://docs.docker.com/engine/reference/commandline/run/#assign-name-and-allocate-pseudo-tty---name--it)

- Let's begin


```bash
# allocate pseudo tty : -it
# --name for container name
❯ docker run --name test -it debian

root@d6c0fe130dba:/# exit 13

# Note the exit code is passed to the caller of docker run.
❯ echo $?                                                                                               
13
❯ docker ps -a                                                          
CONTAINER ID   IMAGE     COMMAND   CREATED              STATUS                       PORTS     NAMES
4a94928d6520   debian    "bash"    About a minute ago   Exited (13) 54 seconds ago             test
```

