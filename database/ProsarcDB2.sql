	drop DATABASE Prosarcdb;
	create DATABASE Prosarcdb;
	use Prosarcdb;

/*Tabla de departamentos*/
create table Departamento(
	ID_Depart int auto_increment unique,
	DepartName varchar(64),
	DepartRegionName varchar(64),
	DepartCapitalName varchar(64),
	FK_DepartCountry int,
	primary key(ID_Depart),
	foreign key (FK_DepartCountry) references Country(ID_Country) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*Tabla de municipios*/
create table Municipio(
	ID_Mun int auto_increment unique,
	MunName varchar(64),
	FK_MunCity int,
	primary key(ID_Mun),
	foreign key (FK_MunCity) references Departamento(ID_Depart) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*TAbla de clientes*/
create table Cliente(
	ID_Cli int auto_increment unique,
	CliNit bigint, /*nit*/
	CliName varchar(255), /*razon social del cliente*/
	CliShortname varchar(32), /*nombre corto del cliente*/
	CliCode varchar(32), /*codigo del cliente ejem: "PL 1 AND"-.S" */
	CliType varchar(32),/*tipo de empresa: organico; biologico; industrial; medicamentos; otros ETC...*/
	CliCategoria varchar(32), /*cliente, generador, transportador, Proveedor etc..*/
	CliAuditable boolean, /*¿cliente auditable?*/
	created_at TIMESTAMP NULL DEFAULT NULL, /*fecha de creacion*/
	updated_at TIMESTAMP NULL DEFAULT NULL,/*fecha de actualizacion*/
	primary key (ID_Cli)
)

/*sedes de cada cliente*/
create table Sede(
	ID_Sede int auto_increment unique,
	SedeName varchar(128), /*nombre de la sede*/
	SedeAddress varchar(255), /*direccion*/
	SedePhone1 varchar(32), /*telefono fijo 1*/
	SedeExt1 int(8),
	SedePhone2 varchar(32), /*telefono fijo 2*/
	SedeExt2 int(8),
	SedeEmail varchar(128),/*correo electronico*/
	SedeCelular varchar(32),/*telefono celular*/
	created_at TIMESTAMP NULL DEFAULT NULL, /*fecha de creacion*/
	updated_at TIMESTAMP NULL DEFAULT NULL,/*fecha de actualizacion*/
	FK_SedeCli int, /*foranea de la tabla cliente*/
	FK_SedeMun int, /*foranea de la tabla municipio*/
	primary key (ID_Sede),
	foreign key (FK_SedeCli) references Clientes(ID_Cli) ON UPDATE CASCADE,
	foreign key (FK_SedeMun) references Municipio(ID_Mun) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla de generadores de cada cliente*/
create table Generador(
	ID_Gener int auto_increment unique,
	GenerName varchar(255),
	GenerShortname varchar(64),
	GenerCode varchar(32), /*codigo del generador ejem: "PL 1 AND"-.S" */
	GenerType varchar(32),/*tipo de empresa: organico; biologico; industrial; medicamentos; otros ETC...*/
	GenerNit varchar(20), /*nit*/
	GenerAuditable boolean, /*¿cliente requiere tratamientos auditables?*/
	created_at TIMESTAMP NULL DEFAULT NULL, /*fecha de creacion*/
	updated_at TIMESTAMP NULL DEFAULT NULL,/*fecha de actualizacion*/
	FK_GenerCli int, /*foranea de la tabla Sede*/
	primary key (ID_Gener),
	foreign key (FK_GenerCli) references Sede(ID_Sede) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*sedes de generadores de residuos*/
create table GenerSede(
	ID_GSede int auto_increment unique,
	GSedeName varchar(128),
	GSedeAddress varchar(255),
	GSedePhone varchar(32),
	GSedePhoneExt varchar(8),/*numero de extencion*/
	GSedeEmail varchar(128),	
	GSedeCelular varchar(32),
	created_at TIMESTAMP NULL DEFAULT NULL, /*fecha de creacion*/
	updated_at TIMESTAMP NULL DEFAULT NULL,/*fecha de actualizacion*/
	FK_GSedeMun int,
	FK_GSede int, /*foranea de la tabla generador*/
	primary key (ID_GSede),
	foreign key (FK_GSede) references Generador(ID_Gener) ON UPDATE CASCADE,
	foreign key (FK_GSedeMun) references Municipio(ID_Mun) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla de residuos peligrosos declarados*/
Create table Respel(
	ID_Respel int auto_increment unique,
	RespelName varchar(128),
	RespelDescrip varchar(512),
	RespelClasf4741 varchar(64),/*codigo de la corriente segun legislacion*/
	RespelIgrosidad varchar(128), /*inflamable; toxico etc...*/
	RespelEstado varchar(32), /*liquido; solido; gaseoso etc...*/
	RespelHojaSeguridad varchar(128), /*ubicacion en servidor de la imagen de la hoja de seguridad*/
	RespelTarj varchar(128), /*ubicacion en servidor de la imagen de la Tarjeta de emergencia*/
	RespelStatus varchar(16), /*aprobada, negada, pendiente, incompleta*/
	FK_RespelGenerSede int, /*foranea de la tabla GenerSede para especificar areas, centros de costos, etc*/
	primary key (ID_Respel),
	foreign key (FK_RespelGenerSede) references GenerSede(ID_GSede) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*areas o dependencias de un modulo*/
	create table Area(
		ID_Area int auto_increment unique,
		AreaName varchar(128),
		FK_AreaSede int, /*foranea de la tabla sede*/
		primary key (ID_Area),
		foreign key (FK_AreaSede) references Sede(ID_Sede) ON UPDATE CASCADE
	)
		COLLATE='utf8mb4_unicode_ci'
		ENGINE=InnoDB;

/*tabla de cargos o jerarquias*/
create table Cargo(
	ID_Carg int auto_increment unique,
	CargName varchar(128),
	CargSalary int, /*salario actual*/
	CargGrade varchar(128), /*grado de instruccion*/
	FK_CargOfi int, /*el cargo corresponde a un area especifica*/
	primary key	(ID_Carg),
	foreign key (FK_CargOfi) references Area(ID_Area) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*datos de empleados de prosarc*/
create table Personal(
	ID_Pers int auto_increment unique,
	PersType boolean, /*interno o externo a Prosarc*/
	PersDocNumber int unique, /*numero de documento*/
	PersFirstName varchar(64),
	PersSecondName varchar(64),
	PersLastName varchar(64),
	PersDocType varchar(32), /*tipo de documento*/
	PersLibreta varchar(32), /*numero de libreta militar*/
	PersPase varchar(32), /*opcional: numero del pase de conduccion...*/
	PersBirthday date,
	PersPhoneNumber varchar(64),/*telefono fijo*/
	PersCellphone varchar(64),/*telefono celular*/
	PersAddress varchar(255),
	PersEPS varchar(255),
	PersARL varchar(255),
	PersBank varchar(128),
	PersBankAccaunt int,
	PersIngreso date, /*fecha de ingreso a Prosarc*/
	PersSalida date, /*fecha de egreso a Prosarc(renuncias, despido)*/
	FK_PersCargo int, /*foranea de la tabla posicion para relacionar el cargo de la persona*/
	primary key (ID_Pers),
	foreign key (FK_PersCargo) references Cargo(ID_Carg) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla de las diferentes capacitaciones del personal*/
Create table Capacitacion(
	ID_Capa int auto_increment unique,
	CapaName varchar(64), /*nombre de la capacitacion*/
	CapaTipo boolean, /*interna o externa*//*internas: ARL EPS PROSARC Externa:Cliente*/
	primary key	(ID_Capa)
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla para romper la relacion de muchos a muchos de la tabla Capacitacion*/
Create table CapacitacionPersonal(
	ID_CapPers int auto_increment unique,
	CapaPersDate date, /*fecha de aprovacion*/
	CapaPersExpire date, /*fecha de vencimiento*/
	FK_Sede int,
	FK_Capa int,
	FK_Pers int,
	foreign key (FK_Sede) references Sede(ID_Sede) ON UPDATE CASCADE,
	foreign key (FK_Capa) references Capacitacion(ID_Capa) ON UPDATE CASCADE,
	foreign key (FK_Pers) references Personal(ID_Pers) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla para registro y consulta de dias festivos (no relacionar)*/
create table DiasFestivos(
	ID_festivo int auto_increment unique,
	FestivoDate date,
	FestivoType varchar(32),/*Tipo de festipo ejem: Bancario, Nacional, etc...*/
	primary key(ID_festivo)
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla de horarios programados para cada persona*/
create table Horario(
	ID_Horario int auto_increment unique,
	HorarioFecha date,
	Horariotipo varchar(32), /*Trabaja, Descanza, Capacitacion, Examen, otro*/
	HorariotipoOther varchar(64), /*observacion si HorarioTipo = otro*/
	HorarioFeriado boolean, /*domingos y lunes festivos marcados como si*/
	HorarioEntrada DATETIME,
	HorarioSalida DATETIME,
	HoraPermisoInicio DATETIME,
	HoraPermisoFin DATETIME,
	FK_HoraPers int, /*foranea de la tabla personas*/
	primary key (ID_Horario),
	foreign key (FK_HoraPers) references Personal(ID_Pers) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla para registro de llegadas y salidas del personal prosarc*/
create table Asistencia(
	ID_Asis int auto_increment unique,
	AsisLlegada timestamp, /*fecha y hora registrada de llegada*/
	AsisSalida timestamp, /*fecha y hora registrada de salida*/
	AsisNocturnas int, /*cantidad de horas nocturnas laboradas*/
	FK_AsisPers int,
	primary key (ID_Asis),
	foreign key (FK_AsisPers) references Personal(ID_Pers) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*Tabla de vehiculos*/
create table Vehiculo(
	ID_Vehic int auto_increment	unique,
	VehicPlaca varchar(16) unique,
	VehicInternExtern boolean,
	VehicTipo varchar(64), /*furgon, mula, sencillo, turbo etc...*/
	VehicCapacidad varchar(64),
	VehicKmActual int, /*km actual de vehiculo*/
	FK_VehiSede int, /*foranea de la tabla sede*/
	primary key (ID_Vehic),
	foreign key (FK_VehiSede) references Sede(ID_Sede) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla de mantenimiento a los vehiculos de prosarc*/
create table MantenVehic(
	ID_Mv int auto_increment unique,
	MvKm int, /*km del vehiculo al momento del mantenimiento*/
	MvStatus boolean, /*Pendiende o Realizado el mantenimiento*/
	MvType varchar,/*Tipo de mantenimiento: Aceite, TecnoMecanica,Tanqueo, etc...*/
	HoraMantenimientoInicio datetime, /*hora de inicio del mantenimiento*/
	HoraMAntenimientoFin datetime, /*hora fin del mantenimiento*/
	FK_VehMan int, /*foranea de la tabla progvehiculo para validar la fecha del mantenimiento*/
	primary key (ID_Mv),
	foreign key (FK_VehMan) references Vehiculo(ID_Vehic) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*Tabla de programacion de vehiculos*/
create table ProgVehiculo(
	ID_ProgVeh int auto_increment unique,
	ProgVehFecha date, /*fecha de la progamacion*/
	progVehKm int, /*km del vehiculo al inicio del dia*/
	ProgVehTurno boolean, /*tarde o mañana*/
	ProgVehtipo boolean, /*Trabaja o Mantenimiento*/
	ProgVehEntrada datetime, /*hora de llegada a planta*/
	ProgVehSalida datetime, /*hora de salida de planta*/
	FK_ProgMan int,
	primary key (ID_ProgVeh),
	foreign key (FK_ProgMan) references MantenVehic(ID_Mv) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla para registro de activos de la empresa... muebles, herramientas, partes etc...*/
create table CategoriaAct(
	ID_CatAct int auto_increment unique,
	CatName varchar(128),
	primary key (ID_CatAct)
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla para registro de sub categorias*/
create table SubCatAct(
	ID_SubCat int auto_increment unique,
	SubCatName varchar(128),
	FK_SubCat int,
	primary key (ID_SubCat),
	foreign key	(FK_SubCat) references CategoriaAct(ID_CatAct) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla de activos que tienen su subcategoria*/
create table Activo(
	ID_Act int auto_increment unique,
	ActName varchar(128),
	ActUnid boolean, /*unidad o peso*/
	ActCant int, /*cantidad inicial registrada*/
	ActSerialProsarc varchar(128),
	ActSerialProveed varchar(128),
	ActModel varchar(64),
	ActTalla varchar(16),
	ActObserv varchar(512),/*campo para anotaciones generales de los cambios en el registro*/
	-- FK_ActPerson int,persona a la que esta asignado el activo (opcional)
	FK_ActSub int, /*forana de la tabla SubCatAct */
	primary key (ID_Act),
	foreign key (FK_ActSub) references SubCatAct(ID_SubCat) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

create table MovimientosAct(
	ID_MovAct int auto_increment unique,
	MovTipo varchar(32), /*tipo de movimiento Entrada/Salida*/
	created_at TIMESTAMP NULL DEFAULT NULL, /*fecha de creacion*/
	updated_at TIMESTAMP NULL DEFAULT NULL,/*fecha de actualizacion*/
	FK_MovInv int, /*foranea de la tabla InventarioAct*/
	FK_ActPerson int,/*persona a la que esta asignado el activo (opcional)*/
	primary key (ID_MovAct),
	foreign key (FK_ActPerson) references Personal(ID_Pers) ON UPDATE CASCADE
	foreign key (FK_MovInv) references Activo(ID_Act) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla para las ordenes de compra de articulos*/
Create table OrdenCompra(
	ID_Orden int auto_increment unique,
	OrdenNum int, /*numero de orden*/
	OrdenStatus varchar(32), /*Pendiente, Cotizada, Autorizada, Rechazada, Eliminada*/
	created_at TIMESTAMP NULL DEFAULT NULL, /*fecha de creacion*/
	updated_at TIMESTAMP NULL DEFAULT NULL,/*fecha de actualizacion*/
	OrdenInvoice varchar(32), /*numero de factura*/
	OrdenRecibida boolean, /*si o no?*/
	OrdenPagada boolean, /* si o no?*/
	OrdenTotal int, /*costo de la orden*/
	FK_OrdenCreateBy int, /*usuario que creo la orden de compra*/
	FK_OrdenProg int, /*fecha y vehiculo programado para la busqueda de la orden*/
	primary key	(ID_Orden),
	foreign key (FK_OrdenCreateBy) references Users(id) ON UPDATE CASCADE,
	foreign key (FK_OrdenProg) references ProgVehiculo(ID_ProgVeh) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla para registra las cotizaciones de las ordenes de compra aprobadas*/
create table Cotizacion(
	ID_Cotiz int auto_increment unique,
	CotizNum int, /*numero de cotizacion*/
	CotizStatus varchar(32), /* Aprobada, AprobadaParcial*/
	CotizSubTotal int, /*costo de la cotizacion*/
	created_at TIMESTAMP NULL DEFAULT NULL, /*fecha de creacion*/
	updated_at TIMESTAMP NULL DEFAULT NULL,/*fecha de actualizacion*/
	FK_CotizOrden int, /*numero de orden*/
	FK_CotizSede int, /*numero de proveedor*/
	primary key	(ID_Cotiz),
	foreign key (FK_CotizSede) references Sede(ID_Sede) ON UPDATE CASCADE,
	foreign key (FK_CotizOrden) references OrdenCompra(ID_Orden) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla para registrar los articulos cotizados por cada proveedor*/
create table ArticXprove(
	ID_ArtiProve int auto_increment unique,
	ArtiUnidad boolean, /*articulos en unidades o peso? */
	ArtiCant int, /*kg o unid por articulo*/ 
	ArtiPrecio int, /*precio del articulo ofertado por el proveedor*/
	ArtiCostoUnid int, /*precio por unidad del articulo*/
	ArtiMinimo int, /*cantidad minima de compra*/
	created_at TIMESTAMP NULL DEFAULT NULL, /*fecha de creacion*/
	updated_at TIMESTAMP NULL DEFAULT NULL,/*fecha de actualizacion*/
	FK_ArtiActiv int, /*foranea de la tabla Activos*/
	FK_ArtCotiz int, /*foranea de la tabla cotizacion*/
	FK_AutorizedBy int, /*compra de articulo autorizado por*/
	primary key (ID_ArtiProve), 
	foreign key (FK_ArtiActiv) references Activo(ID_Act) ON UPDATE CASCADE,
	foreign key (FK_ArtCotiz) references Cotizacion(ID_Cotiz) ON UPDATE CASCADE,
	foreign key (FK_AutorizedBy) references Users(id) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla para registrar los activos tenologicos de las diferentes oficinas de la empresa*/
create table InventarioTecnologia(
	ID_Tecn int auto_increment unique,
	TecnBrand varchar(64),
	TecnModel varchar(64),
	TecnSerial varchar(64),
	TecnOs varchar(32),
	TecnRam int,
	TecnScreen varchar(32),
	TecnAccessory1 varchar(64),
	TecnAccessory2 varchar(64),
	created_Tecn TIMESTAMP NULL DEFAULT NULL, /*fecha de creacion*/
	updated_Tecn TIMESTAMP NULL DEFAULT NULL,/*fecha de actualizacion*/
	Tecnobserv varchar(512),/*campo para anotaciones generales de los cambios en el registro*/
	FK_TecnPerson int,/*persona a la que esta asignado el activo*/
	primary key (ID_Tecn),
	foreign key (FK_TecnPerson) references Personal(ID_Pers) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla para la declaracion de residuos*/
create table SolicitudServicio(
	ID_SolSer int auto_increment unique,
	created_at TIMESTAMP NULL DEFAULT NULL, /*fecha de creacion*/
	updated_at TIMESTAMP NULL DEFAULT NULL,/*fecha de actualizacion*/
	SolSerStatus varchar(16), /*aprobada, negada, pendiente, incompleta*/
	SolSerFrecuencia int,/*cada cuantos dias se recolecta: mensual, quincenal, semanal, por solicitud, N° dias*/
	FK_SolSerRespel int,/*foranea de la tabla de residuos*/
	FK_SolSerGenerSede int, /*foranea de la tabla GenerSede*/
	primary key (ID_SolSer),
	foreign key (FK_SolSerRespel) references Respel(ID_Respel) ON UPDATE CASCADE,
	foreign key (FK_SolSerGenerSede) references GenerSede(ID_GSede) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla de requermientos del cliente por residuo "¡¡PENDIENTE!!"*/
create table Requerimiento(
	ID_Req int auto_increment unique,
	ReqFotoCargue boolean,
	ReqFotoDescargue boolean,
	ReqFotoPesaje boolean,
	ReqFotoReempacado boolean,
	ReqFotoMezclado boolean,
	ReqFotoDestruccion boolean,
	ReqVideoCargue boolean,
	ReqVideoDescargue boolean,
	ReqVideoPesaje boolean,
	ReqVideoReempacado boolean,
	ReqVideoMezclado boolean,
	ReqVideoDestruccion boolean,
	ReqAuditoria boolean,
	ReqAuditoriaTipo varchar(16), /*"Presencial" / ""En linea"*/
	ReqDevolucion boolean,
	ReqDevolucionTipo varchar(128), /*observacion de lo que se quiere que sea devuelto al cliente*/
	ReqDatosPersonal boolean, /*datos de personal y vehiculo que van a la recogida de residuos*/
	ReqPlanillas boolean, /*Planillas de pago de seguridad social*/
	ReqAlistamiento boolean, /*Alistamiento de material*/
	ReqCapacitacion boolean, /*Capacitación de personal dada por el cliente*/
	ReqBascula boolean, /*Pesaje en báscula camionera*/
	ReqMasPerson boolean, /*Personal adicional para cargue*/
	ReqPlatform boolean, /*Vehículo con plataforma*/
	ReqCertiEspecial boolean, /*¿requiere valor especial en el certificado?*/
	primary key (ID_Req)
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla de tratamiento*/
create table Tratamiento(
		ID_Trat int auto_increment unique,
		TratName varchar(64),
		TratTipo boolean, /*interno o externo*/
		FK_TratProv int, /*proveedor del tratamiento*/
		FK_TratRespel int, /*residuo al que aplica*/
		primary key	(ID_Trat),
		foreign key (FK_TratProv) references Clientes(ID_Cli) ON UPDATE CASCADE,
		foreign key (FK_TratRespel) references Respel(ID_Respel) ON UPDATE CASCADE
	)
		COLLATE='utf8mb4_unicode_ci'
		ENGINE=InnoDB;

/*tabla para el recibo de materiales*/
Create table ReciboMaterial(
	ID_Rm int auto_increment unique, /*numero de consecutivo*/
	RmStatus varchar(64), /*opciones: Pendiente; aprobado(tesoreria)*/
	RmTipo varchar(32), /*interno, alquilado, externo*/
	RmAuditable boolean,
	RmSalida time, /*hora de salida de planta*/
	RmLlegada time, /*hora de llegada a planta*/
	RmCobro varchar(128), 
	FK_RmTransportador int, /*empresa que transporta los RESPEL a la planta de tratamiento*/
	FK_RmSolSer int, /*foranea de la tabla declaraciones*/
	FK_RmProgVeh int, /*fecha y vehiculo programado para la busqueda de los residuos*/
	primary key (ID_Rm),
	foreign key (FK_RmSolSer) references SolicitudServicio(ID_SolSer) ON UPDATE CASCADE,
	foreign key (FK_RmTransportador) references Clientes(ID_Cli) ON UPDATE CASCADE,
	foreign key (FK_RmProgVeh) references ProgVehiculo(ID_ProgVeh) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla de cantidades por cada residuo enviado*/
create table RespelEnvio(
	ID_ResEnv int auto_increment unique,
	created_at TIMESTAMP NULL DEFAULT NULL, /*fecha de creacion*/
	updated_at TIMESTAMP NULL DEFAULT NULL,/*fecha de actualizacion*/
	RespelKgEnviado int, /*cantidad en Kilogramos enviado*/
	RespelKgRecibido int, /*cantidad en Kilogramos recibido*/
	RespelKgConciliado int, /*cantidad en Kilogramos Conciliado*/
	RespelKgTratado int, /*cantidad en Kilogramos Tratado*/
	FK_RespelDeclar int, /*foranea de la tabla Declaracion*/
	FK_RespelReq int, /*foranea de la tabla requerimiento*/
	FK_RespelRm int, /*foranea de la tabla recibo material*/
	primary key (ID_ResEnv),
	foreign key (FK_RespelDeclar) references Declaracion(ID_Declar) ON UPDATE CASCADE,
	foreign key (FK_RespelReq) references Requerimiento(ID_Req) ON UPDATE CASCADE,
	foreign key (FK_RespelRm) references ReciboMaterial(ID_Rm) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla de fotos por residuo*/
create table Foto(
	ID_Foto int auto_increment unique,
	FotoName varchar(128),
	FotoTipo varchar(32), /*cargue, descargue, pesaje, reempacado, mezclado, destruccion, otro*/
	FotoTipoOther varchar(64), /*descripcion en caso de otro tipo de foto*/
	created_at TIMESTAMP NULL DEFAULT NULL, /*fecha de creacion*/
	updated_at TIMESTAMP NULL DEFAULT NULL,/*fecha de actualizacion*/
	FotoRmSrc varchar(255), /*direcion de la carperta donde se guardan las diferentes fotos para un recibo de material*/
	FotoSrc varchar(255), /*nombre de la foto dentro de la carpeta especificada en FotoRmSrc*/
	FotoFormat varchar(32), /*jpg, gif, png, etc*/
	FK_FotoRespel int,
	primary key (ID_Foto),
	foreign key (FK_FotoRespel) references RespelEnvio(ID_ResEnv) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla de videos por residuo*/
create table Video(
	ID_Video int auto_increment unique,
	VideoName varchar(128),
	VideoTipo varchar(32), /*cargue, descargue, pesaje, reempacado, mezclado, destruccion, otro*/
	VideoTipoOther varchar(64), /*descripcion en caso de otro tipo de video*/
	created_at TIMESTAMP NULL DEFAULT NULL, /*fecha de creacion*/
	updated_at TIMESTAMP NULL DEFAULT NULL,/*fecha de actualizacion*/
	VideoSrc varchar(255), /*direccion donde esta guardada la imagen*/
	VideoFormat varchar(32), /*mp4, mpeg, avi, wmv*/
	FK_VideoRespel int,
	primary key (ID_Video),
	foreign key (FK_VideoRespel) references RespelEnvio(ID_ResEnv) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla de certificado por residuo la mayoria de los atributos son opcionales para generar registro*/
create table Certificado(
	ID_Cert int auto_increment unique,
	/*CertTipo varchar(64), Por Residuo, Generador, ReciboMaterial, AreaEspecial*/
	CertNumero int, /*numero de certificado en membrete*/
	created_at TIMESTAMP NULL DEFAULT NULL, /*fecha de creacion*/
	updated_at TIMESTAMP NULL DEFAULT NULL,/*fecha de actualizacion*/
	CertKg int, /*peso del residuo tratado *//*no exceder el total tratado!!!*/
	CertiEspName varchar(64), /*nombre del atributo requerido en el certificado*/
	CertiEspValue varchar(64), /*valor del atributo requerido en el certificado*/
	CertObservacion varchar(255), /*observacion adicional para el certificado*/
	CertSrc varchar(255), /*direccion donde esta guardado el certificado */
	CertAnexo varchar(255), /*direccion donde se almacena los anexos necesarios en PDF*/
	FK_CertRm int, /*foranea de la tabla recibo de material*/
	FK_CertGener int, /*foranea de la tabla generador*/
	FK_CertRespel int, /*foranea de la tabla residuos*//*se puede repetir el numero*/
	primary key (ID_Cert),
	foreign key (FK_CertRm) references ReciboMaterial(ID_Rm) ON UPDATE CASCADE,
	foreign key (FK_CertGener) references GenerSede(ID_GSede) ON UPDATE CASCADE,
	foreign key (FK_CertRespel) references ResEnvio(ID_ResEnv) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla de Manifiestos por residuo la mayoria de los atributos son opcionales para generar registro*/
create table Manifiesto(
	ID_Manif int auto_increment unique,
	ManifNumero int, /*numero de manifiesto en membrete*/
	created_at TIMESTAMP NULL DEFAULT NULL, /*fecha de creacion*/
	updated_at TIMESTAMP NULL DEFAULT NULL,/*fecha de actualizacion*/
	ManifKg int, /*peso enviado a tratamiento*/ /*no exceder el total tratado!!!*/
	ManifiEspName varchar(64), /*nombre del atributo requerido en el manifiesto*/
	ManifiEspValue varchar(64), /*valor del atributo requerido en el manifiesto*/
	ManifObservacion varchar(255), /*observacion adicional par el manifiesto*/
	ManifSrc varchar(255), /*direccion donde esta guardado el manifiesto*/
	CertAnexo varchar(255), /*direccion donde se almacena los anexos necesarios en PDF*/
	FK_MAnifRespel int, /*foranea de la tabla residuos*/
	FK_MAnifRm int, /*foranea de la tabla recibo de material*/
	FK_MAnifGener int, /*foranea de la tabla generador*/
	FK_ManifProvee int, /*proveedor del tratamiento*/
	primary key (ID_Manif),
	foreign key (FK_MAnifRm) references ReciboMaterial(ID_Rm) ON UPDATE CASCADE,
	foreign key (FK_MAnifGener) references GenerSede(ID_GSede) ON UPDATE CASCADE,
	foreign key (FK_MAnifRespel) references ResEnvio(ID_ResEnv) ON UPDATE CASCADE,
	foreign key (FK_ManifProvee) references Sede(ID_Sede) ON UPDATE CASCADE
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;

/*tabla de codigos para identificar residuos*/
Create table QrCode(
	ID_QrCode int auto_increment unique,
	QrCodeEstiba int, /*numero de estiba de cada residuo(para los casos donde hay varias estibas por residuo)*/
	QrCodeSrc varchar(255), /*direccion donde esta guardado el codigo qr para su reimpresion*/
	created_at TIMESTAMP NULL DEFAULT NULL, /*fecha de creacion*/
	updated_at TIMESTAMP NULL DEFAULT NULL,/*fecha de actualizacion*/
	FK_QrCodeRespel int, /*atributo para ingresar informacion en el codigo QR(cantidad pesada)*/
	primary key (ID_QrCode),
	foreign key (FK_QrCodeRespel) references ResEnvio(ID_ResEnv) ON UPDATE CASCADE 
)
	COLLATE='utf8mb4_unicode_ci'
	ENGINE=InnoDB;


CREATE TABLE `password_resets` (
	`email` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`token` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`created_at` TIMESTAMP NULL DEFAULT NULL,
	INDEX `password_resets_email_index` (`email`)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB;