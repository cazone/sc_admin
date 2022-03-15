<template>
  <app-layout title="Recepcion de Equipo">
<div class="row g-3 justify-content-center">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header py-3 bg-transparent border-bottom-0">
                                <h6 class="card-title mb-0"><strong>Informaci&oacute;n del cliente</strong></h6>
                            </div>
                            <div class="card-body">
                                <form class="row g-3">
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <label class="col-form-label">Buscar cliente</label>
                                        <fieldset class="form-icon-group left-icon position-relative">
                                            <button v-if="clienteSelectd"
                                            @click.prevent="clienteSelectd =''"
                                            class="btn btn-primary">Buscar</button>
                                            <el-select
                                            v-if="!clienteSelectd"
                                              v-model="clienteSelectd"
                                              filterable
                                              remote

                                              placeholder="Buscar cliente"
                                              :remote-method="buscarCliente"
                                              :loading="loading"
                                            >
                                            <el-option
                                              v-for="item in clientes"
                                              :key="item"
                                              :label="item.nombre + ' ' + item.apaterno + ' ' + item.amaterno"
                                              :value="item"
                                            >
                                            </el-option>
                                         </el-select>

                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <label class="col-form-label">Nombre completo </label>
                                        <fieldset class="form-icon-group left-icon position-relative">
                                            <input v-if="clienteSelectd" type="text" class="form-control" disabled :value="`${clienteSelectd.nombre} ${clienteSelectd.apaterno} ${clienteSelectd.amaterno}`">
                                            <div class="form-icon position-absolute">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"></path>
                                                </svg>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <label class="col-form-label">Email Address</label>
                                        <fieldset class="form-icon-group left-icon position-relative">
                                            <input type="email" class="form-control" :value="clienteSelectd.email" disabled>
                                            <div class="form-icon position-absolute">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"></path>
                                                </svg>
                                            </div>
                                        </fieldset>
                                    </div>
                                       <div class="col-lg-4 col-md-6 col-sm-6">
                                        <label class="col-form-label">Celular</label>
                                        <fieldset class="form-icon-group left-icon position-relative">
                                            <input type="email" class="form-control" :value="clienteSelectd.celular" disabled>
                                            <div class="form-icon position-absolute">

                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <label class="col-form-label">Telefono</label>
                                        <fieldset class="form-icon-group left-icon position-relative">
                                            <input type="email" class="form-control" :value="clienteSelectd.telefono" disabled>
                                            <div class="form-icon position-absolute">

                                            </div>
                                        </fieldset>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div><!-- Personal Information Card End -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header py-3 bg-transparent border-bottom-0">
                                <h6 class="card-title mb-0"><strong>Informaci&oacute;n del equipo</strong></h6>
                            </div>
                            <div class="card-body">
                                <form class="row g-3">
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <label class="col-form-label">Numero de serie</label>

                                            <input type="text" v-model="serie" class="form-control" >


                                        <ul v-if="$page.props.errors.serie" class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required"> {{$page.props.errors.serie}}</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <label class="col-form-label">Marca</label>


                                     <input  class="form-control" v-model="marca" type="text">
                                            <ul v-if="$page.props.errors.marca" class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required"> {{$page.props.errors.marca}}</li>
                                             </ul>

                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <label class="col-form-label">Modelo</label>
                                          <input type="text" v-model="modelo" class="form-control">
                                           <ul v-if="$page.props.errors.modelo" class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required"> {{$page.props.errors.modelo}}</li>
                                             </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <label class="col-form-label">Tipo de Equipo</label>
                                         <input  class="form-control" v-model="tipo" type="text"
                                            >

                                             <ul v-if="$page.props.errors.tipo" class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required"> {{$page.props.errors.tipo}}</li>
                                             </ul>

                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">

                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">

                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Accesorios <sup class="text-danger">*</sup></label>
                                         <VueEditor  v-model="accesorios"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- Company Information Card End -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header py-3 bg-transparent border-bottom-0">
                                <h6 class="card-title mb-0"><strong>Trabajo a realizar</strong></h6>
                            </div>
                            <div class="card-body">
                                 <div class="col-md-12">
                                        <label class="form-label">Describe las fallas , mantenimientop o trabajo a realizar  del Equipo  <sup class="text-danger">*</sup></label>
                                         <VueEditor  v-model="falla"/>

                                    </div>
                            </div>
                        </div>
                    </div><!-- Form Validation -->
                            <div class="col-12">
                        <div class="card">
                            <div class="card-header py-3 bg-transparent border-bottom-0">
                                <h6 class="card-title mb-0"><strong>Observaciones</strong></h6>
                            </div>
                            <div class="card-body">
                                 <div class="col-md-12">
                                        <label class="form-label">Observaciones por parte del tecnico  <sup class="text-danger">*</sup></label>
                                         <VueEditor  v-model="observaciones"/>

                                    </div>
                            </div>
                        </div>
                    </div><!-- Form Validation -->
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                    <div class="col-md-12">
                                             <button
                                             :disabled="clienteSelectd.length == 0"
                                            @click="submit"
                                            class="btn btn-primary">Guardar </button>


                                    </div>
                            </div>
                        </div>
                    </div><!-- Form Validation -->
                </div>
  </app-layout>
</template>
<script  setup >
import { ref, computed } from "vue"
import AppLayout from "@/Layouts/AppLayout.vue"
import useBuscarCliente from '@/Composables/useBuscarCliente'
import { CommonPicker } from "element-plus";
import { usePage } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'
import JetButton from '@/Jetstream/Button.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import { ElLoading } from 'element-plus'
import { VueEditor } from "vue3-editor";
import VueBootstrapTypeahead from 'vue-bootstrap-typeahead'
import { ElMessageBox, ElMessage } from 'element-plus'
const marca = ref('')
const serie = ref('')
const tipo = ref('')
const accesorios = ref('')
const falla = ref('')
const modelo = ref('')
const observaciones = ref('')
const { clienteSelectd, loading,clientes,buscarCliente } = useBuscarCliente();
const test  = (value) =>{
console.log(value);
}
const submit = () => {

   Inertia.visit(route('mantenimientos.store'), {
  method: 'post',
  preserveScroll: true,
  preserveState: true,
  data: {
      serie: serie.value,
      marca: marca.value,
      modelo: modelo.value,
      tipo: tipo.value,
      accesorios: accesorios.value,
      falla: falla.value,
      cliente_id: clienteSelectd.value.id,
      observaciones: observaciones.value,

  },

  onCancelToken: cancelToken => {},
  onCancel: () => {},
  onBefore: visit => {},
  onStart: visit => {},
  onProgress: progress => {

  },
  onSuccess: page => {

      if(page.props.flash.message){
  ElMessageBox.alert(page.props.flash.message, 'Error', {
    confirmButtonText: 'OK',

  })
      }
      console.log('page',page.props.flash.message);
  },
  onError: errors => {
     console.lpg('error');


  },
  onFinish: visit => {
      console.log(visit);
  },
})

}

</script>
