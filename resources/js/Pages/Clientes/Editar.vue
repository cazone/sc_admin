<template>
    <app-layout title="Nuevo Cliente">

    <template #header>
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="h4 mt-1">Editar Cliente </h1>
                    </div>
                   <div class="col-auto">
                        <Link :href="route('clientes.index')" >
                        <a title="regrasar"  class="btn btn-white border lift">Regresar</a>
                        </Link>

                    </div>
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
import JetButton from '@/Jetstream/Button.vue';
import { Link } from "@inertiajs/inertia-vue3";
export default defineComponent( {
    props: ["empresas", "cliente", "convenios"],
    components: {
        AppLayout,
        JetInputError,
        JetButton,
        Link
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
        nombre: this.cliente.nombre,
        apaterno:this.cliente.apaterno,
        amaterno:this.cliente.amaterno,

        curp:this.cliente.curp,
        email:this.cliente.email,
        sexo:this.cliente.sexo,
        rfc:this.cliente.rfc,

        telefono:this.cliente.telefono,
        celular:this.cliente.celular,


      })
        }
    },
    methods: {
        save() {
    props: ["empresas", "cliente"],
              this.form.put(route('clientes.update', this.cliente.id), {

        preserveScroll: true
      });
        }
    },
});
</script>

