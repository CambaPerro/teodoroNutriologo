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
          <i class="fa fa-align-justify"></i> Alimentos
          <button
            type="button"
            data-toggle="modal"
            data-target="#ModalLong"
            class="btn btn-secondary"
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
                      class="form-control"
                      placeholder="Buscar...."
                    />
                    <span class="input-group-append">
                      <button type="submit" class="btn btn-primary">
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
                <th colspan="2"></th>
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
                  <td>{{ data.categoria }}</td>
                  <td>{{ data.nombre }}</td>
                  <td>{{ data.calorias }}</td>
                  <td>{{ data.carbohidratos }}</td>
                  <td>{{ data.grasas }}</td>
                  <td>{{ data.proteinas }}</td>
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
  </main>
</template>

<script>
import Chart from 'chart.js';
import Vue from "vue";
export default {
data()
{
    return {

    }

},
 mounted() {
    this.mostrar();
  },
methods: {
    mostrar()
    {
    }
}
}
</script>

<style>
</style>