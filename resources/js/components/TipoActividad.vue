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
          <i class="fa fa-align-justify"></i> Tipo Actividad
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
                        :id="button_id"
                        @click="listar(1,busscar)"
                      >
                        <i class="fa fa-search"></i> Buscar
                      </button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <filas-component :array_data="array_data" :array_atributo="array_atributo" :url="controller" :button_id="button_id"></filas-component>
        </div>
      </div>
      <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <!--Fin del modal-->
  </main>
</template>

<script>
import Vue from "vue";
export default {
  data() {
    return {
      array_atributo:['id','tipo'],
      array_data:[],
      controller:'tipo_actividad',
        button_id:'buscar_tipo',
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0
      },
      offset: 3,
      buscar:''
      
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
      // enviar la peticion para visualizar la data de esta pagina
      me.pagination.current_page = page;
    },
    
    listar(page, buscar){
      var url=this.controller+'?page='+page+'&buscar='+buscar;
      axios.get(url).then(resp=>{
        this.array_data = resp.data.table.data;
        this.pagination = resp.data.pagination;
        console.log(resp);
      })
      .catch(function(error) {
        console.log(error);
      });
    }
  },
  mounted() {
    this.listar(1,'');
  }
};
</script>
