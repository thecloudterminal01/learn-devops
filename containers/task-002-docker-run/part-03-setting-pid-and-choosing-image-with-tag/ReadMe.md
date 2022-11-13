## Setting PID and choosing image with Specific Tag

### ImageTag

[imagetag](https://docs.docker.com/engine/reference/run/#imagetag)

- Run image with specific tag say ubuntu:14.04
```bash
❯ docker run --rm -it -d ubuntu:14.04 sh
32bd86340d4773b17d5a9ba5c2f8f448ab4d29186801a6d989ad53a2a0a48af3

❯ docker ps -a                          
CONTAINER ID   IMAGE          COMMAND   CREATED         STATUS         PORTS     NAMES
32bd86340d47   ubuntu:14.04   "sh"      5 seconds ago   Up 4 seconds             practical_ishizaka
```

### PID

Let's create two containers a1 and b1, and we want container b1 to be able to see the processes running in container a1

```bash
# Terminal session 1
❯ docker run --rm --name=a1 -it ubuntu /bin/bash
root@9e16886f2f3a:/# sleep 1000




# Terminal session 2
❯ docker ps -a                              
CONTAINER ID   IMAGE     COMMAND       CREATED          STATUS          PORTS     NAMES
9e16886f2f3a   ubuntu    "/bin/bash"   50 seconds ago   Up 50 seconds             a1

# Note that b1 cannot see the processes running inside of a1 yet.
❯ docker run --rm --name=a2 -it ubuntu /bin/bash
root@b87501f4c17f:/# ps -ef
UID        PID  PPID  C STIME TTY          TIME CMD
root         1     0  0 12:30 pts/0    00:00:00 /bin/bash
root         9     1  0 12:30 pts/0    00:00:00 ps -ef
root@b87501f4c17f:/# 

```
