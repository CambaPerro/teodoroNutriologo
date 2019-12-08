<template>
  <main class="main">
    <br />
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Orden Alimenticio
          <button
            type="button"
            class="btn btn-secondary"
            @click="mostrar_detalle('registrar')"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
        </div>
        <template v-if="listado">
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
                        placeholder="Buscar Producto"
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
                        @click="mostrar_detalle('actualizar',data)"
                      >
                        <i class="icon-pencil"></i>
                      </button>
                      &nbsp;
                      <template>
                        <button
                          type="button"
                          class="btn btn-danger btn-sm"
                          @click="eliminar(data.id)"
                        >
                          <i class="icon-trash"></i>
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
        </template>
        <template v-else>
          <div :class="'card-body '+activarValidate">
            <div class="form-group row border">
              <div class="col-md-5">
                <div class="form-group">
                  <label>Nombre</label>
                  <input
                    type="text"
                    v-model="nombre"
                    placeholder="Nombre............"
                    class="form-control"
                    required
                  />
                </div>
              </div>
            </div>

            <div class="form-group row border">
              <div class="col-md-5">
                <div class="form-group">
                  <label>Alimento</label>
                  <v-select
                    @search="select_alimento"
                    label="nombre"
                    :options="array_alimento"
                    placeholder="Alimento..."
                    @input="get_alimento"
                  />
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for></label>
                  <button @click="agregar_detalle()" class="btn btn-success form-control">
                    <i class="icon-plus">Agregar</i>
                  </button>
                </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                    <label for></label>
                    <button
                      @click="abrirModal()"
                      data-toggle="modal"
                      data-target="#ModalLong"
                      class="btn btn-success form-control"
                    >
                      <i class="icon-plus"></i>
                      <i class="icon-plus"></i>
                      <i class="icon-plus"></i>
                    </button>
                  </div>
              </div>
            </div>
            <table class="table table-responsive-sm table-bordered table-striped table-sm">
              <thead>
                <tr>
                  <th>Opciones</th>
                  <th>Alimento</th>
                  <th>Cantidad</th>
                </tr>
              </thead>
              <tbody v-if="(array_detalle.length)">
                <tr v-for="(detalle,index) in array_detalle" :key="detalle.id_alimento">
                  <td>
                    <button
                      @click="eliminar_detalle(index)"
                      type="button"
                      class="btn btn-danger btn-sm"
                    >
                      <i class="icon-close"></i>
                    </button>
                  </td>
                  <td>{{ detalle.alimento.nombre }}</td>
                  <td>
                    <input
                      type="number"
                      min="0"
                      step="any"
                      v-model="detalle.cantidad"
                      class="form-control"
                      required
                      placeholder="Cantidad...."
                    />
                  </td>
                </tr>
              </tbody>
              <tbody v-else>
                <tr>
                  <td colspan="4">No hay Alimentos Agregados</td>
                </tr>
              </tbody>
            </table>

            <div class="form-group row">
              <div class="col-md-12">
                <button type="button" class="btn btn-secondary" @click="ocultar_detalle()">Cerrar</button>
                <button
                  type="button"
                  v-if="tipoAccion==1"
                  class="btn btn-primary"
                  @click="registrar()"
                >Guardar</button>
                <button
                  type="button"
                  v-if="tipoAccion==2"
                  class="btn btn-primary"
                  @click="actualizar()"
                >Actualizar</button>
              </div>
            </div>
          </div>
        </template>
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
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
           <div class="modal-body">
            <div class="form-group row">
              <div class="col-md-8">
                <div class="input-group">
                  <select class="form-control col-md-4">
                    <option value="nombre">Nombre</option>
                  </select>
                  <input
                    type="text"
                    v-model="alimento_buscar"
                    @keyup.enter="listar_alimento(alimento_buscar)"
                    class="form-control"
                    placeholder="Alimento...."
                  />
                  <span class="input-group-append">
                    <button
                      type="submit"
                      @click="listar_alimento(alimento_buscar)"
                      class="btn btn-primary"
                    >
                      <i class="fa fa-search"></i> Buscar
                    </button>
                  </span>
                </div>
              </div>
            </div>
            <table class="table table-responsive-sm table-bordered table-striped table-sm">
              <thead>
                <tr>
                  <th>Opciones</th>
                  <th>Nombre</th>
                  <th>Categoria</th>
                  <th>Calorias</th>
                  <th>Carbohidratos</th>
                  <th>Grasas</th>
                  <th>Proteinas</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="data in array_alimento" :key="data.id">
                  <td>
                    <button
                      type="button"
                      @click="agregar_detalle_modal(data)"
                      class="btn btn-success btn-sm"
                    >
                      <i class="icon-check"></i>
                    </button>
                  </td>
                  <td>{{ data.nombre }}</td>
                  <td>{{ data.categoria }}</td>
                  <td>{{ data.calorias }}</td>
                  <td>{{ data.carbohidratos }}</td>
                  <td>{{ data.grasas }}</td>
                  <td>{{ data.proteinas }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!--Fin del modal-->
  </main>
</template>

<script>
import Vue from "vue";
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
export default {
  data() {
    return {
      //   atributos de la tabla
      id: 0,
      nombre: "",
      array_data: [],
      url_ctrl: "orden_alimenticio",
      // fin de los atributos de la tabla
      referencia: "",
      tituloModal: "",
      tipoAccion: 0,
      array_alimento: [],
      array_detalle: [],
      alimento: {},
      id_alimento: 0,
      vue_alimento: {
        id: 0,
        nombre: ""
      },
      alimento_buscar:'',
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
      mensaje: "",
      listado: true
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
      me.listar(page, buscar);
    },
    listar(page, buscar) {
      var url = this.url_ctrl + "?page=" + page + "&buscar=" + buscar;
      axios
        .get(url)
        .then(resp => {
          this.array_data = resp.data.table.data;
          this.pagination = resp.data.pagination;
          // console.log(resp);
        })
        .catch(error => {
          console.log(error);
        });
    },
    select_alimento(search, loading) {
      loading(true);
      var url = "alimento/select?buscar=" + search;
      axios
        .get(url)
        .then(resp => {
          let respuesta = resp.data;
          q: search;
          this.array_alimento = respuesta.table;
          loading(false);
        })
        .catch(error => {
          console.log(error);
        });
    },
    get_alimento(val1) {
      try {
        this.id_alimento = val1.id;
        this.alimento = val1;
        this.vue_alimento = {
          id: val1.id,
          nombre: val1.nombre
        };
      } catch {
        this.vue_alimento = {
          id: 0,
          nombre: ""
        };
      }
    },
    eventoAlerta(icono, mensaje) {
      Swal.fire({
        position: "center",
        icon: icono,
        title: mensaje,
        showConfirmButton: false,
        timer: 1500
      });
    },
    registrar() {
      if (this.validar()) {
        this.activarValidate = "was-validated";
        this.eventoAlerta("error", this.mensaje);
        return;
      }
      axios
        .post(this.url_ctrl + "/registrar", {
          nombre: this.nombre,
          data: this.array_detalle
        })
        .then(resp => {
          $("#ModalLong").modal("hide");
          this.eventoAlerta("success", "Guardado Exitosamente");
          this.listar(1, "");
          this.listado = true;
          this.limpiar();
        })
        .catch(error => {
          console.log(error);
        });
    },
    actualizar() {
      if (this.validar()) {
        this.activarValidate = "was-validated";
        this.eventoAlerta("error", this.mensaje);
        return;
      }
      axios
        .put(this.url_ctrl + "/actualizar", {
          id: this.id,
          nombre: this.nombre,
          data: this.array_detalle
        })
        .then(resp => {
          $("#ModalLong").modal("hide");
          this.eventoAlerta("success", "Actualizado Exitosamente");
          this.listar(1, "");
          this.listado = true;
          this.limpiar();
        })
        .catch(error => {
          console.log(error);
        });
    },
    eliminar(id) {
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
            axios
              .delete(this.url_ctrl + "/eliminar_" + id)
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
          ) {
            this.eventoAlerta("error", "Cancelado");
          }
        });
    },
    abrirModal() {
      this.array_alimento = [];
      this.tituloModal = "Selecione uno o varios Alimentos";
    },
       listar_alimento(buscar) {
      var url ="alimento/listar?buscar=" + buscar;
      axios
        .get(url)
        .then(resp=>{
        this.array_alimento = resp.data.table; 
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    mostrar_detalle(accion, data = []) {
      this.listado = false;
      switch (accion) {
        case "registrar": {
          this.tituloModal = "Registrar Orden Alimenticio";
          this.limpiar();
          this.tipoAccion = 1;
          break;
        }
        case "actualizar": {
          this.tituloModal = "Actualizar Orden Alimenticio";
          this.tipoAccion = 2;
          this.id = data.id;
          this.nombre = data.nombre;
          axios
            .get(this.url_ctrl + "/listar_alimento?id=" + data.id)
            .then(resp => {
              this.array_detalle = resp.data.detalle;
            })
            .catch(error => {
              console.log(error);
            });
          break;
        }
      }
    },
    agregar_detalle() {
      if (this.id_alimento == 0) {
        this.eventoAlerta("error", "Error");
      } else {
        if (this.encuentra(this.id_alimento)) {
          this.eventoAlerta("error", "Se encuentra Agregado");
        } else {
          this.array_detalle.push({
            id_alimento: this.id_alimento,
            alimento: this.alimento,
            cantidad: this.cantidad,
          });
          this.cantidad = 0;
        }
      }
    },
        agregar_detalle_modal(data=[]) {
 
        if (this.encuentra(data.id)) {
          this.eventoAlerta("error", "Se encuentra Agregado");
        } else {
          this.array_detalle.push({
            id_alimento: data.id,
            alimento: data,
            cantidad: 0
          });
          this.cantidad = 0;
        }
    },
    eliminar_detalle(index) {
      this.array_detalle.splice(index, 1);
    },
    encuentra(id) {
      for (let i = 0; i < this.array_detalle.length; i++) {
        if (this.array_detalle[i].id_alimento == id) {
          return true;
        }
      }
      return false;
    },
    ocultar_detalle() {
      this.listado = true;
      this.limpiar();
      this.listar(1, "");
    },
    limpiar() {
      this.id = 0;
      this.nombre = "";
      this.activarValidate = "";
      this.array_alimento = [];
      this.array_detalle = [];
    },
    validar() {
      if (!this.nombre) {
        this.mensaje = "Ingrese el Nombre";
        return true;
      }
      if (this.array_detalle.length <= 0) {
        this.mensaje = "No tiene Alimentos Agregados";
        return true;
      }
      for (let index = 0; index < this.array_detalle.length; index++) {
        if (!this.array_detalle[index].cantidad) {
          this.mensaje = "La Cantidad No Puede Ser Menor A Cero";
          return true;
        }
      }
      return false;
    }
  }
};
</script>