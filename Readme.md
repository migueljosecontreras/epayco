#Instalación
-Cambiar a gusto los .env, primero que nada.
-Se necesitan credenciales y un correo electrónico para que el sistema pueda enviar mensajes.
-La variable de entorno MAIL_DEBUG es netamente para programadores, esto significa que si está en true, todos los correos llegan al desarrollador siempre, vigilar que esté en false.
# Instalación Automática
-Si se ejecuta en un sistema operativo Linux, basta con ejecutar el comando "bash stack up".
-Verificar que todos los contenedores hayan levantado correctamente (docker ps)
# Instalación Manual
-Si se desea levantar el sistema manualmente, solamente se debe acceder en la carpeta database, levantar el contenedor (docker-compose up -d), y en los servicios (gateway y apirest) hacer uso del "make init"
-Verificar que todos los contenedores hayan levantado correctamente (docker ps)
# Varios
-Hay 3 servicios, base de datos, gateway (servicio puente entre cliente y el restfull), y el servicio restfull.
-El servicio soap no fué realizado como se mencionó en nuestra conversación, en lugar de ello se hizo un servicio restfull.
-Estoy 100% seguro de hacer un servicio soap, sólo que como mencioné, no he creado uno antes (sólo he hecho consultas), y por el tiempo limitado, no quise arriesgarme a no poder hacer la entrega si las investigaciones/pruebas no salían como se esperaba.
-El servicio gateway o puente está hecho en Lumen
-El servicio restfull está hecho en lumen
-Se usó base de datos myqsl
-Se usó base de datos no relacional de mongo para implementar un registro de logs dentro del sistema 
-Cada acción dentro del sistema genera un registro de log (se puede hacer metodos show y que al obtener un registro, puedan aparecer los logs del mismo, sin importar que esté en dos gestores de base de datos distintos)
-Implementé un servicio supervisor que corre automaticamente (esto para ejecución de comandos mediante el kernel de lumen)
-Implementé un cronjob que levanta automaticamente cuando se despliega el docker
-En el servicio restfull hay un comando de esperar a que la base de datos corra, esto se tiene ya que en ciertos pipelines la base de datos no ha levantado cuando intenta ejecutar un migrate por ejemplo.
-Simulé que el servicio rest está dentro de un kubernet, por lo que el comando CMD que levanta el sistema contiene todo para el correcto funcionamiento del sistema, pude muy bien ejecutar los comandos en el docker-compose.yml pero quería hacer mención que sé trabajar con docker dentro de kubernets.
-El gateway funciona como el apigateway de una arquitectura de microservicios.
-Ustedes no hicieron mención o requerimiento de seguridad dentro del sistema, pero quise implementarla de igual forma, por lo que las peticiones requieren del Bearer Token (a excepción del login y el register).
-Al hacer login dentro del postman, automaticamente tomo el token generado y lo guardo en la variable de entorno de token, por lo que al usuario que vaya a hacer pruebas le sea invisible el funcionamiento del Bearer Token y no le genere pasos extras.
-Hice dos tipos de rol en el sistema admin (migueljosecontreras@gmail.com 123456) y client. Admin puede recargar/pagar/consultar a cualquier usuario, mientras que client, el documento y telefono a recargar/pagar/consultar, tienen que ser de él mismo, así que TENER EN CUENTA al momento de hacer pruebas dentro del postman y no pensar que da un 404 por error de sistema, será error de usuario.
-Hice uso de traits y scopes para el ORM, Peticiones y Respuestas dentro del sistema, esto con la finalidad de dar a entender que esto es totalmente escalable, si requieren cambiar la estructura de respuesta, consultas a base de datos, validaciones de usuario, integrarlo con un servicio soap y que la comunicación del puente al servicio cambie, no hay que rehacer mucha lógica, todo converge y se reutiliza en 1 archivo donde pueda alterarse.
-Hice uso del helper trans de lumen para retornar mensajes, esto para dar a entender que sé trabajar con multiples idiomas en un sistema, sin necesidad de reescribir código.
-La zona horaria es la UTC pero bien puede modificarse.
-Se configuró un make init para los servicios de gateway y de restfull para que el despliege sea con un solo comando, esto facilita la vida en los pipelines.
-Se implementó pruebas unitarias que verifican el correcto levantamiento del sistema y de la conexión entre los demás.
