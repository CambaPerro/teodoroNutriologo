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
          <i class="fa fa-align-justify"></i> Categoria
          <button
            type="button"
            data-toggle="modal"
            data-target="#ModalLong"
            class="btn btn-secondary"
            @click="abrirModal('registrar')"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <div class="col-md-12">
              <div class="input-group">
                <div class="col-md-10">
                  <div class="input-group">
                    <select class="form-control col-md-3">
                      <option value="nombre">Nombre</option>
                    </select>
                    <input
                      type="text"
                      v-model="buscar"
                      @input="listar(1, buscar)"
                      class="form-control"
                      placeholder="Buscar Categoria"
                    />
                    <span class="input-group-append">
                      <button type="submit" @click="listar(1, buscar)" class="btn btn-primary">
                        <i class="fa fa-search"></i>
                        Buscar
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
                  <th>Nombre</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="data in array_data" :key="data.id">
                  <td>
                    <span class="badge badge-success">
                      {{
                      data.id
                      }}
                    </span>
                  </td>
                  <td>{{ data.nombre }}</td>
                  <td>
                    <button 
                    type="button" 
                    class="btn btn-warning btn-sm"
                    data-toggle="modal"
                    data-target="#ModalLong"
                    @click="abrirModal('actualizar',data)"   
                    >
                      <i class="icon-pencil"></i>
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-danger btn-sm" @click="eliminar(data.id)">
                      <i class="icon-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <nav>
            <!-- justify-content-center -->
            <ul class="pagination">
              <li class="page-item" v-if="pagination.current_page > 1">
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="
                                        cambiarPagina(
                                            pagination.current_page - 1,
                                            buscar
                                        )
                                    "
                >Ant</a>
              </li>
              <li
                class="page-item"
                v-for="page in pagesNumber"
                :key="page"
                :class="[page == isActived ? 'active' : '']"
              >
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="cambiarPagina(page, buscar)"
                  v-text="page"
                ></a>
              </li>
              <li
                class="page-item"
                v-if="
                                    pagination.current_page <
                                        pagination.last_page
                                "
              >
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="
                                        cambiarPagina(
                                            pagination.current_page + 1,
                                            buscar
                                        )
                                    "
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
            <h4 class="modal-title">{{ tituloModal }}</h4>
            <button type="button" class="close" data-dismiss="modal" @click="limpiar()" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div :class="'modal-body ' + activarValidate">
            <form action method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Nombre de la Categoria</label>
                <div class="col-md-9">
                  <input
                    type="text"
                    v-model="nombre"
                    placeholder="Nombre de la Categoria............"
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
              @click="limpiar()"
            >Cerrar</button>
            <button
              type="button"
              class="btn btn-primary"
              v-if="tipoAccion==1"
              @click="registrar()"
            >Guardar</button>
            <button type="button" class="btn btn-primary" v-else @click="actualizar()"
            
            >Actualizar           
            </button>
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

import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'
export default {
  data() {
    return {
      //atributos de las tablas
      id: 0,
      nombre: "",
      array_data: [],
      url_ctrl: "categoria",
      //fin de los atributos de la tabla
      referencia: "",
      tituloModal: "",
      tipoAccion: 0,
      error: 0,
      errorMostrarMsj: [],
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
  mounted() {
    this.listar(1, "");
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
    cambiarPagina(page, buscar) {
      let me = this;
      // actualizar la Pagina
      me.pagination.current_page = page;
      // enviar la peticion para visualizar la data de esta pagina
      this.listar(page, buscar);
    },
    listar(page, buscar) {
      var url = this.url_ctrl + "?page=" + page + "&buscar=" + buscar;
      axios
        .get(url)
        .then(resp => {
          this.array_data = resp.data.table.data;
          this.pagination = resp.data.pagination;
          //  console.log(this.array_data);
        })
        .catch(error => {
          console.log(error);
        });
    },
    eventoAlerta(icono,mensaje){
        Swal.fire({
          position: "center",
          icon: icono,
          title:mensaje,
          showConfirmButton: false,
          time: 1500
        });
    },
    registrar() {
      if (this.validar()) {
        this.activarValidate = "was-validate";
        this.eventoAlerta("error",this.mensaje);
        return;
      }
      axios
        .post(this.url_ctrl + "/registrar", {
          nombre: this.nombre
        })
        .then(resp => {
          $("#ModalLong").modal("hide");
          this.eventoAlerta("success","Guardado Exitosamente");
          this.listar(1, "");
          this.limpiar();
        })
        .catch(error => {
          console.log(error);
        });
    },
    actualizar(){
        if (this.validar()) {
        this.activarValidate = "was-validate";
        this.eventoAlerta("error",this.mensaje);
        return;
      }
      axios.put(this.url_ctrl+"/actualizar",{
          nombre: this.nombre,
          id:this.id
      })
          .then(resp => {
          $("#ModalLong").modal("hide");
          this.eventoAlerta("success","Actualizar Exitosamente");
          this.listar(1, "");
          this.limpiar();
        })
        .catch(error => {
          console.log(error);
        });
    },
    eliminar(id)
    {
       const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
      });
      swalWithBootstrapButtons
        .fire({
          title: "Estas Seguro de Eliminar?",
          text: "Si Elimina no estara en la Lista!",
          icon: "error",
          showCancelButton: true,
          confirmButtonText: "Si, Eliminar!",
          cancelButtonText: "No, Cancelar!",
          reverseButtons: true
        })
        .then(result => {
          if (result.value) {
      
      axios.delete(this.url_ctrl+"/eliminar_"+id)
      .then(resp => {
          this.eventoAlerta("success", "Eliminado Exitosamente");
          this.listar(1, "");
        })
        .catch(error => {
          console.log(error);
        });
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ){
            this.eventoAlerta('error','Cancelado')
          }
        });
    },
    abrirModal(accion,data=[]){
        switch(accion){
            case"registrar":{
                this.tituloModal="Registrar Categoria de Alimento";
                this.limpiar();
                this.tipoAccion=1;
                break;
            }
            case "actualizar":{
                this.tituloModal="Actualizar Alimento";
                this.tipoAccion=2;
                this.id=data.id;
                this.nombre=data.nombre;
                break;
            }
        }
    },
    limpiar() {
      this.id = 0;
      this.nombre = "";
      this.buscar = "";
      this.activarValidate='';
    },
    validar() {
      if (!this.nombre) {
        this.mensaje = "Ingrese el Nombre";
        return true;
      }
      return false;
    }
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
