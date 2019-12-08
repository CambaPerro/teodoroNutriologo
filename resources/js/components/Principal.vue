<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card mx-4">
            <div class="card-body p-4">
              <form method="POST">
                <template v-if="ventana==1">
                  <h1>Objetivo</h1>
                  <p class="text-muted">Cual es tu Objetivo</p>
                  <button
                    class="btn btn-pill btn-block btn-success"
                    @click="objetivo('reducir')"
                    type="button"
                  >Reducir Grasas</button>

                  <button
                    class="btn btn-pill btn-block btn-warning"
                    @click="objetivo('mantener')"
                    type="button"
                  >Mantener Peso</button>

                  <button
                    class="btn btn-pill btn-block btn-danger"
                    @click="objetivo('contruir')"
                    type="button"
                  >Contruir Musculo</button>
                </template>

                <template v-else-if="ventana==2">
                  <h1>Datos Personales</h1>
                  <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="text-input">Fecha Nacimiento</label>
                    <div class="col-md-9">
                      <input type="date" class="form-control" v-model="fecha_nacimiento" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="text-input">Altura</label>
                    <div class="col-md-9">
                      <input
                        type="number"
                        min="0"
                        v-model="altura"
                        step="any"
                        class="form-control"
                        required
                        placeholder="Altura..."
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="text-input">Peso</label>
                    <div class="col-md-9">
                      <input
                        type="number"
                        min="0"
                        v-model="peso"
                        step="any"
                        class="form-control"
                        required
                        placeholder="Peso..."
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="text-input">Sexo</label>
                    <div class="col-md-9">
                      <select class="form-control" v-model="sexo">
                        <option value>Seleccione</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                      </select>
                    </div>
                  </div>
                </template>
                <template v-else-if="ventana==3">
                  <h1>¿En cuanto tiempo desea alcanzar su objetivo?</h1>
                  <!-- <div class="container-fluid">
                    <div class="animated fadeIn">
                  <div class="card">-->
                  <!-- <div class="card-header">
                         <h3>Semana</h3>
                  </div>-->
                  <div class="card-body">
                    <div class="progress">
                      <div
                        class="progress-bar progress-bar-striped progress-bar-animated"
                        role="progressbar"
                        :aria-valuenow="(progreso)*10"
                        aria-valuemin="0"
                        aria-valuemax="100"
                        :style="'width:' +(progreso*10)+'%'"
                      ></div>
                    </div>
                    <h3>Semanas</h3>
                    <div class="input-group">
                      <span class="input-group-prepend">
                        <button class="btn btn-primary" type="button">
                          <i class="fa fa-minus" @click="cambiarValor(-1)"></i>
                        </button>
                      </span>
                      <input
                        type="number"
                        v-model="progreso"
                        class="form-control"
                        min="1"
                        max="100"
                      />
                      <span class="input-group-append">
                        <button class="btn btn-primary" @click="cambiarValor(+1)" type="button">
                          <i class="fa fa-plus"></i>
                        </button>
                      </span>
                    </div>
                  </div>
                  <!-- </div>
                    </div>
                  </div>-->

                  <div class="form-group row">
                    <label
                      class="col-md-3 form-control-label"
                      for="text-input"
                    >Fecha de Estimada de Cumplimiento</label>
                    <div class="col-md-9">
                      <input type="date" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="text-input">Peso</label>
                    <div class="col-md-9">
                      <input
                        type="number"
                        min="0"
                        v-model="peso"
                        step="any"
                        class="form-control"
                        required
                        placeholder="Peso..."
                      />
                    </div>
                  </div>
                </template>
              </form>
            </div>

            <div class="card-body">
              <nav aria-label="Page navigation example">
                <ul class="pagination pagination-lg justify-content-center">
                  <li class="page-item" v-if="pagination.current_page > 1">
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPagina(pagination.current_page - 1)"
                    >Volver</a>
                  </li>
                  <li
                    class="page-item"
                    v-for="page in pagesNumber"
                    :key="page"
                    :class="[page == isActived ? 'active' : '']"
                    v-if="page==isActived"
                  >
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPagina(page)"
                      v-text="page"
                    ></a>
                  </li>
                  <li class="page-item" v-if="pagination.current_page >1">
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPagina(pagination.current_page + 1)"
                    >Continuar</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
export default {
  props: {
    usuario: Object
  },
  data() {
    return {
      fecha_nacimiento: "",
      altura: "",
      peso: "",
      sexo: "",
      ventana: 1,
      tipo: "",
      pagination: {
        total: 3,
        current_page: 1,
        per_page: 1,
        last_page: 3,
        from: 1,
        to: 1
      },
      offset: 3,
      progreso: 0
    };
  },
  mounted() {
    console.log(this.usuario);
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
    cambiarPagina(page) {
      let me = this;
      // actualizar la Pagina
      me.pagination.current_page = page;
      // enviar la peticion para visualizar la data de esta pagina
      this.ventana = this.pagination.current_page;
      if(this.ventana==4){
      this.registrar();
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
        .post("dieta/registrar", {
          peso_ideal:60,
          calorias:100,
          imc:100,
          tipo:this.tipo,
          fecha_nacimiento:this.fecha_nacimiento,
          altura:this.altura,
          peso:this.peso,
          sexo:this.sexo
        })
        .then(resp => {
          this.eventoAlerta("success", "Bienbenido a Masaco");
          // this.limpiar();
           window.open("home");
        })
        .catch(error => {
          console.log(error);
        });
        
    },
    objetivo(tipo) {
      this.tipo = tipo;
      this.cambiarPagina(this.pagination.current_page + 1);
      // this.ventana = this.pagination.current_page;
    },
    cambiarValor(valor) {
      if (this.progreso + valor >= 10 && valor > 0) {
        this.progreso = 10;
        return;
      }
      if (this.progreso <= 0 && valor < 0) {
        this.progreso = 0;
        return;
      }
      this.progreso = this.progreso + valor;

      // this.cambioValor.emit(this.progreso);k
      // this.txtProgress.nativeElement.focus();
    },
    validar() {
      // if (!this.nombre) {
      //   this.mensaje = "Ingrese el Nombre";
      //   return true;
      // }
      // if (!this.id_categoria) {
      //   this.mensaje = "Seleccione la Categoria";
      //   return true;
      // }
      return false;
    }
  }
};
</script>