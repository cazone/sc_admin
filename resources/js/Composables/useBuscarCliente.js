import { ref } from 'vue';
const useBuscarCliente = () => {
    const clienteSelectd=ref('');
    const loading=ref(false)
    const clientes=ref([])
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
     }
     return {
        clienteSelectd,
        loading,
        clientes,
        buscarCliente


    }
}
export default useBuscarCliente;
