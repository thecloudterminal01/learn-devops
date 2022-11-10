# Docker overview


[docs.docker.com/get-started/overview](https://docs.docker.com/get-started/overview)


## Usecase to solve actual problem

### docker run

The following command runs an `ubuntu` container, attaches interactively to your local command-line session, and runs `/bin/bash`.

```bash
❯  docker run -i -t ubuntu /bin/bash

root@f3d2356faadc:/# ls
bin  boot  dev  etc  home  lib  media  mnt  opt  proc  root  run  sbin  srv  sys  tmp  usr  var
```

> Docker starts the container and executes /bin/bash. Because the container is running interactively and attached to your terminal (due to the -i and -t flags), you can provide input using your keyboard while the output is logged to your terminal.

That's all for today!