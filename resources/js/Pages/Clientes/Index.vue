<template>
    <app-layout title="Clientes">
        <template #header>
           <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col">
                        <small class="text-muted">Listado </small>
                        <h1 class="h4 mt-1">Clientes</h1>
                    </div>
                    <div class="col-auto">
                        <Link :href="route('clientes.create')" >
                        <a title="Nuevo Cliente"  class="btn btn-white border lift">Nuevo Cliente</a>
                        </Link>
                        <!-- <button type="button" class="btn btn-dark lift">Generate Report</button> -->
                    </div>
                </div>
            </div>
        </template>


      <el-card class="box-card">
    <template #header>
      <div class="card-header">
           <el-input
      v-model="BuscarUser.search"
      @keypress.enter="buscar"
      placeholder="Ingresa el nombre del cliente a buscar"
      class="input-with-select"
    >

       <template #append>
         <el-button @click="limpiar">Limpiar</el-button>
      </template>

    </el-input>
         <!-- <el-input v-model="BuscarUser.search" @keypress.enter="buscar" style="width: 50%" placeholder="Buscar Cliente" /> -->

      </div>
    </template>
        <el-table :data="clientes.data" stripe style="width: 100%">

        <el-table-column  fixed  prop="id" label="ID"  width="50"  />
            <el-table-column fixed prop="nombre" label="Nombre"  />
            <el-table-column fixed prop="apaterno" label="Apellido Paterno"/>
            <el-table-column prop="amaterno" label="Apellido Materno"  />
            <el-table-column prop="email" label="Correo"  />
            <el-table-column prop="rfc" label="RFC" />

            <el-table-column prop="celular" label="Celular" />
             <el-table-column prop="telefono" label="Telefono" />
            <el-table-column fixed="right" label="" >
                <template #default="scope">

                     <el-tooltip content="Actualizar información de cliente" placement="top">
                    <el-button
                  @click="editar(scope.row.id)"
                         size="mini"
                         type="primary"
                        >Editar</el-button
                    >
                     </el-tooltip>
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
        <el-divider></el-divider>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li
                    v-for="link in clientes.links"
                    class="page-item"
                    :class="{ active: link.active }"
                >
                    <Link
                        class="page-link"
                        :href="link.url"
                        v-html="link.label"
                    ></Link>
                </li>

            </ul>
        </nav>
  </el-card>
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
import { defineComponent, ref, onMounted } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import { ElMessage } from 'element-plus'
let self;
export default defineComponent({
    props: ["clientes"],
    components: {
        AppLayout,
        Link,
        ElMessage,
    },

    setup() {

       onMounted(() => {

         if(self.$page.props.flash.success){
           ElMessage({
            message: self.$page.props.flash.success,
            type: 'success',
            })
         }

       })
        let elimar_id = ""
        const BuscarUser = ref({
            search: null,
        })

        const dialogEliminar=ref(false)
        const eliminarShow = (row) => {
            dialogEliminar.value = true
            elimar_id = row

        }
        const eliminar = () =>{
            Inertia.delete(route("clientes.destroy", elimar_id))
            dialogEliminar.value = false
        }
        const limpiar = () => {
            Inertia.get(route("clientes.index"), '')
        }

        const buscar = () => {
            Inertia.get(route("clientes.index"), BuscarUser.value)
        }
        const editar = (id) => {
            Inertia.visit(route("clientes.edit", id))
        }



        const submitForm = () => {
            userFormRef.value.validate(async (valid) => {
                if (valid) {
                    await Inertia.visit(url,{
                    method,
                    data: userForm.value
                    });
                    dialogVisible.value = false;
                } else {
                    return false;
                }
            });
        };
        return {
            eliminar,
            BuscarUser,
            buscar,
            dialogEliminar,
            eliminarShow,
            limpiar,
            editar

        };
    },
    created () {
        self = this
    },

});
</script>
<style scoped>
.card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.text {
  font-size: 14px;
}

.item {
  margin-bottom: 18px;
}

.box-card {
  width: 100%;
}
</style>
