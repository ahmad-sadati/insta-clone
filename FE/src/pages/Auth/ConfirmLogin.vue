<template>
  <q-page padding>
    <!-- content -->
    <div class="row text-center">
      <div class="col-12">
        {{ appData.mobile }}
      </div>
      <div class="col-12">
        <q-input v-model="password" type="password" />
      </div>
      <div class="col-12">
        <q-btn @click="login" label="Log in" />
      </div>
    </div>
  </q-page>
</template>

<script>
import { api } from "src/boot/axios";
import { reactive, toRefs } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useQuasar } from "quasar";
import { useAppDataStore } from "src/stores/appData";

export default {
  // name: 'PageName',
  setup() {
    const appData = useAppDataStore();
    const router = useRouter();
    const $q = useQuasar();
    if (!appData.mobile) {
      router.push("/new-login");
    }
    const props = reactive({
      password: null,
    });
    function login() {
      api
        .post("oauth/token", {
          username: appData.mobile,
          password: props.password,
          grant_type: "password",
          client_id: 2,
          client_secret: "8YZfYBt060fiy4uQizKk4L17FAJpjaCgQxJXr2LK",
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
            api.defaults.headers.common = {
              Authorization: "Bearer " + r.data.access_token,
              "Content-Type": "application/json",
              Accept: "application/json;charset=UTF-8",
            };
            router.push("/");
          } else {
            $q.notify({
              message: e.response.data.message,
              color: "negative",
            });
          }
        });
    }
    return {
      ...toRefs(props),
      login,
      appData,
    };
  },
};
</script>
