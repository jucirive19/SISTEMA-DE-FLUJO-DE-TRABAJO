<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../librerias/Bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../librerias/fontawesome/css/all.css">
    <link rel="stylesheet" href="../librerias/datatable/css/dataTables.bootstrap5.min.css">
    <title>gestor</title> 
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">    
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="../imagen/logo.png" alt="" width="60px">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="InicoEstudiantes.php"><span class="fa-solid fa-house"></span>   Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="propuestaEstudiante.php"><span class="fa-regular fa-folder-open"></span>   Propuestas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal"><span class="fa-solid fa-book" ></span>   Postulaciones A.P</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ProyectoEstudiante.php"><span class="fa-solid fa-folder-open" ></span>  Proyectos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../procesos/usuarios/salir.php" style="color: red"><span class="fa-solid fa-power-off"></span>   Salir</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Modal propuesta de proyecto -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="post" id="frmPorpuesta" enctype="multipart/form-data">
          <label for="titulo">Título:</label><br>
          <input type="text" name="titulo" id="titulo" required><br><br>

          <label for="resumen">Resumen:</label><br>
          <textarea name="resumen" id="resumen" rows="5" required></textarea><br><br>

          <label for="palabras_clave">Palabras Clave:</label><br>
          <input type="text" name="palabras_clave" id="palabras_clave" required><br><br>

          <label for="documento">Selecciona un documento:</label><br>
          <input type="file" name="documento" id="documento" accept=".pdf, .doc, .docx" required><br><br> 
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="GuardarPropuesta">Guardar Propuesta</button>
      </div>
    </div>
  </div>
</div>