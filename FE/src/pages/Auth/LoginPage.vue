<template>
  <q-page padding>
    <!-- content -->
    <div class="row">
      <div class="col12">
        <q-input v-model="email" />
      </div>
      <div class="col12">
        <q-input v-model="password" type="password" />
      </div>
      <div class="col12">
        <q-btn @click="login" label="Log in"/>
      </div>
    </div>
  </q-page>
</template>

<script>
import { api } from 'src/boot/axios';

export default {
  // name: 'PageName',
  setup (){
    const props = reactive({
      email:null,
      password:null,
    })
    function login (){
      api.post('api/login',{
        email: props .email,
        password: props.password,
        'client_id' : 2,
        client_secret:'EimcrDxxFW2ynSbcwjW9Uf13zXDW4N5dGj1xm6lw'
      })
      .then(r=>{

      })
    }
    return {
      ...toRefs(props),
      login,
    }
  }
};
</script>
