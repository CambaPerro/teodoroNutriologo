<template>
                  <div class="card">
                <div class="card-header"> Pagination<small>sizing</small></div>
                <div class="card-body">
                 <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-lg justify-content-center">
                      <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>
                      <li class="page-item active"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                  </nav>
                </div>
              </div>
</template>
<script>
export default {
    props:{
        usuario:Object
    },
    data(){
        return{

        };
    },
    mounted() {
        console.log(this.usuario);
    }
}
</script>