## Detached vs Foreground

- [docs.docker.com/engine/reference/run](https://docs.docker.com/engine/reference/run)

By design, containers started in detached mode exit when the root process used to run the container exits

- [docs.docker.com/engine/reference/commandline/run](https://docs.docker.com/engine/reference/commandline/run)

### Detached Mode

```bash
# Note: No --rm option
❯ docker run -d -p 80:80 nginx service nginx start 
3fdd6761951aeba2a8936a54a7fea982b1b7073a0d2892cab9a4c095d080900b

# Note the container exited after starting
❯ docker ps -a                                    
CONTAINER ID   IMAGE     COMMAND                  CREATED         STATUS                     PORTS     NAMES
3fdd6761951a   nginx     "/docker-entrypoint.…"   4 seconds ago   Exited (0) 4 seconds ago             wonderful_fermi

# Note: We added --rm option
❯ docker run --rm -d -p 80:80 nginx service nginx start
e836a7703057577b1aa58ac5cf9ca4e9bb85767069651f9fd8ac1972c4d041c0

# The container also exited after being stopped
❯ docker ps -a                                         
CONTAINER ID   IMAGE     COMMAND   CREATED   STATUS    PORTS     NAMES
❯ 
```


### Foreground Mode

In foreground mode (the default when -d is not specified), docker run can start the process in the container and attach the console to the process’s standard input, output, and standard error

For interactive processes (like a shell), you must use -i -t together in order to allocate a tty for the container process

```bash
❯ docker run -it ubuntu  /bin/bash              
root@6036032b640a:/# ls
bin   dev  home  media  opt   root  sbin  sys  usr
boot  etc  lib   mnt    proc  run   srv   tmp  var
root@6036032b640a:/# exit
exit

❯ 
```