<template>
  <main class="main">
    <!-- Breadcrumb -->
    <!-- <ol class="breadcrumb">
      <li class="breadcrumb-item">Home</li>
      <li class="breadcrumb-item">
        <a href="#">Admin</a>
      </li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>-->
    <br />
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> TipoActividad
          <button
            type="button"
            data-toggle="modal"
            data-target="#ModalLong"
            class="btn btn-secondary"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>

          <button type="button" class="btn btn-danger">
            <i class="fa fa-file-pdf-o"></i>&nbsp;PDF
          </button>

          <button type="button"  class="btn btn-info">
            <i class="fa fa-print fa-lg"></i>
          </button>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <div class="col-md-12">
              <div class="input-group">
                <div class="col-md-10">
                  <div class="input-group">
                    <select class="form-control col-md-3">
                      <option value="tipo">Nombre del tipo de Actividad</option>
                    </select>
                    <input
                      type="text"
                      
                      class="form-control"
                    />
                    <span class="input-group-append">
                      <button
                        type="submit"
                        class="btn btn-primary"
                      >
                        <i class="fa fa-search"></i> Buscar
                      </button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>Tipo de Actividad</th>
                  <th>Estado</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <span class="badge badge-success" ></span>
                  </td>
                  <td>{{ data.tipo}}</td>
                  <td>
                    <div >
                      <span class="badge badge-success">Activo</span>
                    </div>
                    <div>
                      <span class="badge badge-danger">Desactivado</span>
                    </div>
                  </td>
                  <td>
                    <button
                      type="button"
                      data-toggle="modal"
                      data-target="#ModalLong"
                      class="btn btn-warning btn-sm"
                    >
                      <i class="icon-pencil"></i>
                    </button> &nbsp;
                    <template >
                      <button
                        type="button"
                        class="btn btn-danger btn-sm"
                      >
                        <i class="icon-trash"></i>
                      </button>
                    </template>
                    <template >
                      <button type="button" class="btn btn-info btn-sm" >
                        <i class="icon-check"></i>
                      </button>
                    </template>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <nav>
            <!-- justify-content-center -->
            <ul class="pagination">
              <li class="page-item" > 1">
                <a
                  class="page-link"
                  href="#"
                
                >Ant</a>
              </li>
              <li
                class="page-item"
                :key="page"
                :class="[page == isActived ? 'active' : '']"
              >
                <a
                  class="page-link"
                  href="#"
                  
                ></a>
              </li>
              <li class="page-item">
                <a
                  class="page-link"
                  href="#"
                 
                >Sig</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div
      class="modal fade bd-example-modal-lg"
      tabindex="-1"
      role="dialog"
      id="ModalLong"
      aria-labelledby="myModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" ></h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div :class="'modal-body '+activarValidate">
            <form action method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                <div class="col-md-9">
                  <input
                    type="text"
                    
                    placeholder="Nombre de la Actividad............"
                    class="form-control"
                    required
                  />
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
              >Cerrar</button>
            <button
              type="button"
              
              class="btn btn-primary"
              
            >Guardar</button>
            <button
              type="button"
              
              class="btn btn-primary"
              
            >Actualizar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>

      <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
  </main>
</template>

<script>
import Vue from "vue";
export default {
  data() {
    return {
      tipo_id: 0,
      tipo: "",
      referencia: "",
      arrayTipoActividad: [],
      tituloModal: "",
      tipoAccion: 0,
      errorTipoActividad: 0,
      errorMostrarMsjTipoActividad: [],
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0
      },
      offset: 3,
      buscar: "",
      activarValidate: "",
      mensaje: ""
    };
  },
  computed: {
    isActived: function() {
      return this.pagination.current_page;
    },
    pagesNumber: function() {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }

      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    }
  },
  methods: {
    listarTipoActividad(page, buscar) {
      let me = this;
      var url = "TipoActividad?page=" + page + "&buscar=" + buscar;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayTipoActividad = respuesta.tipo_actividads.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    cambiarPagina(page, buscar) {
      let me = this;
      // actualizar la Pagina
      me.pagination.current_page = page;
      // enviar la peticion para visualizar la data de esta pagina
      me.listarTipoActividad(page, buscar);
    },
    registrarTipoActividad() {
      if (this.validarTipoActividad()) {
        this.activarValidate = "was-validated";
        Swal.fire({
          position: "center",
          type: "error",
          title: this.mensaje,
          showConfirmButton: false,
          timer: 1500
        });
        return;
      }
      let me = this;

      axios
        .post("producto/registrar", {
          tipo: this.tipo,
          referencia: this.referencia
        })
        .then(function(response) {
          $("#ModalLong").modal("hide");
          me.cerrarModal();
          me.listarTipoActividad(1, "");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    actualizarProducto() {
      if (this.validarProducto()) {
        this.activarValidate = "was-validated";
        Swal.fire({
          position: "center",
          type: "error",
          title: this.mensaje,
          showConfirmButton: false,
          timer: 1500
        });
        return;
      }
      let me = this;

      axios
        .put("producto/actualizar", {
          nombre: this.nombre,
          stock: this.stock,
          unidad: this.unidad,
          codigo: this.codigo,
          referencia: this.referencia,
          id: this.producto_id
        })
        .then(function(response) {
          $("#ModalLong").modal("hide");
          me.cerrarModal();
          me.listarProducto(1, "");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    desactivar(id) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
      });

      swalWithBootstrapButtons
        .fire({
          title: "Estas Seguro de Desactivar el Registro?",
          text: "Si Desactiva no estara en la Lista!",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Si, Desactivar!",
          cancelButtonText: "No, Cancelar!",
          reverseButtons: true
        })
        .then(result => {
          if (result.value) {
            let me = this;

            axios
              .put("producto/desactivar", {
                id: id
              })
              .then(function(response) {
                me.listarProducto(1, "");
                Swal.fire({
                  position: "center",
                  type: "success",
                  title: "El Registro ha sido Desactivado",
                  showConfirmButton: false,
                  timer: 1000
                }).catch(function(error) {
                  console.log(error);
                });
              });
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
              position: "center",
              type: "error",
              title: "Cancelado",
              showConfirmButton: false,
              timer: 1000
            });
          }
        });
    },
    activar(id) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
      });

      swalWithBootstrapButtons
        .fire({
          title: "Estas Seguro de Activar el Registro?",
          text: "Si Activa no estara en la Lista!",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Si, Activar!",
          cancelButtonText: "No, Cancelar!",
          reverseButtons: true
        })
        .then(result => {
          if (result.value) {
            let me = this;

            axios
              .put("producto/activar", {
                id: id
              })
              .then(function(response) {
                me.listarProducto(1, "");
                Swal.fire({
                  position: "center",
                  type: "success",
                  title: "El Registro ha sido Activado",
                  showConfirmButton: false,
                  timer: 1000
                }).catch(function(error) {
                  console.log(error);
                });
              });
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
              position: "center",
              type: "error",
              title: "Cancelado",
              showConfirmButton: false,
              timer: 1000
            });
          }
        });
    },
    validarProducto() {
      if (!this.nombre || !this.unidad || !this.referencia) {
        this.mensaje = "Ingrese El Nombre y Referencia del stock y la Unidad";
        return true;
      }
      if (!this.stock || !this.codigo) {
        this.mensaje = "Ingrese El Stock y la Unidad no Puede ser 0";
        return true;
      }
      return false;
    },
    cerrarModal() {
      this.tituloModal = "";
      this.limpiarRegistro();
    },
    limpiarRegistro() {
      this.nombre = "";
      this.stock = 0;
      this.codigo = 0;
      this.unidad = "";
      this.activarValidate = "";
      this.mensaje = "";
      this.referencia = "";
    },
    abrirModal(modelo, accion, data = []) {
      switch (modelo) {
        case "producto": {
          switch (accion) {
            case "registrar": {
              this.tituloModal = "Registrar Producto";
              this.limpiarRegistro();
              this.tipoAccion = 1;
              break;
            }
            case "actualizar": {
              // console.log(data);
              this.tituloModal = "Actualizar Producto";
              this.tipoAccion = 2;
              this.producto_id = data["id"];
              this.nombre = data["nombre"];
              this.stock = data["stock"];
              this.codigo = data["codigo"];
              this.unidad = data["unidad"];
              this.referencia = data["referencia"];
              break;
            }
          }
        }
      }
    }
  },
  mounted() {
    this.listarProducto(1, this.buscar);
  }
};
</script>
<style>
.modal-content {
  width: 100% !important;
  position: absolute !important;
}
.mostrar {
  display: list-item !important;
  opacity: 1 !important;
  position: absolute !important;
  background-color: #3c29297a !important;
}
.div-error {
  display: flex;
  justify-content: center;
}
.text-error {
  color: red !important;
  font-weight: bold;
}
</style>

