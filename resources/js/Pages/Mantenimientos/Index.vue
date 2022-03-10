<template>
  <app-layout title="Dashboard">

<div class="row g-3 justify-content-center">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header py-3 bg-transparent border-bottom-0">
                                <h6 class="card-title mb-0"><strong>Filtros de busqueda</strong></h6>
                            </div>
                            <div class="card-body">
                                <form class="row g-3">
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <label class="col-form-label">Folio</label>
                                        <fieldset class="form-icon-group left-icon position-relative">
                                            <input type="text" v-model="BuscarUser.id" @keypress.enter="buscar" class="form-control">
                                            <div class="form-icon position-absolute">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"></path>
                                                </svg>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <label class="col-form-label">Nombre del cliente</label>
                                        <fieldset class="form-icon-group left-icon position-relative">
                                            <input type="text" v-model="BuscarUser.nombre" @keypress.enter="buscar" class="form-control">
                                            <div class="form-icon position-absolute">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"></path>
                                                </svg>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <label class="col-form-label">Correo electronico</label>
                                        <fieldset class="form-icon-group left-icon position-relative">
                                            <input type="email" v-model="BuscarUser.email" @keypress.enter="buscar"  class="form-control">
                                            <div class="form-icon position-absolute">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"></path>
                                                </svg>
                                            </div>
                                        </fieldset>
                                    </div>


                                    <div class="col-12">
                                        <button type="button" style="margin-right: 10px;" @click="buscar" class="btn btn-primary float-right">Buscar</button>
                                        <button type="button" @click="limpiar" class="btn btn-secondary ">Limpiar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- Personal Information Card End -->
</div>

<el-table :data="mantenimientos.data" datastripe style="width: 100%">
   <el-table-column  fixed  prop="id" label="ID"  width="50" >
           <template #default="scope">
           <span>S-{{scope.row.id}}</span>
       </template>
    </el-table-column>
    <el-table-column  fixed  prop="fecha_alta" label="Fecha alta"  >
           <template #default="scope">
           <span>{{scope.row.fecha_alta}}</span>
       </template>
    </el-table-column>
    <el-table-column  fixed  prop="cliente" label="Cliente"  >
           <template #default="scope">
           <span>{{scope.row.cliente.nombre}} {{scope.row.cliente.apaterno}}</span>
       </template>
    </el-table-column>
       <el-table-column  fixed  prop="celular" label="Celular"  >
           <template #default="scope">
           <span>{{scope.row.cliente.celular}} </span>
       </template>
    </el-table-column>
    <el-table-column  fixed  prop="cliente" label="Correo"  >
           <template #default="scope">
           <span>{{scope.row.cliente.email}} </span>
       </template>
    </el-table-column>
       <el-table-column  prop="estatus" label="Estatus"  />
         <el-table-column prop="tipo" label="Tipo" >
                <template #default="scope">
                      {{scope.row.tipo}}
                </template>
            </el-table-column>
                    <el-table-column  fixed  prop="user" label="Tecnico"  >
           <template #default="scope">
           <span>{{scope.row.user.name}} </span>
       </template>
    </el-table-column>
              <el-table-column fixed="right" label="" width="200">
                <template #default="scope">
                       <button type="button"
                       @click="descargar(scope.row.id)"
                     class="btn btn-link btn-sm text-info"
                     data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar PDF"
                     data-bs-original-title="Descargar PDF" aria-label="Delete">
                     <i class="fa fa-file-pdf-o fa-2x"></i>
                     </button>
                     <button type="button"
                       @click="editar(scope.row.id)"
                     class="btn btn-link btn-sm text-success"
                     data-bs-toggle="tooltip" data-bs-placement="top" title="Editar cotizacion"
                     data-bs-original-title="Editar cotizacion" aria-label="Delete">
                     <i class="fa fa-pencil-square-o fa-2x"></i>
                     </button>
                </template>
            </el-table-column>
</el-table>

        <el-divider></el-divider>

 <pagination :links="mantenimientos" text="Cotizaciones"
        ruta="clientes.index"></pagination>

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
import Pagination from '@/Components/Pagination.vue'

import { ElLoading } from 'element-plus'
const BuscarUser = ref({
            id: null,
            nombre: null,
            email: null,
        })
        const limpiar = () => {
            Inertia.get(route("mantenimientos.index"), '')
        }
const buscar = () => {
            Inertia.get(route("mantenimientos.index"), BuscarUser.value,{
                 preserveScroll: true,
  preserveState: true,
            }

            )
        }
         const editar = (id) => {
            Inertia.visit(route("mantenimientos.edit", id))
        }
const descargar = (id) => {
      const loading = ElLoading.service({
    lock: true,
    text: 'Descargando...',
    background: 'rgba(0, 0, 0, 0.7)',
  })
    const nameFile =  'S-'+id+'.pdf'
     axios.get("../descargar-recepcion/" + id, {
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

 const mantenimientos = computed(() => usePage().props.value.mantenimientos)


</script>
