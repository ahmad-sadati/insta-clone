<template>
  <q-page padding>
    <!-- content -->
    <div class="row q-col-gutter-md">
      <div class="col-12">
        <q-input
          prefix="+98"
          v-model="appData.mobile"
          type="mobile"
          label="mobile"
        />
      </div>
      <div class="col-12">
        <q-btn
          class="full-width"
          rounded
          color="blue"
          unelevated
          @click="login"
          label="Submit"
        />
      </div>
    </div>
  </q-page>
</template>

<script>
import { reactive, toRefs } from "vue";
import { api } from "src/boot/axios";
import { useRouter } from "vue-router";
import { useQuasar } from "quasar";
import { useAppDataStore } from "src/stores/appData";
export default {
  // name: 'PageName',
  setup() {
    const appData = useAppDataStore();
    const router = useRouter();
    const $q = useQuasar();
    const props = reactive({
      password: null,
      mobile: null,
    });
    function login() {
      api
        .post("api/verify", {
          mobile: appData.mobile,
        })
        .then((r) => {
          console.log(r.data);
          if (r.data.status) {
            router.push("/confirm");
          } else {
            $q.notify({
              message: "Error!",
              color: "negative",
              position: "top",
            });
          }
        });
    }
    // function login() {
    //   api
    //     .post("oauth/token", {
    //       username: props.email,
    //       password: props.password,
    //       grant_type: "password",
    //       client_id: 2,
    //       client_secret: "EimcrDxxFW2ynSbcwjW9Uf13zXDW4N5dGj1xm6lw",
    //     })
    //     .then((r) => {
    //       if (r.data.access_token) {
    //         $q.notify({
    //           message: "Welcome!",
    //           color: "positive",
    //           position: "top",
    //         });
    //         $q.cookies.set("access_token", r.data.access_token);
    //         $q.cookies.set("refresh_token", r.data.refresh_token);
    //         $q.cookies.set("expires_in", r.data.expires_in);
    //         api.defaults.headers.common = {
    //           Authorization: "Bearer " + r.data.access_token,
    //           "Content-Type": "application/json",
    //           Accept: "application/json;charset=UTF-8",
    //         };
    //         router.push("/");
    //       } else {
    //         $q.notify({
    //           message: e.response.data.message,
    //           color: "negative",
    //         });
    //       }
    //     });
    // }
    return {
      ...toRefs(props),
      login,
      appData,
    };
  },
};
</script>
