create schema moodlev;
use moodlev;

CREATE TABLE IF NOT EXISTS `moodlev`.`roles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(20) NOT NULL,
  `descripcion` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC))
ENGINE = InnoDB;

insert into moodlev.roles (nombre, descripcion)
values
  ('admin', 'Usuario administrador'),
  ('docente', 'Usuario docente'),
  ('estudiante', 'Usuario estudiante'),
  ('invitado', 'Usuario invitado');

CREATE TABLE IF NOT EXISTS `moodlev`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(12) NOT NULL,
  `password` VARCHAR(200) NOT NULL,
  `email` VARCHAR(200) NOT NULL,
  `nombres` VARCHAR(50) NOT NULL,
  `apellidos` VARCHAR(50) NOT NULL,
  `foto` VARCHAR(200) NOT NULL DEFAULT '',
  `rol_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `fk_usuarios_roles_idx` (`rol_id` ASC),
  CONSTRAINT `fk_usuarios_roles`
    FOREIGN KEY (`rol_id`)
    REFERENCES `moodlev`.`roles` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `moodlev`.`cursos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `introduccion` VARCHAR(300) NOT NULL,
  `fecha_inicio` DATETIME NOT NULL,
  `fecha_fin` DATETIME NOT NULL,
  `autor_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cursos_usuarios_idx` (`autor_id` ASC),
  CONSTRAINT `fk_cursos_usuarios`
    FOREIGN KEY (`autor_id`)
    REFERENCES `moodlev`.`usuarios` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `moodlev`.`asignaciones` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `curso_id` INT NOT NULL,
  `titulo` VARCHAR(100) NOT NULL,
  `instruccion` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_asignaciones_cursos_idx` (`curso_id` ASC),
  CONSTRAINT `fk_asignaciones_cursos`
    FOREIGN KEY (`curso_id`)
    REFERENCES `moodlev`.`cursos` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `moodlev`.`grupos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(20) NOT NULL,
  `curso_id` INT NOT NULL,
  `codigo` CHAR(8) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_grupos_cursos_idx` (`curso_id` ASC),
  CONSTRAINT `fk_grupos_cursos`
    FOREIGN KEY (`curso_id`)
    REFERENCES `moodlev`.`cursos` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `moodlev`.`matriculaciones` (
  `usuario_id` INT NOT NULL,
  `grupo_id` INT NOT NULL,
  PRIMARY KEY (`usuario_id`, `grupo_id`),
  INDEX `fk_matricula_grupos_idx` (`grupo_id` ASC),
  CONSTRAINT `fk_matricula_usuarios`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `moodlev`.`usuarios` (`id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `fk_matricula_grupos`
    FOREIGN KEY (`grupo_id`)
    REFERENCES `moodlev`.`grupos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;