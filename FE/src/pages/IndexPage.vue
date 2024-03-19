<template>
  <q-page class="flex flex-center">
    <div v-if="userData">
      {{ appData.phone.number }}
    </div>
    <q-btn
      class="full-width"
      color="blue"
      rounded
      label="Register"
      @click="$router.push('/register')"
    />
  </q-page>
</template>

<script>
import { api } from "src/boot/axios";
import { useAppDataStore } from "src/stores/appData";
import { defineComponent, reactive, toRefs } from "vue";
export default defineComponent({
  name: "IndexPage",
  setup() {
    const appData = useAppDataStore();
    const props = reactive({
      userData: null,
    });
    function fetchMe() {
      api.get("api/user").then((r) => {
        props.userData = r.data;
        appData.userDetail = r.data;
      });
    }
    fetchMe();
    return {
      ...toRefs(props),
      appData,
    };
  },
});
</script>
