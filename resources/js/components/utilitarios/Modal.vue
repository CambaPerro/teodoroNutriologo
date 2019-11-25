<template>
  <div
    class="modal fade bd-example-modal-lg"
    tabindex="-1"
    role="dialog"
    :id="array_id.modal_id"
    aria-labelledby="myModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-primary modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">TITULO</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action method="post" enctype="multipart/form-data" class="form-horizontal">
            <template v-for="(data) in array_atributo" v-if="data!='id'">
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">{{ data.toUpperCase() }}</label>
                <div class="col-md-9">
                  <input
                    type="text"
                    v-model="array_registro[data]"
                    :placeholder="data"
                    class="form-control"
                    required
                  />
                </div>
              </div>
            </template>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" v-if="registrar" @click="registro()" class="btn btn-primary">Guardar</button>
          <button v-else type="button" @click="actualizar()" class="btn btn-primary">Actualizar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>

    <!-- /.modal-dialog -->
  </div>
</template>

<script>
export default {
  props: {
    array_atributo: Array,
    array_id: Object,
    array_registro: Object,
    registrar: Boolean,
    url:String
  },
  data() {
    return {};
  },
  methods: {
   
    registro(){
        let modal=this.array_id.modal_id;
        let button=this.array_id.button_id;
        console.log(this.array_id);
         axios
        .post(this.url+"/registrar", {
          data:this.array_registro
        })
        .then(function(response) {
          $("#"+modal).modal("hide");
          document.getElementById(button).click();
        })
        .catch(function(error) {
          console.log(error);
        });
    },
     actualizar() {},
    }
  
};
</script>