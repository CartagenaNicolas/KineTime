CREATE DATABASE IF NOT EXISTS kinetime;
USE kinetime;

CREATE TABLE zona_lesion(
    id              int(255) auto_increment not null,
    nombre          varchar(50) not null,
    CONSTRAINT pk_zona_lesion PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE deportes(
    id              int(255) auto_increment not null,
    nombre          varchar(100) not null,
    CONSTRAINT pk_deportes PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE hobbies(
    id              int(255) auto_increment not null,
    nombre          varchar(100) not null,
    CONSTRAINT pk_hobbies PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE enfermedades(
    id              int(255) auto_increment not null,
    nombre          varchar(100) not null,
    CONSTRAINT pk_enfermedades PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE examenes(
    id              int(255) auto_increment not null,
    fecha           datetime,
    nombre          varchar(200),
    zona            varchar(100),
    realizado_por   varchar(200),
    hallazgo        varchar(200),
    conclusion      varchar(200),
    CONSTRAINT pk_examenes PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE pacientes(
    id                  int(255) auto_increment not null,
    rut                 char(12) not null,
    nombre              varchar(255),
    edad                int(2),
    direccion           varchar(200),
    ocupacion           varchar(200),
    fumador             char(2),
    bebedor             char(2),
    CONSTRAINT pk_pacientes PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE antecedentes_clinicos(
    id                  int(255) auto_increment not null,
    paciente_id         int(255) not null,
    morbilidad          varchar(255),
    medico              varchar(255),
    zona_id             int(255),
    operacion           varchar(200),
    farmacos            varchar(200),
    factores_riesgo     varchar(200),
    cuando_episodio     TIME,
    CONSTRAINT pk_antecedentes_clinicos PRIMARY KEY (id),
    CONSTRAINT fk_antecedentes_clinicos_pacientes FOREIGN KEY(paciente_id) REFERENCES pacientes(id),
    CONSTRAINT fk_antecedentes_clinicos_zona FOREIGN KEY(zona_id) REFERENCES zona_lesion(id)
)ENGINE=InnoDB;

CREATE TABLE mecanismos(
    id                  int(255) auto_increment not null,
    paciente_id         int(255) not null,
    tipo_lesion         varchar(200),
    como_se_efectuo     varchar(200),
    CONSTRAINT pk_mecanismos PRIMARY KEY(id),
    CONSTRAINT fk_mecanismos_pacientes FOREIGN KEY(paciente_id) REFERENCES pacientes(id)
)ENGINE=InnoDB;

CREATE TABLE deportes_has_pacientes(
    id              int(255) auto_increment not null,
    deporte_id      int(255) not null,
    paciente_id     int(255) not null,
    CONSTRAINT pk_deportes_has_pacientes PRIMARY KEY(id),
    CONSTRAINT fk_deportes_has_pacientes_deportes FOREIGN KEY(deporte_id) REFERENCES deportes(id),
    CONSTRAINT fk_deportes_has_pacientes_pacientes FOREIGN KEY(paciente_id) REFERENCES pacientes(id)
)ENGINE=InnoDB;

CREATE TABLE pacientes_has_hobbies(
    id              int(255) auto_increment not null,
    paciente_id     int(255) not null,
    hobbie_id       int(255) not null,
    CONSTRAINT pk_pacientes_has_hobbies PRIMARY KEY(id),
    CONSTRAINT fk_pacientes_has_hobbies_pacientes FOREIGN KEY(paciente_id) REFERENCES pacientes(id),
    CONSTRAINT fk_pacientes_has_hobbies_hobbies FOREIGN Key(hobbie_id) REFERENCES hobbies(id)
)ENGINE=InnoDB;

CREATE TABLE pacientes_has_examenes(
    id              int(255) auto_increment not null,
    paciente_id     int(255) not null,
    examen_id       int(255) not null,
    CONSTRAINT pk_pacientes_has_examenes PRIMARY KEY(id),
    CONSTRAINT fk_pacientes_has_examenes_pacientes FOREIGN KEY(paciente_id) REFERENCES pacientes(id),
    CONSTRAINT fk_pacientes_has_examenes_examenes FOREIGN KEY(examen_id) REFERENCES examenes(id)
)ENGINE=InnoDB;

CREATE TABLE pacientes_has_enfermedades(
    id              int(255) auto_increment not null,
    paciente_id     int(255) not null,
    enfermedad_id   int(255) not null,
    CONSTRAINT pk_pacientes_has_enfermedades PRIMARY KEY(id),
    CONSTRAINT fk_pacientes_has_enfermedades_pacientes FOREIGN KEY(paciente_id) REFERENCES pacientes(id),
    CONSTRAINT fk_pacientes_has_enfermedades_enfermedades FOREIGN KEY(enfermedad_id) REFERENCES enfermedades(id)
)ENGINE=InnoDB;

CREATE TABLE perfiles(
    id              int(255) auto_increment not null,
    nombre          varchar(100),
    CONSTRAINT pk_perfiles_kinesiologo PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE areas_kinesiologo(
    id              int(255) auto_increment not null,
    nombre          varchar(100),
    CONSTRAINT pk_areas_kinesiologo PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE kinesiologos(
    id                  int(255) auto_increment not null,
    rut                 char(12) not null,
    nombre              varchar(200),
    password            char(60),
    especialidad        varchar(200),
    certificaciones     int(255),
    anos_experiencia    int(255),
    metas               varchar(1000),
    role                varchar(20),
    CONSTRAINT pk_kinesiologos PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE kinesiologos_has_perfiles(
    id                      int(255) auto_increment not null,
    kinesiologo_id          int(255) not null,
    perfil_id   int(255) not null,
    CONSTRAINT pk_kinesiologos_has_perfiles PRIMARY KEY(id),
    CONSTRAINT fk_kinesiologos_has_perfiles_kinesiologos FOREIGN KEY(kinesiologo_id) REFERENCES kinesiologos(id),
    CONSTRAINT fk_kinesiologos_has_perfiles_perfiles FOREIGN KEY(perfil_id) REFERENCES perfiles(id)
)ENGINE=InnoDB;

CREATE TABLE kinesiologos_has_areas(
    id                  int(255) auto_increment not null,
    kinesiologo_id      int(255) not null,
    area_id             int(255) not null,
    CONSTRAINT pk_kinesiolos_has_areas PRIMARY KEY(id),
    CONSTRAINT fk_kinesiologos_has_areas_kinesiologos FOREIGN KEY(kinesiologo_id) REFERENCES kinesiologos(id),
    CONSTRAINT fk_kinesiologos_has_areas_areas FOREIGN KEY(area_id) REFERENCES areas_kinesiologo(id)
)ENGINE=InnoDB;

CREATE TABLE tipo_ejercicios(
    id              int(255) auto_increment not null,
    nombre          varchar(50),
    tipo            varchar(50),
    objetivo        varchar(50),
    url             varchar(100),
    CONSTRAINT pk_tipo_ejercicios PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE volumenes(
    id              int(255) auto_increment not null,
    serie           varchar(50),
    total           varchar(50),
    CONSTRAINT pk_volumenes PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE ejercicios(
    id                      int(255) auto_increment not null,
    tiempo                  TIME,
    volumen                 int(255) not null,
    tipo_ejercicio          int(255) not null,
    descanso                int(255),
    CONSTRAINT pk_ejercicios PRIMARY KEY(id),
    CONSTRAINT fk_ejecicio_volumenes FOREIGN KEY(volumen) REFERENCES volumenes(id),
    CONSTRAINT fk_ejercicio_tipo_ejercicios FOREIGN KEY(tipo_ejercicio) REFERENCES tipo_ejercicios(id)
)ENGINE=InnoDB;

CREATE TABLE rutinas(
    id                      int(255) auto_increment not null,
    hora_inicio             TIME,
    hora_termino            TIME,
    CONSTRAINT pk_rutinas PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE pacientes_has_rutinas(
    id                      int(255) auto_increment not null,
    paciente_id             int(255) not null,
    rutina_id               int(255) not null,
    CONSTRAINT pk_pacientes_has_rutinas PRIMARY KEY(id),
    CONSTRAINT fk_pacientes_has_rutinas_pacientes FOREIGN KEY(paciente_id) REFERENCES pacientes(id),
    CONSTRAINT fk_pacientes_has_rutinas_rutinas FOREIGN KEY(rutina_id) REFERENCES rutinas(id)
)ENGINE=InnoDB;

CREATE TABLE rutinas_has_ejercicios(
    id                      int(255) auto_increment not null,
    rutina_id               int(255) not null,
    ejercicio_id            int(255) not null,
    CONSTRAINT pk_rutinas_has_ejercicios PRIMARY KEY(id),
    CONSTRAINT fk_rutinas_has_ejercicios_rutinas FOREIGN KEY(rutina_id) REFERENCES rutinas(id),
    CONSTRAINT fk_rutinas_has_ejercicios_ejercicios FOREIGN KEY(ejercicio_id) REFERENCES ejercicios(id)
)ENGINE=InnoDB;

CREATE TABLE prestaciones(
    id                      int(255) auto_increment not null,
    nombre                  varchar(100),
    tipo                    varchar(100),
    CONSTRAINT pk_prestaciones PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE atenciones(
    id                      int(255) auto_increment not null,
    prestacion_id           int(255) not null,
    duracion_atencion       TIME,
    fecha                   DATETIME,
    como_llego              varchar(200),
    como_se_fue             varchar(200),
    se_realizo              boolean,
    paciente_id             int(255) not null,
    kinesiologo_id          int(255) not null,
    CONSTRAINT pk_atenciones PRIMARY KEY(id),
    CONSTRAINT fk_atenciones_prestaciones FOREIGN KEY(prestacion_id) REFERENCES prestaciones(id),
    CONSTRAINT fk_atenciones_pacientes FOREIGN KEY(paciente_id) REFERENCES pacientes(id),
    CONSTRAINT fk_atenciones_kinesiologos FOREIGN KEY(kinesiologo_id) REFERENCES kinesiologos(id)
)ENGINE=InnoDB;

INSERT INTO kinesiologos VALUES (DEFAULT, "11.111.111-1", "admin", "$2y$12$mkQlG3pyfHwf0e12XX/RyusWaQgCLm4C4/fQDIdn2.vvlmCeQxlru", null, 0, 0, null, "ROLE_ADMIN");
INSERT INTO zona_lesion VALUES (DEFAULT, "Fractura de cubito");
INSERT INTO zona_lesion VALUES (DEFAULT, "Fractura de metatarso");
INSERT INTO zona_lesion VALUES (DEFAULT, "Fractura de tibia y perone");
INSERT INTO zona_lesion VALUES (DEFAULT, "Fractura de tobillo");
INSERT INTO deportes VALUES (DEFAULT, "Futbol");
INSERT INTO deportes VALUES (DEFAULT, "Voleibol");
INSERT INTO deportes VALUES (DEFAULT, "Tennis");
INSERT INTO deportes VALUES (DEFAULT, "Basketball");
INSERT INTO pacientes VALUES (DEFAULT, "20492942-4", "Alejandro Casas", 26, "Av. Concha Y Toro 2618", "Programador", "Si", "No");
INSERT INTO antecedentes_clinicos VALUES (DEFAULT, "1", "No se que es", "Kevin Pizarro", 1, "No", "Paracetamol", "no se", NOW());