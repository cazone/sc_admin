<template>
    <app-layout title="Nuevo Cliente">

    <template #header>
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="h4 mt-1">Nuevo Cliente</h1>
                    </div>
                    <!-- <div class="col-auto">
                        <a href="https://themeforest.net/user/wrraptheme" title="Download" target="_blank" class="btn btn-white border lift">Download</a>
                        <button type="button" class="btn btn-dark lift">Generate Report</button>
                    </div> -->
                </div>
            </div>
    </template>




                    <div class="col-12">
                        <div class="card">
                            <!-- <div class="card-header py-3 bg-transparent border-bottom-0">
                                <h6 class="card-title mb-0"><strong>Informaci&oacute;n personal</strong></h6>
                            </div> -->
                            <div class="card-body ">
                                <form class="row g-3" @submit.prevent="save" >
                                     <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Nombre</label>
                                            <input  class="form-control" v-model="form.nombre" type="text"
                                             :class="{ 'is-invalid': form.errors.nombre }">
                                       <jet-input-error :message="form.errors.nombre" class="mt-2" />
                                    </div>

                                     <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Apellido paterno</label>
                                            <input  class="form-control" v-model="form.apaterno" type="text"
                                             :class="{ 'is-invalid': form.errors.apaterno }">
                                       <jet-input-error :message="form.errors.apaterno" class="mt-2" />
                                    </div>
                                     <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Apellido materno</label>
                                            <input  class="form-control" v-model="form.amaterno" type="text"
                                             :class="{ 'is-invalid': form.errors.amaterno }">
                                       <jet-input-error :message="form.errors.amaterno" class="mt-2" />
                                    </div>
                                     <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">CURP</label>
                                            <input  class="form-control" v-model="form.curp" type="text"
                                             :class="{ 'is-invalid': form.errors.curp }">
                                       <jet-input-error :message="form.errors.curp" class="mt-2" />
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Email</label>
                                            <input  class="form-control" v-model="form.email" type="email"
                                             :class="{ 'is-invalid': form.errors.email }">
                                       <jet-input-error :message="form.errors.email" class="mt-2" />
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">RFC</label>
                                            <input  class="form-control" v-model="form.rfc" type="text"
                                             :class="{ 'is-invalid': form.errors.rfc }">
                                       <jet-input-error :message="form.errors.rfc" class="mt-2" />
                                    </div>
                                  <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">NSS</label>
                                            <input  class="form-control" v-model="form.nss" type="text"
                                             :class="{ 'is-invalid': form.errors.nss }">
                                       <jet-input-error :message="form.errors.nss" class="mt-2" />
                                    </div>
                                   <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Telefono casa</label>
                                            <input  class="form-control" v-model="form.telefono" type="text"
                                             :class="{ 'is-invalid': form.errors.telefono }">
                                       <jet-input-error :message="form.errors.telefono" class="mt-2" />
                                    </div>
                                  <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Celular</label>
                                            <input  class="form-control" v-model="form.celular" type="text"
                                             :class="{ 'is-invalid': form.errors.celular }">
                                       <jet-input-error :message="form.errors.celular" class="mt-2" />
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Tipo identificacion</label>
                                            <input  class="form-control" v-model="form.tipo_identificacion" type="text"
                                             :class="{ 'is-invalid': form.errors.tipo_identificacion }">
                                       <jet-input-error :message="form.errors.tipo_identificacion" class="mt-2" />
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Folio identificacion</label>
                                            <input  class="form-control" v-model="form.folio_identificacion" type="text"
                                             :class="{ 'is-invalid': form.errors.folio_identificacion }">
                                       <jet-input-error :message="form.errors.folio_identificacion" class="mt-2" />
                                    </div>
                                  <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Estado civil</label>
                                            <input  class="form-control" v-model="form.estado_civil" type="text"
                                             :class="{ 'is-invalid': form.errors.estado_civil }">
                                       <jet-input-error :message="form.errors.estado_civil" class="mt-2" />
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Sexo</label>
                                            <el-select style="width:100%" v-model="form.sexo" clearable placeholder="Selecciona">
                                                 <el-option
                                                   v-for="item in option"
                                                   :key="item.value"
                                                   :label="item.label"
                                                   :value="item.value"
                                                 >
                                                 </el-option>
                                            </el-select>
                                    </div>
                                     <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Fecha de nacimiento</label>
                                        <el-date-picker
                                         format="YYYY-MM-DD"
                                         value-format="YYYY-MM-DD"
                                        style="width:100%" v-model="form.fecha_nacimiento" type="date" placeholder="Selecciona la fecha">
                                        </el-date-picker>
                                    </div>
                                      <el-divider content-position="left">Informaci&oacute;n de la Direccion</el-divider>
                                     <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Calle</label>
                                            <input  class="form-control" v-model="form.calle" type="text"
                                             :class="{ 'is-invalid': form.errors.calle }">
                                       <jet-input-error :message="form.errors.calle" class="mt-2" />
                                    </div>
                                     <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">No Exterior</label>
                                            <input  class="form-control" v-model="form.no_exterior" type="text"
                                             :class="{ 'is-invalid': form.errors.no_exterior }">
                                       <jet-input-error :message="form.errors.no_exterior" class="mt-2" />
                                    </div>
                                     <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">No Exterior</label>
                                            <input  class="form-control" v-model="form.no_interior" type="text"
                                             :class="{ 'is-invalid': form.errors.no_interior }">
                                       <jet-input-error :message="form.errors.no_interior" class="mt-2" />
                                    </div>
                                     <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Estado</label>
                                            <input  class="form-control" v-model="form.estado" type="text"
                                             :class="{ 'is-invalid': form.errors.estado }">
                                       <jet-input-error :message="form.errors.estado" class="mt-2" />
                                    </div>
                                      <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Municipio</label>
                                            <input  class="form-control" v-model="form.municipio" type="text"
                                             :class="{ 'is-invalid': form.errors.municipio }">
                                       <jet-input-error :message="form.errors.municipio" class="mt-2" />
                                    </div>
                                     <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Colonia</label>
                                            <input  class="form-control" v-model="form.colonia" type="text"
                                             :class="{ 'is-invalid': form.errors.colonia }">
                                       <jet-input-error :message="form.errors.colonia" class="mt-2" />
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Poblacion</label>
                                            <input  class="form-control" v-model="form.poblacion" type="text"
                                             :class="{ 'is-invalid': form.errors.poblacion }">
                                       <jet-input-error :message="form.errors.poblacion" class="mt-2" />
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">C.P</label>
                                            <input  class="form-control" v-model="form.cp" type="text"
                                             :class="{ 'is-invalid': form.errors.cp }">
                                       <jet-input-error :message="form.errors.cp" class="mt-2" />
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                    </div>
                                    <el-divider content-position="left">Informaci&oacute;n del Empleo</el-divider>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Num empleado</label>
                                            <input  class="form-control" v-model="form.num_empleado" type="text"
                                             :class="{ 'is-invalid': form.errors.num_empleado }">
                                       <jet-input-error :message="form.errors.num_empleado" class="mt-2" />
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Puesto</label>
                                            <input  class="form-control" v-model="form.puesto" type="text"
                                             :class="{ 'is-invalid': form.errors.puesto }">
                                       <jet-input-error :message="form.errors.puesto" class="mt-2" />
                                    </div>
                                 <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Tipo de pago</label>
                                            <input  class="form-control" v-model="form.tipo_pago" type="text"
                                             :class="{ 'is-invalid': form.errors.tipo_pago }">
                                       <jet-input-error :message="form.errors.tipo_pago" class="mt-2" />
                                    </div>
                                  <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Fecha de ingreso</label>
                                        <el-date-picker
                                         format="YYYY-MM-DD"
                                         value-format="YYYY-MM-DD"
                                        style="width:100%" v-model="form.fecha_ingreso" type="date" placeholder="Selecciona la fecha">
                                        </el-date-picker>

                                       <div v-show="form.errors.cuenta" class="text-danger">
                                        <small>{{form.errors.cuenta}}</small>
                                     </div>

                                    </div>
                                    <el-divider content-position="left">Informaci&oacute;n Bancaria</el-divider>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Numero Cuenta</label>
                                            <input  class="form-control" v-model="form.cuenta" type="text"
                                             :class="{ 'is-invalid': form.errors.cuenta }">
                                       <jet-input-error :message="form.errors.cuenta" class="mt-2" />
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">CLABE</label>
                                            <input  class="form-control" v-model="form.clabe" type="text"
                                             :class="{ 'is-invalid': form.errors.clabe }">
                                       <jet-input-error :message="form.errors.clabe" class="mt-2" />
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Sucursal</label>
                                            <input  class="form-control" v-model="form.sucursal" type="text"
                                             :class="{ 'is-invalid': form.errors.sucursal }">
                                       <jet-input-error :message="form.errors.sucursal" class="mt-2" />
                                    </div>
                                       <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Empresa ID</label>
                                            <el-select style="width:100%" v-model="form.empresas_id" clearable placeholder="Selecciona">
                                                 <el-option
                                                   v-for="item in empresas"
                                                   :key="item.id"
                                                   :label="item.nombre"
                                                   :value="item.id"
                                                 >
                                                 </el-option>
                                            </el-select>
                                             <div v-show="form.errors.empresas_id" class="text-danger">
                                        <small>{{form.errors.empresas_id}}</small>
                                     </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                     <label class="col-form-label">Convenio</label>
                                            <el-select style="width:100%" v-model="form.convenios_id" clearable placeholder="Selecciona">

                                                       <el-option
                                                         v-for="item in convenios"
                                                         :key="item.id"
                                                         :label="item.nombre"
                                                         :value="item.id"
                                                       >
                                                         <span style="float: left">{{ item.nombre }}</span>
                                                         <span
                                                           style="
                                                             float: right;
                                                             color: var(--el-text-color-secondary);
                                                             font-size: 13px;
                                                           "
                                                           >{{ item.dispencion }}</span
                                                         >
                                                       </el-option>
                                                     </el-select>

                                             <div v-show="form.errors.convenios_id" class="text-danger">
                                        <small>{{form.errors.convenios_id}}</small>
                                     </div>
                                    </div>
                                    <div class="col-12">
                                          <jet-button :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
                                            <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
                                              <span class="visually-hidden">Cargando...</span>
                                            </div>
                                            Crear Cliente
                                          </jet-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- Personal Information Card End -->




    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetInputError from '@/Jetstream/InputError.vue';
import JetButton from '@/Jetstream/Button.vue'
export default defineComponent( {
    props: ["empresas", "convenios"],
    components: {
        AppLayout,
        JetInputError,
        JetButton
    },
    data() {
        return {
            option:[
        {
          value: 'F',
          label: 'Femenino',
        },
        {
          value: 'M',
          label: 'Masculino',
        }],
            form: this.$inertia.form({
        nombre: '',
        apaterno: '',
        amaterno:'',
        fecha_nacimiento:'',
        curp:'',
        email:'',
        sexo:'',
        rfc:'',
        nss:'',
        telefono:'',
        celular:'',
        estado_civil:'',
        calle:'',
        no_exterior:'',
        no_interior:'',
        estado:'',
        municipio:'',
        colonia:'',
        cp:'',
        poblacion:'',
        num_empleado:'',
        puesto:'',
        tipo_pago:'',
        fecha_ingreso:'',
        tipo_identificacion:'',
        folio_identificacion:'',
        cuenta:'',
        clabe:'',
        sucursal:'',
        empresas_id: '',
        convenios_id:'',


      })
        }
    },
    methods: {
        save() {
              this.form.post(route('clientes.store'), {

        preserveScroll: true
      });
        }
    },
});
</script>

