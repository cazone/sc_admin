<template>
    <app-layout title="Nuevo Adelanto">

    <template #header>
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="h4 mt-1">Nuevo Adelanto</h1>
                    </div>
                    <!-- <div class="col-auto">
                        <a href="https://themeforest.net/user/wrraptheme" title="Download" target="_blank" class="btn btn-white border lift">Download</a>
                        <button type="button" class="btn btn-dark lift">Generate Report</button>
                    </div> -->
                </div>
            </div>
    </template>
               <div class="row g-3">
                    <div class="col-12">
                        <div class="card mb-1">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center flex-column flex-md-row">
                                    <img src="" alt="" class="rounded-circle">
                                    <div class="media-body ms-md-5 m-0 mt-4 mt-md-0 text-md-start text-center">
{{clienteSelectd.id}}
                                         <el-select
    v-model="clienteSelectd"
    filterable
    remote
    reserve-keyword
    placeholder="Buscar cliente"
    :remote-method="buscarCliente"
    :loading="loading"
  >
    <el-option
      v-for="item in clientes"
      :key="item.id"
      :label="item.nombre"
      :value="item"
    >
    </el-option>
  </el-select>
  <el-divider></el-divider>
<div v-if="clienteSelectd.convenio">
                                        <h5 class="fw-bold mb-1">{{clienteSelectd.nombre}} {{clienteSelectd.apaterno}} {{clienteSelectd.amaterno}}</h5>
                                        <div class="text-muted mb-1"><i class="fa fa-phone"></i> Tel: {{clienteSelectd.telefono}}</div>
                                        <div class="text-muted mb-1"><i class="fa fa-phone"></i> Cel: {{clienteSelectd.celular}}</div>
                                        <div class="text-muted mb-3"><i class="fa fa-envelope"></i> {{clienteSelectd.email}}</div>
                                        <div v-if="clienteSelectd.convenio" class="text-muted mb-3"><i class="fa fa-info"></i> Convenio {{clienteSelectd.convenio.nombre}}</div>
                                    </div>
                                    <div v-else>
                                          <h5 class="fw-bold mb-1">No hay ningun cliente seleccionado</h5>
                                    </div>
                                    </div>
                                    <ul  v-if="clienteSelectd.convenio" class="d-lg-flex d-block ms-3 resume-box agent-profile">
                                        <li class="d-flex mb-lg-0 mb-3">
                                            <div class="icon text-center"><i class="fa fa-money"></i></div>
                                            <div class="ms-2">
                                                <div class="fw-bold mb-0">Dispercion</div>
                                                <span v-if="clienteSelectd.convenio"> {{numeralFormat(clienteSelectd.convenio.dispencion , '0.00')}} %</span>
                                            </div>
                                        </li>
                                        <li class="d-flex mb-lg-0 mb-3">
                                            <div class="icon text-center">
                                                <i class="fa fa-money"></i>
                                            </div>
                                            <div class="ms-2">
                                                <div class="fw-bold mb-0">Anticipo</div>
                                                 <span v-if="clienteSelectd.convenio"> {{numeralFormat(clienteSelectd.convenio.anticipo , '0.00') }} %</span>
                                            </div>
                                        </li>
                                        <!-- <li class="d-flex mb-lg-0 mb-3">
                                            <div class="icon text-center">
                                                <i class="fa fa-dollar"></i>
                                            </div>
                                            <div class="ms-2">
                                                <div class="fw-bold mb-0">INCOME</div>
                                                <span>$3,295</span>
                                            </div>
                                        </li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="clienteSelectd.convenio" class="col-12">
                        <ul class="nav nav-tabs tab-body-header rounded d-inline-flex">
                            <li class="nav-item"><a class="nav-link active show" data-bs-toggle="tab" href="#Company_Settings">Detalles</a></li>
                            <li class="nav-item">  <a class="nav-link" data-bs-toggle="tab" href="#Notifications"><el-badge :value="referencias.length" class="item" type="warning">Referencias </el-badge> </a></li>

                        </ul>
                        <div class="tab-content mt-3">
                            <div class="tab-pane active show" id="Company_Settings">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="card-title">Configuraci&oacute;n del prestamo</h5>
                                    </div>
                                    <div class="card-body">
                                        <form class="row g-4">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label"> </label>

                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label">Fecha del primer pago</label>

                                                      <el-date-picker
                                         format="YYYY-MM-DD"
                                         value-format="YYYY-MM-DD"
                                        style="width:100%" v-model="fecha_inicio" type="date" placeholder="Selecciona la fecha">
                                        </el-date-picker>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label">Monto del credito </label>
                                                      <el-input v-model="prestamo" placeholder="Cantidad a dispersar" />
                                                </div>
                                            </div>
                                              <div class="table-responsive">
                                                <table class="table table-lg table-nowrap card-table mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td>Dispersion</td>
                                                            <td>{{numeralFormat(dispersion , '$0,0.00') }}</td>
                                                            <td><span v-if="clienteSelectd.convenio" class="badge bg-success">{{numeralFormat(clienteSelectd.convenio.dispencion , '0.00') }} %</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Anticipo</td>
                                                            <td>{{numeralFormat(anticipo , '$0,0.00') }}</td>
                                                             <td><span v-if="clienteSelectd.convenio" class="badge bg-success">{{numeralFormat(clienteSelectd.convenio.anticipo , '0.00') }} %</span></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Mensaje al cliente</label>
                                                   <el-input
                                                      v-model="mensaje"
                                                      :rows="2"
                                                      type="textarea"
                                                      placeholder=""
                                                    />
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="Notifications">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Datos de referencias personales</h5>
                                    </div>
                                    <div class="card-body">
                                        <button type="button"  @click="nuevo" class="btn btn-light-primary">Agregar nueva referencia</button>
<el-table :data="referencias" style="width: 100%">
    <el-table-column prop="nombre_completo" label="Nombre Completo"  />
    <el-table-column prop="email" label="Correo"  />
    <el-table-column prop="telefono" label="Télefono" />
    <el-table-column prop="celular" label="Celular" />
    <el-table-column label="Parentesco">
        <template #default="scope">
            {{scope.row.parentesco.nombre}}
        </template>
    </el-table-column>
     <el-table-column fixed="right" label="" width="180">
                <template #default="scope">


                       <el-tooltip content="Eliminar este cliente" placement="top">
                                       <el-button
                     type="danger"
                         size="mini"
@click="eliminarShow(scope.row.id)"
                        >Eliminar</el-button
                    >
   </el-tooltip>


                </template>
            </el-table-column>

  </el-table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> <!-- Row end  -->

  <el-dialog
            v-model="dialogVisible"
            :title="titleDialog"

            :close-on-click-modal="false"
        >
          <el-form ref="refeFormRef" :model="refeForm"
           label-position="top"
                :rules="rules"
                label-width="120px">
                <el-form-item label="Nombre" prop="nombre">
                    <el-input v-model="refeForm.nombre"></el-input>

                </el-form-item>
                <el-form-item label="Telefono" prop="telefono">
                    <el-input v-model.number="refeForm.telefono"
                     ></el-input>
                </el-form-item>
                <el-form-item label="Celular" prop="celular">
                    <el-input v-model.number="refeForm.celular"></el-input>
                        {{ refeForm.errors.email }}
                </el-form-item>
                <el-form-item label="Correo" prop="email">
                    <el-input v-model="refeForm.email"></el-input>
                </el-form-item>
                <el-form-item label="Parentesco" prop="parentesco_id">
                     <el-select v-model="refeForm.parentesco_id"  placeholder="Select" size="large">
                        <el-option
                          v-for="item in parentesco"
                          :key="item.id"
                          :label="item.nombre"
                          :value="item.id"
                        >
                        </el-option>
                      </el-select>
                </el-form-item>
            </el-form>





            <template #footer>
                <span class="dialog-footer">
                    <el-button @click="dialogVisible = false"
                        >Cancelar</el-button
                    >
                     <!-- <el-button @click="submitForm"
                        >Guardar</el-button
                    > -->

                              <jet-button class="ms-2" @click="submitForm" :class="{ 'text-white-50': refeForm.processing }" :disabled="refeForm.processing">
            <div v-show="refeForm.processing" class="spinner-border spinner-border-sm" role="status">
              <span class="visually-hidden">Cargando...</span>
            </div>

            Guardar
          </jet-button>

                </span>
            </template>
        </el-dialog>
<el-dialog v-model="dialogEliminar" title="Eliminar" width="30%">
    <span
      >¿Estas seguro de eliminar?</span
    >
    <template #footer>
      <span class="dialog-footer">
        <el-button @click="dialogEliminar = false">Cancelar</el-button>
        <el-button type="primary" @click="eliminar"
          >Confirmar</el-button
        >
      </span>
    </template>
  </el-dialog>
    </app-layout>
</template>

<script>
import { defineComponent, ref, watch , onMounted} from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetInputError from '@/Jetstream/InputError.vue';
import JetButton from '@/Jetstream/Button.vue';
import { Inertia } from "@inertiajs/inertia";
import { useForm } from '@inertiajs/inertia-vue3'
import { ElMessage } from 'element-plus'


var numeral = require("numeral");
export default defineComponent( {
    props: ["empresas", "convenios","parentesco"],
    components: {
        AppLayout,
        JetInputError,
        JetButton
    },
    setup(){
      onMounted(() => {
      console.log('mounted!')
            })
        const dialogEliminar=ref(false)
        const titleDialog = ref("")
        const refeFormRef = ref(null)
        const referencias = ref([])
        let url= ''
        let method= ''
   let elimar_id = ""
        const eliminarShow = (row) => {
            dialogEliminar.value = true
            elimar_id = row

        }
        const eliminar = async() =>{
            Inertia.delete(route("referencia.destroy", elimar_id),{
                preserveScroll: true,
                  onSuccess: () => {
                       ElMessage({
            message: 'Referencia eliminada',
            type: 'success',
            })
                      buscarReferencias()},
        onError: () => console.log('error'),
        onFinish: () => console.log('finish'),
            })
            dialogEliminar.value = false
        }
          const rules = ref({
            nombre: [
                {
                    required: true,
                    message: "El campo nombre es requerido",
                    trigger: ["blur", "change"],
                },
            ],
            parentesco_id: [
                {
                    required: true,
                    message: "El campo parentesco es requerido",
                  trigger: 'change',
                },
            ],
            email: [
                {
                    type: "email",
                    required: true,
                    message: "El campo email es requerido",
                    trigger: ["blur", "change"],
                },
            ],

             telefono: [
                 {
                    required: true,
                    message: "El campo telefono es requerido",
                    trigger: ["blur", "change"],
                 },
                {
                    type: "number",
                     message: "El campo debe ser numerico",
                    trigger: ["blur", "change"],
                },
            ],
        });


        const dialogVisible = ref(false)
        const refeForm = useForm({
            id: "",
            nombre: "",
            telefono:"",
            celular: "",
            email: "",
            parentesco_id:""

        });
        const nuevo = () => {
            refeForm.reset()
            url =route('referencia.store')
            method = 'post'
            titleDialog.value = "Nueva referencia";
            dialogVisible.value = true;


        };
        const submitForm =  () => {
            refeForm.id= clienteSelectd.value.id
            refeFormRef.value.validate(async (valid) => {
                if (valid) {
                   refeForm.post(url, {
        preserveScroll: true,
        onSuccess: () => {
             ElMessage({
            message: 'Referencia guardada',
            type: 'success',
            })
            buscarReferencias()},
        onError: () => console.log('error'),
        onFinish: () => console.log('finish'),
      })

      refeForm.reset()
                     dialogVisible.value = false;
                } else {
                    return false;
                }
            });
        };



           const fecha_inicio=ref('')
           const mensaje=ref('')
           const dispersion=ref(0)
           const anticipo=ref(0)
           const prestamo=ref('')
           const clienteSelectd=ref('')
           const loading=ref(false)
           const clientes=ref([])
           const buscarReferencias = async()=>{
              let id =clienteSelectd.value.id;
              const {data} =  await axios.get(route('referencia.show',{
                   id
                   }))
                   referencias.value=data;
                   console.log(referencias.value);
           }
           const buscarCliente = async(query) =>{
           loading.value = true;

             if(query !== ''){
                  const {data } =  await axios.get('/clientes/'+query)

                  clientes.value  = data;

                  loading.value  = false;
             }else{
                 clientes.value = []
                  loading.value  = false;
             }
watch(
   prestamo, (val) => {
                 let porcentaje = (clienteSelectd.value.convenio.dispencion / 100)
                 let porcentajeAnticipo = (clienteSelectd.value.convenio.anticipo / 100)
                dispersion.value = (1-porcentaje)*val
                anticipo.value = (1+porcentajeAnticipo)*val
                mensaje.value =`El monto aprobado son MX$${numeral(val).format("0,0")}, el monto a dispersar es de MX$${numeral(dispersion.value).format("0,0")}, el monto a pagar es de MX$${numeral(anticipo.value).format("0,0")} y la fecha de pago es el ${fecha_inicio.value}. ¿Estas de acuerdo?`
          }
)
          watch(
              clienteSelectd, ()=>{

                  buscarReferencias()
              }

             )

        };

        return {
            fecha_inicio,
            mensaje,
            dispersion,
            anticipo,
            prestamo,
            clienteSelectd,
            loading,
            clientes,
            buscarCliente,
            titleDialog,
            dialogVisible,
            refeForm,
            nuevo,
            submitForm,
            refeFormRef,
            rules,
            referencias,
            eliminarShow,
            eliminar,
            dialogEliminar,
        }
    }
    // data() {
    //     return {
    //         mensaje:'',
    //         fecha_inicio:'',
    //         dispersion :0 ,
    //         anticipo:0,
    //         prestamo:'',
    //         clienteSelectd:'',
    //         loading: false,
    //         clientes:[],
    //         form: this.$inertia.form({
    //            nombre: '',
    //   })
    //     }
    // },
    // watch: {
    //     prestamo: function (val) {
    //       console.log(val)
    //       let porcentaje = (this.clienteSelectd.convenio.dispencion / 100)
    //       let porcentajeAnticipo = (this.clienteSelectd.convenio.anticipo / 100)
    //      this.dispersion = (1-porcentaje)*val
    //      this.anticipo = (1+porcentajeAnticipo)*val
    //      this.mensaje =`
    //      El monto aprobado son MX$${numeral(val).format("0,0")}, el monto a dispersar es de MX$${numeral(this.dispersion).format("0,0")}, el monto a pagar es de MX$${numeral(this.anticipo).format("0,0")} y la fecha de pago es el ${this.fecha_inicio}. ¿Estas de acuerdo?
    //      `
    //     }
    // },
    // methods: {
    //    async buscarCliente(query){
    //        this.loading = true;
    //         console.log(query);
    //          if(query !== ''){
    //               const {data } =  await axios.get('/clientes/'+query)
    //               this.clientes = data;
    //               console.log(this.clientes);
    //               this.loading = false;
    //          }else{
    //              this.clientes= []
    //               this.loading = false;
    //          }
    //     },
    //     save() {
    //           this.form.post(route('clientes.store'), {

    //     preserveScroll: true
    //   });
    //     }
    // },
});
</script>

