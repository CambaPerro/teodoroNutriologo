<template>
  <table class="table table-responsive-sm table-bordered table-striped table-sm">
    <thead>
      <tr>
        <th v-for="atributo in array_atributo">{{ atributo.toUpperCase() }}</th>
        <th>OPCIONES</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(data,index) in array_data">
        <td v-for="atributo in array_atributo">{{ data[atributo] }}</td>
        <td>
          <button type="button" class="btn btn-warning btn-sm"
          data-toggle="modal"
          :data-target="'#'+array_id.modal_id"
          @click="actualizar(data,false)">
            <i class="icon-pencil"></i>
          </button>
          &nbsp;
          <button
            type="button"
            class="btn btn-danger btn-sm"
            @click="eliminar(data.id,index)"
          >
            <i class="icon-trash"></i>
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</template>
<script>
import Swal from "sweetalert2/dist/sweetalert2.js";

import "sweetalert2/src/sweetalert2.scss";
export default {
  props: {
    array_data: Array,
    array_atributo: Array,
    url: String,
    array_id:Object
  },
  data() {
    return {
      // array_data:[],
      // array_atributo:[]
    };
  },
  methods: {
    eliminar(id,index) {
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
          text: "Si Eliminar no estara en la Lista!",
          icon: "error",
          showCancelButton: true,
          confirmButtonText: "Si, Eliminar!",
          cancelButtonText: "No, Cancelar!",
          reverseButtons: true
        })
        .then(result => {
          if (result.value) {
                axios.delete(this.url + "/eliminar_"+id).then(resp => {
            // console.log(resp);
             Swal.fire({
              position: "center",
              icon: "success",
              title: "Eliminado Correctamente",
              showConfirmButton: false,
              timer: 1500
            });
            // this.array_data.splice(index,1);
            // console.log(document.getElementById(this.button_id).submit());
            document.getElementById(this.array_id.button_id).click();
        });
           
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
           Swal.fire({
              position: "center",
              icon: 'error',
              title: "Cancelado",
              showConfirmButton: false,
              timer: 1500
            });
          }
        });
      //   axios.delete(this.url + "/eliminar_"+id).then(resp => {
      //       console.log(resp);
      //   });
      console.log(id);
    },
     actualizar(data,bool){
       let dato={
         id:data.id,
         nombre:data.nombre
       };
       let registrar=bool;
this.$emit('cargarRegistro',{dato,registrar});
      }
  }
  //   mounted: {}
};
</script>