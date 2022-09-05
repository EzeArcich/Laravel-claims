Laravel-claims

Plataforma aún en desarrollo para gestión de siniestros. Si bien el proyecto final va a abarcar todas las necesidades del interesado, hasta donde está desarollada la apliación, ya esta siendo utilizada por sus empleados, de quienes tengo feedback y voy trabajando en pos de mejorar la experiencia del usuario y de poder terminar de desarrollar las facetas/instancias restantes.

El diseño es del panel de administración UI STISLA, editado con algo de CSS y Bootstrap.

Principalmente realizada con Laravel, apoyandome en algunas librerías de este mismo framework, me he servido también de recursos commo DataTable para la implementación de CRUD´s.

Con la librería Spatie Laravel Permission, he implementado un sistema de roles y permisos, para que dependiendo el usuario, pueda visualizar y/o acceder a las diferentes funcionalidades de la plataforma. El administrador tiene la posibilidad de crear los roles, asignarles los permisos que necesite, para así poder asignar el rol adecuada para cada usuario.

Dependiendo de los requerimientos del cliente, hay API/CRUD´s que funcionan de manera estándar a través de métodos GEt/POST/PUT, pero en uno que otro caso se debió implemntar AJAX.

En dos secciones/vistas se puede ver implementado el envío de correos automatizados, donde se envía a ciertos usuarios una plantilla de HTML con valores dinámicos señalados por el usuario. Esto se llevó a cabo con PHPmailer, a través de Gmail. Por razones obvias la función no está operativa ya que se omitieron en este repositorio los datos de correo/contraseña del cliente.

Se pueden cargar imágenes y archivos con envios múltiples, las cuales se almacenan directamente en el hosting compartido donde está hecho el despliegue de la plataforma, siendo a través del método ubicadas en una carpeta por número de gestión, estando estos anidades a la gestión correspondiente y no al azar.

A futuro la plataforma debería de contar con un sistema de comentarios, donde se señale que usuario hizo el comentario y en que horario, pudiendo agregar fotos, y recibiendo notificaciones cada vez que esto suceda. La idea es utilizar CKEditor5 para los comentarios y subida de archivos, y las notificaciones con una tabla nueva, donde aparezcan las notificaciones del usuario teniendo dos estados (1-sin leer/2-leído).

