<template>
  <main class="main">
    <br />
    <div class="container-fluid">
         <div class="col-sm-6">
                <div class="card">
                  <div class="card-header">
                    <strong>Perfil</strong>
                  </div>
                  <div class="card-body">
                   
                 <div class="row">
                    <label for="street">Foto de Perfil</label>
                    <div class="col-lg-12">
                      <img class="img-circle" :src="imagen" width="140" height="140" />
                    </div>
                   
                </div>
                <div class="form-group">
                  <div class="form-group col-sm-12">
                       <input type="file" class="custom-file-input form-control" id="customFileLangHTML" @change="imageChanged" />
                   <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                  </div>
                    </div>
                    <div class="form-group">
                      <label>Nombres</label>
                      <input class="form-control"  type="text" placeholder="" />
                    </div>
                    <div class="form-group">
                      <label for="">Apellidos</label>
                      <input class="form-control"  type="text" placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="street">Fecha de Nacimiento</label>
                      <input class="form-control"  type="date" placeholder="Enter street name">
                    </div>
                     <div class="form-group">
                      <label for="">Cedula de Identidad</label>
                      <input class="form-control"  type="number" placeholder="">
                    </div>
                     <div class="form-group">
                      <label for="">Altura</label>
                      <input class="form-control"  type="number" placeholder="">
                    </div>
                     <div class="form-group">
                      <label for="">Peso</label>
                      <input class="form-control"  type="number" placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="">Sexo</label>
                      <input class="form-control"  type="text" placeholder="">
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-8">
                        <label >User</label>
                        <input class="form-control"  type="text" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label >Password</label>
                        <input class="form-control"  type="text" placeholder="">
                      </div>
                    </div>
                    <!-- /.row-->
                    <div class="row">
                      <div class="form-group col-sm-8">
                        <label >Estado de Peso</label>
                        <input class="form-control"  type="text" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label >IMC</label>
                        <input class="form-control"  type="text" placeholder="">
                      </div>
                    </div>
                     <div class="row">
                      <div class="form-group col-sm-4">
                        <label >Calorias al Dia</label>
                        <input class="form-control"  type="text" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label >Peso Ideal</label>
                        <input class="form-control"  type="text" placeholder="">
                      </div>
                      <div class="form-group">
                      <label for="">Calorias Quemadas Totales</label>
                      <input class="form-control"  type="number" placeholder="">
                    </div>
                    </div>
                  
                    <button class="btn btn-sm btn-primary" type="submit" @click="registar">
                      <i class="fa fa-dot-circle-o"></i> Guardar</button>
                    <button class="btn btn-sm btn-danger" type="reset">
                      <i class="fa fa-ban"></i> Cancelar</button>
                

                  </div>
                </div>
              </div>
      <!-- Ejemplo de tabla Listado -->
      <!-- Fin ejemplo de tabla Listado -->
               
    </div>
    <!--Inicio del modal agregar/actualizar-->
   
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
      email: "",
      password:"",
      nombre:"",
      apellido:"",
      fecha_nacimiento:"",
      altura:"",
      peso:"",
      sexo:"",
      array_data: [],
      url_ctrl: "user",
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
      listado: true,
      imagen:''
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
          // this.array_data = resp.data.table.data;
          console.log(resp);
          // this.pagination = resp.data.pagination;
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
        .post(this.url_ctrl + "/guardarImg", {
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
    imageChanged(e) {
      console.log(e.target.files[0]);
      var fileReader = new FileReader();
      fileReader.readAsDataURL(e.target.files[0]);
      fileReader.onload = e => {
        this.imagen = e.target.result;
      };
      console.log(this.imagen);
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
    imageChanged(e) {
      console.log(e.target.files[0]);
      var fileReader = new FileReader();
      fileReader.readAsDataURL(e.target.files[0]);
      fileReader.onload = e => {
        this.imagen = e.target.result;
      };
      console.log(this.imagen);
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