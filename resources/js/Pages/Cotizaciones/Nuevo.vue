<template>
  <app-layout title="Dashboard">


                <div class="row g-3">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card print_invoice p-lg-5 p-4 mb-2">
                            <div class="card-header mb-1 fs-4">Nueva Cotizaci&oacute;n</div>
                            <div class="pt-3 border-top">
                                        <li>

                                            <div class="fw-bold mb-0">Buscar Cliente</div>
                                             <el-select
                                              v-model="clienteSelectd"
                                              filterable
                                              remote

                                              placeholder="Buscar cliente"
                                              :remote-method="buscarCliente"
                                              :loading="loading"
                                            >
                                            <el-option
                                              v-for="item in clientes"
                                              :key="item.id"
                                              :label="item.nombre + ' ' + item.apaterno + ' ' + item.amaterno"
                                              :value="item"
                                            >
                                            </el-option>
                                         </el-select>
                                        </li>

                                        <li>

                                            <div class="fw-bold mb-0">Nombre</div>
                                            <span>{{clienteSelectd.nombre}} {{clienteSelectd.apaterno}}</span>
                                        </li>
                                        <li>

                                            <div class="fw-bold mb-0">Telefono</div>
                                            <span>{{clienteSelectd.celular}}</span>
                                        </li>
                                        <li>

                                            <div class="fw-bold mb-0">Correo</div>
                                            <span>{{clienteSelectd.email}}</span>
                                        </li>

                                <!-- <div id="logo">
                                    <div id="logoctr">
                                        <a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>
                                        <a href="javascript:;" id="save-logo" title="Save changes">Save</a>
                                        |
                                        <a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>
                                        <a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>
                                    </div>
                                    <div id="logohelp">
                                        <input id="imageloc" type="text" size="50" value=""><br>
                                        (max width: 540px, max height: 100px)
                                    </div>
                                    <img id="image" src="" alt="logo">
                                </div> -->
                            </div>
                            <div style="clear:both"></div>
                            <div class="customer mt-4">

                                <!-- <textarea class="form-control customer-title">Widget Card. c/o List Widget</textarea> -->
                                <table class="meta">
                                    <tbody>

                                        <tr>
                                            <td class="meta-head">Fecha: </td>
                                            <td>
                                                 <el-date-picker
                     format="YYYY-MM-DD"
                     value-format="YYYY-MM-DD"

                     v-model="fecha"
                     type="date" placeholder="Selecciona la fecha ">
                    </el-date-picker>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div style="clear:both"></div>
                             <table class="items">
                                <tbody>
                                    <tr>
                                        <th>SKU</th>
                                        <th>URL imagen</th>
                                        <th>Proveedor</th>
                                        <th>Descripcion</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Utilidad %</th>
                                        <th>Utilidad</th>
                                        <th>Subtotal</th>
                                        <th>¿IVA?</th>
                                        <th>IVA</th>
                                        <th>Total</th>
                                        <th></th>

                                    </tr>
                                    <tr class="item-row">
                                        <td class="item-name">
                                            <el-input v-model="form.sku" placeholder="SKU" ></el-input>
                                        </td>
                                         <td class="item-name">
                                              <el-input v-model="form.url" placeholder="URL Imagen" ></el-input>
                                        </td>
                                         <td class="item-name">
                                              <el-select v-model="form.proveedor"  placeholder="Select" size="large">
                                                  <el-option
                                                    v-for="item in proveedores"
                                                    :key="item.id"
                                                    :label="item.nombre"
                                                    :value="item.id"
                                                  >
                                                  </el-option>
                                                </el-select>
                                        </td>
                                        <td class="description">
                                            <el-input v-model="form.descripcion" placeholder="Descripcion" ></el-input>
                                        </td>

                                        <td class="item-name">
                                            <el-input v-model="form.precio" placeholder="Precio" ></el-input>
                                        </td>
                                          <td class="delete-wp">
                                            <el-input-number v-model="form.cantidad" :min="1"  size="small" @change="cantidadChange" />
                                        </td>
                                          <td class="item-name" align="right">
                                             <el-input v-model="form.utilidad" placeholder="Utilidad" ></el-input>
                                        </td>
                                        <td class="item-name" align="right">
                                             <h5>$ {{numeralFormat(form.totalUtilidad,'0,0.00')}}</h5>

                                        </td>
                                         <td class="item-name" align="right">
                                             <h5>$ {{numeralFormat(form.subtotal,'0,0.00')}}</h5>

                                        </td>
                                        <td class="item-name" align="center">
                                            <el-checkbox v-model="form.isIva" label="SI" border @change="ivaChange" size="large"></el-checkbox>
                                        </td>
                                        <td class="item-name" align="right">
                                            <h5>$ {{numeralFormat(form.iva,'0,0.00')}}</h5>
                                        </td>
                                        <td class="item-name" align="right">
                                            <h5>$ {{numeralFormat(form.total,'0,0.00')}}</h5>
                                        </td>

                                        <td class="delete-wp">
                                                <button type="button"
                                                @click="addProductos()"
                                                 class="btn btn-link btn-sm text-success"
                                                 data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                 data-bs-original-title="Agregar" aria-label="Delete"
                                                 :disabled="form.total ==0">
                                                 <i class="fa fa-plus-square fa-2x"></i>
                                                 </button>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                            <table v-if="productos.length > 0" class="items">
                                <tbody>
                                    <tr>
                                        <th>#</th>
                                        <th>SKU</th>
                                        <th>Imagen</th>
                                        <th>URL imagen</th>
                                        <th>Proveedor</th>
                                        <th>Descripcion</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Utilidad %</th>
                                        <th>Utilidad</th>
                                        <th>Subtotal</th>
                                        <th>¿IVA?</th>
                                        <th>IVA</th>
                                        <th>Total</th>
                                    </tr>
                                    <tr class="item-row" v-for="(item, index)  in productos">
                                          <td class="delete-wpr">
                                              <a class="delete"  @click="delProdcuto(index)" title="Eliminar">
                                                    <i class="fa fa-close"></i>
                                              </a>
                                              {{index + 1}}
                                        </td>
                                        <td class="item-name">
                                            <el-input v-model="productos[index].sku" placeholder="SKU" ></el-input>
                                        </td>
                                        <td class="item-name" align="center">
                                             <el-image
                                                style="width: 100px; height: 100px"
                                                :src="item.url"
                                              ></el-image>
                                        </td>
                                         <td class="description">
                                              <el-input v-model="productos[index].url"
                                               autosize
                                               type="textarea"
                                               placeholder="URL Imagen" >
                                              </el-input>
                                        </td>
                                         <td class="item-name">
                                            <el-select v-model="productos[index].proveedor"  placeholder="Select" size="large">
                                              <el-option
                                                v-for="item in proveedores"
                                                :key="item.id"
                                                :label="item.nombre"
                                                :value="item.id"
                                              >
                                              </el-option>
                                            </el-select>
                                        </td>
                                        <td class="description">
                                            <el-input v-model="productos[index].descripcion"
                                                 autosize
                                                 type="textarea" placeholder="Descripcion" >
                                            </el-input>
                                        </td>

                                        <td class="item-name">
                                          <el-input
                                          v-model="productos[index].precio" placeholder="SKU" ></el-input>
                                        </td>
                                        <td class="item-name">
                                            <el-input-number v-model="productos[index].cantidad" :min="1"  size="small" />

                                        </td>
                                        <td class="item-name">
                                             <el-input v-model="productos[index].utilidad" placeholder="Utilidad" ></el-input>
                                        </td>
                                        <td class="item-name" align="right">
                                             <h5>$ {{numeralFormat(item.totalUtilidad,'0,0.00')}}</h5>

                                        </td>
                                         <td class="item-name" align="right">
                                          <h5>$ {{numeralFormat(item.subtotal,'0,0.00')}}</h5>
                                        </td>
                                        <td class="item-name" align="center">
                                            <el-checkbox v-model="productos[index].isIva" label="SI" border size="large"></el-checkbox>
                                        </td>
                                        <td class="item-name" align="right">
                                            <h5>$ {{numeralFormat(item.iva,'0,0.00')}}</h5>
                                        </td>
                                        <td class="description" align="right">
                                            <h5>$ {{numeralFormat(item.total,'0,0.00')}}</h5>
                                        </td>

                                    </tr>

                                    <tr id="hiderow">

                                    </tr>

                                    <tr>
                                        <td colspan="11" class="blank"> </td>
                                        <td colspan="2" class="total-line">Subtotal</td>
                                        <td class="total-value" align="right"><div id="subtotal"><h5>$ {{numeralFormat(subtotal,'0,0.00')}}</h5></div></td>
                                    </tr>
                                    <tr>
                                        <td colspan="11" class="blank"> </td>
                                        <td colspan="2" class="total-line">IVA</td>
                                        <td class="total-value" align="right"><div id="total"><h5>$ {{numeralFormat(iva,'0,0.00')}}</h5></div></td>
                                    </tr>
                                    <tr>
                                        <td colspan="11" class="blank"> </td>
                                        <td colspan="2" class="total-line">Utilidad</td>
                                        <td class="total-value" align="right"><h5>$ {{numeralFormat(utilidad,'0,0.00')}}</h5></td>
                                    </tr>
                                    <tr>
                                        <td colspan="11" class="blank"> </td>
                                        <td colspan="2" class="total-line balance"><h4>Total</h4></td>
                                        <td class="total-value balance" align="right"><div class="due"><h4><strong>$ {{numeralFormat(total, '0,0.00')}}</strong></h4></div></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div style="clear:both"></div>
                            <div class="footer-note mt-5">
                                <h5>Terminos</h5>
                                <el-input v-model="terminos"
                                                 autosize
                                                 type="textarea" placeholder="Terminos o condiciones adicionales" >
                                            </el-input>
                            </div>
                        </div>
                         <jet-button @click="submit" :class="{ 'text-white-50': form.processing }"  :disabled="productos.length == 0  || clienteSelectd.length == 0">
                                            <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
                                              <span class="visually-hidden">Cargando...</span>
                                            </div>
                                            Crear Cotizaci&oacute;n
                                          </jet-button>
                    </div>
                </div> <!-- .row end -->



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
import { ElMessageBox, ElMessage } from 'element-plus'


const { clienteSelectd, loading,clientes,buscarCliente } = useBuscarCliente();
 const proveedores = computed(() => usePage().props.value.proveedores)


const productos = reactive([]);
const subtotal = ref(0);
const iva = ref(0);
const total = ref(0);
const utilidad = ref(0);
const terminos = ref('');

const fecha = ref(new Date().toISOString().slice(0, 10));
const form = ref({
    sku:'',
    descripcion: '',
    cantidad: 1,
    precio: 21099,
    isIva: true,
    iva:0,
    subtotal:0,
    total:0,
    utilidad: 15,
    totalUtilidad:0,
    proveedor:1,
    url:''
});
watch(
  () => productos,
  (newValue, oldValue) => {
    subtotal.value = 0;
    iva.value = 0;
    total.value = 0;
    utilidad.value = 0;
    productos.forEach(item => {

      if(item.isIva){
        item.iva = item.subtotal * 0.16;
      }else{
        item.iva = 0;
      }
      item.subtotal = item.cantidad * item.precio;
      item.totalUtilidad = item.subtotal * item.utilidad / 100;
      item.subtotal += item.totalUtilidad;
      item.total = item.subtotal  + item.iva  ;
      subtotal.value += item.subtotal;
      iva.value += item.iva;
      total.value += item.total;
      utilidad.value += item.totalUtilidad;

    });
  },
  { deep: true })

watch(()=>form.value.precio,(val)=>{

    form.value.subtotal = val * form.value.cantidad;
    form.value.totalUtilidad = form.value.subtotal * form.value.utilidad / 100;
    form.value.subtotal += form.value.totalUtilidad;
    ivaChange(form.value.isIva);
       form.value.total =  form.value.subtotal + form.value.iva;
})
watch(()=>form.value.utilidad,(val)=>{

    form.value.subtotal = form.value.precio * form.value.cantidad;
    form.value.totalUtilidad = form.value.subtotal * val / 100;
    form.value.subtotal += form.value.totalUtilidad;
    ivaChange(form.value.isIva);
       form.value.total =  form.value.subtotal + form.value.iva;
})
const delProdcuto =(index)=>{
    productos.splice(index,1);

}
const addProductos = () => {
 productos.push({...form.value});
  limpiar();
}
const cantidadChange = (value) => {
  form.value.subtotal = value * form.value.precio;
  form.value.totalUtilidad = form.value.subtotal * form.value.utilidad / 100;
  form.value.subtotal += form.value.totalUtilidad;
  ivaChange(form.value.isIva);
  form.value.total =  form.value.subtotal + form.value.iva;
}
const ivaChange = (value) => {
    if(value){
        form.value.iva = form.value.subtotal * 0.16;
        form.value.total = form.value.subtotal + form.value.iva;
    }else{
        form.value.iva = 0;
        form.value.total = form.value.subtotal + form.value.iva;
    }

//   form.value.iva = value * form.value.precio;
}
const limpiar = () => {
    form.value.sku = '';
    form.value.descripcion = '';
    form.value.cantidad = 1;
    form.value.precio = 0;
    form.value.isIva = true;
    form.value.iva = 0;
    form.value.subtotal = 0;
    form.value.total = 0;
    form.value.utilidad = 15;
    form.value.totalUtilidad = 0;
    form.value.proveedor = 1;
    form.value.url = '';
}
const submit = () => {
  console.log(form.value);
   Inertia.visit(route('cotizaciones.store'), {
  method: 'post',
    errorBag: 'createCotizacion',
  data: {
      fecha: fecha.value,
      subtotal: subtotal.value,
      utilidad: utilidad.value,
        iva: iva.value,
        terminos: terminos.value,
        cliente_id: clienteSelectd.value.id,
      total: total.value,
      productos
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
