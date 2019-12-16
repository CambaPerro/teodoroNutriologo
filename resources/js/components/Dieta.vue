<template>
  <main class="main">
    <!-- Breadcrumb -->
    <br />
    <!-- <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
    </ol>-->
    <div class="container-fluid">
      <div class="card">
        <div class="card-header"></div>
        <div class="car-body">
           <div class="row">
               <div class="col-md-6">
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" >
                    <thead>
                      <tr>
                      <th>Total Kcal</th>
                      <td>{{ array_data.total_calorias }}</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                       <th>Calorias</th>
                       <td>{{ array_data.total_calorias }}</td>
                      </tr>
                      <tr>
                        <th>Proteinas</th>
                        <td>{{ array_data.total_proteinas }}</td>
                      </tr>
                      <tr>
                        <th>Carbohidratos</th>
                        <td>{{ array_data.total_carbohidratos }}</td>
                      </tr>
                      <tr>
                        <th>Grasas</th>
                        <td>{{ array_data.total_grasas }}</td>
                      </tr>
                    </tbody>
                </table>
              </div>
            </div>
            
           </div>
          <div class="row">
            <div class="col-md-6">
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm">
                  <template v-for="data in array_data.detalle" v-if="array_data.length>0">
                    <thead>
                      <th colspan="4">{{ data.nombre }}</th>
                    </thead>
                    <tbody>
                      <tr v-for="data1 in data.detalle" :key="data1.id">
                        <td>{{ data1.id }}</td>
                        <td>{{ data1.nombre }}</td>
                        <td>{{ data1.cantidad }}</td>
                        <td>{{ data1.peso }}</td>
                        <td>
                          <button
                            type="button"
                            data-toggle="modal"
                            data-target="#ModalLong"
                            class="btn btn-warning btn-sm"
                          >
                            <i class="icon-pencil"></i>
                          </button>
                          &nbsp;
                          <button
                            type="button"
                            class="btn btn-danger btn-sm"
                            @click="eliminar(data1.id)"
                          >
                            <i class="icon-trash"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </template>
                </table>
              </div>
            </div>
            <div class="col-md-6">
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm">
                  <template v-for="data in array_menu">
                    <thead>
                      <th colspan="3">{{ data.nombre }}</th>
                    </thead>
                    <tbody>
                      <tr v-for="data1 in data.detalle" :key="data1.id">
                        <td>{{ data1.alimento.nombre }}</td>

                        <td>{{ data1.alimento.peso }}</td>
                        <td class="input-group">
                          <span class="input-group-append">
                            <button type="button" data-toggle="modal" class="btn btn-danger btn-sm" 
                            @click="data1.cantidad--">
                              <i class="icon-minus"></i>
                            </button>
                          </span>
                          <!-- &nbsp; -->
                          <input
                            type="number"
                            step="any"
                            class="form-control col-3"
                            v-model.number="data1.cantidad"
                            
                            />
                          <!-- &nbsp; -->
                          <span class="input-group-append">
                            <button
                              type="button"
                              data-toggle="modal"
                              class="btn btn-success btn-sm"
                              @click="data1.cantidad++"
                            >
                              <i class="icon-plus"></i>
                            </button>
                          </span>
                          &nbsp;
                          <span class="input-group-append">
                            <button
                              type="button"
                              data-toggle="modal"
                              class="btn btn-primary btn-sm"
                              @click="agregar(data1)"
                            >
                              <!-- <i class="icon-plus"></i> -->
                              Agregar
                            </button>
                          </span>
                        </td>
                      </tr>
                    </tbody>
                  </template>
                </table>
              </div>
            </div>
          </div>
         
        </div>
      </div>
    </div>
  </main>
</template>
<script>
import Chart from "chart.js";
import Vue from "vue";
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
export default {
  data() {
    return {
      // url_ctrl:'orden_alimento',
      array_data: [],
      array_menu: [],
      fecha:new Date(),
      offset: 4,
    };
  },
  mounted() {
    this.listarMenu();
    this.listarOrdenAlimento();

  },
  methods: {
    listarOrdenAlimento() {
      var url = "orden_alimento?fecha="+this.fecha;
      axios
        .get(url)
        .then(resp => {
          if(resp.data.length>0)
          {
            this.array_data = resp.data[0];
          }         
          // console.log(this.array_data);
        })
        .catch(error => {
          console.log(error);
        });
    },
    listarMenu() {
      var url = "menu/listar_menu";
      axios
        .get(url)
        .then(resp => {
          this.array_menu = resp.data;
        // this.fecha=moment().format('YYYY-MM-DD');
      // console.log(moment().format('YYYY-MM-DD'));
          // console.log(resp);
        })
        .catch(error => {
          console.log(error);
        });
    },
    agregar(data = []) {
      // console.log(this.array_data);
      if (this.array_data==null) {
      //  console.log(this.array_data);
       this.registrar(data);
      } else {
// console.log(data.cantidad);
        
         this.actualizar_detalle(data);
        // this.actualizar_detalle(data);
      }
      // this.listarOrdenAlimento();
    },
    registrar(data=[]) {
      axios
        .post("orden_alimento/registrar", {
          id_alimento:data.id,
          cantidad:data.cantidad
        })
        .then(resp => {
          // console.log(resp);
          this.eventoAlerta("success", "Guardado Exitosamente");

          this.listarOrdenAlimento();
        })
        .catch(error => {
          console.log(error);
        });
    },
    actualizar_detalle(data=[]) {
      axios
        .put("orden_alimento/actualizar", {
          id_alimento:data.id,
          cantidad:data.cantidad,
          id_orden:this.array_data.id

        })
        .then(resp => {
          // console.log(resp);
          this.eventoAlerta("success", "Guardado Exitosamente");

          this.listarOrdenAlimento();
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
              .put("orden_alimento/eliminar_detalle",{
                id:id
              })
              .then(resp => {
                this.eventoAlerta("success", "Eliminado Exitosamente");
                this.listarOrdenAlimento();
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
    eventoAlerta(icono, mensaje) {
      Swal.fire({
        position: "center",
        icon: icono,
        title: mensaje,
        showConfirmButton: false,
        timer: 1500
      });
    }
  }
};
</script>

<style>
</style>