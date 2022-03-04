<template>
  <app-layout title="Dashboard">

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



 const cotizaciones = computed(() => usePage().props.value.cotizaciones)


</script>
