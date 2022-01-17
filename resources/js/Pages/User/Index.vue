<template>
    <app-layout title="Usuarios">
        <template #header>
            <h2 class="h4 font-weight-bold">Usuarios</h2>
        </template>
  <el-card class="box-card">
    <template #header>
      <div class="card-header">
         <el-input v-model="BuscarUser.search" @keypress.enter="buscar" style="width: 50%" placeholder="Buscar Usuario" />
       <el-button @click="nuevo">Nuevo</el-button>
      </div>
    </template>
        <el-table :data="usuarios.data" stripe style="width: 100%">
            <el-table-column prop="id" label="ID" width="180" />
            <el-table-column prop="name" label="Nombre" width="180" />
            <el-table-column prop="roles" label="Rol" width="180">
                <template #default="scope">
                    <el-tag
                        size="small"
                        v-for="role in scope.row.roles"
                        key="role.id"
                        >{{ role.name }}</el-tag
                    >
                </template>
            </el-table-column>
            <el-table-column prop="email" label="Correo" />
            <el-table-column fixed="right" label="Operations" width="120">
                <template #default="scope">
                    <el-button
                        type="text"
                        size="small"
                        @click="eliminarShow(scope.row.id)"
                        >Eliminar</el-button
                    >
                    <el-button
                        @click="modificar(scope.row)"
                        type="text"
                        size="small"
                        >Editar</el-button
                    >
                </template>
            </el-table-column>
        </el-table>
        <el-divider></el-divider>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li
                    v-for="link in usuarios.links"
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

        <el-dialog
            v-model="dialogVisible"
            :title="titleDialog"
            :close-on-click-modal="false"
        >
            <el-form
                label-position="top"
                ref="userFormRef"
                :model="userForm"
                :rules="rules"
                label-width="120px"
                class="demo-ruleForm"
            >
                <el-form-item label="Nombre" prop="name">
                    <el-input v-model="userForm.name"></el-input>
                </el-form-item>
                <el-form-item label="Correo" prop="email">
                    <el-input v-model="userForm.email"></el-input>
                </el-form-item>
            </el-form>
            <template #footer>
                <span class="dialog-footer">
                    <el-button @click="dialogVisible = false"
                        >Cancelar</el-button
                    >
                    <el-button type="primary" @click="submitForm('userForm')"
                        >Guardar</el-button
                    >
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
import { defineComponent, ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
export default defineComponent({
    props: ["usuarios"],
    components: {
        AppLayout,
        Link,
    },
    setup() {
        let url = ""
        let method = ""
        let elimar_id = ""
        const BuscarUser = ref({
            search: null
        })

        const dialogEliminar=ref(false)
        const titleDialog = ref("")
        const userFormRef = ref(null)
        const dialogVisible = ref(false)
        const userForm = ref({
            id: "",
            name: "",
            email: "",
        });

        const rules = ref({
            name: [
                {
                    required: true,
                    message: "El campo nombre es requerido",
                    trigger: ["blur", "change"],
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
        });

        const modificar = (row) => {
            url =route('user.update',row.id)
            method = 'put'
            titleDialog.value = "Editar Usuario";
            dialogVisible.value = true;
            userForm.value.name = row.name;
            userForm.value.email = row.email;
            userForm.value.id = row.id;
        };
        const eliminarShow = (row) => {
            dialogEliminar.value = true 
            elimar_id = row

        }
        const eliminar = () =>{
            Inertia.delete(route("user.destroy", elimar_id))
            dialogEliminar.value = false 
        }

        const buscar = () => {
            Inertia.get(route("user.index"), BuscarUser.value)
        }
        const nuevo = () => {
          
            url =route('user.store')
            method = 'post'
            titleDialog.value = "Nuevo Usuario";
            dialogVisible.value = true;
            userForm.value.name = "";
            userForm.value.email = "";
        };

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
            dialogVisible,
            userForm,
            submitForm,
            rules,
            userFormRef,
            eliminar,
            modificar,
            titleDialog,
            nuevo,
            BuscarUser,
            buscar,
            dialogEliminar,
            eliminarShow

        };
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
