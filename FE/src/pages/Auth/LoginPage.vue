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
        <q-btn @click="login" label="Log in" />
      </div>
    </div>
  </q-page>
</template>

<script>
import { api } from "src/boot/axios";
import router from "src/router";
import { useRouter } from "vue-router";

export default {
  // name: 'PageName',
  setup() {
    const router = useRouter();
    const $q = useQuasar();
    const props = reactive({
      email: null,
      password: null,
    });
    function login() {
      api
        .post("oauth/token", {
          username: props.email,
          password: props.password,
          client_id: 2,
          client_secret: "EimcrDxxFW2ynSbcwjW9Uf13zXDW4N5dGj1xm6lw",
        })
        .then((r) => {
          if (r.data.access_token) {
            $q.notify({
              message: "Welcome!",
              color: "positive",
              position: "top",
            });
            $q.cookies.set("access_token", r.data.access_token);
            $q.cookies.set("refresh_token", r.data.refresh_token);
            $q.cookies.set("expires_in", r.data.expires_in);
            router.push("/");
          } else {
            $q.notify({
              message: "Try again.",
              color: "negative",
            });
          }
        });
    }
    return {
      ...toRefs(props),
      login,
    };
  },
};
</script>
