# Docker 

## _STACKS DO TREINAMENTO:_
- Docker Swarm 
- AWS EC2 - AMI (Amazon Machine Image)
- Kubernetes

### Principais comandos

- `docker ps` ou `docker container -ls` -> Lista de containers
- `docker ps -a` ou `docker container -a` -> Lista de containers que ja foram rodados na máquina

<br>

- `docker run {flag} <container>` -> Rodar o container (cria um novo)

### Flags:
1. `-it` -> Modo iterativo (terminal)
2. `-d` -> Rodar em background (detached)
3. `-p` -> Definir porta de exibição
4. `--name` -> Definir o nome do container
5. `--rm` -> Remove container quando stopado
6. `-v <diretorio>` -> Criar volume
7. `-v <diretorio>:<path>:ro` -> Volume so de leitura

<br>

- `docker start <id>` -> Startar um container já criado
- `docker stop <id>` -> Stopar um container
- `docker stop <id> <id>` -> Stopar varios containers de uma vez
- `docker rm <id>` -> Excluir um container
- `docker rm -f <id>` -> Excluir um container que esta rodando
- `docker logs <id>` -> Logs do container
- `docker logs -f <id>` -> Logs do container em tempo real
- `docker build <diretorio>` -> Fazer o build da imagem
- `docker images` -> Exibir imagens instaladas
- `docker pull <imagem>` -> Download de uma imagem
- `docker tag <nome>` -> Nomear uma imagem
- `docker tag <imagem> <nome>:<tag>` -> Nomear uma imagem e 'versão'
- `docker rmi <imagem>` -> Remover uma imagem
- `docker rmi -f <imagem>` -> Remover uma imagem que esta sendo utilizada em um container
- `docker system prune` -> Remove imagens/container/networks não utilizados
- `docker top <container>` -> Dados de execução do container (pid, cmd...)
- `docker inspect <container>` -> Dados do container (id, imagem, data criação...)
- `docker stats <container>` -> Processos sendo executados em um container (processamento e memória) 
- `docker cp <container>:<caminho> <folder>` -> Copiar arquivos para uma folder
- `docker push <user>:<repo>` -> Enviar para o docker hub
- `docker volume ls` -> Ver todos os volumes do ambiente
- `docker volume create <nome>` -> Criar volume
- `docker volume rm <nome>` -> Apagar volume
- `docker volume prune` -> Apagar todos os volumes
- `docker volume inspect <nome>` -> Dados de um volume
- `docker network ls` -> Listar networks
- `docker network create <nome>` -> Criar network
- `docker network rm <nome>` -> Excluir network
- `docker network prune` -> Excluir todas as networks
- `docker network connect <rede> <container>` -> Conectar em um network (não sendo necessário dar no run)
- `docker network disconnect <rede> <container>` -> Disconectar container de uma network
- `docker network inspect <nome>` -> Dados de uma rede (nome, data criação, containers conectados, drivers, etc...)
- `docker-compose up` -> Startar compose
- `docker-compose down` -> Stopar compose
- `docker-compose ps` -> Dados do compose inicializado

<br>

## Dockerfile 

`FROM` define a imagem base <br>
`WORKDIR` define o diretório da aplicação <br>
`EXPOSE` define a porta da aplicação <br>
`COPY` define quais arquivos locais precisam ser copiados para o container <br>
`ADD` mesma coisa que o copy mas tem algumas features como suporta a URL externa e extração de arquivos locais *tar* <br>
`CMD` executa algo apos ser criado container. ex: CMD["python", "hello"] <br>
`RUN` executa qualquer comanda em uma nova camada da imagem <br>
`ENV` variaveis de ambiente, declarar um path por exemplo e usar nos demais comandos <br>
`ENTRYPOINT` comando principal da imagem, primeira coisa a ser executada. ex: `ENTRYPOINT["echo"] CMD["--help"] ` <br>
