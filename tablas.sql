-- Tabla coordinador
CREATE TABLE coordinador (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100),
  identificacion VARCHAR(20),
  direccion VARCHAR(100),
  telefono VARCHAR(20),
  correo VARCHAR(100),
  genero VARCHAR(20),
  foto VARCHAR(100),
  fecha_nacimiento DATE,
  programa_academico VARCHAR(100),
  areas_conocimiento VARCHAR(200),
  fecha_vinculacion DATE,
  acuerdo_nombramiento VARCHAR(100)
);

-- Tabla semillero
CREATE TABLE semillero (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100),
  correo VARCHAR(100),
  logo VARCHAR(100),
  descripcion TEXT,
  mision TEXT,
  vision TEXT,
  valores TEXT,
  objetivos TEXT,
  lineas_investigacion TEXT,
  archivo_presentacion VARCHAR(100),
  fecha_resolucion DATE,
  numero_resolucion VARCHAR(50),
  archivo_resolucion VARCHAR(100),
  id_coordinador INT,
  FOREIGN KEY (id_coordinador) REFERENCES coordinador(id)
);

-- Tabla estudiante
CREATE TABLE estudiantes (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  identificacion VARCHAR(20) NOT NULL,
  codigo_estudiantil VARCHAR(20) NOT NULL,
  direccion VARCHAR(100) NOT NULL,
  telefono VARCHAR(20) NOT NULL,
  correo VARCHAR(100) NOT NULL,
  genero VARCHAR(20) NOT NULL,
  fecha_nacimiento DATE NOT NULL,
  semestre INT NOT NULL,
  foto VARCHAR(100),
  archivo_matricula VARCHAR(100),
  programa_academico VARCHAR(100) NOT NULL,
  fecha_vinculacion_semillero DATE NOT NULL,
  estado VARCHAR(20) NOT NULL
);

-- Tabla proyecto
CREATE TABLE proyecto (
  codigo INT AUTO_INCREMENT PRIMARY KEY,

  titulo VARCHAR(100),
  tipo_proyecto VARCHAR(50),
  estado VARCHAR(20),
  fecha_inicio DATE,
  fecha_finalizacion DATE,
  archivo_propuesta VARCHAR(100),
  archivo_proyecto_final VARCHAR(100)
);

-- Tabla evento
CREATE TABLE evento (
  codigo INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100),
  descripcion TEXT,
  fecha_inicio DATE,
  fecha_fin DATE,
  lugar VARCHAR(100),
  tipo VARCHAR(20),
  modalidad VARCHAR(20),
  clasificacion VARCHAR(20),
  observaciones TEXT
);

-- Tabla proyecto_evento
CREATE TABLE proyecto_evento (
  codigo_proyecto INT,
  codigo_evento INT,
  PRIMARY KEY (codigo_proyecto, codigo_evento),
  FOREIGN KEY (codigo_proyecto) REFERENCES proyecto(codigo),
  FOREIGN KEY (codigo_evento) REFERENCES evento(codigo)
);

-- Tabla proyecto_estudiante
CREATE TABLE proyecto_estudiante (
  id_proyecto INT,
  id_estudiante INT,
  PRIMARY KEY (id_proyecto, id_estudiante),
  FOREIGN KEY (id_proyecto) REFERENCES proyecto(codigo),
  FOREIGN KEY (id_estudiante) REFERENCES estudiantes(id)
);


-- Tabla estudiante_semillero
CREATE TABLE estudiante_semillero (
  id_estudiante INT,
  id_semillero INT,
  PRIMARY KEY (id_estudiante, id_semillero),
  FOREIGN KEY (id_estudiante) REFERENCES estudiante(id),
  FOREIGN KEY (id_semillero) REFERENCES semillero(id)
);


---Tabla participacion evento

CREATE TABLE participacion_evento (
  id_participacion INT AUTO_INCREMENT PRIMARY KEY,
  id_proyecto INT,
  id_estudiante INT,
  id_evento INT,
  tipo_participacion ENUM('Ponencia', 'Poster') NOT NULL,
  calificacion DECIMAL(5, 2),
  archivo_certificacion VARCHAR(100),
  archivo_evidencias VARCHAR(100),
  FOREIGN KEY (id_proyecto) REFERENCES proyecto(codigo),
  FOREIGN KEY (id_estudiante) REFERENCES estudiante(id),
  FOREIGN KEY (id_evento) REFERENCES evento(codigo)
);