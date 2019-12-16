<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card mx-4">
            <div class="card-body p-4">
              <form method="POST">
                <template v-if="ventana==2">
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
                    @click="objetivo('aumentar')"
                    type="button"
                  >Contruir Musculo</button>
                </template>

                <template v-else-if="ventana==1">
                  <h1>Datos Personales</h1>
                  <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="text-input">Fecha Nacimiento</label>
                    <div class="col-md-9">
                      <input type="date" class="form-control" v-model="fecha_nacimiento" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="text-input">Altura en cm</label>
                    <div class="col-md-9">
                      <input
                        type="number"
                        min="0"
                        v-model.number="altura"
                        step="any"
                        class="form-control"
                        required
                        placeholder="Altura..."
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="text-input">Peso en Kg</label>
                    <div class="col-md-9">
                      <input
                        type="number"
                        min="0"
                        v-model.number="peso"
                        step="any"
                        class="form-control"
                        required
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="text-input">Sexo</label>
                    <div class="col-md-9">
                      <select class="form-control" v-model="sexo">
                        <option value>Seleccione</option>
                        <option value="MASCULINO">MASCULINO</option>
                        <option value="FEMENINO">FEMENINO</option>
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
                    <h3>Objetivo</h3>
                    <select class="form-control" v-model="funcion" @click="calcular_peso()">
                      <option value>Seleccione</option>
                      <option value="normal">Normal</option>
                      <option value="rapido">Rapido</option>
                    </select>
                  </div>
                  <!-- </div>
                    </div>
                  </div>-->

                  <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="text-input">Dias Estimado</label>
                    <div class="col-md-9">{{ dias }} Dias</div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="text-input">Peso ideal</label>
                    <div class="col-md-9">{{ peso_ideal }}</div>
                  </div>
                </template>
                <template v-else-if="ventana==4">
                  <h1>Seleccione el Nivel de Actividad</h1>
                  <!-- <div class="container-fluid">
                    <div class="animated fadeIn">
                  <div class="card">-->
                  <!-- <div class="card-header">
                         <h3>Semana</h3>
                  </div>-->
                  <div class="card-body">
                    <h3>Nivel Actidad</h3>
                    <v-select
                    @search="select_nivel_actividad"
                    label="nombre"
                    :options="array_nivel_actividad"
                    placeholder="Nivel Actividad"
                    @input="get_nivel_actividad"
                  />
                  </div>
                  <div class="form-group row" v-if="calorias>0">
                    <label class="col-md-3 form-control-label" for="text-input">Calorias X dia</label>
                    <div class="col-md-9">{{ calorias }}</div>
                  </div>
                  <div class="form-group row" v-if="calorias>0">
                    <label class="col-md-3 form-control-label" for="text-input">IMC</label>
                    <div class="col-md-9">{{ imc }}</div>
                  </div>
                  <div class="form-group row" v-if="calorias>0">
                    <label class="col-md-3 form-control-label" for="text-input">Fecha Fin</label>
                    <div class="col-md-9">{{ fecha_fin }}</div>
                  </div>
                  <button
              type="button"
              @click="formula()">
                  Calcular</button>

                  <div class="form-group row">
                    <label class="col-md-12 form-control-label" for="text-input">menos de 16.5 Desnutricion</label>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-12 form-control-label" for="text-input">16.5 as 18.5 delgadez</label>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-12 form-control-label" for="text-input">18.5 a 25 Normal</label>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-12 form-control-label" for="text-input">25 a 30 Sobrepeso</label>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-12 form-control-label" for="text-input">30 a 35 obesidad Moderada</label>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-12 form-control-label" for="text-input">35 a 40 obesidad Severa</label>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-12 form-control-label" for="text-input">mas de 40 obesidad morbida o masiva</label>
                  </div>
                </template>
              </form>
            </div>

            <div class="card-body">
              <nav aria-label="Page navigation example">
                <ul class="pagination pagination-lg justify-content-center">
                  <li class="page-item" v-if="pagination.current_page <2 || pagination.current_page>2">
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
                  <li class="page-item" v-if="pagination.current_page <2 || pagination.current_page>2">
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
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
Vue.component("v-select", vSelect);

import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
export default {
  props: {
    usuario: Object
  },
  data() {
    return {
      fecha_nacimiento: "",
      altura: 0,
      peso: 0,
      peso_ideal: 0,
      nivel:0,
      sexo: "",
      ventana: 1,
      tipo: "",
      dias: 0,
      fecha_fin:'',
      fecha_inicio:'',
      imc:0,
      array_nivel_actividad:[],
      id_nivel:0,
      calorias:0,
      pagination: {
        total: 4,
        current_page: 1,
        per_page: 1,
        last_page: 4,
        from: 1,
        to: 1
      },
      offset: 4,
      funcion: ""
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
      if (this.validar()) {
        this.activarValidate = "was-validated";
        this.eventoAlerta("error", this.mensaje);
        return;
      }
      let me = this;
      // actualizar la Pagina
      me.pagination.current_page = page;
      // enviar la peticion para visualizar la data de esta pagina
      

      if (this.ventana+1 == 5) {
        this.registrar();
      }
      this.ventana = this.pagination.current_page;
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
        select_nivel_actividad(search, loading) {
      loading(true);
      var url = "nivel_actividad/select?buscar=" + search;
      axios
        .get(url)
        .then(resp => {
          let respuesta = resp.data;
          q: search;
          this.array_nivel_actividad= respuesta.table;
          loading(false);
        })
        .catch(error => {
          console.log(error);
        });
    },
    get_nivel_actividad(val1) {
      try {
        this.id_nivel = val1.id;
        this.nivel=val1.valor;
        // // this.formula();
      } catch {
       this.id_nivel=0;
       this.nivel=0;
      }
    },
    registrar() {
      if (this.validar()) {
        this.activarValidate = "was-validated";
        this.eventoAlerta("error", this.mensaje);
        return;
      }
      axios
        .post("dieta/registrar", {
          peso_ideal: this.peso_ideal,
          calorias: this.calorias,
          imc:this.imc,
          id_nivel:this.id_nivel,
          tipo: this.tipo,
          fecha_fin:this.fecha_fin,
          fecha_inicio:this.fecha_inicio,
          fecha_nacimiento: this.fecha_nacimiento,
          altura: this.altura,
          peso: this.peso,
          sexo: this.sexo
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
    formula()
    {
      let cal=0;
      let fecha=moment();
      let edad=0;
      
      let total=0;
      let fecha2=moment(this.fecha_nacimiento);
      edad=fecha.diff(fecha2,'years');
      // console.log(edad);
      if (this.sexo == "MASCULINO") {
         
        
        cal=66+(13.7*this.peso)+(5*this.altura)-(6.75*edad);
        // console.log(cal);
      }
      if (this.sexo == "FEMENINO") {
        cal=655+(9.6*this.peso)+(1.8*this.altura)-(4.7*edad);
      }
      cal=cal*this.nivel;
      // console.log(cal);
      if(this.funcion=="normal")
      {
        cal=cal-500;
      }
      if(this.funcion=="rapido")
      {
        cal=cal-1000;
      }
      this.calorias=cal.toFixed(0);

      let im=this.peso/((this.altura/100)*(this.altura/100));
      this.imc=im.toFixed(0);
      let date=new Date();
      this.fecha_inicio=moment().format('YYYY-MM-DD');
      date=date.setDate(this.dias);
      this.fecha_fin=moment(date).format('YYYY-MM-DD');
    },
    objetivo(tipo) {
      this.tipo = tipo;
      this.calcular_peso();
      if(tipo=="mantener" && this.peso>this.peso_ideal|| tipo=="mantener" && this.peso<this.peso_ideal)
      {
        this.eventoAlerta('error','No puede Seleccionar esta Opcion');
        return;
      }
      if(tipo=="reducir" && this.peso<this.peso_ideal)
      {
        this.eventoAlerta('error','No puede Seleccionar esta Opcion');
        return;
      }
       if(tipo=="aumentar" && this.peso>this.peso_ideal)
      {
        this.eventoAlerta('error','No puede Seleccionar esta Opcion');
        return;
      }
      this.cambiarPagina(this.pagination.current_page + 1);
      // this.ventana = this.pagination.current_page;
    },
    calcular_peso() {
      let alt = this.altura;
      let total = 0;
      let d = 0;

      if (this.sexo == "MASCULINO") {
        total = (alt - 100) * 0.9;
      }
      if (this.sexo == "FEMENINO") {
        total = (alt - 100) * 0.85;
      }

      if (this.funcion == "normal") {
        d = (this.peso - total) * 2 * 7;
      }
      if (this.funcion == "rapido") {
        d = (this.peso - total) * 7;
      }
      if(d<0)
      {
        d=d*(-1);
      }
      this.dias = d.toFixed(0);
      this.peso_ideal = total.toFixed(0);
    },
    validar() {
      if (this.ventana == 1) {
        if (!this.fecha_nacimiento) {
          this.mensaje = "Ingrese Su Fecha de Nacimiento";
          return true;
        }
        if (this.altura < 100 || this.altura > 250) {
          this.mensaje =
            "La altura no Puede ser menor a 100 cm o Mayor de 250 cm";
          return true;
        }
        if (this.peso < 20) {
          this.mensaje = "El Peso no Puede ser Menor a 20 Kilos";
          return true;
        }
        if (!this.sexo) {
          this.mensaje = "Seleccione el Sexo";
          return true;
        }
      }
      if (this.ventana == 3) {
        if (!this.dias) {
          this.mensaje = "Seleccione el Objetivo";
          return true;
        }
      }
      if(this.ventana==4)
      {
         if (this.imc<0) {
          this.mensaje = "Calcule su IMC";
          return true;
        }
      }
      return false;
    }
  }
};
</script>