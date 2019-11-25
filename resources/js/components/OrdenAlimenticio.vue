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
          <i class="fa fa-align-justify"></i> Orden Alimenticio
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
                      class="form-control"
                      placeholder="Buscar Producto"
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

                  <th>Nombre</th>
                  
                </tr>
              </thead>
              <tbody>
                <tr >
                  
                </tr>
              </tbody>
            </table>
          </div>
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
          <div class="modal-body">
            <form action method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                <div class="col-md-9">
                  <input
                    type="text"
                    placeholder="Nombre del Orden Alimenticio............"
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
      orden_id: 0,
      nombre: "",
      array_data:[],
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0
      },
      offset: 3
      
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
    
    cambiarPagina(page, buscar) {
      let me = this;
      // actualizar la Pagina
      me.pagination.current_page = page;
      // enviar la peticion para visualizar la data de esta pagina
      me.listarProducto(page, buscar);
    }

  },
  mounted() {
    
  }
};
</script>
