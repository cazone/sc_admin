<template>
  <app-layout title="Dashboard">
    <div class="common-layout">
 <el-container>
      <el-aside width="400px">Aside</el-aside>
      <el-container>
        <el-header> <el-button type="primary" style="margin-left: 16px" @click="drawer = true">
    open
  </el-button></el-header>
        <el-main>Main</el-main>
        <el-footer>Footer</el-footer>
      </el-container>
    </el-container>
    </div>

     <el-drawer v-model="drawer" title="Categorias de productos" >
    <span>Hi there!</span>
  </el-drawer>



  </app-layout>
</template>
<script  setup>
import { defineComponent } from "vue"
import AppLayout from "@/Layouts/AppLayout.vue"
import { ref } from 'vue'

const drawer = ref(false)
</script>

<style scoped>
.common-layout .el-header,
.common-layout .el-footer {
  background-color: #b3c0d1;
  color: var(--el-text-color-primary);
  text-align: center;
  line-height: 60px;
}
.common-layout .el-footer {
  line-height: 60px;
}

.common-layout .el-aside {
  background-color: #d3dce6;
  color: var(--el-text-color-primary);

}

.common-layout .el-main {
  background-color: #e9eef3;
  color: var(--el-text-color-primary);
  text-align: center;
  line-height: 500px;
}

.common-layout > .el-container {
  margin-bottom: 40px;
}

.common-layout .el-container:nth-child(5) .el-aside,
.common-layout .el-container:nth-child(6) .el-aside {
  line-height: 500px;
}

.common-layout .el-container:nth-child(7) .el-aside {
  line-height: 500px
}
</style>
