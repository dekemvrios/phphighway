#!/bin/sh

# |----------------------------------------------------------------------------
# | Script de inicializa��o do container docker para executar a aplica��o
# |----------------------------------------------------------------------------
# |
# | Valida o tipo de script a ser executado de acordo com o argumento fornecido.
# | Caso nenhum argumento for fornecido o container ser� inicializado. Para que
# | seja desligado � necess�rio que a literal 'down' seja fornecida como argumento.
# |
arg="$1"

type_script="up -d"
case "$arg" in
"down") type_script="down";;
*)
esac

# |----------------------------------------------------------------------------
# | Definir valor de ender�o de IP da m�quina local
# |----------------------------------------------------------------------------
# |
# | Captura valor de ender�o de IP da m�quina local de modo a ser utilizada na
# | conex�o com o debugger da aplica��o.
# |
ip_addres=$(eval hostname -I | awk '{print $1}')

# |----------------------------------------------------------------------------
# | Definir valor do diret�rio no qual o manager est� localizado
# |----------------------------------------------------------------------------
# |
# | Captura o caminho para o diret�rio atual e o atribui como diret�rio onde o
# | manager est� localizado. Este sera utilizado para defini��o dos subdiret�rios
# | da aplica��o.
# |
current_directory=$(eval pwd)

# |----------------------------------------------------------------------------
# | Definir valor do diret�rio root da aplica��o
# |----------------------------------------------------------------------------
# |
# | Utiliza o valor de current_directory de modo a definir o caminho do root da
# | aplica��o, que ser� mapeado no container docker.
# |
app_root=$current_directory

# |----------------------------------------------------------------------------
# | Definir valor do caminho para o arquivo docker
# |----------------------------------------------------------------------------
# |
# | Com base no valor de current_directory, define o caminho para o arquivo docker
# | que ser� utilizado para iniciar a aplica��o.
# |
docker_file=$current_directory/sample/environment/docker/docker-compose-apache.yml

# |----------------------------------------------------------------------------
# | Definir valor do caminho para o arquivo de configura��o apache
# |----------------------------------------------------------------------------
# |
# | Com base no valor de current_directory, define o caminho para o arquivo apache
# | utilizado para configura��o do ambiente servidor.
# |
apache_conf=$current_directory/sample/environment/apache/apache.conf

# |----------------------------------------------------------------------------
# | Inicializa a aplica��o
# |----------------------------------------------------------------------------
# |
# | Executa o comando docker-compose de modo a inicializar a aplica��o com base
# | nos valores definidos anteriormente.
# |

IP=$ip_addres \
APP_ROOT=$app_root \
APACHE_CONF=$apache_conf \
docker-compose -f $docker_file $type_script