<template>
  <app-layout title="Dashboard">
<div class="row g-2 row-deck mb-2">
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center p-4">
                                <div class="avatar lg rounded no-thumbnail"><i class="fa fa-archive fa-lg"></i></div>
                                <div class="flex-fill ms-3 text-truncate">
                                    <div class="text-muted">Total Projects</div>
                                    <h5 class="mb-0">24</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center p-4">
                                <div class="avatar lg rounded no-thumbnail"><i class="fa fa-th fa-lg"></i></div>
                                <div class="flex-fill ms-3 text-truncate">
                                    <div class="text-muted">Completed Projects</div>
                                    <h5 class="mb-0">22</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center p-4">
                                <div class="avatar lg rounded no-thumbnail"><i class="fa fa-file fa-lg"></i></div>
                                <div class="flex-fill ms-3 text-truncate">
                                    <div class="text-muted">Pending Projects</div>
                                    <h5 class="mb-0">06</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <form>
                                    <div class="form-group mb-0">
                                        <label>Search</label>
                                        <div class="input-group mb-0">
                                            <input type="text" class="form-control" placeholder="Search..." aria-describedby="project-search-addon">
                                            <div class="input-group-append">
                                                <button class="btn btn-danger" type="button" id="project-search-addon"><i class="fa fa-search search-icon font-12"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
<el-table :data="cotizaciones.data" datastripe style="width: 100%">
   <el-table-column  fixed  prop="id" label="ID"  width="50" >
           <template #default="scope">
           <span>C-{{scope.row.id}}</span>
       </template>
    </el-table-column>
    <el-table-column  fixed  prop="fecha" label="Fecha"  >
           <template #default="scope">
           <span>{{scope.row.fecha}}</span>
       </template>
    </el-table-column>
    <el-table-column  fixed  prop="cliente" label="Cliente"  >
           <template #default="scope">
           <span>{{scope.row.cliente.nombre}} {{scope.row.cliente.apaterno}}</span>
       </template>
    </el-table-column>
    <el-table-column  fixed  prop="cliente" label="Correo"  >
           <template #default="scope">
           <span>{{scope.row.cliente.email}} </span>
       </template>
    </el-table-column>
       <el-table-column  prop="estatus" label="Estatus"  />
         <el-table-column prop="subtotal" label="Subtotal" >
                <template #default="scope">
                    $ {{numeralFormat(scope.row.subtotal, '0,0.00')}}
                </template>
            </el-table-column>
                     <el-table-column prop="iva" label="IVA" >
                <template #default="scope">
                    $ {{numeralFormat(scope.row.iva, '0,0.00')}}
                </template>
            </el-table-column>
         <el-table-column prop="utilidad" label="Utilidad" >
                <template #default="scope">
                    $ {{numeralFormat(scope.row.utilidad, '0,0.00')}}
                </template>
            </el-table-column>
         <el-table-column prop="total" label="Total" >
                <template #default="scope">
                    $ {{numeralFormat(scope.row.total, '0,0.00')}}
                </template>
            </el-table-column>
              <el-table-column fixed="right" label="" width="50">
                <template #default="scope">
                       <button type="button"
                       @click="descargar(scope.row.id)"
                     class="btn btn-link btn-sm text-success"
                     data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar PDF"
                     data-bs-original-title="Descargar PDF" aria-label="Delete">
                     <i class="fa fa-file-pdf-o fa-2x"></i>
                     </button>
                </template>
            </el-table-column>
</el-table>


  </app-layout>
</template>
<script  setup >
import { ref,  watch , reactive,computed} from "vue"
import AppLayout from "@/Layouts/AppLayout.vue"
import useBuscarCliente from '@/Composables/useBuscarCliente'
import { CommonPicker } from "element-plus";
import { usePage } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'
import JetButton from '@/Jetstream/Button.vue';

import { ElLoading } from 'element-plus'

const descargar = (id) => {
      const loading = ElLoading.service({
    lock: true,
    text: 'Descargando...',
    background: 'rgba(0, 0, 0, 0.7)',
  })
    const nameFile =  'C-'+id+'.pdf'
     axios.get("../descargar/" + id, {
      responseType: 'arraybuffer',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/pdf'
            }
         }).then( (response) =>{
             loading.close();
        const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', nameFile); //or any other extension
            document.body.appendChild(link);
            link.click();
    })
    .catch( (error) =>{
      loading.close();
    });
}

 const cotizaciones = computed(() => usePage().props.value.cotizaciones)


</script>
