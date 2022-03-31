# Docker 

## _STACKS DO TREINAMENTO:_
- Docker Swarm 
- Kubernetes
- AWS EC2 - AMI (Amazon Machine Image)
- Docker Labs - PWD (Play With Docker)

<br>

## Mini aurélio:
**Cluster:** dois ou mais computadores/servidores, cada um deles recebe o nome de _node_ ou _nó_ <br>
**Node:** uma máquina do cluster

<br>

### Principais comandos:

#### Flags:
1. `-it` -> Modo iterativo (terminal)
2. `-d` -> Rodar em background (detached)
3. `-p` -> Definir porta de exibição
4. `--name` -> Definir o nome do container
5. `--rm` -> Remove container quando stopado
6. `-v <diretorio>` -> Criar volume
7. `-v <diretorio>:<path>:ro` -> Volume so de leitura

<br>

- `docker run {flag} <container>` -> Rodar o container (cria um novo)
- `docker ps` ou `docker container -ls` -> Lista de containers
- `docker ps -a` ou `docker container -a` -> Lista de containers que ja foram rodados na máquina
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
- `docker login` -> Logar no DockerHub
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
`CMD` executa algo apos ser criado container. ex: **CMD["python", "hello"]** <br>
`RUN` executa qualquer comanda em uma nova camada da imagem <br>
`ENV` variaveis de ambiente, declarar um path por exemplo e usar nos demais comandos <br>
`ENTRYPOINT` comando principal da imagem, primeira coisa a ser executada. ex: `ENTRYPOINT["echo"] CMD["--help"] ` <br>

<br>

## Docker Swarm

**Manager node:** O node que gerencia todos os outros nodes <br>
**Worker node:** recebe funções do manager, pegam o que foi encaminhado dele e replicam nas suas máquinas <br>
**Tasks:** Comandos que são executados nos nodes <br>
**Service:** Conjunto de tasks que o manager manda o para o worker executar <br>

<br>

- `docker swarm init --advertise-addr <ip node>` -> Cria um node manager
- `docker swarm join --token <token> <ip>:<porta>` -> Adicionar nodes (máquinas) ao manager. As adicionadas serão _Workers_. Todas as ações (tasks) utilizadas no manager serão replicadas nos nodes workers
- `docker swarm leave` -> Exclui/Derruba node do swarm, ficando em **STATUS: _Down_**, ainda permanece no cmd **docker node ls** 
- `docker node ls` -> Lista as máquinas conectadas/nodes ativos. Monitora o que esta sendo orquestrado
- `docker service create --name <nome> { *alguns serviços -p <ip>:<porta> <imagem>` -> Subir um serviço (criará um container que vai rodar na máquina)
- `docker service ls` -> Listar serviços rodando no swarm
- `docker service rm <id>` -> Remove um serviço criado
- `docker service create --name <nome> -p <ip>:<porta> --replicas <num. replicas) <imagem>` -> Criar serviço com réplicas, ou seja, se um node cair, ainda terá outros nodes que replica tudo o que o node manager faz
- `docker node rm <id>` -> Remover um node
- `docker swarm join-token manager` -> Gera o token para poder dar join como manager em outros nodes
- `docker swarm join-token worker` -> Gera o token para poder dar join como worker em outros nodes
- `docker info` -> Mostra o id do node, numero de nodes, numero de managers, etc...
- `docker service inspect <id>` -> Mostra dados como porta, nome do serviço, data que foi criado/atualizado...
- `docker service ps <id>` -> Verificar containers rodando
- `docker stack deploy -c <arquivo.yml> <nome>` -> Rodar compose no swarm
- `docker service scale <nome>=<num. replicas>` -> Escalar mais nodes para o serviço
- `docker node update --availability drain <id>` -> Faz com que o node não receba mais ordens do manager, ficando com **STATUS: _Drain_**
- `docker node update --availability active <id>` -> Faz com que o node mude para **STATUS: _Active_** e passe a receber ordens do manager
- `docker service update --image <imagem> <servico>` -> Atualiza parâmetro da imagem no serviço. *Obs: Apenas quem tem status active poderá receber as atualizações
- `docker service update --network-add <rede> <nome>` -> Atualiza parâmetro da network do serviço, ou podemos passar também na criação do serviço utilizando a flag `--network <nome>`

<br>

## Kubernetes

**Control plane:** Onde é gerenciado o controle dos processos dos nodes (manager) <br>
**Nodes:** Máquinas gerenciadas pelo _control plane_ <br>
**Pod:** Um ou mais containers que estão em um _node_. Pods é onde os containers são executados <br>
**Deployment:** Execução de uma imagem/projeto em um _pod_ <br>
**Services:** Serviços que expoe os _pods_ ao mundo externo <br>
**kuberctl:** Cliente de linha de comando do k8s (terminal) <br>

<br>

**minikube:** Simulador de k8s, para não precisarmos de vários computadores/servidores, implanta um custer de apenas um nó (node) na máquina local <br>
- `minikube start --driver=<driver> (docker, virtualbox, hyperv)` -> Startar/Restart o minikube (se tornará o control plane)
- `minikube status` -> Ver status atual do serviço
- `minikube stop` -> Stopar serviço
- `minikube dashboard / (--url)` -> Disponibilizar um dashboard para monitorar/consultar serviços, pods...  

<br>

### Modo imperativo (executando a aplicação na mão com comandos)

- `kubectl create deployment <nome> --image=<imagem>` -> Fazer o deploy em cima de uma imagem criada.
- `kubectl get deployments` -> Verificar todos os deployments
- `kubectl describe deployments` -> Mais infos/detalhes dos deployments 
- `kubectl get pods` -> Verificar todos os pods
- `kubectl describe pods` -> Mais infos/detalhes dos pods
- `kubectl config view` -> Configurações do k8s, infos do minikube
- `kubuctl expose deployment <nome_do_deployment> --type<tipo> (LoadBalancer) --port<porta>` -> Cria um serviço
- `minikube service <nome_do_servico>` -> Cria um ip para poder acessar o serviço
- `kubectl get services` -> Verificar todos os serviços
- `kubectl describe services/<nome_do_servico>` -> Detalhes/infos do serviço
- `kubectl scale deployment/<nome_do_deployment> --replicas=<numero>` -> Criar réplicas, escalar aplicação. Mesmo cmd para diminuir as réplicas, só diminuir o número de réplicas depois de ter as criado.
- `kubectl get rs` -> Checar as réplicas, ver status...
- `kubectl set imagem deployment/<nome_do_deployment> <nome_do_container>=<nova_imagem>:<tag>` -> Atualizar imagem
- `kubectl rollout status deployment/<nome_do_deployment>` -> Verificar uma alteração
- `kubectl rollout undo deployment/<nome_do_deployment>` -> Desfazer uma alteração
- `kubectl delete service <nome_do_servico>` -> Deletar um serviço
- `kubectl delete deployment <nom_do_deployment>` -> Deletar um deployment

### Modo declarativo (executando aplicaçao com arquivo, semelhante ao compose)

Chaves mais utilizadas: <br>
`apiVersion`: versão da ferramenta <br>
`kind`: tipo de arquivo (deployment, service) <br>
`metadata`: descrever algum objeto (nome), ex serviço <br>
`replicas`: número de réplicas de nodes/pods <br>
`containers`: definir as especificações de containers (nome, imagem) <br>

<br>

- `kubectl apply -f <arquivo_yaml>` -> Executar deployment que esta configurado no arquivo
- `kubectl delete -f <arquivo_yaml>` -> Parar/deletar deployment
