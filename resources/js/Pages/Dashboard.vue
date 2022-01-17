<template>
  <app-layout title="Dashboard">
    <template #header>
    <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col">
                        <small class="text-muted">Bienvenido de nuevo</small>
                        <h1 class="h4 mt-1">Dashboard</h1>
                    </div>
                    <!-- <div class="col-auto">
                        <a href="https://themeforest.net/user/wrraptheme" title="Download" target="_blank" class="btn btn-white border lift">Download</a>
                        <button type="button" class="btn btn-dark lift">Generate Report</button>
                    </div> -->
                </div>
            </div>
    </template>

  
  </app-layout>
</template>

<script>
import { defineComponent } from "vue"
import AppLayout from "@/Layouts/AppLayout.vue"

export default defineComponent({
  components: {
    AppLayout,
    
  }
});
</script>
