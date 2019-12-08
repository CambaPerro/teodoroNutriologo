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
            <table class="table table-bordered table-striped table-sm">
                <template v-for="data in array_data.detalle">
                <thead>
                  <th colspan="4">{{ data.nombre }}</th>
                </thead>
                <tbody>
                  <tr v-for="data1 in data.detalle" :key="data1.id">
                    <td>{{ data1.nombre }}</td>
                    <td>{{ data1.cantidad }}</td>
                    <td>{{ data1.peso }}</td>
                    <td>
                      <button
                      type="button"
                      data-toggle="modal"
                      data-target="#ModalLong"
                      class="btn btn-warning btn-sm"
                      @click="abrirModal('actualizar',data)"
                    >
                      <i class="icon-pencil"></i>
                    </button>
                    &nbsp;
                    <button
                      type="button"
                      class="btn btn-danger btn-sm"
                      @click="eliminar(data.id)"
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
            <div class="col-md-6"></div>
          </div>
          <div class="row">
            
          </div>
        </div>
      </div>
    </div>
  </main>
</template>
<script>
import Chart from "chart.js";
import Vue from "vue";
export default {
  data() {
    return {
      url_ctrl:'orden_alimento',
      array_data:[],

    };
  },
  mounted() {
    this.listar();
  },
  methods: {
   listar(page, buscar) {
      var url = this.url_ctrl + "?page=" + page + "&buscar=" + buscar;
      axios
        .get(url)
        .then(resp => {
          this.array_data = resp.data;
          // console.log(resp);
        })
        .catch(error => {
          console.log(error);
        });
    },
  }
};
</script>

<style>
</style>