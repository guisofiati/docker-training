# DevOps

---

## Docker 

---

### Principais comandos

- `docker ps` ou `docker container -ls` -> Lista de containers
- `docker ps -a` ou `docker container -a` -> Lista de containers que ja foram rodados na máquina

<br>

- `docker run` -> Rodar o container (cria um novo)

### Flags:
1. `-it` -> Modo iterativo (terminal)
2. `-d` -> Rodar em background (detached)
3. `-p` -> Definir porta de exibição
4. `--name` -> Definir o nome do container

<br>

- `docker start <id>` -> Startar um container já criado
- `docker stop <id>` -> Stopar um container
- `docker rm <id>` -> Excluir um container
- `docker rm -f <id>` -> Excluir um container que esta rodando
- `docker logs <id>` -> Logs do container
- `docker logs -f <id>` -> Logs do container em tempo real
- `docker build <diretorio>` -> Fazer o build da imagem
- `docker images` -> Exibir imagens instaladas
- `docker pull <imagem>` -> Download de uma imagem
- `docker tag <nome>` -> Nomear uma imagem
- `docker tag <nome>:<tag>` -> Nomear uma imagem e 'versão'

<br>

## Dockerfile 

`FROM` define a imagem base <br>
`WORKDIR` define o diretório da aplicação <br>
`EXPOSE` define a porta da aplicação <br>
`COPY` define quais arquivos precisam ser copiados <br>
